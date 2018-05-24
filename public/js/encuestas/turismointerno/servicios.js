var app = angular.module("situr.gastosServices", []);

app.factory("serviInterno", ["$http", "$q", function ($http, $q) {

    return {

        getDataGastos: function (id) {
            var defered = $q.defer();
            var promise = defered.promise;

            $http.post('/turismointerno/datagastos', { id: id }).success(function (data) {
                defered.resolve(data);
            }).error(function (err) {
                defered.reject(err);
            })
            return promise;
        },
        guardarGastos: function (data) {
            var defered = $q.defer();
            var promise = defered.promise;

            $http.post('/turismointerno/guardargastos', data ).success(function (data) {
                defered.resolve(data);
            }).error(function (err) {
                defered.reject(err);
            })
            return promise;
        },

    }

}]);