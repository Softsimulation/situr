angular.module('receptor.gasto', ['ui.select'])

.controller('gasto', ['$scope', 'receptorServi', '$window',function ($scope, receptorServi, $window) {

    $scope.encuestaReceptor = {};
    $scope.abrirAlquiler = false;
    $scope.abrirTerrestre = false;
    $scope.abrirRopa = false;
    $scope.$watch('id',function(){
        if($scope.id != null){
             $("body").attr("class", "cbp-spmenu-push charging");
            receptorServi.getInfoGasto($scope.id).then(function(data){
                $scope.divisas = data.divisas;
                $scope.financiadores = data.financiadores;
                $scope.municipios = data.municipios;
                $scope.opciones = data.opciones;
                $scope.servicios = data.servicios;
                $scope.tipos = data.tipos;
                $scope.rubros = data.rubros;
                $scope.encuestaReceptor = data.encuesta;
                
                for(var i = 0; i<$scope.rubros.length;i++){
                    $scope.cambiarAlquiler($scope.rubros[i]);
                }
                
              $("body").attr("class", "cbp-spmenu-push");
            }).catch(function(){
                
              $("body").attr("class", "cbp-spmenu-push");
               swal("Error","Error en la carga de pagina","error"); 
            });
        }
    })
    
    $scope.limpiarGasto = function(){
        if($scope.encuestaReceptor.RealizoGasto == 0){
            var aux = [];
            aux = $scope.encuestaReceptor.Financiadores;
            $scope.encuestaReceptor = {}
            $scope.encuestaReceptor.Financiadores = aux;
            $scope.encuestaReceptor.RealizoGasto = 0;
            for(var i= 0; i<$scope.rubros.length;i++){
                $scope.rubros[i].gastos_visitantes = [];
            }
        }
    }
    
    $scope.limpiarPaquete = function(){
        if($scope.encuestaReceptor.ViajoDepartamento == 0){
            var aux = [];
            aux = $scope.encuestaReceptor.Financiadores;
            $scope.encuestaReceptor = {}
            $scope.encuestaReceptor.Financiadores = aux;
            $scope.encuestaReceptor.RealizoGasto = 1;
            $scope.encuestaReceptor.ViajoDepartamento = 0
        }
    }
    
    $scope.limpiarRubros = function(){
        if($scope.encuestaReceptor.GastosAparte == 0){
            for(var i= 0; i<$scope.rubros.length;i++){
                $scope.rubros[i].gastos_visitantes = [];
            }
        }
    }
    
    $scope.limpiarLocalizacion = function(){
        if($scope.encuestaReceptor.Proveedor != 1 && $scope.encuestaReceptor.LugarAgencia != undefined ){
            $scope.encuestaReceptor.LugarAgencia = undefined;
        }
    }
    
    $scope.limpiarMunicipios = function(){
        if($scope.encuestaReceptor.IncluyoOtros == 0 ){
            $scope.encuestaReceptor.Municipios = [];
        }
    }
    
    $scope.limpiarMatriz = function(){
        
        if($scope.encuestaReceptor.poderLLenar){
           for(var i = 0; i<$scope.rubros.length;i++){
                if($scope.rubros[i].gastos_visitantes[0] != null){
                    $scope.rubros[i].gastos_visitantes[0] = null;
                }
            }
            $scope.abrirTerrestre = false;
            $scope.abrirAlquiler = false;
            $scope.abrirRopa = false;
            
        }
        
        
    }
    
    $scope.cambiarAlquiler = function(rub){
        
        if(rub.gastos_visitantes.length==0){
            return;
        }
        
        if( rub.gastos_visitantes[0].personas_cubiertas != null || rub.gastos_visitantes[0].divisas_magdalena!= null || rub.gastos_visitantes[0].cantidad_pagada_magdalena != null || rub.gastos_visitantes[0].gastos_asumidos_otros != null){
               switch (rub.id) {
                   case 3:
                        $scope.abrirTerrestre = true;
                       break;
                   case 5:
                        $scope.abrirAlquiler = true;
                       break;
                   case 12:
                        $scope.abrirRopa = true;
                       break;
                   default:
                      break;
               }
        }
        
        if($scope.abrirTerrestre){
            if( rub.id ==3 && rub.gastos_visitantes[0].personas_cubiertas == null && rub.gastos_visitantes[0].divisas_magdalena == null && rub.gastos_visitantes[0].cantidad_pagada_magdalena==null && (rub.gastos_visitantes[0].gastos_asumidos_otros==null||rub.gastos_visitantes[0].gastos_asumidos_otros==false)){
                $scope.abrirTerrestre = false;
            }
        }
        if($scope.abrirAlquiler){
            if( rub.id == 5 && rub.gastos_visitantes[0].personas_cubiertas == null && rub.gastos_visitantes[0].divisas_magdalena == null && rub.gastos_visitantes[0].cantidad_pagada_magdalena==null){
                $scope.abrirAlquiler = false;
            }
        }
        if($scope.abrirRopa){
            if( rub.id == 12 && rub.gastos_visitantes[0].personas_cubiertas == null && rub.gastos_visitantes[0].divisas_magdalena == null && rub.gastos_visitantes[0].cantidad_pagada_magdalena==null){
                $scope.abrirRopa = false;
            }
        }
        
    }
    
    $scope.verificarOtro = function () {
        
        var i = $scope.encuestaReceptor.Financiadores.indexOf(11)
        if ($scope.encuestaReceptor.Otro != null && $scope.encuestaReceptor.Otro != '') {
            if (i == -1) {
                $scope.encuestaReceptor.Financiadores.push(11);
                $scope.bandera = true;
            }
        } else {
            if (i != -1) {
                $scope.encuestaReceptor.Financiadores.splice(i, 1);
                $scope.bandera = false;
            }
        }
    }
    
    $scope.guardar = function(){
        
        if(!$scope.GastoForm.$valid){
            swal("Error","Corrija los errores","error");
            return ;
        }
        if($scope.encuestaReceptor.ViajoDepartamento ==1){
            
            if($scope.encuestaReceptor.ServiciosIncluidos.length==0){
                return;   
            }
        }
        
        $scope.encuestaReceptor.Rubros = [];
        for(var i = 0 ;i<$scope.rubros.length;i++){
            if($scope.rubros[i].gastos_visitantes.length>0){
                if($scope.rubros[i].gastos_visitantes[0] != null){
                    if((($scope.rubros[i].gastos_visitantes[0].cantidad_pagada_magdalena != null && $scope.rubros[i].gastos_visitantes[0].divisas_magdalena != null) && $scope.rubros[i].gastos_visitantes[0].personas_cubiertas != null)|| $scope.rubros[i].gastos_visitantes[0].gastos_asumidos_otros != undefined  ){
                        $scope.encuestaReceptor.Rubros.push($scope.rubros[i]);
                    }
                }
                
            }
        }
        $scope.encuestaReceptor.id = $scope.id;
         $("body").attr("class", "cbp-spmenu-push charging");
         receptorServi.postGuardarGasto($scope.encuestaReceptor).then(function(data){
              $("body").attr("class", "cbp-spmenu-push");
             if(data.success){
                   swal({
                     title: "Realizado",
                     text: "Se ha guardado satisfactoriamente la sección.",
                     type: "success",
                     timer: 1000,
                     showConfirmButton: false
                   });
                  setTimeout(function () {
                      window.location.href = "/turismoreceptor/seccionpercepcionviaje/" + $scope.id;
                    }, 1000);
             }else{
                 $scope.errores = data.errores;
                 swal("Error","Corrija los errores","error");
             }
             
         }).catch(function(){
              $("body").attr("class", "cbp-spmenu-push");
             swal("Error","Error en la petición","error");
         })
        
    }
}])

