var situr = angular.module("equipoSiturApp", ['InputFile' ,'checklist-model', 'angularUtils.directives.dirPagination', 'ui.select', 'equipoSiturServices']);

situr.directive('fileInput', ['$parse', function ($parse) {

    return {
        restrict: 'A',
        link: function (scope, elm, attrs) {
            elm.bind('change', function () {
                $parse(attrs.fileInput).assign(scope, elm[0].files);
                scope.$apply();
            });
        }
    }
}]);

situr.directive('finalizacion', function () {
    return function (scope, element, attrs) {
        if (scope.$last) {
            $(".select2 ").select2({

            });
        }
    };
});

situr.filter('idiomaFilter', function() {
    return function( items, condition) {
    var filtered = [];
    
    if(condition === undefined || condition.length == 0){
      return items;
    }
    console.log(condition);
    angular.forEach(items, function(item) {
        angular.forEach(condition, function(traduccion){
            if(traduccion.idioma.id != item.id){
                filtered.push(item);
            }
        });
    });
    
    return filtered;
    };
});

situr.controller("lisatdo", ["$scope","ServiEquipo", function($scope,ServiEquipo){

$("body").attr("class", "charging");
    ServiEquipo.getListado()
                            .then(function(data){
                                 $("body").attr("class", "cbp-spmenu-push")
                                $scope.equipo = data.equipo;

                            });   
                            
        
      $scope.crearMiembro = function(){
            
            $scope.miembro = {};
            $scope.miembroForm.$setPristine();
            $scope.miembroForm.$setUntouched();
            $scope.miembroForm.$submitted = false;
            $scope.errores = null;
             $('#nombreImagenSlider').val('');
             $scope.imagenSlider = null;
             $('#imagen-slider-crear').attr('src', '');
            $('#modalCrearMiembro').modal('show');
        }

      $scope.editarMiembro = function(obj){
            
            $scope.miembro =  angular.copy(obj);
            $scope.index = $scope.equipo.indexOf(obj);
            $scope.miembroEditForm.$setPristine();
            $scope.miembroEditForm.$setUntouched();
            $scope.miembroEditForm.$submitted = false;
            $scope.errores = null;
             $('#imagenSliderEditar').val('');
             $scope.imagenSlider = null;
             $('#imagen-slider-editar').attr('src', '');
            $('#modalEditarMiembro').modal('show');
        }        
        

     $scope.guardarMiembro = function () {
        if (!$scope.miembroForm.$valid || $scope.miembroForm == null) {
            swal("Error", "Error en el formulario, favor revisar.", "error");
            return;
        }
       
        // check for browser support (may need to be modified)
         if ($scope.imagenSlider != null) {
                var input = $('#imagenSlider');
                if (input[0].files && input[0].files.length == 1) {
                    if (input[0].files[0].size > 2097152) {
                        swal("Error", "Por favor la imagen debe tener un peso menor de " + (2097152 / 1024 / 1024) + " MB", "error");
                        // alert("The file must be less than " + (1572864/ 1024 / 1024) + "MB");
                        return;
                    }
                }
         }
        var fd = new FormData();
        for (nombre in $scope.miembro) {
            if ($scope.miembro[nombre] != null && $scope.miembro[nombre] != "") {
                fd.append(nombre, $scope.miembro[nombre]);
            }
        }
        if ($scope.imagenSlider != null) {
            fd.append("imagenSlider", $scope.imagenSlider[0]);
        }
        $("body").attr("class", "charging");
        ServiEquipo.agregarMiembro(fd).then(function (data) {
            if (data.success) {
                $scope.errores = null;
                $scope.equipo.push(data.miembro);
                swal({
                    title: "Agregado",
                    text: "Se ha agregado satisfactoriamente el miembro.",
                    type: "success",
                    timer: 1000,
                    showConfirmButton: false
                });
                setTimeout(function () {

                    $('#modalCrearMiembro').modal('hide');
                }, 1000);
            } else {
                swal("Error", "Verifique la información y vuelva a intentarlo.", "error");
                $scope.errores = data.errores;
            }
            $("body").attr("class", "cbp-spmenu-push");
        }).catch(function () {
            $("body").attr("class", "cbp-spmenu-push");
            swal("Error", "Error en la carga, por favor recarga la página.", "error");
        })

    }
    
    
         $scope.cambiarEstado = function (obj) {
        swal({
            title: "cambiar estado del miembro del equipo ",
            text: "¿Está seguro que desea cambiar el estado del miembro ?",
            type: "warning",
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        },
        function () {
            $("body").attr("class", "charging");
            ServiEquipo.cambiarEstado(obj).then(function (data) {
                 $("body").attr("class", "cbp-spmenu-push")
                if (data.success) {
                    obj.estado = !obj.estado;
                    swal("Exito", "Se realizó la operación exitosamente", "success");
                } else {
                    swal("Error", "Se ha manipulado la información, intente de nuevo", "error");
                }
            }).catch(function () {
                swal("Error", "Error en la petición, intente de nuevo", "error");
            })

        })


    }
    
    
    
     $scope.guardarEditarMiembro = function () {
        if (!$scope.miembroEditForm.$valid || $scope.miembroEditForm == null) {
            swal("Error", "Error en el formulario, favor revisar.", "error");
            return;
        }
       
        // check for browser support (may need to be modified)
         if ($scope.imagenSliderEditar != null) {
                var input = $('#imagenSliderEditar');
                if (input[0].files && input[0].files.length == 1) {
                    if (input[0].files[0].size > 2097152) {
                        swal("Error", "Por favor la imagen debe tener un peso menor de " + (2097152 / 1024 / 1024) + " MB", "error");
                        // alert("The file must be less than " + (1572864/ 1024 / 1024) + "MB");
                        return;
                    }
                }
         }
        var fd = new FormData();
        for (nombre in $scope.miembro) {
            if ($scope.miembro[nombre] != null && $scope.miembro[nombre] != "") {
                fd.append(nombre, $scope.miembro[nombre]);
            }
        }
        if ($scope.imagenSliderEditar != null) {
            fd.append("imagenSliderEditar", $scope.imagenSliderEditar[0]);
        }
        $("body").attr("class", "charging");
        ServiEquipo.editarMiembro(fd).then(function (data) {
            if (data.success) {
                $scope.errores = null;
                $scope.equipo[$scope.index] = data.miembro;
                swal({
                    title: "Agregado",
                    text: "Se ha editado satisfactoriamente el miembro.",
                    type: "success",
                    timer: 1000,
                    showConfirmButton: false
                });
                setTimeout(function () {

                    $('#modalEditarMiembro').modal('hide');
                }, 1000);
            } else {
                swal("Error", "Verifique la información y vuelva a intentarlo.", "error");
                $scope.errores = data.errores;
            }
            $("body").attr("class", "cbp-spmenu-push");
        }).catch(function () {
            $("body").attr("class", "cbp-spmenu-push");
            swal("Error", "Error en la carga, por favor recarga la página.", "error");
        })

    }
        
    }]);

