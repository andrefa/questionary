(function() {
	'use strict';

	angular.module('questionary-user-app')
		   .controller('QuestionaryController', QuestionaryController);

	QuestionaryController.$inject = ['$interval', '$state', '$stateParams', 'QuestionaryService'];
	function QuestionaryController($interval, $state, $stateParams, QuestionaryService) {
		
		var vm = this;
		var updateMillisecondsDelay = 1000;
		var updateTimeSpentPromise;

		vm.userQuestionary;
		vm.saveUserQuestionary = saveUserQuestionary;
		
		init();

		function init() {
			QuestionaryService.findUserQuestionary($stateParams.userQuestionaryId).then(function(userQuestionary){
				vm.userQuestionary = userQuestionary;
				initUpdateTimeSpentPromise();
			});
		}

		function initUpdateTimeSpentPromise() {
			updateTimeSpentPromise = $interval(updateTimeSpent, updateMillisecondsDelay);
		}

		function updateTimeSpent() {
			vm.userQuestionary.secondsSpent += 1;
			QuestionaryService.updateTimeSpent(vm.userQuestionary.userQuestionaryId, vm.userQuestionary.secondsSpent);
		}

		function saveUserQuestionary() {
			QuestionaryService.saveUserQuestionary(vm.userQuestionary).then(function() {
				$state.go('logged.result', {userQuestionaryId : vm.userQuestionary.userQuestionaryId});
			}, function(){
				// TODO error message
			});
		}

		$scope.$on('$destroy', function() {
			if (updateTimeSpentPromise) {
				$interval.cancel(updateTimeSpentPromise);
			}
		});

	}
})();