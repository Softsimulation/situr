<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property DMotivosViaje $dMotivosViaje
 * @property DOpcionesNacimiento $dOpcionesNacimiento
 * @property DRangoEdade $dRangoEdade
 * @property DResidenciaVisitante $dResidenciaVisitante
 * @property DSexo $dSexo
 * @property DTiempo $dTiempo
 * @property int $id
 * @property int $motivo_id
 * @property int $opciones_nacimiento_id
 * @property int $rango_edades_id
 * @property int $residencia_visitante_id
 * @property int $sexo_id
 * @property int $tiempo_id
 * @property int $cantidad_datos
 * @property float $gasto_promedio
 * @property float $gasto_promedio_dia
 */
class H_Gasto_Medio_Receptor extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'h_gasto_medio_receptor';

    /**
     * @var array
     */
    protected $fillable = ['motivo_id', 'opciones_nacimiento_id', 'rango_edades_id', 'residencia_visitante_id', 'sexo_id', 'tiempo_id', 'cantidad_datos', 'gasto_promedio', 'gasto_promedio_dia'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dMotivosViaje()
    {
        return $this->belongsTo('App\DMotivosViaje', 'motivo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dOpcionesNacimiento()
    {
        return $this->belongsTo('App\DOpcionesNacimiento', 'opciones_nacimiento_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dRangoEdade()
    {
        return $this->belongsTo('App\DRangoEdade', 'rango_edades_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dResidenciaVisitante()
    {
        return $this->belongsTo('App\DResidenciaVisitante', 'residencia_visitante_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dSexo()
    {
        return $this->belongsTo('App\DSexo', 'sexo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dTiempo()
    {
        return $this->belongsTo('App\DTiempo', 'tiempo_id');
    }
}
