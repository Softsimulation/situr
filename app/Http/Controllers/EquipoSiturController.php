<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Atraccion_Favorita;
use App\Models\Atracciones;
use App\Models\Equipo_Situr;
use App\Models\Actividad_Favorita;
use App\Models\Actividad;
use App\Models\Proveedor_Favorito;
use App\Models\Proveedor;
use App\Models\Evento_Favorita;
use App\Models\Evento;
use App\Models\Planificador;
use Carbon\Carbon;

class EquipoSiturController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('auth',['except' => ['getMiplanificador','getPlanificador'] ]);
        $this->user = \Auth::user();
    }
    
    public function getEquipo(){
        return view('EquipoSitur.equipo');
    }
    
    
    public function getEquipositur(){

        $equipo  = Equipo_Situr::get();
        
        
        return ['equipo' => $equipo];
    }
    
    
    public function postGuardarmiembro(Request $request){

	    
	    $validator = \Validator::make($request->all(), [
            'nombre' => 'string|min:1|max:455|required',
            'cargo' => 'string|min:1|max:455',
            'descripcion' => 'string|required',
            'imagenSlider.*' => 'mimes:jpg,jpeg,png',
        
            
        ],[
          
            'imagenSlider.*.mimes' => 'subir solo archivos jpg,png o jgpe',
            'imagenSlider.required' => 'Debe cargar una imagen.',
            ]
        );
	    if($validator->fails()){
            return ["success"=>false,"errores"=>$validator->errors()];
        }
	
	 
	        $miembro = new Equipo_Situr();
	        $miembro->nombre = $request->nombre;
    	    $miembro->descripcion = $request->descripcion;
    	    if($request->cargo != null){
    	       $miembro->cargo = $request->cargo;
    	    }

    	    $date = Carbon::now(); 
    	    if($request->imagenSlider != null){
    	    $nombre = str_replace(' ', '_', $miembro->nombre);
            $nombrex = $nombre."EquipoSitur"."-".date("YmdHis").".".$request->imagenSlider->getClientOriginalExtension();
           \Storage::disk('EquipoSitur')->put($nombrex,  \File::get($request->imagenSlider));
            $miembro->imagen = "/EquipoSitur/".$nombrex;
    	    }
    	
            $miembro->estado = true;
            $miembro->user_create = $this->user->username;
            $miembro->user_update = $this->user->username;
            $miembro->created_at = Carbon::now();
            $miembro->updated_at = Carbon::now();
            $miembro->save();
     
        
        return ["success"=>true,"miembro"=>$miembro];
	}
    
    public function postEditarmiembro(Request $request){

	    
	    $validator = \Validator::make($request->all(), [
	        'id' => 'required|exists:equipo_situr,id',
            'nombre' => 'string|min:1|max:455|required',
            'cargo' => 'string|min:1|max:455',
            'descripcion' => 'string|required',
            'imagenSliderEditar.*' => 'mimes:jpg,jpeg,png',
        
            
        ],[
          
            'imagenSliderEditar.*.mimes' => 'subir solo archivos jpg,png o jgpe',
            'imagenSliderEditar.required' => 'Debe cargar una imagen.',
            ]
        );
	    if($validator->fails()){
            return ["success"=>false,"errores"=>$validator->errors()];
        }
	
	 
	        $miembro =  Equipo_Situr::where('id',$request->id)->first();
	        $miembro->nombre = $request->nombre;
    	    $miembro->descripcion = $request->descripcion;
    	    if($request->cargo != null){
    	       $miembro->cargo = $request->cargo;
    	    }

    	    $date = Carbon::now(); 
    	    if($request->imagenSliderEditar != null){
    	         \File::delete(public_path() . $miembro->imagen);
        	    $nombre = str_replace(' ', '_', $miembro->nombre);
                $nombrex = $nombre."EquipoSitur"."-".date("YmdHis").".".$request->imagenSliderEditar->getClientOriginalExtension();
               \Storage::disk('EquipoSitur')->put($nombrex,  \File::get($request->imagenSliderEditar));
                $miembro->imagen = "/EquipoSitur/".$nombrex;
    	    }
    	

            $miembro->user_update = $this->user->username;
            $miembro->updated_at = Carbon::now();
            $miembro->save();
     
        
        return ["success"=>true,"miembro"=>$miembro];
	}
	
	public function postCambiarestadomiembro(Request $request){

	    
	    $validator = \Validator::make($request->all(), [
	        'id' => 'required|exists:equipo_situr,id',
           
        
            
        ],[
          
      
            'id.required' => 'el id es requerido.',
            ]
        );
	    if($validator->fails()){
            return ["success"=>false,"errores"=>$validator->errors()];
        }
	
	 
	        $miembro =  Equipo_Situr::where('id',$request->id)->first();

    	
            $miembro->estado = !$miembro->estado;

            $miembro->user_update = $this->user->username;

            $miembro->updated_at = Carbon::now();
            $miembro->save();
     
        
        return ["success"=>true,"miembro"=>$miembro];
	}
    
}
