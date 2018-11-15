
@extends('layout._AdminLayout')

@section('title','Muestra maestra')
@section('TitleSection', "Administración de informes" )
@section('app','ng-app="AppInformacionDepartamento"')
@section('controller','ng-controller="informacionDepartamentoCtrl"')

@section('estilos')

@endsection

@section('content')
    
    <input type="hidden" id="id" value="{{$id}}" />
    
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item active">
            <a class="nav-link" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true" >Información general</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="multimedia-tab" data-toggle="tab" href="#multimedia" role="tab" aria-controls="multimedia" aria-selected="false" >Multimedia</a>
        </li>
    </ul>
    
    <div class="tab-content" id="myTabContent" style="padding: 25px;" >
        <div class="tab-pane fade in active" id="general" role="tabpanel" aria-labelledby="home-tab">
            
            
            <form role="form" name="crearForm"  novalidate>
                
                <div class="row">
                    <div class="col-xs-12">
                        <label for="tituloinformacion"><span class="asterisco">*</span>Título</label>
                        <input type="text" class="form-control" name="tituloinformacion" id="tituloinformacion" ng-model="informacion.titulo" required/>
                        <span class="messages" ng-show="crearForm.$submitted || crearForm.tituloinformacion.$touched">
                            <span ng-show="crearForm.tituloinformacion.$error.required" class="color_errores">* El campo es obligatorio.</span>
                        </span>
                      
                    </div>
                </div>
                
                <br>
                
                <div class="row">
                    
                    <div class="col-xs-12">
                        <label for="textoinformacion"><span class="asterisco">*</span>Cuerpo</label>
                        <ng-ckeditor  
                                      ng-model="informacion.cuerpo"
                                      ng-disabled="editorDIsabled" 
                                      skin="moono" 
                                      remove-buttons="Image" 
                                      remove-plugins="iframe,flash,smiley"
                                      required
                                      >
                        </ng-ckeditor>
                    </div>
                    <span class="messages" ng-show="crearForm.$submitted || crearForm.textoinformacion.$touched">
                        <span ng-show="crearForm.textoinformacion.$error.required" class="color_errores">* El campo es obligatorio.</span>
                    </span>
                </div>
                
                <br>
                
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <button type="submit" ng-click="guardar()" class="btn btn-success">Guardar</button>
                    </div>
                </div>
                
            </form>
                
        </div>
        <div class="tab-pane fade" id="multimedia" role="tabpanel" aria-labelledby="profile-tab">
               
               <div class="row" >
                     <div class="col-md-12" >
                            <form role="form" name="formVideo" novalidate >
                                <div class="input-group">
                                  <input type="url" class="form-control" placeholder="URL de video" ng-model="informacion.video"  required >
                                  <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit" ng-click="guardarvideo()" >Guaradar</button>
                                  </span>
                                </div>
                            </form>
                     </div>
               </div>
               
               <br><br>
               
                <div class="row" >
                    <div class="col-md-12" >
                        <file-input id-input="galeria" ng-model="galeria" accept="image/*" label="Agregar imagenes" icon-class="ion-ios-photos" icon="" multiple ></file-input>
                        <button class="btn btn-primary" ng-click="guardarGaleria()" ng-show="galeria.length>0" >
                            Guaradar imagenes
                        </button>
                    </div>
                    <div class="col-md-12" >
                        <h2>Imagnes de galeria</h2>
                        
                        <div class="alert" ng-if="informacion.imagenes.length==0" >
                            <div class="alert-info" >
                                <b>0 imagenes</b>, Nose encontraron imagenes almacenadas para la galeria.
                            </div>
                        </div>
                                
                        <div class="cont-imagenes row"  >
                            <div class="col-md-4" ng-repeat="item in informacion.imagenes"  >
                                <div class="item" >
                                    <img ng-src="@{{item.ruta}}" />
                                    <button ng-click="eliminarImagen(item.id, $index)"  >Eliminar</button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
        </div>
    </div>
    
    

            

@endsection


@section('javascript')
    <script src="{{asset('/js/plugins/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('/js/plugins/ckeditor/ngCkeditor-v2.0.1.js')}}"></script>
    <script src="{{asset('/js/plugins/directiva-files.js')}}"></script>
    <script src="{{asset('/js/informacionDepartamento/servicios.js')}}"></script>
    <script src="{{asset('/js/informacionDepartamento/app.js')}}"></script>
@endsection
