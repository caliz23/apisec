<?php
namespace Routes;
use Core\Route;


class Routes
{
    public static function ListaRutas()
    {
        //GETs
        Route::get('/', "Ruta Inicial");
        Route::get('/api/auth', "Ruta Api");
       
        Route::get('/api/usuarios', "Ruta Api");		
        Route::post('/api/usuarios', "Ruta Api");		
        Route::put('/api/usuarios', "Ruta Api");		
        Route::delete('/api/usuarios', "Ruta Api");		
       
        Route::get('/api/roles', "Ruta Api");		
        Route::post('/api/roles', "Ruta Api");		
        Route::put('/api/roles', "Ruta Api");		
        Route::delete('/api/roles', "Ruta Api");		
      
        Route::get('/api/permisos', "Ruta Api");		
        Route::post('/api/permisos', "Ruta Api");		
        Route::put('/api/permisos', "Ruta Api");		
        Route::delete('/api/permisos', "Ruta Api");		

        Route::get('/api/aplicaciones', "Ruta Api");		
        Route::post('/api/aplicaciones', "Ruta Api");		
        Route::put('/api/aplicaciones', "Ruta Api");		
        Route::delete('/api/aplicaciones', "Ruta Api");		

        
       
//Route::post('/api/usuarios/', "Ruta Api");
        //Route::put('/api/usuarios/', "Ruta Api");
       // Route::delete('/api/usuarios/', "Ruta Api");
        
    }
}
