(function() {
	'use strict';

	angular.module('questionary-user-app')
		   .controller('LoggedHeaderController', LoggedHeaderController);

	LoggedHeaderController.$inject = ['$state', 'UserService'];
	function LoggedHeaderController($state, UserService) {
		
		var vm = this;
		vm.logoff = logoff;

		function logoff () {
			UserService.logoff().then(function() {
				$state.go('unlogged.login');
			});
		}

	}
})();