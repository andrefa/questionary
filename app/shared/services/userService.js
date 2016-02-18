(function() {
    'use strict';

    angular.module('questionary-user-app')
    	   .factory('UserService', UserService);
    
    UserService.$inject = ['$http'];
    function UserService($http) {
		var userService = {
			isUserLogged: isUserLogged,
			logoff: logoff
		};

  		return userService;

  		function isUserLogged() {
			var promise = $http.get('rest/user/isUserLogged').then(function (response) {
				return response.data.isUserLogged;
			});
			return promise;
		}

		function logoff() {
			var promise = $http.get('rest/user/logoff').then(function (response) {
				return response;
			});
			return promise;
		}
	}

})();