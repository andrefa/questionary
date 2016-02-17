(function() {
    'use strict';

    angular.module('questionary-user-app')
    	   .factory('UserService', UserService);
    
    UserService.$inject = ['$http'];
    function UserService($http) {
		var userService = {
			isUserLogged: function() {
				var promise = $http.get('rest/isUserLogged').then(function (response) {
					return response.data.isUserLogged;
				});
				return promise;
			}, 
			logUser: function(login, password) {
				var promise = $http.get('rest/login',{login : login, password : password}).then(function (response) {
					return response.data;
				});
				return promise;
			}
		};
  		return userService;
	}

})();