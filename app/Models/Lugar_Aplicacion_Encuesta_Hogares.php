<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lugar_Aplicacion_Encuesta_Hogares extends Model
{
    protected $fillable = ['id','nombre'];
    public $timestamps = false;
    
    protected $table = 'lugares_aplicacion_encuesta_hogares';
    
}
