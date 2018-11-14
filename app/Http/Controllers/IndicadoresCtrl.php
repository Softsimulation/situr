<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

use App\Http\Requests;

use DB;

use App\Models\Indicadores_medicion;
use App\Models\Estadisitica_Secundaria;
use App\Models\Valor_serie_tiempo;
use App\Models\Series_estadistica;
use App\Models\Rotulos_estadistica;
use App\Models\Series_estadistica_rotulo;
use App\Models\Temporada;
use App\Models\Mes_Indicador;

class IndicadoresCtrl extends Controller
{
    
    //////////////////////////////////////////////////////
    
    public function getReceptor(){  
        return View("indicadores.index", ["indicadores"=> $this->getDataIndicadoresMedicion(1) ] );
    }
    
    public function getInterno(){ 
        return View("indicadores.index", ["indicadores"=> $this->getDataIndicadoresMedicion(2) ] );
    }
    
    public function getEmisor(){ 
        return View("indicadores.index", ["indicadores"=> $this->getDataIndicadoresMedicion(3) ] );
    }
    
    public function getOferta(){ 
        return View("indicadores.index", ["indicadores"=> $this->getDataIndicadoresMedicion(4) ] );
    }
    
    private function getDataIndicadoresMedicion($indicador){ 
        $idioma = 1;
        return  Indicadores_medicion::where("tipo_medicion_indicador_id",$indicador)
                                    ->with([ "idiomas"=>function($q) use($idioma){ $q->where("idioma_id", $idioma); } ])
                                    ->orderBy('peso', 'asc')->get();
    }
    
    
    public function getSecundarios(){
        $data = Estadisitica_Secundaria::where([ ["estado",true], ["es_visible",true] ])->get();
        return View("indicadores.estadisticasSecundarios", [ "indicadores"=> $data ] );
    }
    
    public function getDatasencundarios($id){
    
        $idioma = 1;
        
        $estadistica = null;
        if($idioma == 1){
            $estadistica = Estadisitica_Secundaria::where("id",$id)->with("graficas")->select("id","nombre" ,"label_x" ,"label_y" )->first();
        }
        else{
            $estadistica = Estadisitica_Secundaria::where("id",$id)->with("graficas")-select("id","name as nombre" ,"label_x_en as label_x" ,"label_y_en as label_y" )->first();
        }
        
        
        if($estadistica){
            $years = null;
            if( count( $estadistica->rotulos ) > 0 ){
                $years = Rotulos_estadistica::join("series_estadistica_rotulos","rotulos_estadisticas.id","=","rotulo_estadistica_id")
                                            ->join("anios","anios.id","=","anio_id")
                                            ->where("estadisticas_secundaria_id",$estadistica->id)
                                            ->distinct()->get([ "anios.id","anios.anio" ]);
            }
            else{
                $years = Series_estadistica::join("valor_series_tiempo","series_estadisticas.id","=","series_estadistica_id")
                                           ->join("anios","anios.id","=","anio_id")
                                           ->where("estadisticas_secundaria_id",$estadistica->id)
                                           ->distinct()->get([ "anios.id","anios.anio" ]);
            }
            
            return [ "periodos"=> $years, "indicador"=>$estadistica ,"data"=> count($years)>0 ? $this->getFiltrardatasecundaria($id,$years[0]->id) : []  ];
        }
        
    }
    
    public function getFiltrardatasecundaria($id,$year){
        
        
        $estadistica = Estadisitica_Secundaria::find($id);
        
        if($estadistica){
            
            $idioma = 1;
            $datos = [];
            $labels = [];
            
            if( count( $estadistica->rotulos ) > 0 ){
                
                foreach($estadistica->series as $serie){
                    $dt = [];
                    foreach($estadistica->rotulos as $rotulo){                         
                        $dato = Series_estadistica_rotulo::where([ ["serie_estadisitica_id",$serie->id] , ["rotulo_estadistica_id",$rotulo->id], ["anio_id",$year]  ])->pluck("valor")->first();
                        array_push( $dt, $dato );
                    }
                    array_push($datos,$dt); 
                }
                
                $labels = $idioma==1 ? $estadistica->rotulos->lists('nombre')->toArray() : $estadistica->rotulos->lists('name')->toArray();
            }
            else{
                
                foreach($estadistica->series as $serie){
                    
                    $meses = Valor_serie_tiempo::join("mes_indicador","mes_indicador.id","=","mes_indicador_id")
                                               ->where([ ["series_estadistica_id",$serie->id], ["anio_id",$year] ])->distinct()->get(["mes_indicador.*"]);
                
                    $dt = [];
                    foreach($meses as $mes){                         
                        $dato = Valor_serie_tiempo::where([ ["series_estadistica_id",$serie->id], ["mes_indicador_id",$mes->id], ["anio_id",$year]  ])->pluck("valor")->first();
                        array_push($dt,$dato); 
                    }
                    
                    array_push($datos,$dt); 
                    $labels = $strMes = $idioma==1? $meses->lists('nombre')->toArray() : $meses->lists('name')->toArray();
                }
                
            }
            
            return [
                "labels"=> $labels,
                "data"=>   $datos,
                "series"=> $idioma==1 ? $estadistica->series->lists('nombre')->toArray()  : $estadistica->series->lists('name')->toArray(),
            ];
        }
        
    }
    
    /////////////////////////////////////////////////////
    
    public function getDataindicador($id){
        $idioma = 1;
        $cultura = "es";
        $periodos = [];
        $data = [];
        
        switch($id){
            
            ////////////////////////////RECEPTOR/////////////////////////////
            case 1: $periodos = DB::select("SELECT *from tiempo_motivos(?)", array($cultura) );
                    $data = $this->MotivoPrincipalViajeReceptor($periodos[0],$cultura); break;
                
            case 2: $periodos = DB::select("SELECT *from tiempo_tipo_alojamiento_receptor(?)", array($cultura) );
                    $data = $this->TipoAlojamientoUtilizadoReceptor($periodos[0],$cultura); break;
            
            case 3: $periodos = DB::select("SELECT *from tiempo_tipo_alojamiento_receptor(?)", array($cultura) );
                    $data = $this->MedioTransporteReceptor($periodos[0],$cultura);  break;
                
            case 4: $periodos = DB::select("SELECT *from tiempo_gasto_medio_receptor(?)", array($cultura) );
                    $data = $this->GastoMedioReceptor($periodos[0],$cultura);  break;
                
            case 5: $periodos = DB::select("SELECT id, year from tiempo_gasto_medio_rubro_receptor(?)", array($cultura) );
                    $data = $this->GastoMedioBienesServiciosReceptor( $periodos[0] ,$cultura);  break;
                
            case 6: $periodos = DB::select("SELECT id, year from tiempo_duracion_media_receptor(?)", array($cultura) );
                    $data = $this->DuracionMediaEstanciaReceptor($periodos[0],$cultura); break;
                
            case 7: $periodos = DB::select("SELECT id, year from tiempo_tamanio_grupo_viaje(?)", array($cultura) );
                    $data = $this->TamanoMedioGrupoViajeReceptor($periodos[0],$cultura);  break;
                
            ////////////////////////////////INTERNO/////////////////////////////////////////
            case 8: $periodos = [
                                    [ 
                                        "id"=>1, 
                                        "year"=>2018,
                                        "temporadas"=> $this->getTemporadas()
                                    ],
                                ]; 
                    $object = new \stdClass();
                    $object->temporada = $periodos[0]["temporadas"][0]->id ;
                    $data = $this->MotivoPrincipalViajeInterno( $object , $cultura); break;   
                
            case 9:  $periodos = [
                                    [ 
                                        "id"=>1, 
                                        "year"=>2018,
                                        "temporadas"=> $this->getTemporadas()
                                    ],
                                ]; 
                    $object = new \stdClass();
                    $object->temporada = $periodos[0]["temporadas"][0]->id ;
                    $data = $this->TipoAlojamientoUtilizadoInterno($object,$cultura);  break; 
            
            case 10: 
                    $periodos = [ [ "id"=>1, "year"=>2018 ] ]; 
                    $data = $this->TamanoMedioGrupoViajeInterno(null,$cultura);  break;
                
            case 11: $periodos = [
                                    [ 
                                        "id"=>1, 
                                        "year"=>2018,
                                        "temporadas"=> $this->getTemporadas()
                                    ],
                                 ]; 
                     $object = new \stdClass();
                     $object->temporada = $periodos[0]["temporadas"][0]->id ;
                     $data = $this->MedioTransporteInterno($object,$cultura);  break; 
            
            case 12: 
                     $periodos = [ [ "id"=>1, "year"=>2018 ] ]; 
                     $data = $this->DuracionMediaEstanciaInterno(null,$cultura);  break; 
            
            case 13:  $periodos = [ [ "id"=>1, "year"=>2018 ] ];
                      $object = new \stdClass();
                      $object->tipoGasto = 1;
                      $data = $this->GastoInterno($object,$cultura);  break; 
                
            ////////////////////////////////EMISOR/////////////////////////////////////////
            case 14: $periodos = [
                                    [ 
                                        "id"=>1, 
                                        "year"=>2018,
                                        "temporadas"=> $this->getTemporadas()
                                    ],
                                ]; 
                     $object = new \stdClass();
                     $object->temporada = $periodos[0]["temporadas"][0]->id ;
                     $data = $this->MotivoPrincipalViajeEmisor($object,$cultura); break;   
                
            case 15: $periodos = [
                                    [ 
                                        "id"=>1, 
                                        "year"=>2018,
                                        "temporadas"=> $this->getTemporadas()
                                    ],
                                ]; 
                     $object = new \stdClass();
                     $object->temporada = $periodos[0]["temporadas"][0]->id ;
                     $data = $this->TipoAlojamientoUtilizadoEmisor($object,$cultura);  break; 
            
            case 16: $periodos = [ [ "id"=>1, "year"=>2018 ] ]; 
                     $data = $this->TamanoMedioGrupoViajeEmisor(null,$cultura);  break;
                
            case 17: $periodos = [
                                    [ 
                                        "id"=>1, 
                                        "year"=>2018,
                                        "temporadas"=> $this->getTemporadas()
                                    ],
                                ]; 
                     $object = new \stdClass();
                     $object->temporada = $periodos[0]["temporadas"][0]->id ;
                     $data = $this->MedioTransporteEmisor($object,$cultura);  break; 
            
            case 18: $periodos = [ [ "id"=>1, "year"=>2018 ] ]; 
                     $data = $this->DuracionMediaEstanciaEmisor(null,$cultura);  break; 
            
            case 19:  $periodos = [ [ "id"=>1, "year"=>2018 ] ];
                      $object = new \stdClass();
                      $object->tipoGasto = 1;
                      $data = $this->GastoEmisor($object,$cultura);  break; 
                      
            case 20: $periodos = [
                                    [ 
                                        "id"=>1, 
                                        "year"=>2018,
                                        "meses"=> Mes_Indicador::get([ "id", "nombre" ])
                                    ],
                                ]; 
                     $object = new \stdClass();
                     $object->mes = $periodos[0]["meses"][0]->id ;
                     $data = $this->NumeroEstablecimeintosOferta($object,$cultura);  break; 
                     
            case 21: $periodos = [
                                    [ 
                                        "id"=>1, 
                                        "year"=>2018,
                                        "meses"=> Mes_Indicador::get([ "id", "nombre" ])
                                    ],
                                ]; 
                     $object = new \stdClass();
                     $object->mes = $periodos[0]["meses"][0]->id ;
                     $data = $this->AgenciasOperadorasOferta($object,$cultura);  break;
                     
            case 22: $periodos = [ [  "id"=>1,  "year"=>2018 ] ]; 
                     $data = $this->TasaOCupacionOferta(null,$cultura);  break;
                
            default: break;
        }
        
        return  [
                "periodos"=> $periodos,
                "indicador"=> Indicadores_medicion::where( "id",$id )
                                                  ->with([ 
                                                            "idiomas"=>function($q) use($idioma){ $q->where("idioma_id", $idioma)->select("id","indicadores_medicion_id","nombre","eje_x","eje_y"); }, 
                                                            "graficas"=>function($q){ $q->select("id","nombre","icono","codigo"); }
                                                        ])->first(),
                "data"=> $data
            ];
            
    }
    
    
    public function postFiltrardataindicador(Request $request){
        
        $data = null;
        $idioma = "es";
        switch($request->indicador){
            
            ////////////////////////////RECEPTOR/////////////////////////////
            case 1: $data = $this->MotivoPrincipalViajeReceptor($request,$idioma); break;
            case 2: $data = $this->TipoAlojamientoUtilizadoReceptor($request,$idioma); break;
            case 3: $data = $this->MedioTransporteReceptor($request,$idioma); break;
            case 4: $data = $this->GastoMedioReceptor($request,$idioma); break;
            case 5: $data = $this->GastoMedioBienesServiciosReceptor($request,$idioma); break;
            case 6: $data = $this->DuracionMediaEstanciaReceptor($request,$idioma); break;
            case 7: $data = $this->DuracionMediaEstanciaReceptor($request,$idioma); break;
                
            ////////////////////////////////INTERNO/////////////////////////////////////////
            case 8:  $data = $this->MotivoPrincipalViajeInterno($request,$idioma); break;
            case 9:  $data = $this->TipoAlojamientoUtilizadoInterno($request,$idioma); break;
            case 10: $data = $this->TamanoMedioGrupoViajeInterno($request,$idioma); break;
            case 11: $data = $this->MedioTransporteInterno($request,$idioma); break;
            case 12: $data = $this->DuracionMediaEstanciaInterno($request,$idioma); break;
            case 13: $data = $this->GastoInterno($request,$idioma); break;
            
            ////////////////////////////////EMISOR/////////////////////////////////////////
            case 14: $data = $this->MotivoPrincipalViajeEmisor($request,$idioma); break;
            case 15: $data = $this->TipoAlojamientoUtilizadoEmisor($request,$idioma); break;
            case 16: $data = $this->TamanoMedioGrupoViajeEmisor($request,$idioma); break;
            case 17: $data = $this->MedioTransporteEmisor($request,$idioma); break;
            case 18: $data = $this->DuracionMediaEstanciaEmisor($request,$idioma); break;
            case 19: $data = $this->GastoEmisor($request,$idioma); break;
            
            ////////////////////////////////OFERTA/////////////////////////////////////////
            case 20: $data = $this->NumeroEstablecimeintosOferta($request,$idioma); break;
            case 21: $data = $this->AgenciasOperadorasOferta($request,$idioma); break;
            case 22: $data = $this->TasaOCupacionOferta($request,$idioma); break;
            case 23: $data = $this->TasaOCupacionRestaurantesOferta($request,$idioma); break;
            case 24: $data = $this->ViajesEmisoresOferta($request,$idioma); break;
            case 25: $data = $this->ViajesInternosOferta($request,$idioma); break;
            
            default: break;
        }
            
        return $data;
    }
    
    
    ////////////////////////////RECEPTOR/////////////////////////////
    
    private function MotivoPrincipalViajeReceptor($request,$idioma){
        $data = new Collection( DB::select("SELECT *from motivo_viaje_receptor(?,?,?)", array($request->year ,$idioma, $request->mes)) );
        return [
            "labels"=> $data->lists('tipo')->toArray(),
            "data"=>   $this->redondear($data->lists('cantidad')->toArray())
        ];
    }
    
    private function TipoAlojamientoUtilizadoReceptor($request,$idioma){
        $data = new Collection( DB::select("SELECT *from tipo_alojamiento_receptor(?,?,?)", array($request->year ,$idioma, $request->mes)) );
        return [
            "labels"=> $data->lists('tipo')->toArray(),
            "data"=>   $this->redondear($data->lists('cantidad')->toArray())
        ];
    }
    
    private function MedioTransporteReceptor($request,$idioma){
        $data = new Collection( DB::select("SELECT *from medio_transporte_receptor(?,?,?)", array($request->year ,$idioma, $request->mes)) );
        return [
            "labels"=> $data->lists('tipo')->toArray(),
            "data"=>   $this->redondear($data->lists('cantidad')->toArray())
        ];
    }
    
    private function GastoMedioReceptor($request,$idioma){
        $data = new Collection( DB::select("SELECT *from gasto_medio_receptor(?,?)", array($request->year ,$idioma )) );
        return [
            "labels"=> $data->lists('mes')->toArray(),
            "data"=>   [ $this->redondear($data->lists('gastodia')->toArray()), $this->redondear($data->lists('gastototal')->toArray()) ],
            "series"=> [ "Gasto por día", "Gasto total" ]
        ];
    }
    
    private function GastoMedioBienesServiciosReceptor($request,$idioma){ 
        $data = new Collection( DB::select("SELECT *from gasto_medio_rubro_receptor(?,?)", array( $request->year ,$idioma )) );
        
        $meses = $data->unique("mes")->lists('mes')->toArray();
        $rubros = $data->unique("rubro")->lists('rubro')->toArray();
        
        $datos = [];
        
        $campoDatos = isset($request->tipoGasto)  ?  ($request->tipoGasto == "1" ? "gastototal" : "gastodia") : "gastototal";
        
        foreach($rubros as $rubro){
            $dt = [];
            $rbs = $data->where( "rubro",$rubro );
            
            foreach($meses as $mes){
                array_push($dt, $rbs->where( "mes", $mes )->pluck($campoDatos)->first() );
            }
            array_push($datos, $this->redondear($dt) );
        }
       
        return [
            "labels"=> $meses,
            "data"=>   $datos,
            "series"=> $rubros
        ];
        
    }
    
    private function DuracionMediaEstanciaReceptor($request, $idioma){
        $data = new Collection( DB::select("SELECT *from duracion_media_receptor(?,?)", array($request->year ,$idioma)) );
        return [
            "labels"=> $data->lists('mes')->toArray(),
            "data"=>   $this->redondear($data->lists('cantidad')->toArray()),
            "dataExtra"=> [
                            "media"=>  $this->redondear( $data->lists('media')->toArray() ), 
                            "mediana"=>$this->redondear( $data->lists('media')->toArray() ), 
                            "moda"=>   $this->redondear( $data->lists('media')->toArray() ), 
                          ]
        ];
    }
    
    private function TamanoMedioGrupoViajeReceptor($request, $idioma){
        $data = new Collection( DB::select("SELECT *from tamanio_grupo_receptor(?,?)", array($request->year ,$idioma)) );
        return [
            "labels"=> $data->lists('mes')->toArray(),
            "data"=>   $this->redondear($data->lists('cantidad')->toArray()),
            "dataExtra"=> [
                            "media"=>  $this->redondear( $data->lists('media')->toArray() ), 
                            "mediana"=>$this->redondear( $data->lists('media')->toArray() ), 
                            "moda"=>   $this->redondear( $data->lists('media')->toArray() ), 
                          ]
        ];
    }
    
    
    ////////////////////////////////INTERNO/////////////////////////////////////////
    
    private function MotivoPrincipalViajeInterno($request,$idioma){
        $data = new Collection( DB::select("SELECT *from estadistica_motivo_viaje_interno(?,?)", array($request->temporada,$idioma)) );
        return [
            "labels"=> $data->lists('tipo')->toArray(),
            "data"=>   $this->redondear($data->lists('cantidad')->toArray())
        ];
    }
    
    private function MedioTransporteInterno($request,$idioma){
        $data = new Collection( DB::select("SELECT *from estadistica_medio_transporte_interno(?,?)", array($request->temporada ,$idioma)) );
        return [
            "labels"=> $data->lists('tipo')->toArray(),
            "data"=>   $this->redondear($data->lists('cantidad')->toArray())
        ];
    }
    
    private function TipoAlojamientoUtilizadoInterno($request,$idioma){
        $data = new Collection( DB::select("SELECT *from estadistica_tipos_alojamiento_interno(?,?)", array($request->temporada ,$idioma)) );
        return [
            "labels"=> $data->lists('tipo')->toArray(),
            "data"=>   $this->redondear($data->lists('cantidad')->toArray())
        ];
    }
    
    private function GastoInterno($request,$idioma){
        
        $labels = [];
        $data = [];
        
        if($request->tipoGasto==1){
            foreach(Temporada::where("estado",true)->get() as $temporada){
            array_push($labels, $temporada->nombre);
            $d = new Collection( DB::select("SELECT *from estadistica_gastos_interno(?,?)", array($temporada->id ,$idioma)) ); 
            $d = $d->pluck('gasto_total')->first();
            array_push($data, $d ? $d :0 );
        }
        }
        else{
            foreach(Temporada::where("estado",true)->get() as $temporada){
                array_push($labels, $temporada->nombre);
                $d = new Collection( DB::select("SELECT *from estadistica_gastos_interno(?,?)", array($temporada->id ,$idioma)) ); 
                $d = $d->pluck('gasto_dia')->first();
                array_push($data, $d ? $d :0 );
            }
        }
        
        return [ "labels"=> $labels, "data"=> $data ];
    }
    
    private function TamanoMedioGrupoViajeInterno($request,$idioma){
        
        $labels = [];
        $data = [];
        foreach(Temporada::where("estado",true)->get() as $temporada){
            array_push($labels, $temporada->nombre);
            $d = new Collection( DB::select("SELECT *from estadistica_tamanio_grupo_viaje_interno(?,?)", array($temporada->id ,$idioma)) ); 
            $d = $d->pluck('cantidad')->first();
            array_push($data, $d ? $d :0 );
        }
    
        return [ "labels"=> $labels, "data"=> $data ];
    }
    
    private function DuracionMediaEstanciaInterno($request,$idioma){
        
        $labels = [];
        $data = [];
        foreach(Temporada::where("estado",true)->get() as $temporada){
            array_push($labels, $temporada->nombre);
            $d = new Collection( DB::select("SELECT *from estadistica_duracion_media_interno(?,?)", array($temporada->id ,$idioma)) ); 
            $d = $d->pluck('cantidad')->first();
            array_push($data, $d ? $d :0 );
        }
    
        return [ "labels"=> $labels, "data"=> $data ];
    }
    
    //////////////////////////////////////////////////////////////////////////////
    
    ////////////////////////////////EMISOR/////////////////////////////////////////
    
    private function MotivoPrincipalViajeEmisor($request,$idioma){
        $data = new Collection( DB::select("SELECT *from estadistica_motivo_viaje_emisor(?,?)", array($request->temporada,$idioma)) );
        return [
            "labels"=> $data->lists('tipo')->toArray(),
            "data"=>   $this->redondear($data->lists('cantidad')->toArray())
        ];
    }
    
    private function MedioTransporteEmisor($request,$idioma){
        $data = new Collection( DB::select("SELECT *from estadistica_medio_transporte_emisor(?,?)", array($request->temporada ,$idioma)) );
        return [
            "labels"=> $data->lists('tipo')->toArray(),
            "data"=>   $this->redondear($data->lists('cantidad')->toArray())
        ];
    }
    
    private function TipoAlojamientoUtilizadoEmisor($request,$idioma){
        $data = new Collection( DB::select("SELECT *from estadistica_tipos_alojamiento_emisor(?,?)", array($request->temporada ,$idioma)) );
        return [
            "labels"=> $data->lists('tipo')->toArray(),
            "data"=>   $this->redondear($data->lists('cantidad')->toArray())
        ];
    }
    
    private function GastoEmisor($request,$idioma){
        
        $labels = [];
        $data = [];
        
        if($request->tipoGasto==1){
            foreach(Temporada::where("estado",true)->get() as $temporada){
            array_push($labels, $temporada->nombre);
            $d = new Collection( DB::select("SELECT *from estadistica_gastos_emisor(?,?)", array($temporada->id ,$idioma)) ); 
            $d = $d->pluck('gasto_total')->first();
            array_push($data, $d ? $d :0 );
        }
        }
        else{
            foreach(Temporada::where("estado",true)->get() as $temporada){
                array_push($labels, $temporada->nombre);
                $d = new Collection( DB::select("SELECT *from estadistica_gastos_emisor(?,?)", array($temporada->id ,$idioma)) ); 
                $d = $d->pluck('gasto_dia')->first();
                array_push($data, $d ? $d :0 );
            }
        }
        
        return [ "labels"=> $labels, "data"=> $data ];
    }
    
    private function TamanoMedioGrupoViajeEmisor($request,$idioma){
        
        $labels = [];
        $data = [];
        foreach(Temporada::where("estado",true)->get() as $temporada){
            array_push($labels, $temporada->nombre);
            $d = new Collection( DB::select("SELECT *from estadistica_tamanio_grupo_viaje_emisor(?,?)", array($temporada->id ,$idioma)) ); 
            $d = $d->pluck('cantidad')->first();
            array_push($data, $d ? $d :0 );
        }
    
        return [ "labels"=> $labels, "data"=> $data ];
    }
    
    private function DuracionMediaEstanciaEmisor($request,$idioma){
        
        $labels = [];
        $data = [];
        foreach(Temporada::where("estado",true)->get() as $temporada){
            array_push($labels, $temporada->nombre);
            $d = new Collection( DB::select("SELECT *from estadistica_duracion_media_emisor(?,?)", array($temporada->id ,$idioma)) ); 
            $d = $d->pluck('cantidad')->first();
            array_push($data, $d ? $d :0 );
        }
    
        return [ "labels"=> $labels, "data"=> $data ];
    }
    
    //////////////////////////////////////////////////////////////////////////////
    
    
    ////////////////////////////////OFERTA/////////////////////////////////////////
    
    private function NumeroEstablecimeintosOferta($request,$idioma){
        
        $data = new Collection( DB::select("SELECT *from estadistica_numero_establecimiento(?,?)", array($request->mes,$idioma)) );
        return [
            "labels"=> $data->lists('tipo')->toArray(),
            "data"=>   $this->redondear($data->lists('cantidad')->toArray())
        ];
    }

    private function AgenciasOperadorasOferta($request,$idioma){
        
        $data = new Collection( DB::select("SELECT *from estadistica_agencia_viaje_operadoras(?,?)", array($request->mes,$idioma)) );
        return [
            "labels"=> $data->lists('tipo')->toArray(),
            "data"=>   $this->redondear($data->lists('cantidad')->toArray())
        ];
    }
    
    private function TasaOCupacionOferta($request,$idioma){
       
        $labels = [];
        $data = [];
        foreach(Mes_Indicador::get() as $mes){
            array_push($labels, $mes->nombre);
            $d = new Collection( DB::select("SELECT *from estadistica_tasa_ocupacion_oferta(?,?)", array($mes->id ,$idioma)) ); 
            $d = $d->pluck('cantidad')->first();
            array_push($data, $d ? $d :0 );
        }
    
        return [ "labels"=> $labels, "data"=> $data ];
    }
    
    private function TasaOCupacionRestaurantesOferta($request,$idioma){
        
        $data = new Collection( DB::select("SELECT *from estadistica_tasa_ocupacion_oferta(?,?)", array($request->mes,$idioma)) );
        return [
            "labels"=> $data->lists('tipo')->toArray(),
            "data"=>   $this->redondear($data->lists('cantidad')->toArray())
        ];
    }
    
    private function ViajesEmisoresOferta($request,$idioma){
        
        $labels = [];
        $data = [];
        foreach(Mes_Indicador::get() as $mes){
            array_push($labels, $mes->nombre);
            $d = new Collection( DB::select("SELECT *from estadistica_agencia_viaje_emisor(?,?)", array($mes->id ,$idioma)) ); 
            $d = $d->pluck('cantidad')->first();
            array_push($data, $d ? $d :0 );
        }
    
        return [ "labels"=> $labels, "data"=> $data ];
        
    }
    
    private function ViajesInternosOferta($request,$idioma){
        
        $labels = [];
        $data = [];
        foreach(Mes_Indicador::get() as $mes){
            array_push($labels, $mes->nombre);
            $d = new Collection( DB::select("SELECT *from estadistica_agencia_viaje_interno(?,?)", array($mes->id ,$idioma)) ); 
            $d = $d->pluck('cantidad')->first();
            array_push($data, $d ? $d :0 );
        }
    
        return [ "labels"=> $labels, "data"=> $data ];
    }
    
    //////////////////////////////////////////////////////////////////////////////
    
    
    public function getTemporadas(){ 
        return Temporada::where('estado',true)->get([ "id", "nombre" ]);
    }
    
    
    
    
    
    private function redondear($array){
       for($i=0; $i<count($array); $i++){ 
           $array[$i] = round( floatval( $array[$i] ) , 2);   
       }
       return $array;
    }
    
}
