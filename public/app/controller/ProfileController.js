var app = angular.module("internal");

app.controller("ProfileController", function($scope, $http, $routeParams) {

	$scope.templates = {
		feeds : '/app/templates/feed.php'
	};

	$http.get('/friend/' + $routeParams.id).success(function(response) {
		$scope.info = response;
		console.log(response);
	});

});