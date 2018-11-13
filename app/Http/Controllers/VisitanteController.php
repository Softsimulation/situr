<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Atraccion_Favorita;
use App\Models\Actividad_Favorita;
use App\Models\Proveedor_Favorito;
use App\Models\Evento_Favorita;

class VisitanteController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('auth');
        $this->user = \Auth::user();
    }
    
    public function getMisfavoritos(){
        return view('visitante.misFavoritos');
    }
    
    
    public function getFavoritos(){
        $atracciones = Atraccion_Favorita::where('usuario_id', $this->user->id)
                        ->join('atracciones','atracciones_favoritas.atracciones_id','=','atracciones.id')
                        ->join('sitios_con_idiomas', function($join){
                            $join->on('atracciones.sitios_id', '=','sitios_con_idiomas.sitios_id')
                            ->where('sitios_con_idiomas.idiomas_id','=', 1);
                        })
                        ->join('multimedia_sitios', function($join){
                            $join->on('atracciones.sitios_id','=','multimedia_sitios.sitios_id')
                            ->where('multimedia_sitios.portada','=' ,true)->where('multimedia_sitios.tipo', '=' , false);
                        })
                        ->get(['atracciones_favoritas.atracciones_id as Id','sitios_con_idiomas.nombre as Nombre','multimedia_sitios.ruta as Ruta',\DB::raw(' 1  as Tipo')])->toArray();
                        
        $actividades = Actividad_Favorita::where('usuario_id', $this->user->id)
                        ->join('actividades_con_idiomas', function($join){
                            $join->on('actividades_favoritas.actividades_id', '=', 'actividades_con_idiomas.actividades_id')
                            ->where('actividades_con_idiomas.idiomas','=',1);
                        })
                        ->join('multimedias_actividades', function($join){
                            $join->on('multimedias_actividades.actividades_id', '=', 'actividades_favoritas.actividades_id')
                            ->where('multimedias_actividades.portada','=', true)->where('multimedias_actividades.tipo','=', false);
                        })
                        ->get(['actividades_favoritas.actividades_id as Id', 'actividades_con_idiomas.nombre as Nombre' ,'multimedias_actividades.ruta as Ruta' ,\DB::raw(' 2  as Tipo')])->toArray();
                        
        $proveedores = Proveedor_Favorito::where('usuario_id', $this->user->id)
                        ->join('proveedores', 'proveedores_favoritos.proveedores_id', '=', 'proveedores.id')
                        ->join('proveedores_rnt', 'proveedores_rnt.id', '=', 'proveedores.proveedor_rnt_id')
                        ->join('proveedores_rnt_idiomas', function($join){
                            $join->on('proveedores_rnt.id', '=', 'proveedores_rnt_idiomas.proveedor_rnt_id')
                            ->where('proveedores_rnt_idiomas.idioma_id','=', 1);
                        })
                        ->join('multimedias_proveedores', function($join){
                            $join->on('proveedores.id','=','multimedias_proveedores.proveedor_id')
                            ->where('multimedias_proveedores.portada','=' ,true)->where('multimedias_proveedores.tipo', '=' , false);
                        })
                        ->get([ 'proveedores.id as Id', 'proveedores_rnt_idiomas.nombre as Nombre', 'multimedias_proveedores.ruta as Ruta' ,\DB::raw(' 3  as Tipo') ])->toArray();
                        
        $eventos = Evento_Favorita::where('usuario_id', $this->user->id)
                    ->join('eventos_con_idiomas', function($join){
                        $join->on('eventos_con_idiomas.eventos_id', '=' , 'eventos_favoritas.eventos_id')
                        ->where('eventos_con_idiomas.idiomas_id', '=', 1);
                    })
                    ->join('multimedia_evento', function($join){
                        $join->on('eventos_favoritas.eventos_id', '=', 'multimedia_evento.eventos_id')
                        ->where('multimedia_evento.portada', '=', true)->where('multimedia_evento.tipo', '=', false);
                    })
                    ->get(['eventos_favoritas.eventos_id as Id', 'eventos_con_idiomas.nombre as Nombre', 'multimedia_evento.ruta as Ruta', \DB::raw(' 4  as Tipo') ])->toArray();
                    
        $favoritos = array_merge($atracciones,$actividades,$proveedores,$eventos);
        
        return ['favoritos' => $favoritos];
    }
    
}
