var app = angular.module("internal");

app.controller("NavbarController", function($scope, $http, $routeParams) {

	$scope.items = [];

    $scope.search = function(term) {
    	if(term.trim() != '') {
    		$http.get('/search/' + term).then(
	    		function(response) {
	    			let result = [];

	    			for(let i = 0; i < response.data.items.length; i++) {
	    				result = result.concat(
	    					response.data.items[i].children.map(function(obj) {
	    						obj.type = response.data.items[i].type;
	    						return obj;
	    					})
	    				);
	    			}
	    			$scope.items = result;
	    		}, function() {
	    			console.log(response);
	    		});
    	}
    };

    $scope.groupFN = function(item) {
    	if(item.type == 'user') {
    		return 'Users';	
    	}
    	if(item.type == 'feed') {
    		return 'Feeds';
    	}
    };

    $scope.social = {
		requests : null,
		friends : null
	};

	$scope.getFriends = function() {
		$http.get('/user/friends').then(
			function(response) {
				$scope.social.requests = response.data.requests;
				$scope.social.friends = response.data.friends;
				console.log($scope.social);
			}, function(response) {
				console.log(response);
			});
	};

	$scope.getFriends();

	$scope.answerFriendRequest = function(id, answer) {
		let request = {
			id: id,
			answer: answer
		};
		$http.post('/user/friends', request).then(
			function(response) {
				if(answer)
					acceptFriendRequest(id, response);
				else 
					denyFriendRequest(id, response);
			}, function(response) {
				handleError(response);
			});
	};

	$scope.unfriend = function(id) {
		$http.post('/user/friends/remove', {'id': id}).then(
			function(response) {
				if(response.data) {
					for(let i = 0; i < $scope.social.friends.length; i++) {
						if($scope.social.friends[i].user_id == response.data.friend_id) {
							// remove friend from friends list
							$scope.social.friends.splice(i,1);
						}
					}
				}
			}, function(response) {
				handleError(response);
			});
	}

	function acceptFriendRequest(id, response) {
		let request = null;
		for(let i = 0; i < $scope.social.requests.length; i++) {
			if($scope.social.requests[i].user_id == id) {
				request = $scope.social.requests[i];
				$scope.social.requests.splice(i,1);
				$scope.social.friends.push(request);
			}
		}
	};

	function denyFriendRequest(id, response) {
		for(let i = 0; i < $scope.social.requests.length; i++) {
			if($scope.social.requests[i].user_id == id) {
				// remove friend from friends list
				$scope.social.requests.splice(i,1);
			}
		}
	};

	function handleError(response) {
		console.log(response);
	};
});