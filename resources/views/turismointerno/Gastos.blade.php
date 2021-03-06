@extends('layout._encuestaInternoLayout')
@section('Title','Gastos - Turísmo interno y emisor :: SITUR')

@section('estilos')
    <style>
        .title-section {
            background-color: #16469e !important;
        }

        .table > thead > tr > th {
            background-color: rgba(0,0,0,.1);
        }

        .jp-options {
            position: absolute;
            background-color: white;
            z-index: 2;
            width: 95%;
            max-height: 300px;
            overflow-y: auto;
            -webkit-box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.75);
            -moz-box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.75);
            box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.75);
            color: dimgray;
        }

        .jp-options > div {
            border-bottom: 0.5px solid rgba(0,0,0,.1);
            padding-left: 2%;
        }

        .jp-options > div label {
            cursor: pointer;
        }

        .st-list-tag {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .st-list-tag li {
            display: inline-block;
            margin-bottom: 0.5em;
            min-width: 8.3%;
            margin-right: 1em;
            border-radius: 20px;
            padding: 1em;
            padding-top: .5em;
            padding-bottom: .5em;
            background-color: dodgerblue;
            color: white;
            text-align: center;
            font-weight: 400;
            cursor: pointer;
        }

        .thead-fixed {
            position: fixed;
            z-index: 10;
            width: 100%;
            top: 0;
            background-color: lightgray;
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

        .alert-fixed {
            z-index: 11 !important;
        }
        td.disabled-table {
            pointer-events: none;
            background: #0000000d;
        }
    </style>
@endsection

@section('TitleSection','Gastos')
@section('Progreso','80%')
@section('NumSeccion','80%')
@section('Control','ng-controller="gastos"')


@section('contenido')
    <div class="main-page" >
        
        <input type="hidden" ng-model="id" ng-init="id={{$id}}" />
        
        <div class="alert alert-danger" ng-if="errores != null">
            <label><b>Errores:</b></label>
            <br />
            <div ng-repeat="error in errores" ng-if="error.errores.length>0">
                -@{{error.[0]}}
            </div>
        </div>
    
        <form role="form" name="GastoForm" novalidate>
          
            
            <div class="panel panel-success">
                <div class="panel-heading">
                    <!-- P2. ¿El viaje al departamento hizo parte de un paquete/plan turístico o excursión?-->
                    <h3 class="panel-title"><b><span class="asterik glyphicon glyphicon-asterisk"></span> ¿El viaje hizo parte de un paquete/plan turístico o excursión?</b></h3>
                </div>
                <div class="panel-footer"><b>Pregunta con selección única</b></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="radio radio-primary">
                                <label>
                                    <input type="radio" value="1" name="viajePaquete" ng-model="encuesta.viajePaquete" ng-required="true">
                                    Si
                                </label>
                            </div>
                            <div class="radio radio-primary">
                                <label>
                                    <input type="radio" value="0" name="viajePaquete" ng-model="encuesta.viajePaquete" ng-required="true" ng-click="clearDataViaje()" >
                                    No
                                </label>
                            </div>
                            <span ng-show="GastoForm.$submitted || GastoForm.viajePaquete.$touched">
                                <span class="label label-danger" ng-show="GastoForm.viajePaquete.$error.required">* El campo es requerido.</span>
                            </span>
                        </div>
                    </div>
                </div>
        </div>
            
            <div ng-if="encuesta.viajePaquete==1">
                
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <!-- Información del paquete turístico-->
                        <h3 class="panel-title"><b>Información del paquete turístico</b></h3>
                    </div>
                    <div class="panel-footer"><b>Complete la siguiente información</b></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-5">
                                <div class="form-group">
                                    <!-- P5P1. ¿Cuánto pagó usted por el paquete turístico o excursión?-->
                                    <label for="costo" class="col-md-12 control-label" style="color:dimgray;"><span class="asterik glyphicon glyphicon-asterisk" style="font-size: .9em;"></span>  ¿Cuánto pagó usted por el paquete turístico o excursión?</label>

                                    <div class="col-md-12">
                                        <i class="material-icons" title="Aproximadamente cual fue el valor" style="font-size: 1.6em;position: relative; top: 8px;">help</i>
                                        <input type="number" class="form-control" min="1" name="costo" ng-model="encuesta.viajeExcursion.valor_paquete" placeholder="" ng-required="encuesta.viajePaquete==1" style="display:inline-block;width:90%;">
                                    </div>
                                    <span ng-show="GastoForm.$submitted || GastoForm.costo.$touched">
                                        <span class="label label-danger" ng-show="GastoForm.costo.$error.required">* El campo es requerido.</span>
                                        <span class="label label-danger" ng-show="GastoForm.costo.$error.min">* El valor mínimo es de 1 </span>
                                        <span class="label label-danger" ng-show="GastoForm.costo.$error.number">* Sólo números</span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <!-- P5P2. Moneda de compra del paquete turístico o excursión-->
                                    <label for="selectDivisa" class="col-md-12 control-label" style="color:dimgray;"><span class="asterik glyphicon glyphicon-asterisk" style="font-size: .9em;"></span>  Moneda de compra del paquete turístico o excursión</label>

                                    <div class="col-md-12">
                                        <select id="selectDivisa" class="form-control" ng-options="it.id as it.divisas_con_idiomas[0].nombre for it in divisas" ng-model="encuesta.viajeExcursion.divisas_id" name="Divisa" ng-required="encuesta.viajePaquete==1">
                                            <!-- P5P2Input1. Seleccione una moneda-->
                                            <option value="" selecd disabled >seleccione una opción</option>
                                        </select>
                                        <span ng-show="GastoForm.$submitted || GastoForm.Divisa.$touched">
                                            <span class="label label-danger" ng-show="GastoForm.Divisa.$error.required">* El campo es requerido.</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <div class="form-group">
                                    <!-- P5P3. ¿A cuántas personas cubrió?-->
                                    <label for="personas_cubiertas" class="col-md-12 control-label" style="color:dimgray;">¿A cuántas personas cubrió?</label>

                                    <div class="col-md-12">
                                        <input type="number" class="form-control" min="1" name="personas_cubiertas" ng-model="encuesta.viajeExcursion.personas_cubrio" placeholder="">
                                        <span ng-show="GastoForm.$submitted || GastoForm.personas_cubiertas.$touched">
                                            <span class="label label-danger" ng-show="GastoForm.personas_cubiertas.$error.min">* El valor debe ser mayor a 0.</span>
                                            <span class="label label-danger" ng-show="GastoForm.personas_cubiertas.$error.number">* Solo números.</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <!-- P6. El paquete/plan turístico o excursión fue comprado a una agencia de viajes u operador turístico:-->
                        <h3 class="panel-title"><b><span class="asterik glyphicon glyphicon-asterisk"></span> El paquete/plan turístico o excursión fue comprado a una agencia de viajes u operador turístico</b></h3>
                    </div>
                    <div class="panel-footer"><b> Pregunta con selección única</b></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="radio radio-primary" ng-repeat="item in TipoProveedorPaquete" >
                                    <label>
                                        <input type="radio" value="@{{item.id}}" name="comproEnAgencia" ng-model="encuesta.viajeExcursion.tipo_proveedor_paquete_id" ng-required="true">
                                        @{{item.tipo_proveedor_paquete_con_idiomas[0].nombre}}
                                    </label>
                                </div>
                                <span ng-show="GastoForm.$submitted || GastoForm.comproEnAgencia.$touched">
                                    <span class="label label-danger" ng-show="GastoForm.comproEnAgencia.$error.required">* El campo es requerido.</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="panel panel-success" ng-show="encuesta.viajeExcursion.tipo_proveedor_paquete_id==1">
                    <div class="panel-heading">
                        <!-- P7. ¿En donde está ubicada la agencia de viajes/operador turístico?-->
                        <h3 class="panel-title"><b><span class="asterik glyphicon glyphicon-asterisk"></span> ¿En donde está ubicada la agencia de viajes/operador turístico?</b></h3>
                    </div>
                    <div class="panel-footer"><b>Pregunta con selección única</b></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="radio radio-primary" ng-repeat="opc in opcionesLugares">
                                    <label>
                                        <input type="radio" id="radio-opt-@{{opc.Id}}" value="@{{opc.id}}" name="lugar" ng-model="encuesta.lugarAgencia" ng-required="encuesta.comproEnAgencia==1">
                                        @{{opc.opciones_lugares_con_idiomas[0].nombre}}
                                    </label>
                                </div>
                                <span ng-show="GastoForm.$submitted">
                                    <span class="label label-danger" ng-show="GastoForm.lugar.$error.required">* El campo es requerido.</span>
                                </span>

                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <!-- P8. ¿Qué productos y servicios incluía el paquete turístico o excursión?-->
                        <h3 class="panel-title"><b><span class="asterik glyphicon glyphicon-asterisk"></span> ¿Qué productos y servicios incluía el paquete turístico o excursión?</b></h3>
                    </div>
                    <div class="panel-footer"><b>Pregunta de selección múltiple</b></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="checkbox" ng-repeat="servicio in serviciosPaquetes">
                                    <label>
                                        <input type="checkbox" name="servicios" checklist-model="encuesta.serviciosPaquetes" checklist-value="servicio.id" checklist-change="changeServiciosPaquetes(servicio)" > 
                                        @{{servicio.nombre}}
                                        <div class="form-group" ng-if="servicio.id==12 && encuesta.serviciosPaquetes.indexOf(12)!=-1">
                                            <label for="otroServicio" class="col-md-12 control-label">Otro, ¿Cuál?</label>
                                            <input type="text" class="form-control" name="otroServicio" ng-model="encuesta.otrosServicios" ng-required="encuesta.serviciosPaquetes.indexOf(12)!=-1" />
                                            <span ng-show="GastoForm.$submitted || GastoForm.otroServicio.$touched">
                                                <span class="label label-danger" ng-show="GastoForm.otroServicio.$error.required">* El campo es requerido.</span>
                                            </span>
                                        </div>
                                    </label>
                                </div>
                                <span ng-show="GastoForm.$submitted || GastoForm.servicios.$touched">
                                    <span class="label label-danger" ng-show="encuesta.serviciosPaquetes.length == 0 ||  encuesta.serviciosPaquetes == null">* El campo es requerido.</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div ng-if="encuesta.gastosServicosPaquetes.length>0" >
                        <div class="panel-heading">
                            <!-- P8. ¿Qué productos y servicios incluía el paquete turístico o excursión?-->
                            <h3 class="panel-title"><b><span class="asterik glyphicon glyphicon-asterisk"></span> Qué porcentaje del gasto realizó:</b></h3>
                        </div>
                        <div class="panel-footer"><b>Complete la siguiente tabla</b></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                   
                                    <table class="table table-striped">
                                        <thead>
                                          <tr>
                                            <th>Servicio</th>
                                            <th>En Atlántico</th>
                                            <th>Fuera de Atlántico</th>
                                            <th></th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr ng-repeat="servicio in encuesta.gastosServicosPaquetes" >
                                            <td> @{{servicio.nombre}}</td>
                                            <td>
                                                <div class="form-group">
                                                    <!-- P5P1. ¿Cuánto pagó usted por el paquete turístico o excursión?-->
                                                    <label for="costoA@{{$index}}" class="col-md-12 control-label" style="color:dimgray;"></label>
                                                    <input type="number" placeholder="%%" class="form-control" min="0" max="100" name="costoA@{{$index}}" ng-model="servicio.dentro" ng-change="changeRubros(rub)" ng-required="true" style="display:inline-block;width:90%;">
                                                    <span ng-show="GastoForm.$submitted || GastoForm.costoA@{{$index}}.$touched">
                                                        <span class="label label-danger" ng-show="GastoForm.costoA@{{$index}}.$error.required">* El campo es requerido.</span>
                                                        <span class="label label-danger" ng-show="GastoForm.costoA@{{$index}}.$error.min">* El valor mínimo es 0</span>
                                                        <span class="label label-danger" ng-show="GastoForm.costoA@{{$index}}.$error.max">* El valor máximo es 100</span>
                                                        <span class="label label-danger" ng-show="GastoForm.costoA@{{$index}}.$error.number">* Sólo números</span>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <!-- P5P1. ¿Cuánto pagó usted por el paquete turístico o excursión?-->
                                                    <label for="costoB@{{$index}}" class="col-md-12 control-label" style="color:dimgray;"></label>
                                                    <input type="number" placeholder="%%" class="form-control" min="0" max="100" name="costoB@{{$index}}" ng-model="servicio.fuera" ng-required="true" style="display:inline-block;width:90%;">
                                                    <span ng-show="GastoForm.$submitted || GastoForm.costoB@{{$index}}.$touched">
                                                        <span class="label label-danger" ng-show="GastoForm.costoB@{{$index}}.$error.required">* El campo es requerido.</span>
                                                        <span class="label label-danger" ng-show="GastoForm.costoB@{{$index}}.$error.min">* El valor mínimo es 0</span>
                                                        <span class="label label-danger" ng-show="GastoForm.costoB@{{$index}}.$error.max">* El valor mínimo es 0</span>
                                                        <span class="label label-danger" ng-show="GastoForm.costoB@{{$index}}.$error.number">* Sólo números</span>
                                                    </span>
                                                </div>
                                            </td>
                                            <td ng-show="GastoForm.$submitted || GastoForm.costoB@{{$index}}.$touched || GastoForm.costoA@{{$index}}.$touched " >
                                                <span ng-show="(servicio.dentro+servicio.fuera)!=100" >
                                                    <span class="label label-danger">La suma debe completar 100%</span>
                                                </span>
                                            </td>
                                          </tr>
                                        </tbody>
                                    </table>
                                   
                                  
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
            
        
            
            
            <div class="panel panel-success" >
                    <div class="panel-heading">
                        <!-- P9. Indique los gastos totales hechos por usted, para usted o su grupo de viaje. No coloque gastos individuales-->
                        <h3 class="panel-title"><b><span class="asterik glyphicon glyphicon-asterisk"></span>  Indique los gastos totales hechos por usted, para usted o su grupo de viaje. No coloque gastos induviduales</b></h3>
                    </div>
                    <div class="panel-footer"><b>Complete la siguiente tabla</b></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div style="overflow-x: auto;">
                                    <table id="tgastos" class="table table-condensed table-bordered table-hover" style="min-height: 500px;">
                                        <thead id="head-tgastos">
                                            <tr>
                                                <!--P9Col1. Rubro-->
                                                <th class="text-center" style="width:35%;">Rubro</th>
                                                <!--P9Col2. Cantidad pagada-->
                                                <th class="text-center" style="width:35%;">Cantidad pagada</th>
                                                <!--P9Col3. ¿A cuántas personas cubrió?-->
                                                <th class="text-center" style="width:8%;">¿A cuántas personas cubrió?</th>
                                                <!--P9Col4. Fue pagado por otra persona u organización/ empresa diferente a usted o a su grupo de viaje -->
                                                <th class="text-center" style="width:22%;">Fue pagado por otra persona u organización/ empresa diferente a usted o a su grupo de viaje</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <tr>
                                                <td>
                                                    <div class="checkbox" >
                                                        <label>
                                                            <input type="checkbox"  name="noGastos" ng-model="encuesta.noRealiceGastos" ng-change="changeNorealiceGastos()"  ng-true-value="1" ng-false-value="0"  > 
                                                            No realicé ningún tipo de gasto
                                                        </label>
                                                    </div>
                                                    <span ng-show="GastoForm.$submitted || GastoForm.Financiadores.$touched">
                                                        <span class="label label-danger" ng-show="encuesta.financiadores.length == 0 ||  encuesta.financiadores == null">* El campo es requerido.</span>
                                                    </span>
                                                </td>
                                                <td></td><td></td><td></td>
                                            </tr>
                                            
                                            <tr ng-repeat="rub in encuesta.rubros"  >
                                                <td style="width:35%;">
                                                    @{{rub.nombre}}
                                                    
                                                    <div class="form-group" ng-if="rub.id==20" >
                                                        <label for="otroRubros" class="col-md-12 control-label">Otro, ¿Cuál?</label>
                                                        <input type="text" class="form-control" name="otroRubros" ng-model="rub.viajes_gastos_internos[0].otro" ng-required="rub.viajes_gastos_internos[0].valor && rub.viajes_gastos_internos[0].divisa_id && rub.viajes_gastos_internos[0].personas_cubrio"  />
                                                        <span ng-show="GastoForm.$submitted || GastoForm.otroRubros.$touched">
                                                                <span class="label label-danger" ng-show="GastoForm.otroRubros.$error.required">* El campo es requerido.</span>
                                                        </span>
                                                    </div>
                                                
                                                </td>
                                                <td style="width:25%;" ng-class="{ 'disabled-table' : encuesta.noRealiceGastos==1 }" >
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-6">
                                                            <label for="cantidadFuera@{{$index}}" class="col-md-12 control-label" style="color:dimgray;">Cantidad </label>
                                                            <input type="number" class="form-control" placeholder="Cantidad" name="valor@{{$index}}" placeholder="0" min="1" ng-model="rub.viajes_gastos_internos[0].valor" ng-change="changeRubros(rub)"  ng-required="rub.viajes_gastos_internos[0].divisa_id" >
                                                            <span ng-show="GastoForm.$submitted || GastoForm.valor@{{$index}}.$touched">
                                                                <span class="label label-danger" ng-show="GastoForm.valor@{{$index}}.$error.required">* El campo es requerido.</span>
                                                                <span class="label label-danger" ng-show="GastoForm.valor@{{$index}}.$error.min">*El valor mínimo es de 1</span>
                                                                <span class="label label-danger" ng-show="GastoForm.valor@{{$index}}.$error.number">* Solo números.</span>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-12 col-md-6">
                                                            
                                                            <div class="form-group">
                                                                <!-- P5P2. Moneda de compra del paquete turístico o excursión-->
                                                                <label for="divisa@{{$index}}" class="col-md-12 control-label" style="color:dimgray;">Moneda</label>
                            
                                                                <div class="col-md-12">
                                                                    <select id="divisa@{{$index}}" name="divisa@{{$index}}" class="form-control" ng-options="it.id as it.divisas_con_idiomas[0].nombre for it in divisas" ng-model="rub.viajes_gastos_internos[0].divisa_id"   ng-change="changeRubros(rub)" ng-required="rub.viajes_gastos_internos[0].valor"  >
                                                                        <!-- P5P2Input1. Seleccione una moneda-->
                                                                        <option value="" selecd >Moneda</option>
                                                                    </select>
                                                                    <span ng-show="GastoForm.$submitted || GastoForm.divisa@{{$index}}.$touched">
                                                                        <span class="label label-danger" ng-show="GastoForm.divisa@{{$index}}.$error.required">* El campo es requerido.</span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <span ng-show="GastoForm.$submitted || GastoForm.personas@{{$index}}.$touched">
                                                                <span class="label label-danger" ng-show="rub.viajes_gastos_internos[0].personas_cubrio != null && (!rub.viajes_gastos_internos[0].valor && !rub.viajes_gastos_internos[0].divisa_id )">*Debe llenar una cantidad</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="width:15%;" ng-class="{ 'disabled-table' : encuesta.noRealiceGastos==1 }" >
                                                    <label for="personas@{{$index}}" class="col-md-12 control-label" style="color:dimgray;">Número personas</label>
                                                    <input type="number" placeholder="Número personas" min="1" class="form-control" name="personas@{{$index}}" ng-model="rub.viajes_gastos_internos[0].personas_cubrio" ng-required="rub.viajes_gastos_internos[0].valor || rub.viajes_gastos_internos[0].divisa_id" ng-change="changeRubros(rub)" />
                                                    <span ng-show="GastoForm.$submitted || GastoForm.personas@{{$index}}.$touched">
                                                        <span class="label label-danger" ng-show="GastoForm.personas@{{$index}}.$error.required">*Requerido este campo</span>
                                                        <span class="label label-danger" ng-show="GastoForm.personas@{{$index}}.$error.min">*El valor debe ser mayor a 0.</span>
                                                        <span class="label label-danger" ng-show="GastoForm.personas@{{$index}}.$error.number">* Solo números.</span>
                                                    </span>
                                                </td>
                                                <td style="width:25%;text-align: center;">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="asumido@{{$index}}" ng-model="rub.viajes_gastos_internos[0].gastos_realizados_otros" value="true" ng-change="changeRubros(rub)"> Si
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div ng-if="verNombreEmpresa" >
                        
                        <div class="panel panel-success" >
                            <div class="panel-heading"  >
                                <!-- P9. Indique los gastos totales hechos por usted, para usted o su grupo de viaje. No coloque gastos individuales-->
                                <h3 class="panel-title"><b><span class="asterik glyphicon glyphicon-asterisk"></span>  Nombre de la empresa de transporte</b></h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <!-- P5P1. ¿Cuánto pagó usted por el paquete turístico o excursión?-->
                                            <label for="empresaTransporte" class="col-md-12 control-label" style="color:dimgray;"></label>
                                            <input type="text" class="form-control" name="empresaTransporte" ng-model="encuesta.empresaTransporte" ng-required="true" maxlength="150" style="display:inline-block;width:90%;">
                                            <span ng-show="GastoForm.$submitted || GastoForm.costoA@{{$index}}.$touched">
                                                <span class="label label-danger" ng-show="GastoForm.empresaTransporte.$error.required">* El campo es requerido.</span>
                                                <span class="label label-danger" ng-show="GastoForm.empresaTransporte.$error.maxlength">* El número maximo de caracteres es 150</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div ng-if="verAlquilerVehiculo" >
                        
                        <div class="panel panel-success" >
                            <div class="panel-heading">
                                <!-- P7. ¿En donde está ubicada la agencia de viajes/operador turístico?-->
                                <h3 class="panel-title"><b><span class="asterik glyphicon glyphicon-asterisk"></span> El alquiler del vehículo se realizó: </b></h3>
                            </div>
                            <div class="panel-footer"><b>Pregunta con selección única</b></div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="radio radio-primary" ng-repeat="opc in opcionesLugares">
                                            <label ng-if="opc.id!=3" >
                                                <input type="radio" id="radio2-opt-@{{opc.Id}}" value="@{{opc.id}}" name="lugar2" ng-model="rubroAlquilerVehiculo.viajes_gastos_internos[0].alquila_vehiculo_id" ng-required="true">
                                                @{{opc.opciones_lugares_con_idiomas[0].nombre}}
                                            </label>
                                        </div>
                                        <span ng-show="GastoForm.$submitted">
                                            <span class="label label-danger" ng-show="GastoForm.lugar2.$error.required">* El campo es requerido.</span>
                                        </span>
        
                                    </div>
                                </div>
                            </div>
                        </div>
                
                    </div>
                    
                    <div ng-if="encuesta.porcentajeGastoRubros.length>0" >
                        
                        <div class="panel panel-success" >
                            <div class="panel-heading">
                                <!-- P8. ¿Qué productos y servicios incluía el paquete turístico o excursión?-->
                                <h3 class="panel-title"><b><span class="asterik glyphicon glyphicon-asterisk"></span> Qué porcentaje del gasto realizó:</b></h3>
                            </div>
                            <div class="panel-footer"><b>Complete la siguiente tabla</b></div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                       
                                        <table class="table table-striped">
                                            <thead>
                                              <tr>
                                                <th>Rubro</th>
                                                <th>En Atlántico</th>
                                                <th>Fuera de Atlántico</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <tr ng-repeat="rb in encuesta.porcentajeGastoRubros" >
                                                <td> @{{rb.nombre}}</td>
                                                <td>
                                                    <div class="form-group">
                                                        <!-- P5P1. ¿Cuánto pagó usted por el paquete turístico o excursión?-->
                                                        <label for="costoC@{{$index}}" class="col-md-12 control-label" style="color:dimgray;"></label>
                                                        <input type="number" placeholder="%%" class="form-control" min="0" max="100" name="costoC@{{$index}}" ng-model="rb.dentro" ng-required="true" style="display:inline-block;width:90%;">
                                                        <span ng-show="GastoForm.$submitted || GastoForm.costoC@{{$index}}.$touched">
                                                            <span class="label label-danger" ng-show="GastoForm.costoC@{{$index}}.$error.required">* El campo es requerido.</span>
                                                            <span class="label label-danger" ng-show="GastoForm.costoC@{{$index}}.$error.min">* El valor mínimo de 0</span>
                                                            <span class="label label-danger" ng-show="GastoForm.costoC@{{$index}}.$error.max">* El valor máximo de 100</span>
                                                            <span class="label label-danger" ng-show="GastoForm.costoC@{{$index}}.$error.number">* Sólo números</span>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <!-- P5P1. ¿Cuánto pagó usted por el paquete turístico o excursión?-->
                                                        <label for="costoD@{{$index}}" class="col-md-12 control-label" style="color:dimgray;"></label>
                                                        <input type="number" placeholder="%%" class="form-control" min="0" max="100" name="costoD@{{$index}}" ng-model="rb.fuera" ng-required="true" style="display:inline-block;width:90%;">
                                                        <span ng-show="GastoForm.$submitted || GastoForm.costoD@{{$index}}.$touched">
                                                            <span class="label label-danger" ng-show="GastoForm.costoD@{{$index}}.$error.required">* El campo es requerido.</span>
                                                            <span class="label label-danger" ng-show="GastoForm.costoD@{{$index}}.$error.min">* El valor mínimo es 0</span>
                                                            <span class="label label-danger" ng-show="GastoForm.costoD@{{$index}}.$error.max">* El valor máximo es 100</span>
                                                            <span class="label label-danger" ng-show="GastoForm.costoD@{{$index}}.$error.number">* Sólo números</span>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td ng-show="GastoForm.$submitted || GastoForm.costoC@{{$index}}.$touched || GastoForm.costoD@{{$index}}.$touched " >
                                                    <span ng-show="(rb.dentro+rb.fuera)!=100" >
                                                        <span class="label label-danger">La suma debe completar 100%</span>
                                                    </span>
                                                </td>
                                              </tr>
                                            </tbody>
                                        </table>
                                       
                                      
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            
            <div class="panel panel-success">
                <div class="panel-heading">
                    <!-- P10. Los gastos de las personas que conformaron el grupo de viaje fueron pagados por:-->
                    <h3 class="panel-title"><b><span class="asterik glyphicon glyphicon-asterisk"></span>  Los gastos de las personas que conformaron el grupo de viaje fueron pagados por:</b></h3>
                </div>
                <div class="panel-footer"><b>Pregunta de selección múltiple</b></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="checkbox" ng-repeat="fin in financiadores" ng-show="!(encuestaInterno.RealizoGasto==0 && fin.Id==1)">
                                <label>
                                    <input type="checkbox" checklist-model="encuesta.financiadores" name="Financiadores" checklist-value="fin.id"> 
                                    @{{fin.financiadores_viajes_con_idiomas[0].nombre}}
                                </label>
                                <!--
                                <div class="form-group" ng-if="fin.id==11 && encuesta.financiadores.indexOf(11)!=-1">
                                    <label for="otroFinanciadores" class="col-md-12 control-label">Otro, ¿Cuál?</label>
                                    <input type="text" class="form-control" name="otroFinanciadores" ng-model="encuesta.otroFinanciadores" ng-required="encuesta.financiadores.indexOf(11)!=-1"  />
                                    <span ng-show="GastoForm.$submitted || GastoForm.otroFinanciadores.$touched">
                                        <span class="label label-danger" ng-show="GastoForm.otroFinanciadores.$error.required">* El campo es requerido.</span>
                                    </span>
                                </div>
                                -->
                            </div>
                            <span ng-show="GastoForm.$submitted || GastoForm.Financiadores.$touched">
                                <span class="label label-danger" ng-show="encuesta.financiadores.length == 0 ||  encuesta.financiadores == null">* El campo es requerido.</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="row" style="text-align:center">
                <a href="/turismointerno/transporte/{{$id}}" class="btn btn-raised btn-default">{{trans('resources.EncuestaBtnAnterior')}}</a>
                <input type="submit" class="btn btn-raised btn-success" ng-click="guardar()" value="{{trans('resources.EncuestaBtnSiguiente')}}" />
            </div>
            <br />
    </form>
    
        <div class='carga'>
    
        </div>
    </div>
@endsection






