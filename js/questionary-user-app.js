(function() {
    'use strict';

    angular.module('questionary-user-app', ['ui.bootstrap', 
    										'ui.router'])

    	   .controller('mainController', mainController);

    function mainController() {
    	console.log('main controller!');
    }
})();