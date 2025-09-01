<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $table = 'anggota';

    protected $fillable = ['pos_damkar_id', 'nama', 'nik', 'no_register'];

    public function damkar()
    {
        return $this->belongsTo(Damkar::class, 'pos_damkar_id');
    }
    














    
}
