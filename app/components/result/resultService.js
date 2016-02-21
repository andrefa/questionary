(function() {
    'use strict';

    angular.module('questionary-user-app')
    	   .factory('ResultService', ResultService);
    
    ResultService.$inject = ['$http', '$q'];
    function ResultService($http, $q) {
		var resultService = {
            findUserQuestionaryResult : findUserQuestionaryResult
		};

  		return resultService;

        function findUserQuestionaryResult(userQuestionaryId) {
            var def = $q.defer();

            $http.post('rest/result/findUserQuestionaryResult', {userQuestionaryId : userQuestionaryId}).success(function(data) {
                def.resolve(data);
            }).error(function(response) {
                def.reject(response);
            });

            return def.promise;
        }
	}

})();