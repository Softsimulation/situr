<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function () {

    return "hola";
  
    
    
});

Route::controller('/temporada','TemporadaController');
Route::controller('/turismointerno','TurismoInternoController');

Route::controller('/turismoreceptor','TurismoReceptorController');


//Route::controller('/administradoratracciones', 'AdministradorAtraccionController');

Route::controller('/administrarmunicipios', 'AdministrarMunicipiosController');

Route::controller('/administrardepartamentos', 'AdministrarDepartamentosController');

Route::controller('/administrarpaises', 'AdministrarPaisesController');
Route::controller('/grupoviaje','GrupoViajeController');
Route::controller('/exportacion','ExportacionController');


Route::group(['middleware' => 'cors'], function(){
 
   Route::controller('/turismointernoapi','TurismoInternoCorsController');
   
   Route::controller('/turismoreceptoroapi','TurismoReceptorCorsController');
  
});

Route::controller('/usuario','UsuarioController');


