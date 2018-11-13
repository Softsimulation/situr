@extends('layout._publicLayout')

@section('title', 'Mis favoritos')

@section('estilos')
    <style>
        .panel-body {
            max-height: 400px;
            color: white;
        }

        .filter-select {
            color: darkgray;
            border: 1px solid lightgrey;
            font-family: Arial;
            font-size: 1.2em;
        }

        .messages {
            color: #FA787E;
        }

        form.ng-submitted input.ng-invalid {
            border-color: #FA787E;
        }

        form input.ng-invalid.ng-touched {
            border-color: #FA787E;
        }

        .mensaje-caracteres {
            float: right;
            margin-top: -2px;
            padding: 0px;
        }

        .carga {
            display: none;
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: rgba(0, 0, 0, 0.57) url(../../Content/Cargando.gif) 50% 50% no-repeat;
        }
        /* Cuando el body tiene la clase 'loading' ocultamos la barra de navegacion */
        body.charging {
            overflow: hidden;
        }

        /* Siempre que el body tenga la clase 'loading' mostramos el modal del loading */
        body.charging .carga {
            display: block;
        }
        .form-group {
            margin: 0;
        }
        .form-group label, .form-group .control-label, label {
            font-size: smaller;
        }
        .input-group {
            display: flex;
        }
        .input-group-addon {
            width: 3em;
        }
        .text-error {
            color: #a94442;
            font-style: italic;
            font-size: .7em;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        p {
            font-size: .9em;
        }
        .row {
            margin: 1em 0 0;
        }
    </style>
    
    <link href="{{asset('/css/ADM-dateTimePicker.min.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('/css/sweetalert.min.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('/css/styleLoading.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('/css/object-table-style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('/css/ADM-dateTimePicker.min.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('/css/select.min.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('/css/select2.css')}}" rel='stylesheet' type='text/css' />
@endsection

@section('TitleSection', 'Mis favoritos')



@section('content')
<div class="main-page" ng-app="visitanteApp" ng-controller="misFavoritosCtrl">
    
    <div class="content-titulo">
        <div style="position: absolute; bottom: 0; width: 100%;">
            <div style="text-align: center; margin-top: 1em;">
                <a href="#" class="btn btn-default titulo-btn">Antes de viajar</a>
            </div>
            <div id="titulo">
                <h1><strong>Planifica tu viaje</strong></h1>
            </div>
        </div>
    </div>
    
    <div class='carga'>

    </div>
</div>
@endsection

@section('javascript')
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{asset('/js/plugins/angular.min.js')}}"></script>
    
    <script src="{{asset('/js/ADM-dateTimePicker.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/plugins/select.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/sweetalert.min.js')}}" async></script>
    <script src="{{asset('/js/visitante/main.js')}}"></script>
    <script src="{{asset('/js/visitante/service.js')}}"></script>
@endsection