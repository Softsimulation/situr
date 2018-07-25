
@extends('layout._AdminLayout')

@section('title','Muestra maestra')
@section('TitleSection','Muestra maestra')
@section('app','ng-app="appMuestraMaestra"')
@section('controller','ng-controller="MuestraMaestraCtrl"')


@section('content')
   
    <div class="row"  >
        
        
        <button type="button" id="btn-add" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalAddZona">Agregar zona</button>

       
        <div class="col-md-12">
            
            <ng-map id="mapa" zoom="9" center="[10.4113014,-74.4056612]" styles="[{featureType:'poi.school',elementType:'labels',stylers:[{visibility:'off'}]} , {featureType:'poi.business',elementType:'labels',stylers:[{visibility:'off'}]} , {featureType:'poi.attraction',elementType:'labels',stylers:[{visibility:'off'}]} ]" map-type-control="false" street-view-control="true" >
              
                <marker ng-repeat="pro in proveedores" id="marker-@{{pro.id}}" 
                      position="@{{pro.latitud}},@{{pro.longitud}}" on-click="map.showInfoWindow('bar@{{pro.id}}')">
                  
                    <info-window id="bar@{{pro.id}}" >
                        <div ng-non-bindable="" style="text-align:center" >
                            <h4 class="positive" style="text-align:center" >@{{pro.nombre}} </h4>
                        </div>
                    </info-window>
                  
                </marker>
              
                <shape ng-repeat="item in zonas" index="@{{$index}}" fill-color="@{{ !item.id ? '#FF0000' : ''}}"
                    name="rectangle" editable="@{{ item.id ? false:true}}" draggable="@{{ item.id ? false:true}}"
                    bounds="[[@{{item.pos1}},@{{item.pos2}}],[@{{item.pos3}},@{{item.pos4}}]]"
                    on-bounds_changed="boundsChanged()">
            
                     <custom-marker position="@{{item.tex1}},@{{item.tex2}}" >
                        
                        <div>
                            <div class="dropdown">
                              <button class="btn btn-xs btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                 @{{item.nombre}} <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu">
                                <li><a href="#">Ver</a></li>
                                <li><a href="#">Editar</a></li>
                                <li><a href="/MuestraMaestra/excel/@{{item.id}}" download >Generar Excel</a></li>
                              </ul>
                            </div>
                        </div>
                           
                     </custom-marker>
                </shape>
                  
            </ng-map>
            
        </div>
      
    </div>
    
    
    <!-- Modal para gregar zona -->
<div id="modalAddZona" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Agregar zona</h4>
      </div>
      <div class="modal-body">
        
        <div class="form-group">
          <label for="name">Nombre:</label>
          <input type="text" class="form-control" id="name" ng-model="nombreZona" >
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="agregarZona()" >Guardar</button>
      </div>
    </div>

  </div>
</div>
    

@endsection

@section('estilos')
    <style type="text/css">
        #mapa{
            height: 700px;
            width: 100%;
        }
        .custom-marker .dropdown {
            bottom: -30px;
            left: 28px; 
        }
        .container, .container .row, .container .col-md-12{
            padding: 0px !important;
            margin:0 !important;
            width: 100% !important;
        }
        #btn-add{
            position: absolute;
            z-index: 100;
            margin: 10px;
        }
    </style>
@endsection



@section('javascript')
    <script src="https://maps.google.com/maps/api/js?libraries=placeses,visualization,drawing,geometry,places"></script>
    <script src="https://rawgit.com/allenhwkim/angularjs-google-maps/master/build/scripts/ng-map.js"></script>
    <script src="{{asset('/js/muestraMaestra/servicios.js')}}"></script>
    <script src="{{asset('/js/muestraMaestra/app.js')}}"></script>
@endsection