<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Noticia;
use App\Models\Idioma;
use App\Models\Noticia_Idioma;
use App\Models\Multimedia_noticia;
use App\Models\Multimedia_noticia_Idioma;
use App\Models\Tipo_noticia;
use App\Models\Tipo_noticia_Idioma;
use App\Models\User;
use App;

class HomeController extends Controller
{
	
	public function getIndex(Request $request) {
	    
	    $noticias = Noticia::
        join('noticias_has_idiomas', 'noticias_has_idiomas.noticias_id', '=', 'noticias.id')
        ->join('tipos_noticias', 'tipos_noticias.id', '=', 'noticias.tipos_noticias_id')
        ->join('tipos_noticias_has_idiomas', 'tipos_noticias_has_idiomas.tipos_noticias_id', '=', 'tipos_noticias.id')
        ->where('noticias_has_idiomas.idiomas_id',1)->where('tipos_noticias_has_idiomas.idiomas_id',1)
        ->where('tipos_noticias.estado',1)
        ->select("noticias.id as idNoticia","noticias.enlace_fuente","noticias.es_interno","noticias.estado", "noticias.created_at as fecha",
        "noticias_has_idiomas.titulo as tituloNoticia","noticias_has_idiomas.resumen","noticias_has_idiomas.texto",
        "tipos_noticias.id as idTipoNoticia","tipos_noticias_has_idiomas.nombre as nombreTipoNoticia")->
        orderBy('fecha','DESC')->take(4)->get();
        
        $tiposNoticias = Tipo_noticia_Idioma::where('idiomas_id',1)->get();
        return view('home.index',array('noticias' => $noticias,"tiposNoticias"=>$tiposNoticias));
	}
	
}