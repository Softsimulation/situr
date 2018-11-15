@extends('layout._publicLayout')
@section('title', '')

@section ('estilos')
    <style>
        header{
            position: static;
            background-color: black;
            margin-bottom: 1rem;
        }
        .nav-bar > .brand a img{
            height: auto;
        }
        .carousel-inner:after{
            background-color: transparent;
        }
    </style>
@endsection


@section('content')
    <div class="container">
        <h2 class="text-danger text-center">{{$informacion->titulo}}</h2>
    </div>
        @if(count($informacion->imagenes) > 0)
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            @for ($i = 0; $i < count($informacion->imagenes); $i++)
            <li data-target="#carousel-example-generic" data-slide-to="{{$i}}" @if($i == 0) class="active" @endif></li>
            @endfor
          </ol>
        
          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
            @for ($i = 0; $i < count($informacion->imagenes); $i++)
            <div class="item @if($i == 0) active @endif">
              <img src="{{$informacion->imagenes[$i]->ruta}}" alt="" role="presentation">
            </div>
            @endfor
          </div>
        
          <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Siguiente</span>
          </a>
        </div>
        <br>
        @endif
        <div class="container">
    <div id="contentDetalle">
        {!! $informacion->cuerpo !!}
        
        {{$informacion->video}}
    </div>
    
    </div>
    
    
@endsection