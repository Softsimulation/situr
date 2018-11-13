var app = angular.module("visitanteService", []);

app.factory("visitanteServi", ["$http", "$q", function ($http, $q) {

    return {
        CargarFavoritos: function () {
            var defered = $q.defer();
            var promise = defered.promise;

            $http.get('/visitante/favoritos').success(function (data) {
                defered.resolve(data);
            }).error(function (err) {
                defered.reject(err);
            })
            return promise;
        },
    }
}]);