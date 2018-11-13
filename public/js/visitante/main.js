angular.module('visitanteApp', ["visitanteService","ADM-dateTimePicker","ui.select"])

.directive('fileInput', ['$parse', function ($parse) {

    return {
        restrict: 'A',
        link: function (scope, elm, attrs) {
            elm.bind('change', function () {
                $parse(attrs.fileInput).assign(scope, elm[0].files);
                scope.$apply();
            })

        }

    }

}])

.controller('misFavoritosCtrl', ['$scope', 'visitanteServi',function ($scope, visitanteServi) {
   
    $scope.planificadores = [];
    $scope.listaPlanificadores = [];
    $scope.favoritos = [];
    $scope.intrucciones = { ver: true };
    var hoy = new Date();
    var dia = hoy.getDate() > 10 ? hoy.getDate() : '0' + hoy.getDate();
    var mes = (hoy.getMonth() + 1) > 10 ? hoy.getMonth() + 1 : '0' + (hoy.getMonth() + 1);
   
    $("body").attr("class", "charging");
    visitanteServi.CargarFavoritos().then(function(data) {
       $scope.favoritos = data.favoritos;
       $("body").attr("class", "cbp-spmenu-push");
    }).catch(function() {
       $("body").attr("class", "cbp-spmenu-push");
       swal("Error", "Error en la carga, por favor recarga la página.", "error");
    })
    
    
   
}])