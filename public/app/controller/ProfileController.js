var app = angular.module("internal");

app.controller("ProfileController", function($scope, $http, $routeParams) {

	$scope.social = {
		requests : null,
		friends : null
	};

	$scope.templates = {
		navbar : '/app/templates/includes/navbar.php',
		feeds : '/app/templates/feed.php'
	};

	$http.get('/friend/' + $routeParams.id).success(function(response) {
		$scope.info = response;
		console.log(response);
	});

	$scope.getFriends = function() {
		$http.get('/user/friends').then(
			function(response) {
				console.log(response);
				$scope.social.requests = response.data.requests;
				$scope.social.friends = response.data.friends;
			}, function(response) {
				console.log(response);
			});
	};

	$scope.sendFriendRequest = function() {
		let id = $routeParams.id;
		$http.post('/user/friends/request/' + id).then(
			function success(response) {
				if(response.data) {
					$scope.info.relation.status = "requested";
					$scope.info.relation.requestedByMe = true;
				}
			}, function error(response) {
				console.log(response);
			});
	};

	$scope.answerFriendRequest = function(answer) {
		let id = $routeParams.id;
		if(answer) {
			$http.post('/user/friends/' + id).then(
				function(response) {
					acceptFriendRequest(response);
				}, function(response) {
					handleError(response);
				});
		}
	};

	function acceptFriendRequest(response) {
		$scope.info.relation.status = 'friend';
		$scope.info.relation.friends = true;
	};

	function handleError(response) {
		console.log(response);
	};


	$scope.getFriends();

});