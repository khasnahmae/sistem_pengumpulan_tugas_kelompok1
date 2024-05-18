<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelass';
    protected $primaryKey ="id";
    protected $guarded = [''];

    /**
     * Mendefinisikan relasi antara kelas dan dosen sebagai wali kelas.
     */
    public function waliKelas()
    {
        return $this->belongsTo(Dosen::class, 'wali_kelas');
    }

}
