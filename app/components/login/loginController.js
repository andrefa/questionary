(function() {
	'use strict';

	angular.module('questionary-user-app')
		   .controller('LoginController', LoginController);

	LoginController.$inject = ['$state', 'LoginService'];
	function LoginController($state, LoginService) {
		
		var vm = this;
		vm.alerts = [];

		vm.doLogin = function() {
			vm.alerts = [];
			LoginService.logUser(vm.login, vm.password).then(function(loginSuccess) {
				if (loginSuccess) {
					$state.go('logged.dashboard');
				} else {
					vm.alerts.push({ type: 'danger', msg: 'Oops..! Login ou senha inválidos.'});
				}
			});
		}
		
		vm.closeAlert = function(index) {
			vm.alerts.splice(index, 1);
		};

	}
})();