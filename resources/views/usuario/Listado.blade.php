
@extends('layout._AdminLayout')

@section('Title', 'Listado de usuarios')

@section('TitleSection', 'Listado de usuarios')

@section('app','ng-app="admin.usuario"')

@section('controller','ng-controller="listadoUsuariosCtrl"')

@section('titulo','Usuarios')
@section('subtitulo','El siguiente listado cuenta con @{{usuarios.length}} registro(s)')

@section('content')
    
   
    <div class="blank-page widget-shadow scroll" id="style-2 div1">
        <div class="flex-list">
            <a href="/usuario/guardar" type="button" class="btn btn-lg btn-success">
              Agregar usuario
            </a> 
            <div class="form-group has-feedback" style="display: inline-block;">
                <label class="sr-only">Búsqueda de usuario</label>
                <input type="text" ng-model="prop.search" class="form-control input-lg" id="inputEmail3" placeholder="Buscar usuario...">
                <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
            </div>      
        </div>
        <div class="text-center" ng-if="(usuarios | filter:prop.search).length > 0 && (prop.search != '' && prop.search != undefined)">
            <p>Hay @{{(usuarios | filter:prop.search).length}} registro(s) que coinciden con su búsqueda</p>
        </div>
        <div class="alert alert-info" ng-if="usuarios.length == 0">
            <p>No hay registros almacenados</p>
        </div>
        <div class="alert alert-warning" ng-if="(usuarios | filter:prop.search).length == 0 && usuarios.length > 0">
            <p>No existen registros que coincidan con su búsqueda</p>
        </div>

        <div class="row">
            <div class="col-xs-12" style="overflow: auto;">
                <div>
                    <table class="table table-hover table-responsive Table">
                        <thead>
                            <tr>
                                <th>Nombres</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody ng-init="currentPageUsuarios = 1">
                            <tr dir-paginate="usuario in usuarios|filter:prop.search|itemsPerPage: 10" current-page="currentPageUsuarios" ng-click="verDetalleUsuario($event, usuario)">
                                <!--<td>@{{($index + 1) + (currentPageUsuarios - 1) * 10}}</td>-->
                                <td>@{{usuario.nombre}}</td>
                                <td>@{{usuario.email}}</td>
                                <td><span ng-repeat="rol in usuario.roles">@{{rol.display_name}}<span ng-if="!$last">,</span></span></td>
                                <td ng-if="usuario.estado == true">Activo</td>
                                <td ng-if="usuario.estado != true">Inactivo</td>
                                <td>
                                    <a href="/usuario/editar/@{{usuario.id}}" role="button" title="Editar usuario" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <button type="button" ng-if="usuario.estado == true" ng-click="cambiarEstado(usuario)" title="Desactivar usuario" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-ban-circle"></span></button>
                                    <button type="button" ng-if="usuario.estado != true" ng-click="cambiarEstado(usuario)" title="Activar usuario" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-ok-circle"></span></button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    
                    <div class="col-md-12 text-center">
                        <dir-pagination-controls></dir-pagination-controls>
                    </div>
                </div>
            </div>
        </div>
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


