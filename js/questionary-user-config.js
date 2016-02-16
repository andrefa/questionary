(function() {
    'use strict';

    angular.module('questionary-user-app')
    	   .config(UiRouterConfig)
    	   .run(RunConfig);
    
    UiRouterConfig.$inject = ['$stateProvider', '$urlRouterProvider'];
    function UiRouterConfig($stateProvider, $urlRouterProvider) {

    	$urlRouterProvider.otherwise('/home');
    
    	$stateProvider
			.state('some',{
				url : '/some',
				template : '<div>some</div>',
				data : {requiresLogin : true },
			})
			.state('login',{
				url : '/login',
				templateUrl : 'tpl.login.html',
				controller : 'UserCtrl',
			})
    }

    RunConfig.$inject = ['$rootScope', '$state', 'User'];
	function RunConfig($rootScope, $state, User) {
		$rootScope.$on('$stateChangeStart', function(event, toState, toParams, fromState, fromParams) {
			var isAuthenticationRequired =  toState.data && toState.data.requiresLogin && !User.isLoggedIn;
			if(isAuthenticationRequired) {
				event.preventDefault();
				$state.go('login');
			}
	  	});
	}	
})();