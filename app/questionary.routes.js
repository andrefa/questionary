(function() {
    'use strict';

    angular.module('questionary-user-app')
           .config(UiRouterConfig);
		
	UiRouterConfig.$inject = ['$stateProvider', '$urlRouterProvider'];
	function UiRouterConfig($stateProvider, $urlRouterProvider) {

		$urlRouterProvider.otherwise('dashboard');
	
		$stateProvider
			.state('logged',{
				abstract : true,
				views : {
                    'main@': {
                        templateUrl: 'app/shared/logged/loggedTemplate.html',
                        controller : 'LoggedHeaderController',
                        controllerAs : 'loggedHeaderCtrl',
                    },
    				'header@logged': {
    					templateUrl: 'app/shared/logged/loggedHeader.html'
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
                        controller : 'DashboardController',
                        controllerAs : 'dashboardCtrl',
                        templateUrl: 'app/components/dashboard/dashboard.html'
                    }
    			}
    		})
    		.state('logged.questionary',{
    			url : '/questionary/{userQuestionaryId:int}',
    			views : {
                    'content@logged': {
                        controller : 'QuestionaryController',
                        controllerAs : 'questionaryCtrl',
                        templateUrl: 'app/components/questionary/questionary.html'
                    }
                }
    		})
    		.state('logged.result',{
    			url : '/result/{userQuestionaryId:int}',
    			views : {
                    'content@logged': {
                        controller : 'ResultController',
                        controllerAs : 'resultCtrl',
                        templateUrl: 'app/components/result/result.html'
                    }
    			}
    		})

            .state('unlogged',{
                abstract : true,
                views : {
                    'main@': {
                        templateUrl: 'app/shared/unlogged/unloggedTemplate.html'
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
                    authenticated: redirToLoggedArea
                }

            });

        redirToLoggedArea.$inject = ['$q', 'UserService', '$state']
        function redirToLoggedArea($q, UserService, $state) {
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
        }

	}
})();