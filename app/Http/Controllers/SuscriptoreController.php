<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Slider;
use App\Models\Idioma;
use App\Models\User;
use App\Models\Suscriptore;
use App\Models\Publicacione;
use App\Models\Tipo_Documento_Idioma;
use App\Models\Categoria_Documento_Idioma;


class SuscriptoreController extends Controller
{
    public function postGuardarsuscriptor(Request $request){
        //return $request->all();
        if(Suscriptore::where('email',$request->emailSuscriptor)->first() != null){
            return view('informes.ListadoInformesPublico', array(
               "informes"=> Publicacione::
                   join('publicaciones_idioma', 'publicaciones_idioma.publicaciones_id', '=', 'publicaciones.id')
                   ->join('tipo_documento_idioma', 'tipo_documento_idioma.tipo_documento_id', '=', 'publicaciones.tipo_documento_id')
                   ->join('categoria_documento_idioma', 'categoria_documento_idioma.categoria_documento_id', '=', 'publicaciones.categoria_doucmento_id')
                   ->where('publicaciones_idioma.idioma_id',1)
                   ->where('tipo_documento_idioma.idioma_id',1)
                   ->where('categoria_documento_idioma.idioma_id',1)
                   ->where(function($q)use($request){ if( isset($request->tipoInforme) && $request->tipoInforme != null ){$q->where('publicaciones.tipo_documento_id',$request->tipoInforme);}})
                    ->where(function($q)use($request){ if( isset($request->categoriaInforme) && $request->categoriaInforme != null ){$q->where('publicaciones.categoria_doucmento_id',$request->categoriaInforme);}})
                    ->where(function($q)use($request){ if( isset($request->buscar) && $request->buscar != null ){$q->where(strtolower('publicaciones_idioma.palabrasclaves'),'like','%',trim(strtolower($request->buscar)))
                                                                                                                   ->where(strtolower('publicaciones_idioma.nombre'),'like','%',trim(strtolower($request->buscar)))
                                                                                                                   ->where(strtolower('publicaciones_idioma.descripcion'),'like','%',trim(strtolower($request->buscar)))
                    ;}}) 
                    ->select("publicaciones.id","publicaciones.autores", "publicaciones.volumen", "publicaciones.portada", "publicaciones.ruta", "publicaciones.fecha_creacion", 
                        "publicaciones.fecha_publicacion", "tipo_documento_idioma.nombre as tipoInforme", "categoria_documento_idioma.nombre as categoriaInforme",
                        "publicaciones_idioma.palabrasclaves as palabrasClaves", "publicaciones_idioma.nombre as tituloInforme", "publicaciones_idioma.descripcion")
                    ->orderBy('id')->paginate(10),
                   
                   /*with([ "idiomas"=>function($q){ $q->with(['idioma'=>function($s){$s->where('id',1);}]); }, 
                                                 "tipo"=>function($q){ $q->with([ "tipoDocumentoIdiomas"=>function($qq){ $qq->where("idioma_id",1); } ]); }, 
                                                 "categoria"=>function($q){ $q->with([ "categoriaDocumentoIdiomas"=>function($qq){ $qq->where("idioma_id",1); } ]); } 
                                                ])
                                                ->where(function($q)use($request){ if( isset($request->tipoInforme) && $request->tipoInforme != null ){$q->where('tipo_documento_id',$request->tipoInforme);}})
                                                ->where(function($q)use($request){ if( isset($request->categoriaInforme) && $request->categoriaInforme != null ){$q->where('categoria_doucmento_id',$request->categoriaInforme);}})
                                                ->orderBy('id')->paginate(10),*/
               "tipos"=> Tipo_Documento_Idioma::with(['tipoDocumento'=>function($s){$s->where('estado',true);}])->where('idioma_id',1)->get(),
               "categorias"=> Categoria_Documento_Idioma::with(['categoriaDocumento'=>function($s){$s->where("estado",true);}])->where('idioma_id',1)->get(),
               "suscriptorExiste"=>"Ya el correo se encuentra registrado.",
               "exitoso"=>null
            ));
            return ["success"=>false,"errores"=>[["Ya el correo se encuentra registrado."]]];
        }
        
        
        $suscriptor = new Suscriptore();
        $suscriptor->email = $request->emailSuscriptor;
        $suscriptor->created_at = Carbon::now();
        $suscriptor->updated_at = Carbon::now();
        $suscriptor->save();
        
        return view('informes.ListadoInformesPublico', array(
               "informes"=> Publicacione::
                   join('publicaciones_idioma', 'publicaciones_idioma.publicaciones_id', '=', 'publicaciones.id')
                   ->join('tipo_documento_idioma', 'tipo_documento_idioma.tipo_documento_id', '=', 'publicaciones.tipo_documento_id')
                   ->join('categoria_documento_idioma', 'categoria_documento_idioma.categoria_documento_id', '=', 'publicaciones.categoria_doucmento_id')
                   ->where('publicaciones_idioma.idioma_id',1)
                   ->where('tipo_documento_idioma.idioma_id',1)
                   ->where('categoria_documento_idioma.idioma_id',1)
                   ->where(function($q)use($request){ if( isset($request->tipoInforme) && $request->tipoInforme != null ){$q->where('publicaciones.tipo_documento_id',$request->tipoInforme);}})
                    ->where(function($q)use($request){ if( isset($request->categoriaInforme) && $request->categoriaInforme != null ){$q->where('publicaciones.categoria_doucmento_id',$request->categoriaInforme);}})
                    ->where(function($q)use($request){ if( isset($request->buscar) && $request->buscar != null ){$q->where(strtolower('publicaciones_idioma.palabrasclaves'),'like','%',trim(strtolower($request->buscar)))
                                                                                                                   ->where(strtolower('publicaciones_idioma.nombre'),'like','%',trim(strtolower($request->buscar)))
                                                                                                                   ->where(strtolower('publicaciones_idioma.descripcion'),'like','%',trim(strtolower($request->buscar)))
                    ;}}) 
                    ->select("publicaciones.id","publicaciones.autores", "publicaciones.volumen", "publicaciones.portada", "publicaciones.ruta", "publicaciones.fecha_creacion", 
                        "publicaciones.fecha_publicacion", "tipo_documento_idioma.nombre as tipoInforme", "categoria_documento_idioma.nombre as categoriaInforme",
                        "publicaciones_idioma.palabrasclaves as palabrasClaves", "publicaciones_idioma.nombre as tituloInforme", "publicaciones_idioma.descripcion")
                    ->orderBy('id')->paginate(10),
                   
                   /*with([ "idiomas"=>function($q){ $q->with(['idioma'=>function($s){$s->where('id',1);}]); }, 
                                                 "tipo"=>function($q){ $q->with([ "tipoDocumentoIdiomas"=>function($qq){ $qq->where("idioma_id",1); } ]); }, 
                                                 "categoria"=>function($q){ $q->with([ "categoriaDocumentoIdiomas"=>function($qq){ $qq->where("idioma_id",1); } ]); } 
                                                ])
                                                ->where(function($q)use($request){ if( isset($request->tipoInforme) && $request->tipoInforme != null ){$q->where('tipo_documento_id',$request->tipoInforme);}})
                                                ->where(function($q)use($request){ if( isset($request->categoriaInforme) && $request->categoriaInforme != null ){$q->where('categoria_doucmento_id',$request->categoriaInforme);}})
                                                ->orderBy('id')->paginate(10),*/
               "tipos"=> Tipo_Documento_Idioma::with(['tipoDocumento'=>function($s){$s->where('estado',true);}])->where('idioma_id',1)->get(),
               "categorias"=> Categoria_Documento_Idioma::with(['categoriaDocumento'=>function($s){$s->where("estado",true);}])->where('idioma_id',1)->get(),
               "suscriptorExiste"=>null,
               "exitoso"=>"Suscripción realizada satisfactoriamente"
            ));
    }
}