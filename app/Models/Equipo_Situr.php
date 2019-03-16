<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property EncuestasPstSostenibilidad $encuestasPstSostenibilidad
 * @property HabitacionesDiscapacidade[] $habitacionesDiscapacidades
 * @property int $encuestas_pst_sostenibilidad_id
 * @property int $numero_habitaciones
 */
class Equipo_Situr extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'equipo_situr';

    /**
     * The primary key for the model.
     * 
     * @var string
     */

    
    public $timestamps = false;
    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */


    /**
     * @var array
     */
    protected $fillable = ['numero_habitaciones','encuestas_pst_sostenibilidad_id'];


}
