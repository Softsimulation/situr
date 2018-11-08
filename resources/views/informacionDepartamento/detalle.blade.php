@extends('layout._publicLayout')
@section('title', '')


@section('content')
    
    <br><br><br><br><br><br><br><br>
    <p>{{$informacion->titulo}}</p>
    
    <br><br>
    {!! $informacion->cuerpo !!}
    
    @foreach ($informacion->imagenes as $imagen)
       <img src="{{$imagen->ruta}}" ></img>
    @endforeach
    
@endsection