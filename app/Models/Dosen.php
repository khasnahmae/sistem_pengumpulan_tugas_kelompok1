<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosens';
    protected $guarded = [''];
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }
    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class);
    }
    public function pengumpulan()
    {
        return $this->hasManyThrough(Pengumpulan::class, Tugas::class, 'id_dosens', 'id_tugas');
    }
    public function mapels()
    {
        return $this->hasMany(Mapel::class, 'id_dosens');
    }
}
