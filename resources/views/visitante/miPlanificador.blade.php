@extends('layout._publicLayout')

@section('Title', 'Mi planificador')

@section('estilos')
    <style>
    header{
        position: static;
        background-color: black;
        margin-bottom: 1rem;
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
    
    <link href="{{asset('/css/ADM-dateTimePicker.min.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('/css/sweetalert.min.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('/css/object-table-style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('/css/ADM-dateTimePicker.min.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('/css/select.min.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('/css/select2.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('/css/favoritos.css')}}" rel="stylesheet" type="text/css" />  
    <script src="{{asset('/js/plugins/angular.min.js')}}"></script> 
@endsection

@section('meta_og')
<meta property="og:title" content="@{{planificador.Nombre}}. Miralo en SITUR Atlántico" />
<meta property="og:image" content="{{asset('/res/logo/black/128.png')}}" />
@endsection

@section('content')
    <div class="container" ng-app="visitanteApp" ng-controller="planificador">
        <input type="hidden" ng-model="Id" ng-init="Id={{$id}}" />
            
            <h2 class="titulo">@{{planificador.Nombre}}</h2>
            <hr>
            <div id="planificadores" class="panel panel-default">
                <div class="panel-heading heading-planificador">
                    <div class="row">
                        <div class="col-xs-9">
                            @{{planificador.Nombre}} (@{{planificador.Fecha_inicio | date:'dd/MM/yyyy'}} - @{{planificador.Fecha_fin | date:'dd/MM/yyyy'}})
                        </div>
                        <div class="col-xs-3" style="text-align: right;">
                            <!--<span class="glyphicon glyphicon-pencil" style="margin-right: 1em; cursor: pointer;" data-toggle="tooltip" data-placement="bottom" title="Editar planificador"></span>-->
                            <!--<span class="glyphicon glyphicon-remove" style="cursor: pointer;" data-toggle="tooltip" data-placement="bottom" title="@Resource.LabelFavEliminarPlanificador"></span>-->
                        </div>
                    </div>
    
    
                </div>
                <div class="panel-body">
                    <div class="panel-group" id="accordion@{{planificador.Id}}" role="tablist" aria-multiselectable="true">
    
                        <div class="panel panel-default" ng-repeat="dia in planificador.Dias">
                            <div class="panel-heading heading-dias" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion@{{planificador.Id}}" href="#collapse@{{$index}}_@{{planificador.Id}}" aria-expanded="false" aria-controls="collapseTwo" style="cursor: pointer;">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h4 class="panel-title">
    
                                            Día @{{$index + 1}} <small>(@{{dia.Items.length}} items)</small>
    
                                        </h4>
                                    </div>
                                </div>
    
                            </div>
                            <div id="collapse@{{$index}}_@{{planificador.Id}}" ng-class="{true:'panel-collapse collapse in',false:'panel-collapse collapse'}[$first]" role="tabpanel" aria-labelledby="heading@{{$index}}">
                                <div class="panel-body">
                                    <ul class="list-group">
                                        <li class="list-group-item" ng-repeat="item in dia.Items">
                                            <span class="badge hide-print" ng-if="item.Tipo==4"><a href="/eventos/ver/@{{item.Id}}" target="_blank" title="Ver detalle"><i class="glyphicon glyphicon-new-window"></i></a></span>
                                            <span class="badge hide-print" ng-if="item.Tipo==2"><a href="/actividades/ver/@{{item.Id}}" target="_blank" title="Ver detalle"><i class="glyphicon glyphicon-new-window"></i></a></span>
                                            <span class="badge hide-print" ng-if="item.Tipo==1"><a href="/atracciones/ver/@{{item.Id}}" target="_blank" title="Ver detalle"><i class="glyphicon glyphicon-new-window"></i></a></span>
                                            <span class="badge hide-print" ng-if="item.Tipo==3"><a href="/proveedor/ver/@{{item.Id}}" target="_blank" title="Ver detalle"><i class="glyphicon glyphicon-new-window"></i></a></span>
                                            <!--<span class="badge hide-print" ng-show="!$first" ng-click="ordenarItem($index,dia.Items)" title="@Resource.LabelFavOrdenarItem"><i class="glyphicon glyphicon-chevron-up"></i></span>-->
                                            <div class="list-group-item-img">
                                                <img ng-src="@{{item.Imagen}}" alt="">
                                            </div>
                                            @{{item.Nombre}}
                                            <p class="hide-page show-print" style="font-size: 12px; overflow: auto; white-space: normal">@{{item.Descripcion}}</p>
                                            <p class="hide-page show-print">Dirección: @{{item.Direccion}}</p>
                                            <p class="hide-page show-print">Teléfono: @{{item.Telefono}}</p>
                                        </li>
                                    </ul>
                                    <!--Arrastre y suelte los items que desea agregar a este día-->
                                    <p ng-if="dia.Items.length == 0">Arrastre y suelte los items que desea agregar a este día</p>
                                </div>
                            </div>
                        </div>
                        <!--Agregue días al planificador para poder agregar items. Recuerde que solo podrá añadir el número de días indicado en el rango de fecha ingresado al crear el planificador.-->
                        <p ng-if="planificador.Dias.length == 0">
                            Agregue días al planificador para poder agregar items. Recuerde que solo podrá añadir el número de días indicado en el rango de fecha ingresado al crear el planificador.
                        </p>
    
                    </div>
    
                </div>
    
            </div>
            <div id="shareButtons" class="text-center">
                <p>Comparte esta publicación</p>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{\Request::url()}}" role="button" class="btn btn-circle btn-primary" title="Compartir en Facebook" target="_blank" rel="noopener noreferrer">
                    <span class="ion-social-facebook" aria-hidden="true"></span>
                    <span class="sr-only">Compartir en Facebook</span>
                </a>
                <a href="https://twitter.com/home?status= Comparte @{{planificador.Nombre}} por SITUR Atlántico. Lee más en {{\Request::url()}}" role="button" class="btn btn-circle btn-info" title="Compartir en Twitter" target="_blank" rel="noopener noreferrer">
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

@section('javascript')
    <script src="{{asset('/js/ADM-dateTimePicker.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/plugins/select.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/sweetalert.min.js')}}" async></script>
    <script src="{{asset('/js/dir-pagination.js')}}"></script>
    <script src="{{asset('/js/ngDraggable.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/list.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/visitante/main.js')}}"></script>
    <script src="{{asset('/js/visitante/service.js')}}"></script>
@endsection