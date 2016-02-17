(function() {
    'use strict';

    angular.module('questionary-user-app')
           .config(UiRouterConfig);
		
	UiRouterConfig.$inject = ['$stateProvider', '$urlRouterProvider'];
	function UiRouterConfig($stateProvider, $urlRouterProvider) {

		$urlRouterProvider.otherwise('login');
	
		$stateProvider
			.state('logged',{
				abstract : true,
				views : {
                    'main@': {
                        templateUrl: 'app/shared/logged/template.html'
                    },
    				'header@logged': {
    					templateUrl: 'app/shared/logged/header.html'
    				},
					'footer@logged': {
						templateUrl: 'app/shared/partials/footer.html'
					}
				},
                data : {requiresLogin : true }
    		})
    		.state('logged.dashboard',{
    			url : '/dashboard',
    			views : {
                    'content@logged': {
                        template: '<h1>content do dashboard</h1>'
                    }
    			}
    		})
    		.state('logged.questionary',{
    			url : '/questionary',
    			views : {
                    'content@logged': {
                        template: 'content do questionary'
                    }
                }
    		})
    		.state('logged.result',{
    			url : '/result',
    			views : {
                    'content@logged': {
                        template: 'content do result'
                    }
    			}
    		})

            .state('unlogged',{
                abstract : true,
                views : {
                    'main@': {
                        templateUrl: 'app/shared/unlogged/template.html'
                    },
                    'header@unlogged': {
                        templateUrl: 'app/shared/unlogged/header.html'
                    },
                    'footer@unlogged': {
                        templateUrl: 'app/shared/partials/footer.html'
                    }
                }
            })
            .state('unlogged.login',{
                url : '/login',
                views : {
                    'content@unlogged': {
                        controller : 'LoginController',
                        controllerAs : 'loginCtrl',
                        templateUrl: 'app/components/login/login.html'
                    }
                },
                resolve : {
                    authenticated: ['$q', 'UserService', '$state', function ($q, UserService, $state) {
                        var deferred = $q.defer();
                        UserService.isUserLogged().then(function (loggedIn) {
                            if (loggedIn) {
                                $state.go('logged.dashboard');
                                deferred.reject();
                            } else {
                                deferred.resolve();
                            }
                        });

                        return deferred.promise;
                    }]
                }





            });
	}
})();