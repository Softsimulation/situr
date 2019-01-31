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
    agregarMiembro: function (data) {
        var defered = $q.defer();
        var promise = defered.promise;
    
        $http.post('/equiposituradmin/guardarmiembro', data, {
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
    editarMiembro: function (data) {
        var defered = $q.defer();
        var promise = defered.promise;
    
        $http.post('/equiposituradmin/editarmiembro', data, {
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
    cambiarEstado: function (model) {
            var defered = $q.defer();
            var promise = defered.promise;

            $http.post('/equiposituradmin/cambiarestadomiembro',model)
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