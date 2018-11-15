@extends('layout._publicLayout')
@section('Title', $publicacion->titulo)
@section('estilos')
<style>
header{
    position: static;
    background-color: black;
    margin-bottom: 1rem;
}
#contenidoNoticia h1, #contenidoNoticia h2, #contenidoNoticia h3, #contenidoNoticia h4, #contenidoNoticia h5, #contenidoNoticia h6,
    #contenidoNoticia strong{
        font-weight: 500;
    }
h1 small.btn-block, h2 small.btn-block, h3 small.btn-block, h4 small.btn-block, h5 small.btn-block, h6 small.btn-block {
    line-height: 2;
}

main h1, main h2, main h3, main h4, main h5, main h6 {
    color: #004a87;
}
.btn.btn-circle {
    font-size: 1.5rem;
    line-height: 1.35;
    padding: .5rem;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    text-align: center;
}
#shareButtons{
    margin-top: .5rem;
    
}
.list-group-item:first-child {
    border-radius: 0;
    border-top: 0;
}
.list-group-item:last-child {
    border-radius: 0;
    border-bottom: 0;
}
.list-group-item {
    border-left: 0;
    border-right: 0;
    padding: .5rem 1rem;
    border-color: #eee;
}
</style>
@endsection

@section('content')
<div class="container">
    <ol class="breadcrumb">
      <li><a href="/">Inicio</a></li>
      <li><a href="/promocionPublicacion/listado">Biblioteca digital</a></li>
      <li class="active">{{$publicacion->titulo}}</li>
    </ol>
    <h2>{{$publicacion->titulo}}</h2>
    <hr>
    @if($publicacion->resumen)
    <blockquote style="white-space:pre-line;">{{$publicacion->resumen}}</blockquote>
    @endif
    @if($publicacion->portada && $publicacion->portada != null)
    <img src="{{$publicacion->portada}}" class="img-responsive" alt="Imagen de presentación de {{$publicacion->titulo}}" style="margin-bottom: 1rem;">

    @endif
    
    <div id="contenidoNoticia">
        {!! $publicacion->descripcion !!}
    </div>
    @if($publicacion->temas || $publicacion->personas || $publicacion->palabras)
    <hr>
    @endif
    <div class="row">
        @if($publicacion->temas)
        <div class="col-xs-12 col-md-4">
            <strong>Temas</strong>
            <ul class="list-group">
            @foreach($publicacion->temas as $tema)
            <li class="list-group-item">{{$tema->idiomas[0]['nombre']}}</li>
            @endforeach
            </ul>
        </div>
        @endif
        @if($publicacion->personas)
        <div class="col-xs-12 col-md-4">
            <strong>Personas</strong>
            <ul class="list-group">
            @foreach($publicacion->personas as $personas)
            <li class="list-group-item">{{$personas->nombres}} {{$personas->apellidos}}</li>
            @endforeach
            </ul>
        </div>
        @endif
        @if($publicacion->palabras)
        <div class="col-xs-12 col-md-4">
            <strong>Palabras</strong>
            <ul class="list-group">
            @foreach($publicacion->palabras as $palabras)
            <li class="list-group-item">{{$palabras->nombre}}</li>
            @endforeach
            </ul>
        </div>
        @endif
    </div>
   
    @if ($publicacion->ruta != null)
    <div class="text-center">
        <a role="button" class="btn btn-lg btn-success" href="{{$publicacion->ruta}}" target="_blank"><i class="ion-android-download"></i> Descargar archivo</a>
    </div>
    @endif
    <div id="shareButtons" class="text-right">
        <p>Comparte esta publicación</p>
        <a href="https://www.facebook.com/sharer/sharer.php?u={{\Request::url()}}" role="button" class="btn btn-circle btn-primary" title="Compartir en Facebook" target="_blank" rel="noopener noreferrer">
            <span class="ion-social-facebook" aria-hidden="true"></span>
            <span class="sr-only">Compartir en Facebook</span>
        </a>
        <a href="https://twitter.com/home?status= {{$publicacion->titulo}} por SITUR Atlántico. Lee más en {{\Request::url()}}" role="button" class="btn btn-circle btn-info" title="Compartir en Twitter" target="_blank" rel="noopener noreferrer">
            <span class="ion-social-twitter" aria-hidden="true"></span>
            <span class="sr-only">Compartir en Twitter</span>
        </a>
        <a href="https://plus.google.com/share?url={{\Request::url()}}" role="button" class="btn btn-circle btn-danger" title="Compartir en Google +" target="_blank" rel="noopener noreferrer">
            <span class="ion-social-googleplus" aria-hidden="true"></span>
            <span class="sr-only">Compartir en Google +</span>
        </a>
        <button type="button" class="btn btn-circle btn-default" title="Imprimir esta publicación" onclick="window.print();return false;">
            <span class="ion-android-print" aria-hidden="true"></span>
            <span class="sr-only">Imprimir esta publicación</span>
        </button>
    </div>
    
 
</div>


@endsection
