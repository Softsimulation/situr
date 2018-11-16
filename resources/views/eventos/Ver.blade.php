<?php
header("Access-Control-Allow-Origin: *");
function parse_yturl($url) 
{
    $pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
    preg_match($pattern, $url, $matches);
    return (isset($matches[1])) ? $matches[1] : false;
}
?>
@extends('layout._publicLayout')

@section('Title',$evento->eventosConIdiomas[0]->nombre)

@section('meta_og')
<meta property="og:title" content="Conoce {{$evento->eventosConIdiomas[0]->nombre}} en el departamento del Magdalena" />
<meta property="og:image" content="{{asset('/res/img/brand/128.png')}}" />
<meta property="og:description" content="{{$evento->eventosConIdiomas[0]->descripcion}}"/>
@endsection

@section ('estilos')
    <link href="{{asset('/css/public/pages.css')}}" rel="stylesheet">
    @if(count($evento->multimediaEventos) == 0)
        <style>
            header {
                position: relative;
                background: black;
                margin-bottom: 1rem;
            }
            .carousel-caption{
                position: static;
                padding: 0;
                color: #333;
            }
            .carousel-caption h2 {
                text-shadow: none;
                font-size: 2.325rem;
                color: #185a1e;
            }
            .carousel-caption h2 small, .carousel-caption .ion-android-star, .carousel-caption .ion-android-star-outline{
                color:darkorange;
            }
            .btn.btn-lg.btn-circled{
                font-size: 1.825rem;
                color: red;
                background: whitesmoke;
            }
            .nav-bar nav>ul li ul a, .submenu{
                background-color:white;
            }
        </style>
    @endif
@endsection

@section('content')
    <div id="carousel-main-page" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        @for($i = 0; $i < count($evento->multimediaEventos); $i++)
            <li data-target="#carousel-main-page" data-slide-to="{{$i}}" {{  $i === 0 ? 'class=active' : '' }}></li>
        @endfor
      </ol>
    
      <!-- Wrapper for slides -->
        
      
      <div class="carousel-inner">
        @for($i = 0; $i < count($evento->multimediaEventos); $i++)
        <div class="item {{  $i === 0 ? 'active' : '' }}">
          <img src="{{$evento->multimediaEventos[$i]->ruta}}" alt="Imagen de presentación de {{$evento->eventosConIdiomas[0]->nombre}}">
          
        </div>
        @endfor
        
      </div>
      <div class="carousel-caption">
          <h2>{{$evento->eventosConIdiomas[0]->nombre}}
              @if($evento->eventosConIdiomas[0]->edicion)
              <small class="btn-block">
	              Ed. {{$evento->eventosConIdiomas[0]->edicion}} del {{date("j/m/y", strtotime($evento->fecha_in))}} al {{date("j/m/y", strtotime($evento->fecha_fin))}}
	            
	          </small>
	          @endif
          </h2>
          <div class="text-center">
            @if(Auth::check())
                <form role="form" action="/eventos/favorito" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="evento_id" value="{{$evento->id}}" />
                    <button type="submit" class="btn btn-lg btn-circled btn-favorite">
                      <span class="ion-android-favorite" aria-hidden="true"></span><span class="sr-only">Marcar como favorito</span>
                    </button>    
                </form>
            @else
                <button type="button" class="btn btn-lg btn-circled" title="Marcar como favorito" data-toggle="modal" data-target="#modalIniciarSesion">
                  <span class="ion-android-favorite-outline" aria-hidden="true"></span><span class="sr-only">Marcar como favorito</span>
                </button>
            @endif
              
          </div>
      </div>
      <!-- Controls -->
      <!--<a class="left carousel-control" href="#carousel-main-page" role="button" data-slide="prev">-->
      <!--  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>-->
      <!--  <span class="sr-only">Anterior</span>-->
      <!--</a>-->
      <!--<a class="right carousel-control" href="#carousel-main-page" role="button" data-slide="next">-->
      <!--  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>-->
      <!--  <span class="sr-only">Siguiente</span>-->
      <!--</a>-->
    </div>
    <div id="menu-page">
        <div class="container">
            <ul id="menu-page-list">
                <li>
                    <a href="#informacionGeneral" class="toSection">
						<i class="ionicons ion-information-circled" aria-hidden="true"></i>
						<span class="hidden-xs">Información general</span>
					</a>
                </li>
                <li>
                    <a href="#caracteristicas" class="toSection">
						<i class="ionicons ionicons ion-android-pin" aria-hidden="true"></i>
						<span class="hidden-xs">{{trans('resources.detalle.queDeboTenerEnCuenta')}}</span>
					</a>
                </li>
            </ul>
        </div>
    </div>
    @if(Session::has('message'))
        <div class="alert alert-info" role="alert" style="text-align: center;">{{Session::get('message')}}</div>
    @endif
    <section id="informacionGeneral" class="container">
        <h3 class="title-section">{{$evento->eventosConIdiomas[0]->nombre}} <small>Ed: {{$evento->eventosConIdiomas[0]->edicion or 'No disponible'}}</small></h2>
        <div class="row">
            <div class="col-xs-12">
                @if($video_promocional != null)
                <iframe src="https://www.youtube.com/embed/<?php echo parse_yturl($video_promocional); ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen style="width: 100%; height: 350px;margin-bottom: 1rem;"></iframe>
                @endif
            </div>
            <div class="col-xs-12 col-md-8">
                 <p style="white-space: pre-line;">{{$evento->eventosConIdiomas[0]->descripcion}}</p>
            </div>
            <div class="col-xs-12 col-md-4">
                <ul class="list">
                    <li>
                        <div class="row align-items-center">
                            <div class="col-xs-2">
                                <span class="ionicons ion-cash" aria-hidden="true"></span> <span class="sr-only">Valor estimado</span>
                            </div>
                            <div class="col-xs-10">
                                <div class="form-group">
                                    <label>Valor estimado</label>
                                    <p class="form-control-static">
                                        ${{number_format(intval($evento->valor_min))}} - ${{number_format(intval($evento->valor_max))}}
                                    </p>
                                </div>
                                
                            </div>
                            
                        </div>
                    </li>
                    <li>
                        <div class="row align-items-center">
                            <div class="col-xs-2">
                                <span class="ionicons ion-calendar" aria-hidden="true"></span> <span class="sr-only">Fechas del evento</span>
                            </div>
                            <div class="col-xs-10">
                                <div class="form-group">
                                    <label>Fechas del evento</label>
                                    <p class="form-control-static">
                                        {{trans('resources.listado.fechaEvento', ['fechaInicio' => date('d/m/Y', strtotime($evento->fecha_inicio)), 'fechaFin' => date('d/m/Y', strtotime($evento->fecha_fin))])}}
                                        
                                    </p>
                                </div>
                                
                            </div>
                            
                        </div>
                    </li>
                    @if($evento->telefono != null)
                    <li>
                        <div class="row align-items-center">
                            <div class="col-xs-2">
                                <span class="ionicons ion-android-call" aria-hidden="true"></span> <span class="sr-only">Teléfono</span>
                            </div>
                            <div class="col-xs-10">
                                <div class="form-group">
                                    <label>Teléfono</label>
                                    <p class="form-control-static">{{$evento->telefono}}</p>
                                </div>
                                
                            </div>
                        </div>
                    </li>
                    @endif
                    @if($evento->sitio_web != null)
                    <li>
                        <div class="row align-items-center">
                            <div class="col-xs-2">
                                <span class="ionicons ion-android-globe" aria-hidden="true"></span> <span class="sr-only">Sitio web</span>
                            </div>
                            <div class="col-xs-10">
                                <div class="form-group">
                                    <label>Sitio web</label>
                                    <p class="form-control-static">
                                        <a href="{{$evento->sitio_web}}" target="_blank" rel="noopener noreferrer">Clic para ir al sitio web</a>
                                    </p>
                                </div>
                                
                            </div>
                        </div>
                    </li>
                    @endif
                    
                </ul>    
            </div>
        </div>
    </section>

    <!--{{-- La posición 0 es la portada --}}-->
    <!--<div class="row">-->
    <!--    <img src="{{$evento->multimediaEventos[0]->ruta}}"></img>-->
    <!--</div>-->
    <!--<div class="row">-->
    <!--    {{-- La cuenta empieza desde 1 porque la primera posición es la portada --}}-->
    <!--    @for($i = 1; $i < count($evento->multimediaEventos[0]->ruta); $i++)-->
    <!--    <img src="{{$evento->multimediaEventos[0]->ruta}}"></img>-->
    <!--    @endfor-->
    <!--</div>-->
    @if(count($evento->sitiosConEventos) > 0)
    <section id="caracteristicas" class="container">
        <h3 class="title-section">Sitios</h3>
        <div class="tiles">
            @foreach ($evento->sitiosConEventos as $sitio)
            <div class="tile">
                <div class="tile-body">
                    {{$sitio->sitiosConIdiomas[0]->nombre}}
                </div>
                
            </div>
            @endforeach
        </div>
    </section>
    @endif
@endsection
