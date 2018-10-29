
@extends('layout._ofertaEmpleoLayaout')

@section('title', 'Actividad comercial :: SITUR Atlántico')

@section('estilos')
    <style>
        .title-section {
            background-color: #4caf50 !important;
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
        label {
            color: dimgray;
        }
        .form-group label {
            font-size: 1em!important;
        }
        .label.label-danger {
            font-size: .9em;
            font-weight: 400;
            padding: .16em .5em;
        }
    </style>
@endsection

@section('TitleSection', 'Actividad Comercial')

@section('Progreso', '20%')

@section('NumSeccion', '20%')

@section('app','ng-app="ofertaempleo"')
@section('controller','ng-controller="seccionActividadComercialAdmin"')

@section('content')
 
    <input type="hidden" ng-model="Id" ng-init="Id={{$Id}}" />
    <input type="hidden" ng-model="Sitio" ng-init="Sitio={{$Sitio}}" />
    <input type="hidden" ng-model="Anio" ng-init="Anio={{$Anio}}" />
    <input type="hidden" ng-model="encuestadores" ng-init="encuestadores={{$Encuestadores}}" />
    <div class="alert alert-danger" ng-if="errores != null">
        <label><b>Errores:</b></label>
        <br />
        <div ng-repeat="error in errores" ng-if="error.length>0">
            -@{{error[0]}}
        </div>
    </div>
    
    <form name="ActividadForm" novalidate>
        
        
        <div class="panel panel-success">
            <div class="panel-heading">

                <h3 class="panel-title"><b><span class="asterik glyphicon glyphicon-asterisk"></span>  Datos del entrevistado</b></h3>
            </div>
            <div class="panel-footer"><b>Seleccione la opción</b></div>
            <div class="panel-body">
                
                 <div class="row">
                        
                        <div class="col-xs-12 col-sm-12 col-md-8">
                            <div class="form-group" ng-class="{true:'form-group has-error has-feedback',false:'form-group'}[(ActividadForm.$submitted || ActividadForm.nombre.$touched) && ActividadForm.nombre.$error.required]">
                                <label class="control-label" for="nombre">Nombre del contacto</label> <span style="font-size: .7em;color: darkgrey;" ng-if="actividad.nombre.length > 0">@{{actividad.nombre.length}} de 255 caracteres</span><span class="text-error" ng-show="(ActividadForm.$submitted || ActividadForm.nombre.$touched) && ActividadForm.nombre.$error.required">(El campo es obligatorio)</span>
                                <div class="input-group">
                                    <div class="input-group-addon" title="Campo requerido"><span class="glyphicon glyphicon-asterisk"></span></div>
                                    <input type="text" class="form-control" name="nombre" id="nombre" ng-model="actividad.nombre" ng-init="actividad.nombre = '{{$dato->nombre_contacto}}' " maxlength="255" ng-required="true" placeholder="Máx. 255 caracteres" />
                                    <span class="glyphicon glyphicon-exclamation-sign form-control-feedback" aria-hidden="true" ng-if="(ActividadForm.$submitted || ActividadForm.nombre.$touched) && ActividadForm.nombre.$error.required "></span>
                                </div>

                            </div>
                            
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group" ng-class="{true:'form-group has-error has-feedback',false:'form-group'}[(ActividadForm.$submitted || ActividadForm.cargo.$touched) && ActividadForm.cargo.$error.required]">
                                <label class="control-label" for="cargo">Cargo</label> <span style="font-size: .7em;color: darkgrey;" ng-if="actividad.cargo.length > 0">@{{actividad.cargo.length}} de 255 caracteres</span><span class="text-error" ng-show="(ActividadForm.$submitted || ActividadForm.cargo.$touched) && ActividadForm.cargo.$error.required">(El campo es obligatorio)</span>
                                <div class="input-group">
                                    <div class="input-group-addon" title="Campo requerido"><span class="glyphicon glyphicon-asterisk"></span></div>
                                    <input type="text" class="form-control" name="cargo" id="cargo" ng-model="actividad.cargo" ng-init="actividad.cargo = '{{$dato->cargo_contacto}}'" maxlength="255" ng-required="true" placeholder="Máx. 255 caracteres" />
                                    <span class="glyphicon glyphicon-exclamation-sign form-control-feedback" aria-hidden="true" ng-if="(ActividadForm.$submitted || ActividadForm.cargo.$touched) && ActividadForm.cargo.$error.required "></span>
                                </div>

                            </div>
                            
                        </div>
                    </div>
                
                <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8">
                    <div class="form-group" ng-class="{true:'form-group has-error has-feedback',false:'form-group'}[(ActividadForm.$submitted || ActividadForm.email.$touched) && (ActividadForm.email.$error.email)]">
                        <label class="control-label" for="email">Email</label> <span style="font-size: .7em;color: darkgrey;" ng-if="actividad.email.length > 0">@{{actividad.email.length}} de 255 caracteres</span><span class="text-error" ng-show="(ActividadForm.$submitted || ActividadForm.email.$touched) && ActividadForm.email.$error.email">(Formato de email no permitido)</span>
                        <div class="input-group">
                            <div class="input-group-addon"></div>
                            <input type="email" class="form-control" name="email" id="email" ng-model="actividad.email" ng-init="actividad.email = '{{$dato->email}}' "  maxlength="255"   placeholder="Ej: alguien@dominio.com"/>
                            <span class="glyphicon glyphicon-exclamation-sign form-control-feedback" aria-hidden="true" ng-if="(ActividadForm.$submitted || ActividadForm.email.$touched) && (ActividadForm.email.$error.email)"></span>
                        </div>

                    </div>

                </div>

                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="form-group">

                            <label for="inputDepartamentoResidencia" class="col-xs-12 control-label">Encuestador</label>
                            <div class="col-xs-12">
                                <!--P4P10Select1. Seleccione un Encuestador-->
                                <select class="form-control" id="inputDepartamentoResidencia" name="encuestador" ng-model="actividad.Encuestador" ng-required="true">
                                    <option value="" disabled>Seleccione un encuestador</option>
                                    <option ng-repeat="item in encuestadores" value="@{{item.id}}">@{{item.user.username}}</option>
                                </select>
                                <!--P4P10Alert1. El campo Barrio de residencia es requerido-->
                                <span ng-show="ActividadForm.$submitted || ActividadForm.barrio.$touched">
                                    <span class="label label-danger" ng-show="ActividadForm.encuestador.$error.required">*El campo es requerido</span>
                                </span>
                            </div>
                        </div>
                    </div>


                </div>
                <span ng-show="ActividadForm.$submitted || ActividadForm.actividadComercial.$touched">
                    <span class="label label-danger" ng-show="ActividadForm.actividadComercial.$error.required">*El campo es requerido.</span>
                </span>
            </div>

        </div>
        
        
        
        <div class="panel panel-success">
            <div class="panel-heading">

                <h3 class="panel-title"><b><span class="asterik glyphicon glyphicon-asterisk"></span>  ¿El establecimiento tuvo actividad comercial?</b></h3>
            </div>
            <div class="panel-footer"><b>Seleccione la opción</b></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">

                        <select class="form-control" name="actividadComercial" ng-model="actividad.Comercial" ng-required="true">
                            <option value="" disabled selected>Seleccione</option>
                            <option value="1">Si</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
                <span ng-show="ActividadForm.$submitted || ActividadForm.actividadComercial.$touched">
                    <span class="label label-danger" ng-show="ActividadForm.actividadComercial.$error.required">*El campo es requerido.</span>
                </span>
            </div>

        </div>

        <div class="panel panel-success" ng-if="actividad.Comercial==1">
            <div class="panel-heading">
                <h3 class="panel-title"><b><span class="asterik glyphicon glyphicon-asterisk"></span> ¿Cúantos días en el mes?</b></h3>
            </div>
            <div class="panel-footer"><b>Complete la información</b></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">

                        <input class="form-control" type="number" id="numeroDias" name="numeroDias" ng-model="actividad.NumeroDias" min="1" max="31" ng-required="true" placeholder="Solo números">
                    </div>
                </div>
                <span ng-show="ActividadForm.$submitted || ActividadForm.numeroDias.$touched">
                    <span class="label label-danger" ng-show="ActividadForm.numeroDias.$error.required">*El campo es requerido.</span>
                    <span class="label label-danger" ng-show="ActividadForm.numeroDias.$error.number">*El campo debe ser un número.</span>
                    <span class="label label-danger" ng-show="ActividadForm.numeroDias.$error.min">*El campo debe ser mayor que 1.</span>
                    <span class="label label-danger" ng-show="ActividadForm.numeroDias.$error.max">*El campo debe ser menor o igual que 31.</span>
                </span>

            </div>
        </div>

        <div class="row" style="text-align:center">
            <a href="/ofertaempleo/encuesta/{{$Sitio}}" class="btn btn-raised btn-default">Anterior</a>
            <input type="submit" class="btn btn-raised btn-success" ng-click="guardar()" value="Siguiente" />
        </div>
        <br />

    </form>
    <div class='carga'>

    </div>


@endsection
