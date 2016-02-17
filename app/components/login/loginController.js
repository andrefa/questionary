(function() {
	'use strict';

	angular.module('questionary-user-app')
		   .controller('LoginController', LoginController);

	LoginController.$inject = ['$state', 'LoginService'];
	function LoginController($state, LoginService) {
		
		var vm = this;
		vm.alerts = [];

		vm.doLogin = function() {
			LoginService.logUser(vm.login, vm.password).then(function() {
				$state.go('logged.dashboard');
			}, function(){
				vm.alerts.push({ type: 'danger', msg: 'Oops..! Login ou senha inválidos.'});
			});
		}
		
		vm.closeAlert = function(index) {
			vm.alerts.splice(index, 1);
		};

	}
})();