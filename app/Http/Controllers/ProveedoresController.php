<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests;
use App\Models\Proveedor;
<<<<<<< HEAD
use App\Models\Comentario_Proveedor;
use Carbon\Carbon;
=======
use App\Models\Proveedor_Favorito;

>>>>>>> 53d8fc323acc5f921ee6fd9448f7b6c38a0ec627
class ProveedoresController extends Controller
{
    
    public function __construct()
    {
        
        $this->middleware('auth',["only"=>["postFavorito","postFavoritoclient"]]);
        // $this->user = \Auth::user();
    }
    
    //
    
        public function __construct()
	{
	    $this->user = Auth::user();
	}
    //
    public function getVer($id){
        if ($id == null){
            return response('Bad request.', 400);
        }elseif(Proveedor::find($id) == null){
            return response('Not found.', 404);
        }
        
        $proveedor = Proveedor::with(['comentariosProveedores'=> function ($queryComentario){
            $queryComentario->orderBy('fecha', 'DESC')->with(['user']);
        },'proveedorRnt' => function ($queryProveedorRnt){
            $queryProveedorRnt->with(['idiomas' => function ($queyProveedor_rnt_idioma){
                $queyProveedor_rnt_idioma->select('proveedor_rnt_id', 'idioma_id', 'descripcion')->orderBy('idioma_id');
            }])->select('id', 'razon_social');
        }, 'proveedoresConIdiomas' => function ($queryProveedoresConIdiomas){
            $queryProveedoresConIdiomas->select('idiomas_id', 'proveedores_id', 'horario')->where('idiomas_id', 2);
        }, 'multimediaProveedores' => function ($queryMultimediaProveedores){
            $queryMultimediaProveedores->where('tipo', false)->orderBy('portada', 'desc')->select('proveedor_id', 'ruta');
        }, 'actividadesProveedores' => function ($queryActividadesProveedores){
            $queryActividadesProveedores->with(['actividadesConIdiomas' => function ($queryActividadesConIdiomas){
                $queryActividadesConIdiomas->select('actividades_id', 'idiomas', 'nombre');
            }])->select('actividades.id');
        }, 'perfilesUsuariosConProveedores' => function($queryPerfilesUsuariosConProveedores){
            $queryPerfilesUsuariosConProveedores->with(['perfilesUsuariosConIdiomas' => function ($queryPerfilesUsuariosConIdiomas){
                $queryPerfilesUsuariosConIdiomas->orderBy('idiomas_id')->select('idiomas_id', 'perfiles_usuarios_id', 'nombre');
            }])->select('perfiles_usuarios.id');
        }, 'categoriaTurismoConProveedores' => function($queryCategoriaTurismoConProveedores){
            $queryCategoriaTurismoConProveedores->with(['categoriaTurismoConIdiomas' => function($queryCategoriaTurismoConIdiomas){
                $queryCategoriaTurismoConIdiomas->orderBy('idiomas_id')->select('categoria_turismo_id', 'idiomas_id', 'nombre');
            }])->select('categoria_turismo.id');
        }])->select('id', 'proveedor_rnt_id',  'telefono', 'sitio_web', 'valor_min', 'valor_max', 'calificacion_legusto')->where('id', $id)->first();
        
        $video_promocional = Proveedor::with(['multimediaProveedores' => function ($queryMultimediaProveedores){
            $queryMultimediaProveedores->where('tipo', true)->select('proveedor_id', 'ruta');
        }])->first()->multimediaProveedores;

        if (count($video_promocional) > 0){
            $video_promocional = $video_promocional[0]->ruta;
        }else {
            $video_promocional = null;
        }
        
        //return ['proveedor' => $proveedor, 'video_promocional' => $video_promocional];
        return view('proveedor.Ver', ['proveedor' => $proveedor, 'video_promocional' => $video_promocional]);
    }
    
<<<<<<< HEAD
    public function postGuardarcomentario(Request $request){
	   
	   $validator = \Validator::make($request->all(), [
            'id' => 'required|exists:proveedores,id',

            'calificacionLeGusto' => 'required|numeric|min:1|max:5',

            'comentario' => 'required|string',
        ],[
            'comentario.string' => 'El comentario  debe ser de tipo string.',
            'id.exists' => 'No se encontro la actividad',
        
            ]
        );
        
        if($validator->fails()){
           return redirect('proveedor/ver/'.$request->id)->with('error','No se pudo guardar el comentario');
            
        }
        
        
        if($this->user == null){
            return redirect('proveedor/ver/'.$request->id)->with('error','No se pudo guardar el comentario');
            
        }
        
        $comentario = new Comentario_Proveedor();
        $comentario->proveedores_id = $request->id;
        $comentario->user_id = $this->user->id;
        $comentario->comentario = $request->comentario;
        $comentario->le_gusto = $request->calificacionLeGusto;
        $comentario->fecha = Carbon::now();
        $comentario->save();
        $proveedor = Proveedor::where('id',$request->id)->first();
        $proveedor->calificacion_legusto = Comentario_Proveedor::where('proveedores_id',$request->id)->avg('le_gusto');
        $proveedor->save();
        
        return redirect('proveedor/ver/'.$request->id)->with('success','Comentario guardado correctamente');
=======
    public function postFavorito(Request $request){
        $this->user = \Auth::user();
        $proveedor = Proveedor::find($request->proveedor_id);
        if(!$proveedor){
           return response('Not found.', 404);
        }else{
            if(Proveedor_Favorito::where('usuario_id',$this->user->id)->where('proveedores_id',$proveedor->id)->first() == null){
                Proveedor_Favorito::create([
                    'usuario_id' => $this->user->id,
                    'proveedores_id' => $proveedor->id
                ]);
                return \Redirect::to('/proveedor/ver/'.$proveedor->id)
                        ->with('message', 'Se ha añadido el proveedor a tus favoritos.')
                        ->withInput(); 
            }else{
                Proveedor_Favorito::where('usuario_id',$this->user->id)->where('proveedores_id',$proveedor->id)->delete();
                return \Redirect::to('/proveedor/ver/'.$proveedor->id)
                        ->with('message', 'Se ha quitado el proveedor de tus favoritos.')
                        ->withInput(); 
            }
        }
    }
    
    public function postFavoritoclient(Request $request){
        $this->user = \Auth::user();
        $proveedor = Proveedor::find($request->proveedor_id);
        if(!$proveedor){
           return ["success" => false, "errores" => [["El proveedor seleccionado no se encuentra en el sistema."]] ];
        }else{
            if(Proveedor_Favorito::where('usuario_id',$this->user->id)->where('proveedores_id',$proveedor->id)->first() == null){
                Proveedor_Favorito::create([
                    'usuario_id' => $this->user->id,
                    'proveedores_id' => $proveedor->id
                ]);
                return ["success" => true];
            }else{
                Proveedor_Favorito::where('usuario_id',$this->user->id)->where('proveedores_id',$proveedor->id)->delete();
                return ["success" => true]; 
            }
        }
>>>>>>> 53d8fc323acc5f921ee6fd9448f7b6c38a0ec627
    }
    
}