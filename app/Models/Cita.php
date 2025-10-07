<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';

    protected $fillable = [
        'nombre_dueno',
        'nombre_mascota',
        'servicio',
        'fecha',
        'hora',
        'motivo',
      //  'telefono',
       // 'correo',
    ];
}
