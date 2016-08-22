var app = angular.module("internal");

app.controller("ProfileController", function($scope, $http, $routeParams) {

	$(".modal-backdrop").hide();

	$http.get('/friend/' + $routeParams.id).success(function(response) {
		$scope.info = response;
	});

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
});