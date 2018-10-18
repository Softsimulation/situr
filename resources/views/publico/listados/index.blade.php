<?php
/*
* Vista para listados del portal
*/
?>
@extends('layout._publicLayout')

@section('Title','Listados')
@section ('estilos')
    <link href="{{asset('/css/public/pages.css')}}" rel="stylesheet">
    <style>
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
@section ('content')
    <div class="container">
        <h2 class="title-section">Listados</h2>
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
            <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-filter" aria-hidden="true" title="Filtrar resultados" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter"></span><span class="sr-only">Filtrar resultados</span></button>
        </div>
        
        <div class="collapse" id="collapseFilter">
            <br/>
            <div class="well">
                <fieldset>
                    <legend>Filtrar búsqueda</legend>
                    <div class="row">
                        
                    </div>
                </fieldset>
            </div>
        </div>
        <hr/>
        <div id="listado" class="tiles">
            <div class="tile">
                <div class="tile-img">
                    <img src="/res/slider/slide1.jpeg" alt=""/>
                </div>
                <div class="tile-body">
                    <div class="tile-caption">
                        <h3><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras fringilla aliquam sem, in fringilla tortor fermentum et. Vestibulum at metus quam metus.</a></h3>    
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
            <div class="tile">
                <div class="tile-img">
                    <img src="/res/slider/slide1.jpeg" alt=""/>
                </div>
                <div class="tile-body">
                    <div class="tile-caption">
                        <h3><a href="#">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</a></h3>
                    </div>
                    
                </div>
            </div>
            <div class="tile">
                <div class="tile-img">
                    <img src="/res/slider/slide1.jpeg" alt=""/>
                </div>
                <div class="tile-body">
                    <div class="tile-caption">
                        <h3><a href="#">Lorem ipsum dolor sit amet</a></h3>    
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras fringilla aliquam sem, in fringilla tortor fermentum et. Vestibulum at metus quam metus.</p>
                </div>
            </div>
            <div class="tile">
                <div class="tile-img">
                    <img src="/res/slider/slide1.jpeg" alt=""/>
                </div>
                <div class="tile-body">
                    <div class="tile-caption">
                        <h3><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras fringilla aliquam sem.</a></h3>    
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dignissim nisl at nisl viverra fusce.</p>
                </div>
            </div>
            <div class="tile">
                <div class="tile-img">
                    <img src="/res/slider/slide1.jpeg" alt=""/>
                </div>
                <div class="tile-body">
                    <div class="tile-caption">
                        <h3><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nullam</a></h3>    
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras fringilla aliquam sem, in fringilla tortor fermentum et. Vestibulum at metus quam metus.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
<script>
    $(document).ready(function(){
       $('.nav-bar > .brand a img').attr('src','/res/logo/black/96.png'); 
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