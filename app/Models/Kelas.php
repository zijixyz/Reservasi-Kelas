<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    protected $fillable = ['nama_kelas', 'kapasitas', 'fasilitas', 'status'];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_kelas', 'id_kelas');
    }
}
