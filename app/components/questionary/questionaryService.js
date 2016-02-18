(function() {
    'use strict';

    angular.module('questionary-user-app')
    	   .factory('QuestionaryService', QuestionaryService);
    
    QuestionaryService.$inject = ['$http', '$q'];
    function QuestionaryService($http, $q) {
		var questionaryService = {
            findUserQuestionary : findUserQuestionary,
			updateTimeSpent: updateTimeSpent,
            saveUserQuestionary : saveUserQuestionary
		};

  		return questionaryService;

        function findUserQuestionary(userQuestionaryId) {
            var def = $q.defer();

            $http.post('rest/questionary/findUserQuestionary', {userQuestionaryId : userQuestionaryId}).success(function(data) {
                def.resolve(data);
            }).error(function(response) {
                def.reject(response);
            });

            return def.promise;
        }

        function updateTimeSpent(userQuestionaryId, secondsSpent) {
            $http.post('rest/questionary/updateTimeSpent',{userQuestionaryId : userQuestionaryId, 
                                                           secondsSpent : secondsSpent});
        }

        function saveUserQuestionary(userQuestionary) {
            var def = $q.defer();

            $http.post('rest/questionary/saveUserQuestionary', userQuestionary).success(function(data) {
                def.resolve(data);
            }).error(function(response) {
                def.reject(response);
            });

            return def.promise;
        }
	}

})();