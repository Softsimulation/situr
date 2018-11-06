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
            $name = "Actividades";
            $path = "/actividades/ver/";
            break;
        case(2):
            $name = "Atracciones";
            $path = "/atracciones/ver/";
            break;
        case(3):
            $name = "Destinos";
            $path = "/destinos/ver/";
            break;
        case(4):
            $name = "Eventos";
            $path = "/eventos/ver/";
            break; 
        case(5):
            $name = "Rutas turísticas";
            $path = "/rutas/ver/";
            break;
    }
    return (object)array('name'=>$name, 'path'=>$path);
}

$tipoItem = (isset($_GET['tipo'])) ? $_GET['tipo'] : 0 ;

$tituloPagina = ($tipoItem) ? getItemType($tipoItem)->name : "Vive el Atlántico";

$colorTipo = ['primary','success','danger', 'info', 'warning'];

$countItems = false;

for($i = 0; $i < count($query); $i++){
    if($tipoItem && $query[$i]->tipo == $tipoItem){
        $countItems = true;
        break;
    }
}
$countItems = ($tipoItem) ? $countItems : count($query) > 0;
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

@section('TitleSection','Actividades')

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
        <button type="button" class="btn btn-default" onclick="changeViewList(this,'listado','tile-list')" title="Vista de lista"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span><span class="sr-only">Vista de lista</span></button>
        <button type="button" class="btn btn-default" onclick="changeViewList(this,'listado','')" title="Vista de mosaico"><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span><span class="sr-only">Vista de mosaico</span></button>
        <form class="form-inline">
            <div class="form-group">
                <label class="sr-only" for="searchMain">Buscador general</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="searchMain" placeholder="¿Qué desea buscar?" maxlength="255">
                    <div class="input-group-addon"><button type="submit" class="btn btn-default" title="Buscar"><span class="glyphicon glyphicon-search" aria-hidden="true"></span><span class="sr-only">Buscar</span></button></div>
                </div>
                
            </div>
            
        </form>
        <!--<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-filter" aria-hidden="true" title="Filtrar resultados" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter"></span><span class="sr-only">Filtrar resultados</span></button>-->
    </div>
    <hr/>
    
    @if($countItems)
    <div id="listado" class="tiles">
    @for($i = 0; $i < count($query); $i++)
        @if(!$tipoItem || ($tipoItem && $query[$i]->tipo == $tipoItem))
        <div class="tile">
            
            <div class="tile-img">
                @if($query[$i]->portada != null && $query[$i]->portada != "")
                <img src="{{$query[$i]->portada}}" alt="Imagen de presentación de {{$query[$i]->nombre}}"/>
                @endif
                @if(!$tipoItem)
                <div class="text-overlap">
                    <span class="label label-{{$colorTipo[$query[$i]->tipo - 1]}}">{{getItemType($query[$i]->tipo)->name}}</span>
                </div>
                @endif
            </div>
            
            <div class="tile-body">
                <div class="tile-caption">
                    
                    <h3><a href="{{getItemType($query[$i]->tipo)->path}}{{$query[$i]->id}}">{{$query[$i]->nombre}}</a></h3>
                </div>
                @if($query[$i]->tipo == 4)
                <p class="tile-date">Del {{date('d/m/Y', strtotime($query[$i]->fecha_inicio))}} al {{date('d/m/Y', strtotime($query[$i]->fecha_fin))}}</p>
                @endif
                <div class="btn-block ranking">
    	              <span class="{{ ($query[$i]->calificacion_legusto > 0.0) ? (($query[$i]->calificacion_legusto <= 0.9) ? 'ionicons-inline ion-android-star-half' : 'ionicons-inline ion-android-star') : 'ionicons-inline ion-android-star-outline'}}" aria-hidden="true"></span>
    	              <span class="{{ ($query[$i]->calificacion_legusto > 1.0) ? (($query[$i]->calificacion_legusto <= 1.9) ? 'ionicons-inline ion-android-star-half' : 'ionicons-inline ion-android-star') : 'ionicons-inline ion-android-star-outline'}}" aria-hidden="true"></span>
    	              <span class="{{ ($query[$i]->calificacion_legusto > 2.0) ? (($query[$i]->calificacion_legusto <= 2.9) ? 'ionicons-inline ion-android-star-half' : 'ionicons-inline ion-android-star') : 'ionicons-inline ion-android-star-outline'}}" aria-hidden="true"></span>
    	              <span class="{{ ($query[$i]->calificacion_legusto > 3.0) ? (($query[$i]->calificacion_legusto <= 3.9) ? 'ionicons-inline ion-android-star-half' : 'ionicons-inline ion-android-star') : 'ionicons-inline ion-android-star-outline'}}" aria-hidden="true"></span>
    	              <span class="{{ ($query[$i]->calificacion_legusto > 4.0) ? (($query[$i]->calificacion_legusto <= 5.0) ? 'ionicons-inline ion-android-star-half' : 'ionicons-inline ion-android-star') : 'ionicons-inline ion-android-star-outline'}}" aria-hidden="true"></span>
    	              <span class="sr-only">Posee una calificación de {{$query[$i]->calificacion_legusto}}</span>
    	            
    	          </div>
    	          
            </div>
        </div>
        @endif
    @endfor
    </div>
    @else
    <div class="alert alert-info">
        <p>No hay elementos disponibles para mostrar.</p>
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