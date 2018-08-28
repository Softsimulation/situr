
@extends('layout._AdminLayout')

@section('title', 'Activar proveedor')

@section('estilos')
      <style>
        .title-section {
            background-color: #1974cc;!important;
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
            margin-top: 1em;
        }
        .form-control.select2-container,.select2-container .select2-choice {
            height: 34px!important;
        }
        .select2-container .select2-choice {
            height: 100%!important;
        }
        .select2-results .select2-disabled{
            font-size: .9em;
            color: dimgray;
        }
        .select2-results li{
            font-size: .9em;
        }
        .select2-container .select2-choice .select2-arrow b{
            background: url('../Content/icons/arrow_down.png') 
        }
        
        .select2-container .select2-choice .select2-arrow {
            background: none!important;
            border-left: none;
        }
        .select2-container .select2-choice {
            background-image: none;
        }
        .select2-container .select2-choice > .select2-chosen {
            margin-top: .2em;
        }
    </style>
@endsection

@section('TitleSection', 'Activar proveedor')

@section('app','ng-app="proveedoresoferta"')

@section('controller','ng-controller="activarController"')

@section('content')

 <input type="hidden" ng-model="id" ng-init="id = {{$id}}" />


    <br />
   
    <div class="alert alert-danger" ng-if="errores != null">
    <label><b>Errores:</b></label>
    <br />
    <div ng-repeat="error in errores" ng-if="error.length>0">
        -@{{error[0]}}
    </div>

    </div>   
    <div class="blank-page widget-shadow scroll" id="style-2 div1">

        <form role="form" name="indentificacionForm" novalidate>
            <div class="panel panel-success">
                <div class="panel-heading" style="background-color: rgba(255,216,0,.5)">
                    <h3 class="panel-title"><b><span class="asterik glyphicon glyphicon-asterisk"></span> Los campos marcados con asteriscos son obligatorios</b></h3>
                </div>
                <div>
                    <div class="row">
                        

                        <div class="col-xs-12 col-sm-12 col-md-8">
                            <div class="form-group" ng-class="{true:'form-group has-error has-feedback',false:'form-group'}[(indentificacionForm.$submitted || indentificacionForm.nombrer.$touched) && indentificacionForm.nombrer.$error.required]">
                                <label class="control-label" for="nombre">Nombre</label> <span style="font-size: .7em;color: darkgrey;" ng-if="establecimiento.razon_social.length > 0">@{{establecimiento.razon_social.length}} de 255 caracteres</span><span class="text-error" ng-show="(indentificacionForm.$submitted || indentificacionForm.nombrer.$touched) && indentificacionForm.nombrer.$error.required">(El campo es obligatorio)</span>
                                <div class="input-group">
                                    <div class="input-group-addon" title="Campo requerido"><span class="glyphicon glyphicon-asterisk"></span></div>
                                    <input type="text" class="form-control" name="nombre" id="nombre" ng-model="establecimiento.razon_social" maxlength="255" ng-required="true" placeholder="Máx. 255 caracteres" />
                                    <span class="glyphicon glyphicon-exclamation-sign form-control-feedback" aria-hidden="true" ng-if="(indentificacionForm.$submitted || indentificacionForm.nombrer.$touched) && indentificacionForm.nombrer.$error.required "></span>
                                </div>

                            </div>
                            
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group" ng-class="{true:'form-group has-error has-feedback',false:'form-group'}[(indentificacionForm.$submitted || indentificacionForm.municipio.$touched) && indentificacionForm.municipio.$error.required]">
                                <label class="control-label" for="cargo">Municipio</label><span class="text-error" ng-show="(indentificacionForm.$submitted || indentificacionForm.municipio.$touched) && indentificacionForm.municipio.$error.required">(El campo es obligatorio)</span>
                                <div class="input-group">
                                    <div class="input-group-addon" title="Campo requerido"><span class="glyphicon glyphicon-asterisk"></span></div>
                                       <select class="form-control" name="municipio" id="municipio" ng-model="establecimiento.municipio_id" ng-options="item.id as item.nombre for item in municipios" required>
                                            <option selected disabled value="">- Seleccione un municipio -</option>
                                        </select>
                                    <span class="glyphicon glyphicon-exclamation-sign form-control-feedback" aria-hidden="true" ng-if="(indentificacionForm.$submitted || indentificacionForm.municipio.$touched) && indentificacionForm.municipio.$error.required "></span>
                                </div>

                            </div>
                            
                        </div>
</div>
                    <div class="row">
                        

                        <div class="col-xs-12 col-sm-12 col-md-8">
                            <div class="form-group" ng-class="{true:'form-group has-error has-feedback',false:'form-group'}[(indentificacionForm.$submitted || indentificacionForm.direccion.$touched) && indentificacionForm.direccion.$error.required]">
                                <label class="control-label" for="nombre">Dirección</label> <span style="font-size: .7em;color: darkgrey;" ng-if="establecimiento.direccion.length > 0">@{{establecimiento.direccion.length}} de 255 caracteres</span><span class="text-error" ng-show="(indentificacionForm.$submitted || indentificacionForm.direccion.$touched) && indentificacionForm.direccion.$error.required">(El campo es obligatorio)</span>
                                <div class="input-group">
                                    <div class="input-group-addon" title="Campo requerido"><span class="glyphicon glyphicon-asterisk"></span></div>
                                    <input type="text" class="form-control" name="nombre" id="nombre" ng-model="establecimiento.direccion" maxlength="255" ng-required="true" placeholder="Máx. 255 caracteres" />
                                    <span class="glyphicon glyphicon-exclamation-sign form-control-feedback" aria-hidden="true" ng-if="(indentificacionForm.$submitted || indentificacionForm.direccion.$touched) && indentificacionForm.direccion.$error.required "></span>
                                </div>

                            </div>
                            
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group" ng-class="{true:'form-group has-error has-feedback',false:'form-group'}[(indentificacionForm.$submitted || indentificacionForm.categoria.$touched) && indentificacionForm.categoria.$error.required]">
                                <label class="control-label" for="cargo">Categoria</label><span class="text-error" ng-show="(indentificacionForm.$submitted || indentificacionForm.categoria.$touched) && indentificacionForm.categoria.$error.required">(El campo es obligatorio)</span>
                                <div class="input-group">
                                    <div class="input-group-addon" title="Campo requerido"><span class="glyphicon glyphicon-asterisk"></span></div>
                                       <select class="form-control" name="categoria" id="categoria" ng-model="establecimiento.categoria_proveedor_id" ng-options="item.id as item.nombre for item in categorias" required>
                                            <option selected disabled value="">- Seleccione una categoria -</option>
                                        </select>
                                    <span class="glyphicon glyphicon-exclamation-sign form-control-feedback" aria-hidden="true" ng-if="(indentificacionForm.$submitted || indentificacionForm.categoria.$touched) && indentificacionForm.categoria.$error.required "></span>
                                </div>

                            </div>
                            
                        </div>
</div>
                    <div class="row">

                        <div class="col-xs-12 col-sm-8 col-md-8">
                            <div class="form-group" ng-class="{true:'form-group has-error has-feedback',false:'form-group'}[(indentificacionForm.$submitted || indentificacionForm.email.$touched) && (indentificacionForm.email.$error.required || indentificacionForm.email.$error.email)]">
                                <label class="control-label" for="email">Email</label> <span style="font-size: .7em;color: darkgrey;" ng-if="establecimiento.email.length > 0">@{{establecimiento.email.length}} de 255 caracteres</span><span class="text-error" ng-show="(indentificacionForm.$submitted || indentificacionForm.email.$touched) && indentificacionForm.email.$error.required">(El campo es obligatorio)</span><span class="text-error" ng-show="(indentificacionForm.$submitted || indentificacionForm.email.$touched) && indentificacionForm.email.$error.email">(Formato de email no permitido)</span>
                                <div class="input-group">
                                    <div class="input-group-addon" title="Campo requerido"><span class="glyphicon glyphicon-asterisk"></span></div>
                                    <input type="email" class="form-control" name="email" id="email" ng-model="establecimiento.email" maxlength="255" ng-required="true"  placeholder="Ej: alguien@dominio.com"/>
                                    <span class="glyphicon glyphicon-exclamation-sign form-control-feedback" aria-hidden="true" ng-if="(indentificacionForm.$submitted || indentificacionForm.email.$touched) && (indentificacionForm.email.$error.required || indentificacionForm.email.$error.email)"></span>
                                </div>

                            </div>

                        </div>
                        
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-group" ng-class="{true:'form-group has-error has-feedback',false:'form-group'}[(indentificacionForm.$submitted || indentificacionForm.fundacion.$touched) && (indentificacionForm.fundacion.$error.required || establecimiento.fundacion > hoy)]">
                                <label class="control-label" for="fundacion">Fecha de fundación</label> <span class="text-error" ng-show="(indentificacionForm.$submitted || indentificacionForm.fundacion.$touched) && indentificacionForm.fundacion.$error.required">(El campo es obligatorio)</span><span class="text-error" ng-show="(indentificacionForm.$submitted || indentificacionForm.fundacion.$touched) && establecimiento.fundacion >= hoy">(La fecha debe ser menor o igual al día de hoy)</span>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="fundacion" min="1" id="ano_fundacion" ng-model="establecimiento.ano_fundacion" placeholder="Solo números"/>
                                    <span class="glyphicon glyphicon-exclamation-sign form-control-feedback" aria-hidden="true" ng-if="(indentificacionForm.$submitted || indentificacionForm.extension.$touched) && (indentificacionForm.extension.$error.number || indentificacionForm.extension.$error.valid)"></span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        

                        <div class="col-xs-12 col-sm-12 col-md-8">
                            <div class="form-group" ng-class="{true:'form-group has-error has-feedback',false:'form-group'}[(indentificacionForm.$submitted || indentificacionForm.nombre.$touched) && indentificacionForm.nombre.$error.required]">
                                <label class="control-label" for="nombre">Nombre del contacto</label> <span style="font-size: .7em;color: darkgrey;" ng-if="establecimiento.nombre.length > 0">@{{establecimiento.nombre.length}} de 255 caracteres</span><span class="text-error" ng-show="(indentificacionForm.$submitted || indentificacionForm.nombre.$touched) && indentificacionForm.nombre.$error.required">(El campo es obligatorio)</span>
                                <div class="input-group">
                                    <div class="input-group-addon" title="Campo requerido"><span class="glyphicon glyphicon-asterisk"></span></div>
                                    <input type="text" class="form-control" name="nombre" id="nombre" ng-model="establecimiento.nombre_contacto" maxlength="255" ng-required="true" placeholder="Máx. 255 caracteres" />
                                    <span class="glyphicon glyphicon-exclamation-sign form-control-feedback" aria-hidden="true" ng-if="(indentificacionForm.$submitted || indentificacionForm.nombre.$touched) && indentificacionForm.nombre.$error.required "></span>
                                </div>

                            </div>
                            
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group" ng-class="{true:'form-group has-error has-feedback',false:'form-group'}[(indentificacionForm.$submitted || indentificacionForm.cargo.$touched) && indentificacionForm.cargo.$error.required]">
                                <label class="control-label" for="cargo">Cargo</label> <span style="font-size: .7em;color: darkgrey;" ng-if="establecimiento.cargo.length > 0">@{{establecimiento.cargo.length}} de 255 caracteres</span><span class="text-error" ng-show="(indentificacionForm.$submitted || indentificacionForm.cargo.$touched) && indentificacionForm.cargo.$error.required">(El campo es obligatorio)</span>
                                <div class="input-group">
                                    <div class="input-group-addon" title="Campo requerido"><span class="glyphicon glyphicon-asterisk"></span></div>
                                    <input type="text" class="form-control" name="cargo" id="cargo" ng-model="establecimiento.cargo_contacto" maxlength="255" ng-required="true" placeholder="Máx. 255 caracteres" />
                                    <span class="glyphicon glyphicon-exclamation-sign form-control-feedback" aria-hidden="true" ng-if="(indentificacionForm.$submitted || indentificacionForm.cargo.$touched) && indentificacionForm.cargo.$error.required "></span>
                                </div>

                            </div>
                            
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xs-12 col-sm-8 col-md-4">
                            <div class="form-group" ng-class="{true:'form-group has-error has-feedback',false:'form-group'}[(indentificacionForm.$submitted || indentificacionForm.telefono.$touched) && (indentificacionForm.telefono.$error.required || indentificacionForm.telefono.$error.pattern)]">
                                <label class="control-label" for="telefono">Teléfono fijo</label> <span class="text-error" ng-show="(indentificacionForm.$submitted || indentificacionForm.telefono.$touched) && indentificacionForm.telefono.$error.required">(El campo es obligatorio)</span><span class="text-error" ng-show="(indentificacionForm.$submitted || indentificacionForm.telefono.$touched) && indentificacionForm.telefono.$error.pattern">(Formato no válido)</span>
                                <div class="input-group">
                                    <div class="input-group-addon" title="Campo requerido"><span class="glyphicon glyphicon-asterisk"></span></div>
                                    <input type="text" class="form-control" name="telefono" id="telefono" ng-model="establecimiento.telefono_fijo" pattern="([0-9])+|[+]([0-9])+" maxlength="255" ng-required="true" placeholder="Caracteres válidos: + 0-9. Ej: +57 4300000" />
                                    <span class="glyphicon glyphicon-exclamation-sign form-control-feedback" aria-hidden="true" ng-if="(indentificacionForm.$submitted || indentificacionForm.telefono.$touched) && (indentificacionForm.telefono.$error.required || indentificacionForm.telefono.$error.pattern)"></span>
                                </div>

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-3">
                            <div class="form-group" ng-class="{true:'form-group has-error has-feedback',false:'form-group'}[(indentificacionForm.$submitted || indentificacionForm.extension.$touched) && (indentificacionForm.extension.$error.number || indentificacionForm.extension.$error.valid)]">
                                <label class="control-label" for="extension">Extensión</label> <span class="text-error" ng-show="(indentificacionForm.$submitted || indentificacionForm.extension.$touched) && indentificacionForm.extension.$error.number">(Solo números)</span><span class="text-error" ng-show="(indentificacionForm.$submitted || indentificacionForm.extension.$touched) && indentificacionForm.extension.$error.valid">(Números >= 0)</span>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="extension" min="1" id="extension" ng-model="establecimiento.extension" placeholder="Solo números"/>
                                    <span class="glyphicon glyphicon-exclamation-sign form-control-feedback" aria-hidden="true" ng-if="(indentificacionForm.$submitted || indentificacionForm.extension.$touched) && (indentificacionForm.extension.$error.number || indentificacionForm.extension.$error.valid)"></span>
                                </div>

                            </div>
                            
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-5">
                            <div class="form-group" ng-class="{true:'form-group has-error has-feedback',false:'form-group'}[(indentificacionForm.$submitted || indentificacionForm.celular.$touched) && (indentificacionForm.celular.$error.required || indentificacionForm.celular.$error.pattern)]">
                                <label class="control-label" for="celular">Celular</label> <span class="text-error" ng-show="(indentificacionForm.$submitted || indentificacionForm.celular.$touched) && indentificacionForm.celular.$error.required">(El campo es obligatorio)</span><span class="text-error" ng-show="(indentificacionForm.$submitted || indentificacionForm.celular.$touched) && indentificacionForm.celular.$error.pattern">(Formato no válido)</span>
                                <div class="input-group">
                                    <div class="input-group-addon" title="Campo requerido"><span class="glyphicon glyphicon-asterisk"></span></div>
                                    <input type="text" class="form-control" name="celular" id="celular" ng-model="establecimiento.celular" pattern="([0-9])+|[+]([0-9])+" maxlength="255" ng-required="true" placeholder="Caracteres válidos: + 0-9. Ej: +57 4300000" />
                                    <span class="glyphicon glyphicon-exclamation-sign form-control-feedback" aria-hidden="true" ng-if="(indentificacionForm.$submitted || indentificacionForm.celular.$touched) && (indentificacionForm.celular.$error.required || indentificacionForm.celular.$error.pattern)"></span>
                                </div>

                            </div>

                        </div>


                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="comercio" class="col-xs-12 col-md-8 control-label">¿Tiene usted registro en la cámara de comercio? </label>
                                <div class="col-xs-12 col-md-4">
                                    <label class="radio-inline">
                                        <input type="radio" name="comercio" ng-model="establecimiento.camara_comercio" ng-required="true" value="1" /> Si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="comercio" ng-model="establecimiento.camara_comercio" ng-required="true" value="0" /> No
                                    </label>
                                    <span ng-show="indentificacionForm.$submitted || indentificacionForm.comercio.$touched">
                                        <span class="label label-danger" ng-show="indentificacionForm.comercio.$error.required">* El campo es requerido</span>
                                </div>
                                </span>
                            </div>
                        </div>
                       
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="registro" class="col-xs-12 col-md-8 control-label">¿Tiene usted registro nacional de turismo- RNT? </label>
                                <div class="col-xs-12 col-md-4">
                                    <label class="radio-inline">
                                        <input type="radio" name="registro" ng-model="establecimiento.registro_turismo" ng-required="true" value="1" /> Si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="registro" ng-model="establecimiento.registro_turismo" ng-required="true" value="0" /> No
                                    </label>
                                    <span ng-show="indentificacionForm.$submitted || indentificacionForm.registro.$touched">
                                        <span class="label label-danger" ng-show="indentificacionForm.registro.$error.required">* El campo es requerido</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <br />

            </div>

            <div class="row" style="text-align:center">
                <input type="submit" class="btn btn-raised btn-success" value="Guardar" ng-click="guardar()" />
            </div>
        </form>

    </div>
  

    <div class='carga'>

    </div>

@endsection


@section('javascript')
<script src="{{asset('/js/dir-pagination.js')}}"></script>
<script src="{{asset('/js/plugins/checklist-model.js')}}"></script>
<script src="{{asset('/js/plugins/angular-sanitize.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/plugins/select.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/encuestas/ofertaempleo/proveedoresapp.js')}}"></script>
<script src="{{asset('/js/encuestas/ofertaempleo/servicesproveedor.js')}}"></script>
        
@endsection