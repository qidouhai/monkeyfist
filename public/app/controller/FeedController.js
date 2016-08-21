var app = angular.module("internal");

app.controller("FeedController", function($scope, $http, $routeParams, $location) {

	// Amount of feeds loaded
	$scope.feedCounter = 0;
	// Amount of feeds to load with one query
	$scope.feedSteps = 4;
	// Feeds
	$scope.feeds = [];
	// Set to true, if all feeds are loaded
	$scope.noMoreFeeds = false;
	// Feed url
	$scope.feedURL = '/feeds/skip/' + $scope.feedCounter + '/take/' + $scope.feedSteps;

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
			$http.get($scope.feedURL).success(function(response) {
				$scope.feedCounter += $scope.feedSteps;
				$scope.setFeedURL();
				for(let i = 0; i < response.length; i++) {
					$scope.feeds.push(response[i]);
				}
				if(response.length < $scope.feedSteps)
					$scope.noMoreFeeds = true;
			});
		}
	};

	$scope.removeFeed = function(feedId) {
		$http.delete('/feed/' + feedId).then(
			function success(response) {
				if(response.data == 1) {
					for(let x = 0; x < $scope.feeds.length; x++) {
						if($scope.feeds[x].id == feedId){
							$scope.feedCounter--;
							$scope.feeds.splice(x,1);
						}
					}
				}
			}, function error(response) {
				console.log(response);
			});
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

	$scope.setFeedURL = function () {
		if($location.url().includes('feed')) {
			$scope.feedURL = '/feeds/' + $routeParams.id;
			$scope.displayPostInput = false;
			$('#feedloader').hide();
		} else if($location.url().includes('profile')) {
			$scope.feedURL = '/user/' + $routeParams.id + '/feeds/skip/' + $scope.feedCounter + '/take/' + $scope.feedSteps;
			$scope.displayPostInput = ($scope.user.id == $routeParams.id);
		} else {
			$scope.feedURL = '/feeds/skip/' + $scope.feedCounter + '/take/' + $scope.feedSteps;
			$scope.displayPostInput = true;
		}
	};

	$scope.setFeedURL();
	$scope.getFeeds();

	// let insertImageFactory = null;
	setTimeout(function() {
		insertImageFactory = new InsertImageFactory();
        insertImageFactory.init();
	}, 1000);
});