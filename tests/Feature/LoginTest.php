<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_halaman_login_dapat_ditampilkan(): void
    {
        $this->get(route('login'))
            ->assertOk()
            ->assertSee('Masuk ke akun Anda')
            ->assertSee('Username');
    }

    public function test_guest_diarahkan_ke_halaman_login(): void
    {
        $this->get(route('home'))->assertRedirect(route('login'));

        $this->get(route('admin.dashboard'))->assertRedirect(route('login'));
        $this->get(route('user.dashboard'))->assertRedirect(route('login'));
    }

    public function test_admin_berhasil_login_dan_diarahkan_ke_dashboard_admin(): void
    {
        $admin = User::factory()->create([
            'username' => 'admin',
            'password' => 'password',
            'role' => 'admin',
        ]);

        $response = $this->post(route('login.store'), [
            'username' => 'admin',
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($admin);
        $response->assertRedirect(route('admin.dashboard'));

        $this->get(route('admin.dashboard'))->assertOk()->assertSee('Dashboard Admin');
    }

    public function test_mahasiswa_berhasil_login_dan_diarahkan_ke_dashboard_mahasiswa(): void
    {
        $mahasiswa = User::factory()->create([
            'username' => 'aji',
            'password' => 'password',
            'role' => 'mahasiswa',
        ]);

        $response = $this->post(route('login.store'), [
            'username' => 'aji',
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($mahasiswa);
        $response->assertRedirect(route('user.dashboard'));

        $this->get(route('user.dashboard'))->assertOk()->assertSee('Dashboard Mahasiswa');
    }

    public function test_login_gagal_dengan_password_salah(): void
    {
        User::factory()->create([
            'username' => 'user',
            'password' => 'password',
        ]);

        $response = $this->from(route('login'))->post(route('login.store'), [
            'username' => 'user',
            'password' => 'password-salah',
        ]);

        $this->assertGuest();
        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('username');
    }

    public function test_login_tidak_bisa_menggunakan_email(): void
    {
        User::factory()->create([
            'username' => 'aji',
            'email' => 'aji@student.ac.id',
            'password' => 'password',
        ]);

        $this->post(route('login.store'), [
            'username' => 'aji@student.ac.id',
            'password' => 'password',
        ])->assertSessionHasErrors('username');

        $this->assertGuest();
    }

    public function test_mahasiswa_tidak_bisa_mengakses_dashboard_admin(): void
    {
        $mahasiswa = User::factory()->create(['role' => 'mahasiswa']);

        $this->actingAs($mahasiswa)
            ->get(route('admin.dashboard'))
            ->assertForbidden();
    }

    public function test_admin_tidak_bisa_mengakses_dashboard_mahasiswa(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get(route('user.dashboard'))
            ->assertForbidden();
    }

    public function test_user_dapat_logout(): void
    {
        $user = User::factory()->create(['role' => 'mahasiswa']);

        $this->actingAs($user)
            ->post(route('logout'))
            ->assertRedirect(route('login'));

        $this->assertGuest();
    }
}
