(function(){

    angular.module("appMuestraMaestra", [ 'ngSanitize', 'ui.select', 'checklist-model', "ADM-dateTimePicker",  "serviciosMuestraMaestra", "ngMap" ] )
    
    .config(["ADMdtpProvider", function(ADMdtpProvider) {
         ADMdtpProvider.setOptions({ calType: "gregorian", format: "YYYY/MM/DD", default: "today" });
    }])
    
    .controller("MuestraMaestraCtrl", ["$scope","ServiMuestra", "NgMap", function($scope,ServiMuestra,NgMap){
        
        $scope.zonas = [ 
                          {
                            id : 1,
                            pos1: 11.521288265308348, 
                            pos2: -74.33892893603422,
                            pos3: 10.821934079756392,
                            pos4: -73.15430450251677, 
                            nombre: "Zona 1"
                          },
                          {
                            id : 2,
                            pos1: 10.648006432989229, //getNorthEast().lat()
                            pos2: -74.38562083056547, //getSouthWest().lng()
                            pos3: 9.881692570632636, //getSouthWest().lat()
                            pos4: -72.94007110407927, //getNorthEast().lng()
                            nombre: "Zona 2"
                          }  
                        ];
       
           
        ServiMuestra.getData()
           .then(function(data){ 
                $scope.zonas = data.zonas; 
                $scope.proveedores = data.proveedores; 
            });
             
        
        
        $scope.agregarZona = function(){
            
            if(!$scope.nombreZona){ return; }
            
            $scope.zonas.push({
                            pos1: $scope.map.getCenter().lat(), 
                            pos2: $scope.map.getCenter().lng(),
                            pos3: $scope.map.getCenter().lat() + ( $scope.map.getZoom() > 10 ? 0.01 : 0.5 ),
                            pos4: $scope.map.getCenter().lng() + ( $scope.map.getZoom() > 10 ? 0.01 : 0.5 ),
                            nombre: $scope.nombreZona,
                          });
            $scope.nombreZona = null;
        }
      
        $scope.verDetalleZona = function(zona){
          alert("ok");  
        }
        
        
        $scope.boundsChanged = function() {
           
            if(this.getBounds()){
                $scope.zonas[this.index].tex1 = this.getBounds().getNorthEast().lat();
                $scope.zonas[this.index].tex2 = this.getBounds().getSouthWest().lng();
            }
            //  console.log( $scope.map.getCenter().lat() +"  "+ $scope.map.getCenter().lng() );
              //console.log(this.getBounds().getNorthEast().lat()  +"  "+  this.getBounds().getSouthWest().lng());
              //console.log(this.getBounds().getSouthWest().lat()  +"  "+  this.getBounds().getNorthEast().lng());
        
        };
        
        
        $scope.validarZonas = function(){
          
        }
        
        NgMap.getMap().then(function(map) { $scope.map = map;  });

    }])
     
}());