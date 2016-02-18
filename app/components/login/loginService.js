(function() {
    'use strict';

    angular.module('questionary-user-app')
    	   .factory('LoginService', LoginService);
    
    LoginService.$inject = ['$http', '$q'];
    function LoginService($http, $q) {
		var loginService = {
			logUser: logUser
		};

  		return loginService;

        function logUser(login, password) {
            var def = $q.defer();

            $http.post('rest/user/login',{login : login, password : password}).success(function(data) {
                def.resolve(data.isUserLogged);
            }).error(function(response) {
                def.reject(response);
            });

            return def.promise;
        }
	}

})();