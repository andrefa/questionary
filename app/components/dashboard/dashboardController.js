(function() {
	'use strict';

	angular.module('questionary-user-app')
		   .controller('DashboardController', DashboardController);

	DashboardController.$inject = ['$state', 'DashboardService'];
	function DashboardController($state, DashboardService) {
		
		var vm = this;

		vm.availableQuestionaries = DashboardService.listAvailableQuestionaries();
		vm.executionHistory = DashboardService.listExecutionHistory();
		vm.createUserQuestionary = createUserQuestionary;

		function createUserQuestionary (questionaryId) {
			DashboardService.createUserQuestionary(questionaryId).then(function(response) {
				$state.go('logged.questionary', {userQuestionaryId : response.userQuestionaryId});
			}, function(error) {
				// TODO error handling
			});
		}

	}
})();