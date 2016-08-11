var app = angular.module("internal", ["ngRoute"]);

app.config(function($routeProvider, $locationProvider) {
	$routeProvider
	.when("/dashboard", {
		templateUrl: "/app/templates/dashboard.php",
		controller: "DashboardController"
	})
	.when("/", {
		templateUrl: "/app/templates/dashboard.php",
		controller: "DashboardController"
	})
	.when("/test", {
		templateUrl: "/app/templates/dashboard.php",
		controller: "DashboardController"
	});

	$locationProvider.html5Mode(true);
});

// Filter to display trusted html code
angular.module('internal')
	.filter('trustHTML', ['$sce', function($sce) {
		return function(text) {
			return $sce.trustAsHtml(text);
		};
	}]);