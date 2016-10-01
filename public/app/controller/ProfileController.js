var app = angular.module("internal");

app.controller("ProfileController", function($scope, $http, $routeParams, $location, msgService) {

	$(".modal-backdrop").hide();

	$http.get('/friend/' + $routeParams.id).success(function(response) {
		$scope.info = response;
	});

	$scope.sendMessage = function(userId) {
		msgService.searchConversation({participants:[$scope.user.id, userId]}).then(function(response) {
			$location.url('messenger/' + response.conversation_id);
		});
	}

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
					// as this is only for the profile page,
					// there is no need for a deny option
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
