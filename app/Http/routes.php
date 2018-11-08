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

Route::controller('/indicadores','IndicadoresCtrl');

Route::get('/', function () {

    return view('home.index');
  
});
Route::get('/quienesSomos', function () {

    return view('publico.situr.quienesSomos');
  
});
Route::get('/historia', function () {

    return view('publico.situr.historia');
  
});
Route::get('/vision', function () {

    return view('publico.situr.vision');
  
});
Route::get('/equipo', function () {

    return view('publico.situr.equipo');
  
});
Route::get('/queHacemos', function () {

    return view('publico.situr.queHacemos');
  
});
Route::get('/entidadesAsociadas', function () {

    return view('publico.situr.entidadesAsociadas');
  
});
Route::get('/listados', function () {

    return view('publico.listados.index');
  
});

Route::controller('/temporada','TemporadaController');
Route::controller('/turismointerno','TurismoInternoController');

Route::controller('/turismoreceptor','TurismoReceptorController');

Route::controller('/ofertaempleo','OfertaEmpleoController');
Route::controller('/MuestraMaestra','MuestraMaestraCtrl');


//Route::controller('/administradoratracciones', 'AdministradorAtraccionController');

Route::controller('/administrarmunicipios', 'AdministrarMunicipiosController');

Route::controller('/administrardepartamentos', 'AdministrarDepartamentosController');

Route::controller('/administrarpaises', 'AdministrarPaisesController');
Route::controller('/grupoviaje','GrupoViajeController');
Route::controller('/exportacion','ExportacionController');


Route::controller('/administradorproveedores', 'AdministradorProveedoresController');

Route::controller('/administradoreventos', 'AdministradorEventosController');

Route::controller('/administradorrutas', 'AdministradorRutasController');

Route::controller('/administradoratracciones', 'AdministradorAtraccionController');

Route::controller('/administradoractividades', 'AdministradorActividadesController');

Route::controller('/administradordestinos', 'AdministradorDestinosController');


// Public Jáder
Route::controller('/atracciones', 'AtraccionesController');

Route::controller('/actividades', 'ActividadesController');

Route::controller('/destinos', 'DestinosController');

Route::controller('/rutas', 'RutasTuristicasController');

Route::controller('/eventos', 'EventosController');

Route::controller('/proveedor', 'ProveedoresController');

Route::group(['middleware' => 'cors'], function(){
    Route::controller('/authapi', 'ApiAuthController');
    Route::group(['middleware'=> 'jwt.auth'], function () {
        
        Route::controller('/turismointernoapi','TurismoInternoCorsController');
        Route::controller('/turismoreceptoroapi','TurismoReceptorCorsController');
    
    });
    
    Route::controller('/ofertayempleoapi','AppOfertaEmpleoController');
});




Route::controller('/usuario','UsuarioController');


Route::get('/encuestaAdHoc/{encuesta}/registro', 'EncuestaDinamicaCtrl@getRegistrodeusuarios' );
Route::get('/encuestaAdHoc/{encuesta}', 'EncuestaDinamicaCtrl@encuesta' );
Route::controller('/encuesta','EncuestaDinamicaCtrl');

Route::controller('/importarRnt','ImportacionRntController');

Route::controller('/sostenibilidadpst', 'SostenibilidadPstController');

Route::controller('/sostenibilidadhogares','SostenibilidadHogaresController');
Route::controller('/login','LoginController');

Route::controller('/noticias','NoticiaController');
Route::controller('/promocionNoticia','PublicoNoticiaController');
Route::controller('/sliders','SliderController');
Route::controller('/suscriptores','SuscriptoreController');
