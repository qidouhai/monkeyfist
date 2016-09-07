var app = angular.module("internal");

app.controller("MessengerController", function($scope, $routeParams, msgService) {

	$scope.conversations;
	$scope.conversationId;
	$scope.messages;

	$scope.getConversations = function() {
		msgService.getConversations().then(function(response) {
			$scope.conversations = response;
			console.log($scope.conversations);
		});
	};

	$scope.getMessages = function(conversationId) {
		msgService.getMessages(conversationId).then(function(response) {
			if(response.exists && response.member)
				$scope.messages = response.messages;
			$scope.conversationId = conversationId;
			console.log($scope.messages);
		});
	};

	$scope.submitMessage = function() {
		msgService.sendMessage({conversation_id: $scope.conversationId, body: $('#message_input_field').val()}).then(function(response) {
			console.log(response);
		});
	};

	$scope.getConversations();
	// check if a conversation is selected
	if($routeParams.conversationId)
		$scope.getMessages($routeParams.conversationId);


	// position textarea at page bottom
	angular.element(document).ready(function () {
		let sidebar_height = $('#messenger_sidebar').height();
		let input_height = $('.message_input_wrapper').height();
		let message_wrapper_height = sidebar_height - input_height - 92;

		console.log(sidebar_height);
		console.log(input_height);
		console.log(message_wrapper_height);

		$('.message_wrapper').css('height', message_wrapper_height);
    });

});