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

Route::get('/PlanificaTuViaje','InformacionDepartamentoCtrl@PlanificaTuViaje');
Route::get('/Departamento/AcercaDe','InformacionDepartamentoCtrl@AcercaDe');
Route::get('/Departamento/Requisitos','InformacionDepartamentoCtrl@Requisitos');
Route::controller('/InformacionDepartamento','InformacionDepartamentoCtrl');

Route::controller('/promocionInforme','PublicoInformeController');
Route::controller('/informes','InformesCtrl');
Route::get('/Mapa', 'MapaCtrl@getIndex');
Route::get('/Mapa/getData', 'MapaCtrl@getData');

Route::controller('/EstadisticasSecundarias','EstadisticasSecundariasCtrl');
Route::controller('/MuestraMaestra','MuestraMaestraCtrl');

Route::controller('/indicadores','IndicadoresCtrl');



// Route::get('/', function () {

//     return view('home.index');
  
// });
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
Route::get('/registrar', function () {
    return view('publico.situr.registrar',array('errores' => null,'mensajeExito'=>null));
  
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
Route::get('/llenarEncuestaAdHoc/{idEncuesta}', 'EncuestaDinamicaCtrl@anonimos' );
Route::controller('/encuesta','EncuestaDinamicaCtrl');

Route::controller('/importarRnt','ImportacionRntController');

Route::controller('/sostenibilidadpst', 'SostenibilidadPstController');

Route::controller('/sostenibilidadhogares','SostenibilidadHogaresController');
Route::controller('/login','LoginController');


Route::group(['prefix' => 'publicaciones','middleware'=>'auth'], function () {
    
    Route::get('/listadonuevas', 'PublicacionController@publicaciones');
    Route::get('/crear', 'PublicacionController@CrearPublicacion');
    Route::get('/editar/{id}', 'PublicacionController@EditarPublicacion');
    Route::get('/listado', 'PublicacionController@ListadoPublicaciones');
    Route::get('/listadoadmin', 'PublicacionController@ListadoPublicacionesAdmin');
    Route::get('/getPublicacion', 'PublicacionController@getPublicacion');
    Route::get('/getListadoPublico', 'PublicacionController@getListadoPublico');
    Route::get('/getListado', 'PublicacionController@getListado');
    Route::post('/guardarPublicacion', 'PublicacionController@guardarPublicacion' );
    Route::post('/editPublicacion', 'PublicacionController@editPublicacion' );
    Route::post('/eliminarPublicacion', 'PublicacionController@eliminarPublicacion' );
    Route::post('/cambiarEstadoPublicacion', 'PublicacionController@cambiarEstadoPublicacion' );
    Route::get('/getPublicacionEdit/{id}', 'PublicacionController@getPublicacionEdit');
    Route::post('/EstadoPublicacion', 'PublicacionController@EstadoPublicacion' );
    
});


Route::controller('/bolsaEmpleo','BolsaEmpleoController');



Route::controller('/postulado','PostuladoController');



Route::controller('/noticias','NoticiaController');
/*
Route::controller('/promocionNoticia','PublicoNoticiaController');
Route::controller('/promocionInforme','PublicoInformeController');
Route::controller('/promocionPublicacion','PublicoPublicacionController');*/
Route::controller('/sliders','SliderController');
Route::controller('/suscriptores','SuscriptoreController');
Route::controller('/registrar','RegistrarController');

//Route::controller('/','HomeController');







Route::group(['middleware' => ['web']], function () {
 
    Route::get('/lang/{lang}', function ($lang) {
        session(['lang' => $lang]);
        return \Redirect::back();
    })->where([
        'lang' => 'en|es'
    ]);
    Route::controller('/visitante', 'VisitanteController');
    
    // Public Jáder
    Route::controller('/atracciones', 'AtraccionesController');
    
    Route::controller('/destinos', 'DestinosController');
    
    Route::controller('/quehacer', 'QueHacerController');
    
    Route::controller('/rutas', 'RutasTuristicasController');
    
    Route::controller('/eventos', 'EventosController');
    
    Route::controller('/proveedor', 'ProveedoresController');
    
    Route::controller('/actividades', 'ActividadesController');
    
    Route::controller('/promocionNoticia', 'PublicoNoticiaController');
    
    Route::controller('/promocionPublicacion', 'PublicoPublicacionController');
    
    Route::controller('/promocionInforme', 'PublicoInformeController');
    
    Route::controller('/promocionBolsaEmpleo','PublicoBolsaEmpleoController');
 
    Route::controller('/','HomeController');
 
});

