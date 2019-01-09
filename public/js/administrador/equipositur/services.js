(function(){
 
    angular.module("equipoSiturServices",[])

    .factory('ServiEquipo', ['$http', '$q', function($http,$q) {
      
      
      var http = {
          
            post: function (url,data) { return this.peticion("POST",url,data); },
             
            get: function(url){ return this.peticion("GET",url,null); },
            
            peticion: function(metodo, url, data){
                var defered = $q.defer();
                var promise = defered.promise;
                $http({  method : metodo,  url : url,  data : data })
                .success(function (data) {  defered.resolve(data); })
                .error(function(err){  });  
                return promise; 
            } 
      };
      
      return {
  
     getListado: function(){ return http.get("/equiposituradmin/equipositur");  },
     editarPublicacion: function (data) {
                var defered = $q.defer();
                var promise = defered.promise;

                $http.post('/publicaciones/editPublicacion', data, {
                    transformRequest: angular.identity,
                    headers: {
                        'Content-Type': undefined
                    }
                }).success(function (data) {
                    defered.resolve(data);
                }).error(function (err) {
                    defered.reject(err);
                })
                return promise;
            },
     cambiarEstadoPublicacion: function (model) {
            var defered = $q.defer();
            var promise = defered.promise;

            $http.post('/publicaciones/cambiarEstadoPublicacion',model)
            .success(function (data) {
                defered.resolve(data);
            }).error(function (err) {
                defered.reject(err);
            })
            return promise;
        },
     eliminarPublicacion: function (model) {
                var defered = $q.defer();
                var promise = defered.promise;
    
                $http.post('/publicaciones/eliminarPublicacion',model)
                .success(function (data) {
                    defered.resolve(data);
                }).error(function (err) {
                    defered.reject(err);
                })
                return promise;
            },
     EstadoPublicacion: function (model) {
            var defered = $q.defer();
            var promise = defered.promise;

            $http.post('/publicaciones/EstadoPublicacion',model)
            .success(function (data) {
                defered.resolve(data);
            }).error(function (err) {
                defered.reject(err);
            })
            return promise;
        },
          
      };
      
      
    }]);
    
}())