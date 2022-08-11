<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    protected $table = 'beasiswa';
    protected $primaryKey = 'id_beasiswa';
    use HasFactory;

    public function siswas(){
        return $this->belongsToMany(Siswa::class,'beasiswa_siswa','id_beasiswa','id_siswa');
    }
}
