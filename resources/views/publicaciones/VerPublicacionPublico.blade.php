@extends('layout._publicLayout')
@section('title', $publicacion->titulo)
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
    <img src="{{$publicacion->portada}}" class="img-responsive" alt="Imagen de presentación de {{$publicacion->titulo}}">
    @endif
    @foreach($publicacion->temas as $tema)
    Temas
    <p>{{$tema}}</p>
    @endforeach
    @foreach($publicacion->personas as $personas)
    Personas
    <p>{{$personas->nombres}} {{$personas->apellidos}}</p>
    @endforeach
    @foreach($publicacion->palabras as $palabras)
    Palabras
    <p>{{$palabras->nombre}}</p>
    @endforeach
    <div id="contenidoNoticia">
        {!! $publicacion->descripcion !!}
    </div>
    @if ($publicacion->ruta != null)
    <div class="text-right">
          <p><i>Fuente: <a href="{{$publicacion->ruta}}" target="_blank">Clic para ir a la ruta</a></i></p>  
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


{{$publicacion}}

@endsection
