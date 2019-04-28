<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sub_Lugar_Aplicacion_Receptor extends Model
{
    protected $table = 'sub_lugares_aplicacion_encuesta_receptor';
    
    protected $fillable = ['nombre', 'opcion_id', 'estado', 'codigo'];
    
}
