angular.module("internal").service('socialService', function($http) {

	this.list = function() {
		return $http.get('/user/friends').then(
			function success(response) {
				return response.data;
			},
			function error(response) {
				console.log('Error: ' + response);
			}
		);
	};

	this.getFriends = function() {
		return $http.get('/user/friends').then(
			function success(response) {
				return response.data;
			},
			function error(response) {
				console.log('Error: ' + response);
			}
		);
	};

	this.getFriendRequests = function() {
		return $http.get('/user/friends').then(
			function success(response) {
				return response.data;
			},
			function error(response) {
				console.log('Error: ' + response);
			}
		);
	};

	this.answerFriendRequest = function(requestBody) {
		return $http.post('/user/friends', requestBody).then(
			function success(response) {
				return response.data;
			},
			function error(response) {
				console.log('Error: ' + response);
			}
		);
	};

	this.removeFriend = function(requestBody) {
		return $http.post('/user/friends/remove', requestBody).then(
			function success(response) {
				return response.data;
			},
			function error(response) {
				console.log('Error: ' + response);
			}
		);
	};

});
