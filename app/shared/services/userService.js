(function() {
    'use strict';

    angular.module('questionary-user-app')
    	   .factory('UserService', UserService);
    
    UserService.$inject = ['$http'];
    function UserService($http) {
		var userService = {
			isUserLogged: function() {
				var promise = $http.get('rest/user/isUserLogged').then(function (response) {
					return response.data.isUserLogged;
				});
				return promise;
			}
		};
  		return userService;
	}

})();