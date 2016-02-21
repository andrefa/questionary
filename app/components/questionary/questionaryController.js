(function() {
	'use strict';

	angular.module('questionary-user-app')
		   .controller('QuestionaryController', QuestionaryController);

	QuestionaryController.$inject = ['$scope', '$interval', '$state', '$stateParams', 'QuestionaryService'];
	function QuestionaryController($scope, $interval, $state, $stateParams, QuestionaryService) {
		
		var vm = this;
		var updateMillisecondsDelay = 1000;
		var updateTimeSpentPromise;

		vm.userQuestionary;
		vm.saveAndContinue = saveAndContinue;
		vm.saveAndExit = saveAndExit;
		
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
			vm.userQuestionary.secondsSpent = parseInt(vm.userQuestionary.secondsSpent) + 1;
			QuestionaryService.updateTimeSpent(vm.userQuestionary.userQuestionaryId, vm.userQuestionary.secondsSpent);
		}

		function saveAndContinue() {
			QuestionaryService.saveAndCalculateScore(vm.userQuestionary).then(function() {
				$state.go('logged.result', {userQuestionaryId : vm.userQuestionary.userQuestionaryId});
			}, function(){
				// TODO error message
			});
		}

		function saveAndExit() {
			QuestionaryService.save(vm.userQuestionary).then(function() {
				$state.go('logged.dashboard');
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