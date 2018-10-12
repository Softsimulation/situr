
@extends('layout._AdminLayout')

@section('title', 'Proveedores oferta y empleo')

@section('app','ng-app="proveedoresoferta"')

@section('controller','ng-controller="listadoRnt"')

@section('titulo','Proveedores RNT')
@section('subtitulo','Listado de proveedores RNT')

@section('content')

<div class="alert alert-danger" ng-if="errores != null">
    <label><b>Errores:</b></label>
    <br />
    <div ng-repeat="error in errores" ng-if="error.length>0">
        -@{{error[0]}}
    </div>

</div>    

<div class="flex-list" ng-show="proveedores.length > 0">
    <input type="text" style="margin-bottom: .5em;" ng-model="prop.search" class="form-control input-lg" id="inputSearch" placeholder="Buscar registro...">    
</div>

<br/>
<div class="text-center" ng-if="(proveedores | filter:prop.search).length > 0 && (prop.search != undefined && (proveedores | filter:prop.search).length != proveedores.length)">
    <p>Hay @{{(proveedores | filter:search).length}} registro(s) que coinciden con su búsqueda</p>
</div>
<div class="alert alert-info" ng-if="proveedores.length == 0">
    <p>No hay registros almacenados</p>
</div>
<div class="alert alert-warning" ng-if="(proveedores | filter:prop.search).length == 0 && proveedores.length > 0">
    <p>No existen registros que coincidan con su búsqueda</p>
</div>

    <div class="row" ng-show="(proveedores | filter:prop.search).length > 0">
        <div class="col-xs-12">
            <table class="table table-striped">
                <thead>
                <tr>                           
                    <th>Número de RNT</th>
                    <th>Nombre comercial</th>
                    <th>Categoría</th>
                    <th>Tipo</th>
                    <th>Encuesta</th>
                    <th style="width: 70px;"></th>
                </tr>
                </thead>
                 <tbody>
                <tr dir-paginate="item in proveedores|filter:prop.search|itemsPerPage:10 as results" pagination-id="paginacion_antiguos" >
                        
                        <td>@{{item.rnt}}</td>
                        <td>@{{item.nombre}}</td>
                        <td>@{{item.subcategoria}}</td>
                        <td>@{{item.categoria}}</td>
                        <td ng-if="item.sitio_para_encuesta_id != null">Activo</td>
                        <td ng-if="item.sitio_para_encuesta_id == null">Desactivado</td>
                        <td style="text-align: center;">
                          <a  href="/ofertaempleo/activar/@{{item.id}}" class="btn btn-default btn-xs" title="Editar" ><span class="glyphicon glyphicon-pencil"></span></a>
                        </td>
                    </tr>
                 </tbody>
            </table>
            
        </div>
    </div>
    <div class="row">
      <div class="col-xs-12 text-center">
          <dir-pagination-controls pagination-id="paginacion_antiguos"  max-size="5" direction-links="true" boundary-links="true"></dir-pagination-controls>
      </div>
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