var app = angular.module("internal");

app.controller("ProfileController", function($scope, $http, $routeParams) {

	// Amount of feeds loaded
	$scope.feedCounter = 0;
	// Amount of feeds to load with one query
	$scope.feedSteps = 4;
	// Feeds
	$scope.feeds = [];
	// Set to true, if all feeds are loaded
	$scope.noMoreFeeds = false;

	$http.get('/friend/' + $routeParams.id).success(function(response) {
		$scope.info = response;
		console.log(response);
		$scope.getFeeds();
	});

	$scope.submitComment = function(feedId) {
		let comment_text = $('#comment-text-' + feedId).val().trim();

		if(comment_text && comment_text != "") {
			let comment = {
				'feed_id' : feedId,
				'content' : comment_text,
				'created' : moment().format('YYYY-MM-DD HH:mm:ss')
			};
			
			$http.post('/feed/' + feedId + '/comment', comment).success(function(response) {
				for(let i = 0; i < $scope.feeds.length; i++) {
					if($scope.feeds[i].id == feedId)
						$scope.feeds[i].comments.push(response);
				}
			});

			$('#comment-text-' + feedId).val('');
		}
	};

	$scope.getFeeds = function() {
		if(!$scope.noMoreFeeds) {
			$http.get('/user/' + $scope.info.user.id + '/feeds/skip/' + $scope.feedCounter + '/take/' + $scope.feedSteps).success(function(response) {
				$scope.feedCounter += $scope.feedSteps;
				for(let i = 0; i < response.length; i++) {
					$scope.feeds.push(response[i]);
				}
				if(response.length < $scope.feedSteps)
					$scope.noMoreFeeds = true;
			});
		}
	};

	$scope.addLinkToPost = function() {
		bootbox.prompt("Enter link:", function(result) {
			if(result != null) {
				let link = '<a href="' + result + '">' + result + '</a>';
				$('#post_content').val($('#post_content').val() + link);
			}
		});
	};

	$scope.addYoutubeToPost = function() {
		bootbox.prompt("Enter Youtube Link:", function(result) {
			if(result != null) {
				let youtube = '<iframe src ="//www.youtube.com/embed/' + $scope.findYoutubeId(result) + '" allowfullscreen="" frameborder="0"></iframe>';
				$('#post_content').val($('#post_content').val() + youtube);
			}
		});
	};

	$scope.findYoutubeId = function (url) {
		// extracts the video id from the youtube url
		var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
		var match = url.match(regExp);
		if (match && match[2].length == 11) {
			return match[2];
		} else {
			bootbox.alert("Unknown Youtube Video ID!");
			return null;
		}
	}

	$scope.publishPost = function() {
		let post_content = $('#post_content').val().trim();
		console.log(post_content);
		if(post_content != "") {
			let post = {
				'created' : moment().format('YYYY-MM-DD HH:mm:ss'),
				'content' : post_content
			};
			$http.post('/feed', post).then(
				function successCallback(response) {
				$scope.feeds.splice(0, 0, response.data);
				$scope.feedCounter++;
			}, function errorCallback(response) {
				console.log(response);
			});
			
		}
		$('#post_content').val('')
	};

});