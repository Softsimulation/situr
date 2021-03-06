<?php
    use Illuminate\Support\Facades\Input;
?>
@extends('layout._publicLayout')
@section('title', 'Informes')

@section ('estilos')
    <style>
        header{
            position: static;
            background-color: black;
        }
        .nav-bar > .brand a img{
            height: auto;
        }
        .row{
        width: calc(100% + 30px);
        }
        .tile .tile-img.no-img{
            background-color: white;
        }
        .tile .tile-img.no-img img{
            height: 100px;
        }
        .tiles .tile .tile-img.no-img {
            height: 100px;
        }
        .content-head {
            padding-top: 1rem;
            background-color: whitesmoke;
            box-shadow: 0px 2px 4px -2px rgba(0,0,0,.35);
        }
        @media only screen and (min-width: 992px) {
            .tiles .tile {
                width: calc(33.33% - 1rem);
            }
        }
    </style>
@endsection

@section('content')
<div class="content-head">
    <div class="container">
        <h2 class="text-uppercase">{{trans('resources.publicaciones.informes')}}</h2>
        <hr/>
        <form method="GET" action="/promocionInforme/listado">
            <div class="row">
                
                
                <!--<div class="col-xs-12 col-md-12 col-lg-4">-->
                <!--    <div class="form-group has-feedback">-->
                <!--            <label class="sr-only">Búsqueda</label>-->
                <!--            <input type="text" name="buscar" class="form-control" id="buscar" placeholder="¿Qué desea buscar?" @if(isset($_GET['buscar'])) value="{{$_GET['buscar']}}" @endif maxlength="255" autocomplete="off">-->
                <!--            <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>-->
                        
                <!--    </div>-->
                <!--</div>-->
                <div class="col-xs-12 col-md-4 col-lg-5">
                    
                    
                        <div class="form-group">
                            <label for="tipoInforme" class="control-label sr-only">{{trans('resources.listado.tipoDeInforme')}}</label>
                            <select class="form-control" id="tipoInforme" name="tipoInforme" onchange="this.form.submit()">
                                <option value="" selected @if(isset($_GET['tipoInforme']) && $_GET['tipoInforme'] == "") disabled @endif>@if(isset($_GET['tipoInforme']) && $_GET['tipoInforme'] != "") {{trans('resources.listado.verTodosLosRegistros')}} @else - {{trans('resources.listado.seleccioneElTipoDeInforme')}} -  @endif</option>
                                @foreach($tipos as $tipo)
                                    <option value="{{$tipo->tipo_documento_id}}" @if(isset($_GET['tipoInforme']) && $_GET['tipoInforme'] == $tipo->tipo_documento_id) selected @endif>{{$tipo->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                    
                </div>
                <div class="col-xs-12 col-md-4 col-lg-5">
                    
                    
                        <div class="form-group">
                            <label for="categoriaInforme" class="control-label sr-only">{{trans('resources.listado.categoriaDeInforme')}}</label>
                            <select class="form-control" id="categoriaInforme" name="categoriaInforme" onchange="this.form.submit()">
                                <option value="" selected @if(isset($_GET['categoriaInforme']) && $_GET['categoriaInforme'] == "") disabled @endif>@if(isset($_GET['categoriaInforme']) && $_GET['categoriaInforme'] != "") {{trans('resources.listado.verTodosLosRegistros')}} @else - {{trans('resources.listado.seleccioneLaCategoria')}} -  @endif</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{$categoria->categoria_documento_id}}" @if(isset($_GET['categoriaInforme']) && $_GET['categoriaInforme'] == $categoria->categoria_documento_id) selected @endif>{{$categoria->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                    
                </div>
                <div class="col-xs-12 col-md-4 col-lg-2">
        			<button type="submit" class="btn btn-block btn-success" title="Buscar"><span class="glyphicon glyphicon-search"></span> {{trans('resources.listado.buscar')}}</button>
        		</div>
            </div>
        </form>
    </div>
</div>
<div class="container">
@if(isset($_GET['buscar']) || isset($_GET['tipoInforme']) || isset($_GET['categoriaInforme']))
<div class="text-center">
    <a href="/promocionInforme/listado" class="btn btn-default">{{trans('resources.listado.limpiarFiltros')}}</a>
</div>
@endif
<br>
    @if ($informes != null && count($informes) > 0)
    <div class="tiles">
        @foreach ($informes as $informe)
        <div class="tile @if(strlen($informe->tituloInforme) >= 200 || strlen($informe->descripcion) > 230) two-places @endif">
            <div class="tile-img @if(!$informe->portada) no-img @endif">
                @if($informe->portada)
                <img src="{{$informe->portada}}" alt="" role="presentation">
                @else
                <img src="/res/report.png" alt="" role="presentation">
                @endif
                <div class="text-overlap">
                    <span class="label label-info">{{$informe->tipoInforme}}</span><br>
                    <span class="label label-warning">{{$informe->categoriaInforme}}</span>
                </div>
            </div>
            <div class="tile-body">
                <div class="tile-caption">
                    <h3><a target="_blank" href="{{$informe->ruta}}">{{$informe->tituloInforme}}</a></h3>
                </div>
                <p class="text-muted">{{$informe->descripcion}}</p>
                <div class="text-right">
                    <a target="_blank" href="{{$informe->ruta}}" class="btn btn-xs btn-link">{{trans('resources.listado.descargarPDF')}}</a>
                </div>
            </div>
        </div>  
    @endforeach
    </div>
    {!!$informes->links()!!}
    @else
    <div class="alert alert-info">
        <p>{{trans('resources.listado.noHayElementos')}}.</p>
    </div>
    @endif
    <!--@if ($informes != null || count($informes) > 0)
        @foreach ($informes as $informe)
            Tipo de informe : {{$informe->tipoInforme}}
            <br>
            Categoría de informe : {{$informe->categoriaInforme}}
            <br>
            Autores : {{$informe->autores}}
            <br>
            Título : {{$informe->tituloInforme}}
            <br>
            Descripción : {{$informe->descripcion}}
            <br>
            Fecha de creación : {{$informe->fecha_creacion}}
            <br>
            Fecha de publicación : {{$informe->fecha_publicacion}}
            <br>
            Portada : {{$informe->portada}}
            <br>
            <a target="_blank" href="{{$informe->ruta}}">Ver PDF</a>
            <br>
            <a href="ver/{{$informe->id}}">Ver más de informe</a>
        @endforeach
    @endif-->
    
@endsection