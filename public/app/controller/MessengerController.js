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

});