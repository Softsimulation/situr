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
    </style>
@endsection

@section('content')
<div class="content-head">
    <div class="container">
        <h2 class="text-uppercase">Informes</h2>
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
                            <label for="tipoInforme" class="control-label sr-only">Tipo de informe</label>
                            <select class="form-control" id="tipoInforme" name="tipoInforme" onchange="this.form.submit()">
                                <option value="" selected @if(isset($_GET['tipoInforme']) && $_GET['tipoInforme'] == "") disabled @endif>@if(isset($_GET['tipoInforme']) && $_GET['tipoInforme'] != "") Ver todos los registros @else - Seleccione el tipo de informe -  @endif</option>
                                @foreach($tipos as $tipo)
                                    <option value="{{$tipo->tipo_documento_id}}" @if(isset($_GET['tipoInforme']) && $_GET['tipoInforme'] == $tipo->tipo_documento_id) selected @endif>{{$tipo->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                    
                </div>
                <div class="col-xs-12 col-md-4 col-lg-5">
                    
                    
                        <div class="form-group">
                            <label for="categoriaInforme" class="control-label sr-only">Categoría de informe</label>
                            <select class="form-control" id="categoriaInforme" name="categoriaInforme" onchange="this.form.submit()">
                                <option value="" selected @if(isset($_GET['categoriaInforme']) && $_GET['categoriaInforme'] == "") disabled @endif>@if(isset($_GET['categoriaInforme']) && $_GET['categoriaInforme'] != "") Ver todos los registros @else - Seleccione la categoría -  @endif</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{$categoria->categoria_documento_id}}" @if(isset($_GET['categoriaInforme']) && $_GET['categoriaInforme'] == $categoria->categoria_documento_id) selected @endif>{{$categoria->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                    
                </div>
                <div class="col-xs-12 col-md-4 col-lg-2">
        			<button type="submit" class="btn btn-block btn-success" title="Buscar"><span class="glyphicon glyphicon-search"></span> Buscar</button>
        		</div>
            </div>
        </form>
    </div>
</div>
<div class="container">
@if(isset($_GET['buscar']) || isset($_GET['tipoInforme']) || isset($_GET['categoriaInforme']))
<div class="text-center">
    <a href="/promocionInforme/listado" class="btn btn-default">Limpiar filtros</a>
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
                    <span class="label label-info">{{$informe->tipoInforme}}</span>
                    <span class="label label-warning">{{$informe->categoriaInforme}}</span>
                </div>
            </div>
            <div class="tile-body">
                <div class="tile-caption">
                    <h3><a href="/promocionNoticia/ver/{{$informe->idNoticia}}">{{$informe->tituloInforme}}</a></h3>
                </div>
                <p class="text-muted">{{$informe->descripcion}}</p>
                <div class="text-right">
                    <a target="_blank" href="{{$informe->ruta}}" class="btn btn-xs btn-link">Descargar PDF</a>
                </div>
            </div>
        </div>
   </div>    
    @endforeach
    </div>
    {!!$informes->links()!!}
    @else
    <div class="alert alert-info">
        <p>No hay elementos publicados en este momento.</p>
    </div>
    @endif
    <div class="row">
    	<div class="col-xs-12">
    		<form name="guardarSuscriptor" action="/suscriptores/guardarsuscriptor" method="post">
    			<div class="form-group">
                    <input type="email" class="form-control" name="emailSuscriptor" id="emailSuscriptor" placeholder="Ingrese el correo donde desea recibir las notificaciones"/>
					<button type="submit" class="btn btn-success">Enviar</button>
                </div>
                @if($suscriptorExiste != null)
                    <div class="alert alert-warning">
                        <h6>Aviso</h6>
                        <span class="messages">
                              <span>*{{$suscriptorExiste}}</span><br/>
                        </span>
                    </div>
                @endif
    		</form>
    	</div>
    </div>
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