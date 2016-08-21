var app = angular.module("internal", ["ngRoute"]);

app.config(function($routeProvider, $locationProvider) {
	$routeProvider
	.when("/dashboard", {
		templateUrl: "/app/templates/dashboard.php",
		controller: "DashboardController",
		resolve: {
			login: checkLogin
		}
	})
	.when("/", {
		templateUrl: "/app/templates/dashboard.php",
		controller: "DashboardController",
		resolve: {
			login: checkLogin
		}
	})
	.when("/feed/:id", {
		templateUrl: "/app/templates/feed.php",
		controller: "FeedController",
		resolve: {
			login: checkLogin
		}
	})
	.when("/profile/:id", {
		templateUrl: "/app/templates/profile.php",
		controller: "ProfileController",
		resolve: {
			login: checkLogin
		}
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

let checkLogin = function($q, $http, $rootScope) {
	let deferred = $q.defer();

	$http.get('/user').success(function(user) {
		if(user.id) {
			$rootScope.user = user;
			deferred.resolve();
		} else {
			deferred.resolve();
		}
	});

	return deferred.promise;
};