(function() {
	'use strict';

	angular.module('questionary-user-app')
		   .controller('ModalController', ModalController);

	ModalController.$inject = ['$uibModalInstance', 'title', 'content'];
	function ModalController($uibModalInstance, title, content) {
		
		var vm = this;
		vm.title = title;
		vm.content = content;
		vm.ok = ok;
		
		function ok() {
			$uibModalInstance.close();
		};

	}
})();