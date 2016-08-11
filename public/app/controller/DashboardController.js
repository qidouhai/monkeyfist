var app = angular.module("internal");

app.controller("DashboardController", function($scope, $http, $location) {

	// Amount of feeds loaded
	$scope.feedCounter = 0;
	// Amount of feeds to load with one query
	$scope.feedSteps = 4;
	// Feeds
	$scope.feeds = [];
	// Set to true, if all feeds are loaded
	$scope.noMoreFeeds = false;

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
			$http.get('/feeds/skip/' + $scope.feedCounter + '/take/' + $scope.feedSteps).success(function(response) {
				$scope.feedCounter += $scope.feedSteps;
				for(let i = 0; i < response.length; i++) {
					$scope.feeds.push(response[i]);
				}
				if(response.length < $scope.feedCounter)
					$scope.noMoreFeeds = true;
			});
		}
	};

	$scope.getFeeds();

});