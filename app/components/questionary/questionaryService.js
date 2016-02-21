(function() {
    'use strict';

    angular.module('questionary-user-app')
    	   .factory('QuestionaryService', QuestionaryService);
    
    QuestionaryService.$inject = ['$http', '$q'];
    function QuestionaryService($http, $q) {
		var questionaryService = {
            findUserQuestionary : findUserQuestionary,
			updateTimeSpent: updateTimeSpent,
            saveAndCalculateScore : saveAndCalculateScore,
            save : save
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

        function saveAndCalculateScore(userQuestionary) {
            var def = $q.defer();

            $http.post('rest/questionary/saveAndCalculateScore', userQuestionary).success(function(data) {
                def.resolve(data);
            }).error(function(response) {
                def.reject(response);
            });

            return def.promise;
        }

        function save(userQuestionary) {
            var def = $q.defer();

            $http.post('rest/questionary/save', userQuestionary).success(function(data) {
                def.resolve(data);
            }).error(function(response) {
                def.reject(response);
            });

            return def.promise;
        }
	}

})();