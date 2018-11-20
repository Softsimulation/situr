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
						<span class="hidden-xs">Ubicación</span>
					</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12 col-xs-12 text-center">
            <h1>Nombre: {{$evento->eventosConIdiomas[0]->nombre}} Edicion {{$evento->eventosConIdiomas[0]->edicion or 'No disponible'}}</h1>
        </div>
    </div>
    @if(Session::has('message'))
        <div class="alert alert-info" role="alert" style="text-align: center;">{{Session::get('message')}}</div>
    @endif
    <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-4 col-sm-offset-4">
            Descripción: {{$evento->eventosConIdiomas[0]->descripcion}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-4 col-sm-offset-4">
            Valor mínimo: {{$evento->valor_min}} Valor máximo: {{$evento->valor_max}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-4 col-sm-offset-4">
            Fecha de inicio: {{$evento->fecha_in}} Fecha de fin: {{$evento->fecha_fin}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-4 col-sm-offset-4">
            Teléfono: {{$evento->telefono or 'No disponible'}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-4 col-sm-offset-4">
            Página web: {{$evento->web or 'No disponible'}}
        </div>
    </div>
    {{-- La posición 0 es la portada --}}
    <div class="row">
        <img src="{{$evento->multimediaEventos[0]->ruta}}"></img>
    </div>
    <div class="row">
        {{-- La cuenta empieza desde 1 porque la primera posición es la portada --}}
        @for($i = 1; $i < count($evento->multimediaEventos[0]->ruta); $i++)
        <img src="{{$evento->multimediaEventos[0]->ruta}}"></img>
        @endfor
    </div>
    <div class="row">
        <iframe src="{{$video_promocional}}">
        </iframe>
    </div>
    <br/>
    <h4>Sitios: </h4>
    <div class="row">
        @foreach ($evento->sitiosConEventos as $sitio)
        <div class="col-sm-12 col-md-12 col-xs-12">
            {{$sitio->sitiosConIdiomas[0]->nombre}}
        </div>
        @endforeach
    </div>
@endsection
