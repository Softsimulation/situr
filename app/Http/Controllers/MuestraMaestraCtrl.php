<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Proveedor;


use App\Models\Categoria_Proveedor;
use App\Models\Tipo_Proveedor;
use App\Models\Categoria_Proveedor_Con_Idioma;

use Excel;


class MuestraMaestraCtrl extends Controller
{
    
    public function getIndex(){
        return View("MuestraMaestra.index");
    }
    
    
    public function getDatacongiguracion(){
        return [
                "proveedores"=> Proveedor::join("sitios","sitios.id","=","proveedores.sitios_id")
                                          ->join("sitios_con_idiomas","sitios.id","=","sitios_con_idiomas.sitios_id")
                                          ->where([ ["proveedores.estado",true], ["idiomas_id",1] ])
                                          ->get(["proveedores.id","nombre","latitud","longitud"]),
                "zonas"=>[]
            ];
    }
    
    
    public function getExcel($id){ 
       
       
       
       Excel::create('Laravel Excel', function($excel) {
 
            $excel->sheet('Proveedores', function($sheet) {
 
                $proveedores = Proveedor::join("sitios","sitios.id","=","proveedores.sitios_id")
                                          ->join("sitios_con_idiomas","sitios.id","=","sitios_con_idiomas.sitios_id")
                                          ->where([ ["proveedores.estado",true], ["idiomas_id",1] ])
                                          ->get([ "direccion", "nombre", "proveedores.telefono","nombre", "categoria_proveedores_id as Subcategoria"])->take(10);
       
               foreach($proveedores as $proveedor){
                   $categoria = Categoria_Proveedor::find($proveedor->Subcategoria);
                   $proveedor["categoria"] = Tipo_Proveedor::join("tipo_proveedores_con_idiomas","tipo_proveedores.id","=","tipo_proveedores_id")
                                                           ->where("tipo_proveedores.id",$categoria->tipo_proveedores_id)->pluck("nombre")->first();
                                         
                   $proveedor["Subcategoria"] = Categoria_Proveedor_Con_Idioma::where("categoria_proveedores_id",$proveedor->Subcategoria)->pluck("nombre")->first();
               }
 
                $sheet->fromArray($proveedores);
 
            });
        })->export('xls');
    }
    
}
