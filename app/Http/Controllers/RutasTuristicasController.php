<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Ruta;

class RutasTuristicasController extends Controller
{
    //
    public function getVer($id){
        if ($id == null){
            return response('Bad request.', 400);
        }elseif(Ruta::find($id) == null){
            return response('Not found.', 404);
        }
        
        $idioma = \Config::get('app.locale') == 'es' ? 1 : 2;
        
        $ruta = Ruta::where('id', $id)->with(['rutasConIdiomas' => function ($queryRutasConIdiomas) use ($idioma){
            $queryRutasConIdiomas->where('idioma_id', $idioma)->select('idioma_id', 'ruta_id', 'nombre', 'descripcion', 'recomendacion');
        }, 'rutasConAtracciones' => function ($queryRutasConAtracciones) use ($idioma){
            $queryRutasConAtracciones->with(['sitio' => function($querySitio) use ($idioma){
                $querySitio->with(['sitiosConIdiomas' => function($querySitiosConIdiomas) use ($idioma){
                    $querySitiosConIdiomas->where('idiomas_id', $idioma)->select('idiomas_id', 'sitios_id', 'nombre');
                }, 'multimediaSitios' => function($queryMultimediaSitios){
                    $queryMultimediaSitios->select('sitios_id', 'ruta')->orderBy('portada', 'desc')->where('tipo', false);
                }])->select('id', 'sitios_id');
            }])->select('id');
        }])->select('id', 'portada')->first();
        
        //return ['ruta' => $ruta];
        return view('rutas.Ver', ['ruta' => $ruta]);
    }
}
