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
            $('#modalCrearMiembro').modal('show');
        }
        
      $scope.cambiarEstado = function (obj) {
        swal({
            title: "cambiar estado publicación ",
            text: "¿Está seguro que desea cambiar el estado de la publicación ?",
            type: "warning",
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        },
        function () {
            $("body").attr("class", "charging");
            ServiPublicacion.cambiarEstadoPublicacion(obj).then(function (data) {
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
    
     $scope.cambiarEstadoPublicacion = function (item) {
        $scope.estado = angular.copy(item);
        $scope.indexitem = $scope.publicaciones.indexOf(item);
        $scope.cambiarForm.$setPristine();
        $scope.cambiarForm.$setUntouched();
        $scope.cambiarForm.$submitted = false;
       $scope.erroresEstado = null;
        $('#modalCambiarEstado').modal('show');
    }
    
     $scope.cambioEstado = function () {
         if (!$scope.cambiarForm.$valid) {
            return;
        }
       $scope.erroresEstado = null;
         $("body").attr("class", "charging");
        ServiPublicacion.EstadoPublicacion($scope.estado).then(function (data) {
             $("body").attr("class", "cbp-spmenu-push")
            if (data.success) {
               $scope.errores = null;
                $scope.publicaciones[$scope.indexitem] = data.publicacion;
                swal({
                    type: "success",
                    title: "Realizado",
                    text: "Se ha agregado satisfactoriamente la agenda.",
                    timer: 2000,
                    showConfirmButton: false
                });
                $('#modalCambiarEstado').modal('hide');
            } else {
               $scope.erroresEstado  = data.errores;
                swal("Error", "Verifique la información y vuelva a intentarlo.", "error");
            }
            $('#processing').removeClass('process-in');
        }).catch(function () {
            $('#processing').removeClass('process-in');
            swal("Error", "Error en la carga, por favor recarga la página.", "error");
        })
      
          }
    
     $scope.eliminar = function (obj) {
        swal({
            title: "Eliminar publicación ",
            text: "¿Está seguro que desea eliminar la publicación ?",
            type: "warning",
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        },
        function () {
             $("body").attr("class", "charging");
            ServiPublicacion.eliminarPublicacion(obj).then(function (data) {
                $("body").attr("class", "cbp-spmenu-push")
                if (data.success) {
                    $scope.publicaciones.splice($scope.publicaciones.indexOf(obj),1)
                    swal("Exito", "Se realizó la operación exitosamente", "success");
                } else {
                    swal("Error", "Se ha manipulado la información, intente de nuevo", "error");
                }
            }).catch(function () {
                swal("Error", "Error en la petición, intente de nuevo", "error");
            })

        })


    }
        
        
    }]);

