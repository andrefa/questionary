(function() {
    'use strict';

    angular.module('questionary-user-app', ['ui.bootstrap', 
    										'ui.router'])
    	   .run(RunConfig);

    RunConfig.$inject = ['$rootScope', '$state', 'UserService'];
	function RunConfig($rootScope, $state, UserService) {
		$rootScope.$on('$stateChangeStart', function(event, toState, toParams, fromState, fromParams) {
			var isAuthenticationRequired =  toState.data && toState.data.requiresLogin;
			if(isAuthenticationRequired) {
				UserService.isUserLogged().then(function(isUserLogged){
					if (!isUserLogged) {
						event.preventDefault();
						$state.go('unlogged.login');
					}
				})
			}
	  	});
	}	
})();