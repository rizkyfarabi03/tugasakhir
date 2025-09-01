<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Damkar extends Model
{
    use HasFactory;
    protected $fillable = ['nama_pos','alamat','kecamatan','telepon','latitude','longitude',]; // atau sesuaikan field aslinya

    public function anggota()
    {
        return $this->hasMany(Anggota::class, 'pos_damkar_id');
    }
}


