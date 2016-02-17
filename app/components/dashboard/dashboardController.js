(function() {
	'use strict';

	angular.module('questionary-user-app')
		   .controller('DashboardController', DashboardController);

	DashboardController.$inject = ['DashboardService'];
	function DashboardController(DashboardService) {
		
		var vm = this;
		vm.alerts = [];

		vm.closeAlert = function(index) {
			vm.alerts.splice(index, 1);
		};

	}
})();