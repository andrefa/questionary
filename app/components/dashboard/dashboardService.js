(function() {
    'use strict';

    angular.module('questionary-user-app')
    	   .factory('DashboardService', DashboardService);
    
    DashboardService.$inject = ['$http', '$q'];
    function DashboardService($http, $q) {
		var dashboardService = {
            listAvailableQuestionaries : listAvailableQuestionaries,
            listExecutionHistory : listExecutionHistory,
            createUserQuestionary : createUserQuestionary
        };

        return dashboardService;

        function listAvailableQuestionaries() {
            var def = $q.defer();

            $http.post('rest/dashboard/listAvailableQuestionaries').success(function(data) {
                def.resolve(data);
            }).error(function(response) {
                def.reject(response);
            });

            return def.promise;
        }

        function listExecutionHistory() {
            var def = $q.defer();

            $http.post('rest/dashboard/listExecutionHistory').success(function(data) {
                def.resolve(data);
            }).error(function(response) {
                def.reject(response);
            });

            return def.promise;
        }

        function createUserQuestionary(questionaryId) {
            var def = $q.defer();

            $http.post('rest/dashboard/createUserQuestionary', {questionaryId : questionaryId}).success(function(data) {
                def.resolve(data);
            }).error(function(response) {
                def.reject(response);
            });

            return def.promise;
        }
	}

})();