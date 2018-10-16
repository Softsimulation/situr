@extends('layout._AdminLayout')

@section('Title', 'Formulario para el modificación de usuarios')

@section('app','ng-app="admin.usuario"')

@section('controller','ng-controller="editarUsuarioCtrl"')

@section('titulo','Usuarios')
@section('subtitulo','Formulario para el modificación de usuarios')

@section('content')

            <div class="alert alert-danger" ng-if="errores != null">
                <h3>Corriga los siguientes errores:</h3>
                <div ng-repeat="error in errores">
                    -@{{error[0]}}
                </div>
            </div>
        
            <div class="blank-page widget-shadow scroll" id="style-2 div1">
                <form role="form" name="crearForm" novalidate>
                    
                    <fieldset>
                        <legend>Información general del usuario</legend>
                        <div class="alert alert-info">
                            <p>Los campos marcados con asterisco (*) son obligatorios.</p>
                        </div>
                        <input type="hidden" name="id" id="id" ng-init="usuario.id={{$id}}"/>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group" ng-class="{'has-error': (crearForm.$submitted || crearForm.nombres.$touched) && crearForm.nombres.$error.required }">
                                    <label class="control-label" for="nombres"><span class="asterisk">*</span> Nombres</label>
                                    <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Ingrese el o los nombres del docente. Máx. 255 caracteres" maxlength="255" ng-model="usuario.nombres" required />
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group" ng-class="{ 'has-error':(((crearForm.$submitted || crearForm.email.$touched) && crearForm.email.$error.required))}">
                                    <label class="control-label" for="email"><span class="asterisk">*</span> Correo electrónico</label>
                                    <input class="form-control" type="email" name="email" id="email"  placeholder="Ej: micorreo@dominio.com. Máx. 255 caracteres" maxlength="255" ng-model="usuario.email" required />
                                    <span class="text-error" ng-show="(crearForm.$submitted || crearForm.email.$touched) && crearForm.email.$error.required">&nbsp;</span>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group" ng-class="{ 'has-error':(((crearForm.$submitted || crearForm.password1.$touched) && (usuario.password1!= usuario.password2)))}">
                                    <label class="control-label" for="password1">Contraseña nueva</label>
                                    <input class="form-control" type="password" name="password1" id="password1" ng-model="usuario.password1" ng-maxlength="150" />
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group" ng-class="{ 'has-error':(((crearForm.$submitted || crearForm.password2.$touched) && (usuario.password1!= usuario.password2) ))}">
                                    <label class="control-label" for="password2">Confirmar contraseña</label>
                                    <input class="form-control" type="password" name="password2" id="password2" ng-model="usuario.password2" ng-maxlength="150" />
                                    <span class="text-error" ng-show="usuario.password2 != usuario.password1">Las contraseñas no coinciden</span>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="control-label"><span class="asterisk">*</span> Roles</label>
                                    <ui-select multiple sortable="true" ng-model="usuario.rol" theme="bootstrap" title="Escoja rol(es)" style="width:100%;">
                                        <ui-select-match placeholder="Seleccione rol(es)">@{{$item.display_name}}</ui-select-match>
                                        <ui-select-choices repeat="item.id as item in roles | filter: $select.search">
                                          <div ng-bind-html="item.display_name | highlight: $select.search"></div>
                                        </ui-select-choices>
                                    </ui-select>
                                </div>
                                
                            </div>
                            <div class="col-xs-12 text-center">
                                
                                <button type="button" class="btn btn-lg btn-success" ng-click="editarUsuario()" ng-disabled="crearForm.$invalid">Guardar</button>
                                <a role="button" class="btn btn-lg btn-default" href="/usuario/listadousuarios">Cancelar</a>
                            </div>
                        </div>
                    </fieldset>
                    
                </form>
            </div>
            <div class='carga'>
        
            </div>
        
@endsection
@section('javascript')
<script src="{{asset('/js/plugins/angular-sanitize.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/plugins/select.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/dir-pagination.js')}}"></script>
<script src="{{asset('/js/administrador/usuarios/administrador/usuario.js')}}" type="text/javascript"></script> 
<script src="{{asset('/js/administrador/usuarios/services/usuarioServices.js')}}" type="text/javascript"></script> 
@endsection

