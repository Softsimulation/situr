
@extends('layout._AdminLayout')

@section('title', 'Formulario de activación de proveedores')

@section('app','ng-app="proveedoresoferta"')

@section('controller','ng-controller="activarController"')

@section('titulo','Proveedores de oferta y empleo')
@section('subtitulo','Formulario de activación')

@section('content')

 <input type="hidden" ng-model="id" ng-init="id = {{$id}}" />

   
    <div class="alert alert-danger" ng-if="errores != null">
        <label><b>Errores:</b></label>
        <br />
        <div ng-repeat="error in errores" ng-if="error.length>0">
            -@{{error[0]}}
        </div>

    </div>   
    <div class="blank-page widget-shadow scroll" id="style-2 div1">

        <form role="form" name="indentificacionForm" novalidate>
            <fieldset>
                <legend>Información para activación de proveedor</legend>
                <div class="alert alert-info">
                    <p>Los campos marcados con asterisco (*) son obligatorios.</p>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="form-group" ng-class="{'has-error':(indentificacionForm.$submitted || indentificacionForm.nombrer.$touched) && indentificacionForm.nombrer.$error.required}">
                            <label class="control-label" for="nombrer"><span class="asterisk">*</span> Nombre</label> 
                            <input type="text" class="form-control" name="nombrer" id="nombrer" ng-model="establecimiento.razon_social" maxlength="255" required placeholder="Máx. 255 caracteres" />
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-8">
                        <div class="form-group" ng-class="{'has-error':(indentificacionForm.$submitted || indentificacionForm.categoria.$touched) && indentificacionForm.categoria.$error.required}">
                            <label class="control-label" for="cargo"><span class="asterisk">*</span> Categoria</label>
                            <select class="form-control" name="categoria" id="categoria" ng-model="establecimiento.categoria_proveedor_id" ng-options="item.id as item.nombre for item in categorias" required>
                                <option selected disabled value="">- Seleccione una categoria -</option>
                            </select>
                                
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <div class="form-group" ng-class="{'has-error':(indentificacionForm.$submitted || indentificacionForm.fundacion.$touched) && (indentificacionForm.fundacion.$error.required || establecimiento.fundacion > hoy)}">
                            <label class="control-label" for="fundacion">Fecha de fundación</label> 
                            <input type="number" class="form-control" name="fundacion" min="1" id="ano_fundacion" ng-model="establecimiento.ano_fundacion" placeholder="Solo números"/>
                            <span class="text-error" ng-show="(indentificacionForm.$submitted || indentificacionForm.fundacion.$touched) && establecimiento.fundacion >= hoy">La fecha debe ser menor o igual al día de hoy</span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3">
                        <div class="form-group" ng-class="{'has-error':(indentificacionForm.$submitted || indentificacionForm.municipio.$touched) && indentificacionForm.municipio.$error.required}">
                            <label class="control-label" for="cargo"><span class="asterisk">*</span> Municipio</label>
                            <select class="form-control" name="municipio" id="municipio" ng-model="establecimiento.municipio_id" ng-options="item.id as item.nombre for item in municipios" required>
                                <option selected disabled value="">- Seleccione un municipio -</option>
                            </select>
                          
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-5">
                        <div class="form-group" ng-class="{'has-error':(indentificacionForm.$submitted || indentificacionForm.direccion.$touched) && indentificacionForm.direccion.$error.required}">
                            <label class="control-label" for="direccion"><span class="asterisk">*</span> Dirección</label> 
                            <input type="text" class="form-control" name="direccion" id="direccion" ng-model="establecimiento.direccion" maxlength="255" required placeholder="Máx. 255 caracteres" />
                            
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <div class="form-group" ng-class="{'has-error':(indentificacionForm.$submitted || indentificacionForm.email.$touched) && ( indentificacionForm.email.$error.email)}">
                            <label class="control-label" for="email">Email</label> 
                            <input type="email" class="form-control" name="email" id="email" ng-model="establecimiento.email" maxlength="255" placeholder="Ej: alguien@dominio.com"/>
                            <span class="text-error" ng-show="(indentificacionForm.$submitted || indentificacionForm.email.$touched) && indentificacionForm.email.$error.email">Formato de email no permitido</span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-8">
                        <div class="form-group" ng-class="{'has-error':(indentificacionForm.$submitted || indentificacionForm.nombre.$touched) && indentificacionForm.nombre.$error.required}">
                            <label class="control-label" for="nombre"><span class="asterisk">*</span> Nombre del contacto</label> 
                            <input type="text" class="form-control" name="nombre" id="nombre" ng-model="establecimiento.nombre_contacto" maxlength="255" required placeholder="Máx. 255 caracteres" />
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <div class="form-group" ng-class="{'has-error':(indentificacionForm.$submitted || indentificacionForm.cargo.$touched) && indentificacionForm.cargo.$error.required}">
                            <label class="control-label" for="cargo"><span class="asterisk">*</span> Cargo</label> 
                            <input type="text" class="form-control" name="cargo" id="cargo" ng-model="establecimiento.cargo_contacto" maxlength="255" required placeholder="Máx. 255 caracteres" />
                           
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-5">
                        <div class="form-group" ng-class="{'has-error':(indentificacionForm.$submitted || indentificacionForm.telefono.$touched) && (indentificacionForm.telefono.$error.required || indentificacionForm.telefono.$error.pattern)}">
                            <label class="control-label" for="telefono"><span class="asterisk">*</span> Teléfono fijo</label> 
                            <input type="text" class="form-control" name="telefono" id="telefono" ng-model="establecimiento.telefono_fijo" pattern="([0-9])+|[+]([0-9])+" maxlength="255" required placeholder="Caracteres válidos: + 0-9. Ej: +57 4300000" />
                            <span class="text-error" ng-show="(indentificacionForm.$submitted || indentificacionForm.telefono.$touched) && indentificacionForm.telefono.$error.pattern">Formato no válido</span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-2">
                        <div class="form-group" ng-class="{'has-error':(indentificacionForm.$submitted || indentificacionForm.extension.$touched) && (indentificacionForm.extension.$error.number || indentificacionForm.extension.$error.valid)}">
                            <label class="control-label" for="extension">Ext.</label> 
                            <input type="number" class="form-control" name="extension" min="1" id="extension" ng-model="establecimiento.extension" placeholder="Solo números"/>
                            <span class="text-error" ng-show="(indentificacionForm.$submitted || indentificacionForm.extension.$touched) && indentificacionForm.extension.$error.number">Solo números</span>
                            <span class="text-error" ng-show="(indentificacionForm.$submitted || indentificacionForm.extension.$touched) && indentificacionForm.extension.$error.valid">Números >= 0</span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-5">
                        <div class="form-group" ng-class="{'has-error':(indentificacionForm.$submitted || indentificacionForm.celular.$touched) && (indentificacionForm.celular.$error.required || indentificacionForm.celular.$error.pattern)}">
                            <label class="control-label" for="celular"><span class="asterisk">*</span> Celular</label> 
                            <input type="text" class="form-control" name="celular" id="celular" ng-model="establecimiento.celular" pattern="([0-9])+|[+]([0-9])+" maxlength="255" required placeholder="Caracteres válidos: + 0-9. Ej: +57 4300000" />
                            <span class="text-error" ng-show="(indentificacionForm.$submitted || indentificacionForm.celular.$touched) && indentificacionForm.celular.$error.pattern">Formato no válido</span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label for="comercio" class="col-xs-12 col-md-8 control-label"><span class="asterisk">*</span> ¿Tiene usted registro en la cámara de comercio? </label>
                            <div class="col-xs-12 col-md-4">
                                <label class="radio-inline">
                                    <input type="radio" name="comercio" ng-model="establecimiento.camara_comercio" required value="1" /> Si
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="comercio" ng-model="establecimiento.camara_comercio" required value="0" /> No
                                </label>
                                
                            </div>
                            <span class="text-error" ng-show="(indentificacionForm.$submitted || indentificacionForm.comercio.$touched) && indentificacionForm.comercio.$error.required">El campo es requerido</span>
                        </div>
                        
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label for="registro" class="col-xs-12 col-md-8 control-label"><span class="asterisk">*</span> ¿Tiene usted registro nacional de turismo- RNT? </label>
                            <div class="col-xs-12 col-md-4">
                                <label class="radio-inline">
                                    <input type="radio" name="registro" ng-model="establecimiento.registro_turismo" required value="1" /> Si
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="registro" ng-model="establecimiento.registro_turismo" required value="0" /> No
                                </label>
                                
                                
                            </div>
                            <span class="text-error" ng-show="(indentificacionForm.$submitted || indentificacionForm.registro.$touched) && indentificacionForm.registro.$error.required">* El campo es requerido</span>
                        </div>
                    </div>
                    <div class="col-xs-12 text-center">
                        <hr/>
                        <input type="submit" class="btn btn-lg btn-success" value="Guardar" ng-click="guardar()" />
                        <a href="/ofertaempleo/listadoproveedores" role="button" class="btn btn-lg btn-default">Volver</a>
                    </div>
                </div>
                
            </fieldset>
               
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