var app = angular.module("internal");

app.controller("FeedController", function($scope, $http, $routeParams) {


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

	$scope.getFeed = function() {
		if(!$scope.noMoreFeeds) {
			$http.get('/feeds/' + $routeParams.id).success(function(response) {
				$scope.feeds = response;
				console.log($scope.feeds);
			});
		}
	};

	$scope.getFeed();

});