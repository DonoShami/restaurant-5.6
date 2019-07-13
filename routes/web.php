<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/inicio', 'HomeController@index')->name('inicio');
Route::get('/', function(){
	return view('index',['title' => 'HOME - APP']);
});
Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/lista','CarritoController@index');
Route::post('/lista/add','CarritoController@add')->name('addToCar');

//RUTAS USUARIOS LOGEADOS

Route::group(['prefix' => 'sistema','as' => 'sistema::','middleware' => 'auth'], function () {
    Route::get('/',['uses'=>'GeneralController@index'])->name('home');
    // RECURSOS PRINCIPALES
    Route::resource('/permiso','PermisoController');
    Route::resource('/zona','ZonasController');
    Route::resource('/tipousuario','TipoUsuarioController');
    Route::resource('/tipodocumento','TipoDocumentoController');
    Route::resource('/restaurant','restaurantController');
    
    Route::resource('/menu','MenuController');
    Route::resource('/igv','IgvController');
    // ORDENES
    Route::resource('/tipo_orden','TipoOrdenController');
    Route::resource('/estadoordenes','EstadoOrdenesController');
    // MESAS
    Route::resource('/estado_mesas','EstadoMesaController');
    Route::resource('/mesa','MesaController');    
    // PRODUCTO ENVIRONMENT
    Route::resource('/producto', 'ProductoController');
    
});

Route::group(['prefix' => 'sistema', 'middleware' => ['auth','usuario-mozo']],function(){
    //Login redireciona
    //Route::get('','MozoController@index');
    /*Ventas Rutas*/
    //Route::get('ordenes/agregar', 'OrdenController@create')->name('agregar_venta');
    Route::resource('/orden','OrdenController');

});
Route::group(['prefix' => 'sistema', 'middleware' => ['auth','usuario-administrador']],function(){

    Route::resource('/carta','CartaController');
    Route::resource('/carta-item','CartaItemController');
});