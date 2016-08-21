var app = angular.module("internal");

app.controller("DashboardController", function($scope, $http, $location) {

	$scope.templates = {
		navbar : '/app/templates/includes/navbar.php',
		feeds : '/app/templates/feed.php'
	};

	console.log($scope.templates);

});