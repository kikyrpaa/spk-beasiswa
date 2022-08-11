<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{
    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    protected $fillable = [
        'nama',
        'username',
        'password',
        'username',
        'alamat',
        'tanggal_lahir',
        "tempat_lahir",
        'nilai_rapot',
        'foto_siswa',
        'foto_rapot',
        'sertifikat_prestasi',
        'sertifikat_hafidh',
        'status'
    ];
    use HasFactory, Notifiable;

    public function beasiswas() {
        return $this->belongsToMany(Beasiswa::class,'beasiswa_siswa','id_siswa','id_beasiswa');
    }
}
