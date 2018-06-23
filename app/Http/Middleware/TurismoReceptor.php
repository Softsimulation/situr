<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Visitante;
use Auth;

class TurismoReceptor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $visitante = Visitante::find($request->one);
        
        if(!$visitante){
            return \Redirect::to('/turismoreceptor/listadoencuestas')->with('message', 'El visitante no se encuentra registrado en el sistema.')
                    ->withInput();
        }else{
            $url = $request->route()->uri();
            if(strpos($url, 'turismoreceptor/seccionestancia') !== false){
                if( $visitante->ultima_sesion >= 1 ){
                     return $next($request);
                }else{
                    return \Redirect::to('/turismoreceptor/listadoencuestas')->with('message', 'Verifique que el visitante este en la sección adecuada.')
                        ->withInput();
                }
            }
            
            if(strpos($url, 'turismoreceptor/secciontransporte') !== false){
                if( $visitante->ultima_sesion >= 2){
                     return $next($request);
                }else{
                    return \Redirect::to('/turismoreceptor/listadoencuestas')->with('message', 'Verifique que el visitante este en la sección adecuada.')
                        ->withInput();
                }
            }
            
            if(strpos($url, 'turismoreceptor/secciongrupoviaje') !== false){
                if( $visitante->ultima_sesion >= 3){
                     return $next($request);
                }else{
                    return \Redirect::to('/turismoreceptor/listadoencuestas')->with('message', 'Verifique que el visitante este en la sección adecuada.')
                        ->withInput();
                }
            }
            
            if(strpos($url, 'turismoreceptor/secciongastos') !== false){
                if( $visitante->ultima_sesion >= 4){
                     return $next($request);
                }else{
                    return \Redirect::to('/turismoreceptor/listadoencuestas')->with('message', 'Verifique que el visitante este en la sección adecuada.')
                        ->withInput();
                }
            }
            
            if(strpos($url, 'turismoreceptor/seccionpercepcionviaje') !== false){
                if( $visitante->ultima_sesion >= 5){
                     return $next($request);
                }else{
                    return \Redirect::to('/turismoreceptor/listadoencuestas')->with('message', 'Verifique que el visitante este en la sección adecuada.')
                        ->withInput();
                }
            }
            
            
            if(strpos($url, 'turismoreceptor/seccionfuentesinformacion') !== false){
                if( $visitante->ultima_sesion >= 6){
                     return $next($request);
                }else{
                    return \Redirect::to('/turismoreceptor/listadoencuestas')->with('message', 'Verifique que el visitante este en la sección adecuada.')
                        ->withInput();
                }
            }
            
        }
        
        return $next($request);
    }
}
