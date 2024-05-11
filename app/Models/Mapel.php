<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'mapels';
    protected $primaryKey ="id";
    protected $guarded = [''];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosens');
    }
}
