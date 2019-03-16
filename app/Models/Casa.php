<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property Alojamiento $alojamiento
 * @property int $id
 * @property int $alojamientos_id
 * @property int $total
 * @property int $capacidad
 * @property int $promedio
 * @property float $habitaciones
 * @property float $tarifa
 * @property int $viajeros
 * @property int $viajeros_colombia
 * @property int $viajeros_extranjeros
 * @property int $total_huespedes
 * @property int $capacidad_ocupadas
 */
class Casa extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['alojamientos_id', 'total', 'capacidad', 'promedio', 'habitaciones', 'tarifa', 'viajeros', 'viajeros_colombia', 'viajeros_extranjeros', 'total_huespedes', 'capacidad_ocupadas','lugar_encuesta_id'];
    public $timestamps = false;
    
    protected $casts = [
        'tarifa' => 'float',
        'habitaciones' => 'int',
    ];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alojamiento()
    {
        return $this->belongsTo('App\Alojamiento', 'alojamientos_id');
    }
    
    public function lugarEncuesta()
    {
        return $this->belongsTo('App\Models\Lugar_Aplicacion_Encuesta_Hogares', 'lugar_encuesta_id');
    }
    
}
