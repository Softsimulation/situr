angular.module('proveedoresoferta', ["checklist-model","proveedorServices",'angularUtils.directives.dirPagination'])

.controller('listado', ['$scope', 'proveedorServi',function ($scope, proveedorServi) {
   
     $("body").attr("class", "cbp-spmenu-push charging");
        
    proveedorServi.CargarListado().then(function(data){
                                 $("body").attr("class", "cbp-spmenu-push");
                                $scope.proveedores = data.proveedores;
                               
                }).catch(function () {
            $("body").attr("class", "cbp-spmenu-push");
            swal("Error", "No se realizo la solicitud, reinicie la página");
        });   
   

   
}])

.controller('listadoecuesta', ['$scope', 'proveedorServi',function ($scope, proveedorServi) {
   
        
    $scope.$watch('id', function () {
        $("body").attr("class", "cbp-spmenu-push charging");
        
        proveedorServi.getEncuestas($scope.id).then(function (data) {
            $("body").attr("class", "cbp-spmenu-push");
            $scope.encuestas = data.encuestas;
            $scope.ruta = data.ruta;
        }).catch(function () {
            $("body").attr("class", "cbp-spmenu-push");
            swal("Error", "No se realizo la solicitud, reinicie la página");
        })
    })
   

   
}])

.controller('activarController', ['$scope', 'proveedorServi',function ($scope, proveedorServi) {
   
        
    $scope.$watch('id', function () {
        $("body").attr("class", "cbp-spmenu-push charging");
        
        proveedorServi.getProveedor($scope.id).then(function (data) {
            $("body").attr("class", "cbp-spmenu-push");
            if(data.establecimiento != null){
                $scope.establecimiento = data.establecimiento;
                $scope.establecimiento.extension = +$scope.establecimiento.extension
            }else{
                $scope.establecimiento = {};
                $scope.establecimiento.proveedor_rnt_id = $scope.id;
            }
        }).catch(function () {
            $("body").attr("class", "cbp-spmenu-push");
            swal("Error", "No se realizo la solicitud, reinicie la página");
        })
    })
   
    $scope.guardar = function(){
              if (!$scope.indentificacionForm.$valid) {
            swal("Error", "Formulario incompleto corrige los errores", "error")
            return
        }

        $("body").attr("class", "cbp-spmenu-push charging")
        proveedorServi.Activar($scope.establecimiento).then(function (data) {
        $("body").attr("class", "cbp-spmenu-push");
           if (data.success == true) {
                    swal({
                        title: "Realizado",
                        text: "Se ha completado satisfactoriamente la sección.",
                        type: "success",
                        timer: 1000,
                        showConfirmButton: false
                    });
                    setTimeout(function () {
                        window.location.href = "/ofertaempleo/listadoproveedores";
                    }, 1000);
                } else {
                   
                    $scope.errores = data.errores;
                    swal("Error", "Error en la carga, por favor recarga la pagina", "error")

                }
            }).catch(function () {
                $("body").attr("class", "cbp-spmenu-push");
                swal("Error", "No se realizo la solicitud, reinicie la página");
            })
        
    }

   
}])

.controller('listadoRnt', ['$scope', 'proveedorServi',function ($scope, proveedorServi) {
   
     $("body").attr("class", "cbp-spmenu-push charging");
        
    proveedorServi.CargarListadoRnt().then(function(data){
                                 $("body").attr("class", "cbp-spmenu-push");
                                $scope.proveedores = data.proveedores;
                               
                }).catch(function () {
            $("body").attr("class", "cbp-spmenu-push");
            swal("Error", "No se realizo la solicitud, reinicie la página");
        });   
   

   
}])