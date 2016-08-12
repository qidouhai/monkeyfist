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
	.when("/feed/:id", {
		templateUrl: "/app/templates/feed.php",
		controller: "FeedController"
	})
	.when("/profile/:id", {
		templateUrl: "/app/templates/profile.php",
		controller: "ProfileController"
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