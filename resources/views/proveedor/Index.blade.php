<?php
header("Access-Control-Allow-Origin: *");

function parse_yturl($url) 
{
    $pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
    preg_match($pattern, $url, $matches);
    return (isset($matches[1])) ? $matches[1] : false;
}

function getItemType($type){
    $path = ""; $name = "";
    switch($type){
        case(1):
            $name = "Alojamiento";
            $path = "/proveedor/ver/";
            break;
        case(2):
            $name = "Establecimientos de gastronomía";
            $path = "/atracciones/ver/";
            break;
        case(3):
            $name = "Agencias de viaje";
            $path = "/destinos/ver/";
            break;
        case(4):
            $name = "Establecimientos de esparcimiento y similares";
            $path = "/eventos/ver/";
            break; 
        case(5):
            $name = "Transporte especializado ";
            $path = "/rutas/ver/";
            break;
    }
    return (object)array('name'=>$name, 'path'=>$path);
}

$tituloPagina = "Proveedores";
if(!is_null($tipoProveedor)){
    $tituloPagina = $tipoProveedor->tipoProveedoresConIdiomas->first()->nombre;
}

$colorTipo = ['primary','success','danger', 'info', 'warning'];


?>
@extends('layout._publicLayout')

@section('Title', '¿Qué hacer?')

@section('estilos')
    <link href="{{asset('/css/public/pages.css')}}" rel="stylesheet">
    
    <style>
        header {
            position: relative;
            background: black;
            margin-bottom: 1rem;
        }
        .tile .tile-caption h3 {
            margin: 0;
            font-size: 1rem;
            text-transform: uppercase;
            font-weight: 700;
        }
        .ionicons-inline {
            font-size: 1.5rem;
        }
        .tile .tile-img .text-overlap {
            font-family: Roboto, sans-serif;
        }
        .tile-date {
            font-size: 0.875rem;
            font-family: Roboto, sans-serif;
            color: #757575;
        }
        .nav-bar > .brand a img{
            width: auto;
            height: 72px;
        }
        #opciones{
            text-align:right;
        }
        #opciones button, #opciones form{
            display:inline-block;
        }
        .input-group .form-control{
            font-size: 1rem;
            height: auto;
        }
        .input-group .input-group-addon {
            padding: 0;
        }
        .input-group .input-group-addon .btn{
            border-radius: 2px;
            border: 0;
        }
        #collapseFilter{
            position: fixed;
            left: 0px;
            top: 0px;
            height: 100%;
            max-width: 220px;
            background-color: rgba(255, 255, 255, 0.95);
            z-index: 60;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }
    </style>
    
@endsection

@section('TitleSection','Proveedores de servicios turísticos')

@section('meta_og')
<meta property="og:title" content="que hacer" />
<meta property="og:image" content="{{asset('/res/img/brand/128.png')}}" />
<meta property="og:description" content="¿Qué hacer?"/>
@endsection

@section ('estilos')
    <link href="{{asset('/css/public/pages.css')}}" rel="stylesheet">
    <link href="{{asset('/css/public/details.css')}}" rel="stylesheet">
    <link href="//cdn.materialdesignicons.com/2.5.94/css/materialdesignicons.min.css" rel="stylesheet">
    
@endsection

@section('content')
<div class="container">
    <h2 class="text-uppercase">{{$tituloPagina}}</h2>
    
    <div id="opciones">
        <button type="button" class="btn btn-default" onclick="changeViewList(this,'listado','tile-list')" title="Vista de lista"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span><span class="sr-only">{{trans('resources.listado.vistaLista')}}</span></button>
        <button type="button" class="btn btn-default" onclick="changeViewList(this,'listado','')" title="Vista de mosaico"><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span><span class="sr-only">{{trans('resources.listado.vistaMosaico')}}</span></button>
        <form class="form-inline">
            <div class="form-group">
                <label class="sr-only" for="searchMain">{{trans('resources.listado.buscadorGeneral')}}</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="searchMain" placeholder="{{trans('resources.listado.queDeseaBuscar')}}" maxlength="255">
                    <div class="input-group-addon"><button type="submit" class="btn btn-default" title="Buscar"><span class="glyphicon glyphicon-search" aria-hidden="true"></span><span class="sr-only">{{trans('resources.listado.buscar')}}</span></button></div>
                </div>
                
            </div>
            
        </form>
        <!--<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-filter" aria-hidden="true" title="Filtrar resultados" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter"></span><span class="sr-only">Filtrar resultados</span></button>-->
    </div>
    <hr/>
    
    @if(count($proveedores))
    
    <div id="listado" class="tiles">
        @foreach($proveedores as $proveedor)
        <div class="tile">
            <div class="tile-img">
                @if(!is_null($proveedor->multimediaProveedores) && count($proveedor->multimediaProveedores) > 0)
                <img src="{{$proveedor->multimediaProveedores->first()->ruta}}" alt="{{$proveedor->multimediaProveedores->first()->texto_alternativo}}">
                @else
                <img src="" alt="" role="presentation" aria-hidden="true">
                @endif
                <div class="text-overlap">
                    <span class="label label-success">{{$proveedor->proveedorRnt->categoriaProveedor->tipoProveedor->tipoProveedoresConIdiomas->first()->nombre}}</span>
                </div>
            </div>
            <div class="tile-body">
                <div class="tile-caption">
                    
                    <h3><a href="/proveedor/ver/{{$proveedor->id}}">{{$proveedor->proveedorRnt->idiomas->first()->nombre}}</a></h3>
                </div>
                <div class="btn-block ranking">
    	              <span class="{{ ($proveedor->calificacion_legusto > 0.0) ? (($proveedor->calificacion_legusto <= 0.9) ? 'ionicons-inline ion-android-star-half' : 'ionicons-inline ion-android-star') : 'ionicons-inline ion-android-star-outline'}}" aria-hidden="true"></span>
    	              <span class="{{ ($proveedor->calificacion_legusto > 1.0) ? (($proveedor->calificacion_legusto <= 1.9) ? 'ionicons-inline ion-android-star-half' : 'ionicons-inline ion-android-star') : 'ionicons-inline ion-android-star-outline'}}" aria-hidden="true"></span>
    	              <span class="{{ ($proveedor->calificacion_legusto > 2.0) ? (($proveedor->calificacion_legusto <= 2.9) ? 'ionicons-inline ion-android-star-half' : 'ionicons-inline ion-android-star') : 'ionicons-inline ion-android-star-outline'}}" aria-hidden="true"></span>
    	              <span class="{{ ($proveedor->calificacion_legusto > 3.0) ? (($proveedor->calificacion_legusto <= 3.9) ? 'ionicons-inline ion-android-star-half' : 'ionicons-inline ion-android-star') : 'ionicons-inline ion-android-star-outline'}}" aria-hidden="true"></span>
    	              <span class="{{ ($proveedor->calificacion_legusto > 4.0) ? (($proveedor->calificacion_legusto <= 5.0) ? 'ionicons-inline ion-android-star-half' : 'ionicons-inline ion-android-star') : 'ionicons-inline ion-android-star-outline'}}" aria-hidden="true"></span>
    	              <span class="sr-only">Posee una calificación de {{$proveedor->calificacion_legusto}}</span>
    	            
    	        </div>
            </div>
        </div>
        @endforeach
    </div>
   
    @else
    <div class="alert alert-info">
        <p>{{trans('resources.listado.noHayElementos')}}</p>
    </div>
    @endif
</div>
    
@endsection
@section('javascript')
<script>
    $(document).ready(function(){
       $('.nav-bar > .brand a img').attr('src','/res/logo/white/72.png');
    });
</script>
<script>
    function changeViewList(obj, idList, view){
        var element, name, arr;
        element = document.getElementById(idList);
        name = view;
        element.className = "tiles " + name;
    }
</script>
@endsection