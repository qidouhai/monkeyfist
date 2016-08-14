var app = angular.module("internal");

app.controller("DashboardController", function($scope, $http, $location) {

	$scope.templates = {
		feeds : '/app/templates/feed.php'
	};

});