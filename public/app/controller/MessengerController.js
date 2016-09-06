var app = angular.module("internal");

app.controller("MessengerController", function($scope, $http, $location, msgService) {

	$scope.conversations;

	$scope.getConversations = function() {
		msgService.getConversations().then(function(response) {
			$scope.conversations = response;
			console.log($scope.conversations);
		});
	};

	$scope.getConversations();


	// position textarea at page bottom
	angular.element(document).ready(function () {
		let sidebar_height = $('#messenger_sidebar').height();
		let input_height = $('.message_input').height();
		let message_wrapper_height = sidebar_height - input_height - 120;

		$('.message_wrapper').css('height', message_wrapper_height);
		console.log($('#messenger_sidebar').height());
    });

});