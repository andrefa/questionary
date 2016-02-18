(function() {
	'use strict';

	angular.module('questionary-user-app')
		   .controller('DashboardController', DashboardController);

	DashboardController.$inject = ['$state', 'DashboardService', 'UserService'];
	function DashboardController($state, DashboardService, UserService) {
		
		var vm = this;

		//vm.availableQuestionaries = DashboardService.listAvailableQuestionaries();
		//vm.executionHistory = DashboardService.listExecutionHistory();
		vm.createUserQuestionary = createUserQuestionary;
		vm.logoff = logoff;

		function createUserQuestionary (questionaryId) {
			DashboardService.createUserQuestionary(questionaryId).then(function(response) {
				$state.go('logged.questionary', {userQuestionaryId : response.userQuestionaryId});
			}, function(error) {
				// TODO error handling
			});
		}

		function logoff () {
			UserService.logoff().then(function() {
				$state.go('unlogged.login');
			});
		}

	}
})();