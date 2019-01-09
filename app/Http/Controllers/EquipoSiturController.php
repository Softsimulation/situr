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
    
 
    
}
