(function() {
	'use strict';

	angular.module('questionary-user-app')
		   .controller('ResultController', ResultController);

	ResultController.$inject = ['$stateParams', '$uibModal','ResultService'];
	function ResultController($stateParams, $uibModal, ResultService) {
		
		var vm = this;
		vm.userQuestionaryResult;
		vm.openQuestionModal = openQuestionModal;
		
		init();

		function init() {
			ResultService.findUserQuestionaryResult($stateParams.userQuestionaryId).then(function(userQuestionaryResult){
				vm.userQuestionaryResult = userQuestionaryResult;
			});
		}

		function openQuestionModal(question) {
			console.log(question.questionDescription);
			var modalInstance = $uibModal.open({
				templateUrl: 'app/shared/modal/modalTemplate.html',
				controller : 'ModalController',
				controllerAs : 'modalCtrl',
				resolve: {
					title: function () {
						return "Questão";
					},
					content: function () {
						return question.questionDescription;
					}
				}
    		});
		};

	}
})();