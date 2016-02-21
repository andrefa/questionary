(function() {
	'use strict';

	angular.module('questionary-user-app')
		   .controller('DashboardController', DashboardController);

	DashboardController.$inject = ['$state', 'DashboardService'];
	function DashboardController($state, DashboardService) {
		
		var vm = this;

		vm.availableQuestionaries;
		vm.executionHistory;
		vm.createUserQuestionary = createUserQuestionary;

		init();

		function init() {
			DashboardService.listAvailableQuestionaries().then(function(availableQuestionaries){
				vm.availableQuestionaries = availableQuestionaries;
			});

			DashboardService.listExecutionHistory().then(function(executionHistory){
				vm.executionHistory = executionHistory;
			});
		}

		function createUserQuestionary (questionaryId) {
			DashboardService.createUserQuestionary(questionaryId).then(function(response) {
				$state.go('logged.questionary', {userQuestionaryId : response.userQuestionaryId});
			}, function(error) {
				// TODO error handling
			});
		}

	}
})();