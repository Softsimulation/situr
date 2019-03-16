@extends('layout._AdminLayout')

@section('Title','Equipo SITUR')

@section ('estilos')
    <style>
        header{
            position: static;
            background-color: black;
            margin-bottom: 1rem;
        }
        .nav-bar > .brand a img{
            height: auto;
        }
        main{
            padding: 2% 0;
        }
        .label{
            white-space: normal;
            display: inline-block;
            font-weight: 500;
            font-size: .85rem;
        }
        .tile .tile-img .text-overlap{
            display: flex;
            align-items: flex-end;
            background: transparent;
        }
        .tile .tile-img img{
            width: 100%;
        }
        .tiles .tile .tile-img{
            height: 256px;
        }
        
        
           .image-preview-input {
            position: relative;
            overflow: hidden;
            margin: 0px;
            color: #333;
            background-color: #fff;
            border-color: #ccc;
        }

        .image-preview-input input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
        }

        .image-preview-input-title {
            margin-left: 2px;
        }

        .messages {
            color: #FA787E;
        }
    </style>
@endsection

@section('app','ng-app="equipoSiturApp"')

@section('controller','ng-controller="lisatdo"')

@section('titulo','Equipo Situr')
@section('subtitulo','Módulo para la administración delos integrantes de situr')

@section('content')
    <div class="container">
             <button type="button" ng-click="crearMiembro()" class="btn btn-lg btn-success" class="btn btn-lg btn-success">
                Crear Miembro  </button>
        <hr>
       
        <div class="tiles" ng-repeat="miembro in equipo">
            <div class="tile">
                <div class="tile-img" style="background:white;">
                    <img src= '@{{miembro.imagen}}' alt="Imagen por defecto de persona">
                    <div class="text-overlap" ng-show="miembro.cargo">
                        <span class="label label-success">@{{miembro.cargo}}</span>
                    </div>
                </div>
                <div class="tile-body">
                    <h4>@{{miembro.nombre}}</h4>
                    
                    <p class="text-muted">@{{miembro.descripcion}}</p>
                    <div class="row">
                        <div class="col-md-2">
                             <button class="btn btn-default btn-sm" title="Editar miembro" ng-click="editarMiembro(miembro)"><span class="glyphicon glyphicon-edit"></span> </button>
                           
                        </div>
                        
                        <div class="col-md-2">
                            <button class="btn btn-@{{miembro.estado ? 'danger' : 'success'}}" ng-click="cambiarEstado(miembro)">@{{miembro.estado ? 'Desactivar' : 'Activar'}}</button>
                        </div>
                             
                      </div>
                </div>
                
            </div>

        </div>
        
    </div>
        
        
 <div class="modal fade" id="modalCrearMiembro" tabindex="-1" role="dialog" aria-labelledby="modalCrearMiembro">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Crear Miembro</h4>
            </div>
            <form role="form" name="miembroForm" novalidate>
                <div class="modal-body">
                 

                    <div class="alert alert-danger" ng-if="errores != null">
                        <h6>Errores</h6>
                          <div class="alert alert-danger" ng-repeat="error in errores">
                            *@{{error[0]}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12" style="margin-left: 0; margin-right: 0;">
                                <div class="form-group"´id="upload-ini">
                                    <label class="control-label" for="imagenSlider"> Subir imagen <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="bottom" title="La imagen debe tener un peso de 2MB y debe ser de formato jpeg, jpg o png"></span></label>
                                    <div class="input-upload" title="Presione para seleccionar un logo">
                                        <label for="imagenSlider">
                                            <div class="content-input-upload">
                                         
                                                <img id="imagen-slider-crear" class="previewUpload" alt="Imagen previa" />
                                                <div class="content">
                                                    <span class="ion-camera"></span><br />
                                                    Presione para seleccionar un logotipo (Opcional)
                                                </div>
                                            </div>
                                        </label>
                                        <input type="file" id="imagenSlider" name="imagenSlider" file-input='imagenSlider' accept=".jpg,.jpeg,.png" />
                                    </div>
                                    
                                </div>
                                
                                
                            </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-8 col-sm-8">
                            <div class="form-group" ng-class="{'has-error': (miembroForm.$submitted || miembroForm.sesion.$touched) && miembroForm.sesion.$error.required }">
                                <label class="control-label" for="sesion"><span class="asterisk">*</span>Nombre</label>
                                <input type="text" class="form-control" name="sesion" id="sesion" placeholder="Ingrese el nombre de la persona. Máx. 455 caracteres" maxlength="455" ng-model="miembro.nombre" required />
                            </div>
                        </div>
                            <div class="col-xs-12 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="presidente">Cargo</label>
                                <input type="text" class="form-control" name="presidente" id="presidente" placeholder="Ingrese el cargo de la persona. Máx. 455 caracteres" maxlength="455" ng-model="miembro.cargo"  />
                            </div>
                        </div>
                    </div>
             
             
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group" ng-class="{'has-error': (miembroForm.$submitted || miembroForm.descripcion.$touched) && miembroForm.descripcion.$error.required }" >
                                <label class="control-label" for="datosDestacados"><span class="asterisk">*</span>Descripción</label>
                                <textarea class="form-control" name="descripcion" id="descripcion" ng-model="miembro.descripcion" placeholder="Ingrese la descripción de la persona " rows="4" required></textarea>
                            </div>
                        </div>
                    </div>


                

                </div>
                <div class="modal-footer text-right">
                    <div class="col-xs-12">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" ng-click="guardarMiembro()" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modalEditarMiembro" tabindex="-1" role="dialog" aria-labelledby="modalEditarMiembro">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Editar Miembro</h4>
            </div>
            <form role="form" name="miembroEditForm" novalidate>
                <div class="modal-body">

                    <div class="alert alert-danger" ng-if="errores != null">
                        <h6>Errores</h6>
                          <div class="alert alert-danger" ng-repeat="error in errores">
                            *@{{error[0]}}
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-xs-12" id="upload-ini" style="margin-left: 0; margin-right: 0;">
                                <label><span class="asterisk">*</span> Subir imagen</label> <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="bottom" title="La imagen debe tener un peso de 2MB y debe ser de formato jpeg, jpg o png"></span>
                                <div class="input-upload" title="Presione para seleccionar un logo">
                                    <label for="imagenSliderEditar">
                                        <div class="content-input-upload">
                                           
                                            <img id="imagen-slider-editar" class="previewUpload" src="@{{miembro.imagen}}" alt="Imagen previa" />
                                            <div class="content">
                                                <span class="ion-camera"></span><br />
                                                Presione para seleccionar un logotipo (Opcional)
                                            </div>
                                        </div>
                                    </label>
                                    <input type="file" id="imagenSliderEditar" name="imagenSliderEditar" file-input='imagenSliderEditar' accept=".jpg,.jpeg,.png" />
                                </div>
                                
                            </div>
                                
                                
                    </div>
                        
     
                    <div class="row">
                        <div class="col-xs-12 col-md-8 col-sm-8">
                            <div class="form-group" ng-class="{'has-error': (miembroEditForm.$submitted || miembroEditForm.sesion.$touched) && miembroEditForm.sesion.$error.required }">
                                <label class="control-label" for="sesion"><span class="asterisk">*</span>Nombre</label>
                                <input type="text" class="form-control" name="sesion" id="sesion" placeholder="Ingrese el nombre de la persona. Máx. 455 caracteres" maxlength="455" ng-model="miembro.nombre" required />
                            </div>
                        </div>
                            <div class="col-xs-12 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="presidente">Cargo</label>
                                <input type="text" class="form-control" name="presidente" id="presidente" placeholder="Ingrese el cargo de la persona. Máx. 455 caracteres" maxlength="455" ng-model="miembro.cargo"  />
                            </div>
                        </div>
                    </div>
             
             
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group" ng-class="{'has-error': (miembroEditForm.$submitted || miembroEditForm.descripcion.$touched) && miembroEditForm.descripcion.$error.required }" >
                                <label class="control-label" for="datosDestacados"><span class="asterisk">*</span>Descripción</label>
                                <textarea class="form-control" name="descripcion" id="descripcion" ng-model="miembro.descripcion" placeholder="Ingrese la descripción de la persona " rows="4" required></textarea>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer text-right">
                    <div class="col-xs-12">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" ng-click="guardarEditarMiembro()" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

   

@endsection
@section('javascript')
<script src="{{asset('/js/dir-pagination.js')}}"></script>
<script src="{{asset('/js/plugins/checklist-model.js')}}"></script>
<script src="{{asset('/js/plugins/select.min.js')}}"></script>
<script src="{{asset('/js/administrador/equipositur/services.js')}}"></script>
<script src="{{asset('/js/administrador/equipositur/app.js')}}"></script>
<script src="{{asset('/js/plugins/directiva-tigre.js')}}"></script>
<script defer>

    function readURL(input , idPreview) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(idPreview).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#modalAgregarSlider").on('shown.bs.modal', function () {
        $('#imagen-slider-crear').attr('src', '');
    });

    $("#imagenSlider").change(function () {
        readURL(this, "#imagen-slider-crear");
    });
    $("#imagenSliderEditar").change(function () {
        readURL(this, "#imagen-slider-editar");
    });
</script><script defer>

    function readURL(input , idPreview) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(idPreview).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#modalAgregarSlider").on('shown.bs.modal', function () {
        $('#imagen-slider-crear').attr('src', '');
    });

    $("#imagenSlider").change(function () {
        readURL(this, "#imagen-slider-crear");
    });
    $("#imagenSliderEditar").change(function () {
        readURL(this, "#imagen-slider-editar");
    });
</script>
@endsection