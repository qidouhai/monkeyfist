var app = angular.module("internal");

app.controller("MessengerController", function($scope, $routeParams, msgService, socketService) {

	$scope.conversations;

	$scope.currentConversation = {
		'id': null,
		'participants': null,
		'messages': null
	};

	$scope.setConversation = function(conversationId) {
		$scope.getMessages(conversationId);
		$routeParams.conversationId = conversationId;
	};

	$scope.getConversations = function() {
		msgService.getConversations().then(function(response) {
			$scope.conversations = response;
		});
	};

	$scope.getMessages = function(conversationId) {
		msgService.getMessages(conversationId).then(function(response) {
			if(response.exists && response.member) {
				$scope.currentConversation.id = response.data.id;
				$scope.currentConversation.participants = response.data.participants;
				$scope.currentConversation.messages = response.data.messages;
				console.log($scope.currentConversation);
			};
		});
	};

	$scope.submitMessage = function() {
		let input = $('#message_input_field').val().trim();
		if(input != '') {
			msgService.sendMessage({conversation_id: $scope.currentConversation.id, body: input}).then(function(response) {
				console.log(response);
			});
		}
		$('#message_input_field').val('')
	};

	socketService.on('messenger-channel:' + $scope.user.id, function(data) {
		if(data.conversation_id == $scope.currentConversation.id) {
			$scope.currentConversation.messages.push(data);
		}
	});

	$scope.getConversations();
	// check if a conversation is selected
	if($routeParams.conversationId)
		$scope.getMessages(parseInt($routeParams.conversationId));


	// position textarea at page bottom
	angular.element(document).ready(function () {
		let sidebar_height = $('#messenger_sidebar').height();
		let input_height = $('.message_input_wrapper').height();
		let message_wrapper_height = sidebar_height - input_height - 92;

		$('.message_wrapper').css('height', message_wrapper_height);
    });

});