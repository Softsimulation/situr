<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property Visitante $visitante
 * @property int $visitante_id
 * @property string $nombre
 */
class Otra_Fuente_Informacion_Antes_Viaje extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'otras_fuente_informacion_antes_viaje';
    public $timestamps=false;

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'visitante_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    protected $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['nombre'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function visitante()
    {
        return $this->belongsTo('App\Visitante');
    }
}
