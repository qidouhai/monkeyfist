var app = angular.module("internal");

app.controller("MessengerController", function($scope, $http, $location, socialService) {

	// request all friends and friend requests
	$scope.getFriends = function() {
		socialService.list().then(function(friends) {
			$scope.social = friends;
		});
	};

	$scope.social;
	$scope.getFriends();

});