/**
 * Created by Axel on 19.03.2017.
 */
app.controller("FeedController", function ($scope, $location, feedService) {

    $scope.moreFeeds = true;
    $scope.feeds = [];
    $scope.user;

    var querySize = 4;

    $scope.getFeeds = function () {
        feedService.getFeeds($scope.feeds.length, querySize).query(function (response) {
            $scope.feeds.push.apply($scope.feeds, response);
            $scope.moreFeeds = response.length === querySize;
        });
    };

    $scope.publishFeed = function () {
        var feed_content = $('#feed_content').val().trim();

        if (feed_content !== '') {
            feedService.addFeed({
                'content': feed_content
            }).save(function (response) {
                $scope.feeds.splice(0, 0, response);
                $('#feed_content').val('');
            });
        }
    };

    $scope.submitComment = function (feedId) {
        var comment_text = $('#comment-text-' + feedId).val().trim();

        if (comment_text && comment_text !== '') {
            feedService.addComment(feedId, {
                'feed_id': feedId,
                'content': comment_text
            }).save(function (response) {
                searchFeed(feedId).comments.push(response);
                $('#comment-text-' + feedId).val('');
            });
        }
    };

    $scope.like = function (feedId) {
        feedService.like(feedId).save(function (response) {
            var feed = searchFeed(feedId);
            if (feed.likes === null) {
                feed.likes = {count: 0};
            }
            feed.likes.count++;
            feed.votes[0] = {feed_id: feedId, id: $scope.user.id, like: 1};
        });
    };

    $scope.dislike = function (feedId) {
        feedService.dislike(feedId).save(function (response) {
            var feed = searchFeed(feedId);
            if (feed.dislikes === null) {
                feed.dislikes = {count: 0};
            }
            feed.dislikes.count++;
            feed.votes[0] = {feed_id: feedId, id: $scope.user.id, like: 0};
        });
    };

    $scope.unlike = function (feedId) {
        feedService.unlike(feedId).save(function (response) {
            var feed = searchFeed(feedId);
            feed.likes.count--;
            feed.votes = [];
        });
    };

    $scope.undislike = function (feedId) {
        feedService.undislike(feedId).save(function (response) {
            var feed = searchFeed(feedId);
            feed.dislikes.count--;
            feed.votes = [];
        });
    };

    // force focus on comment input with given feedId
    $scope.focus = function (feedId) {
        $('#comment-text-' + feedId).focus();
    };


    var searchFeed = function (feedId) {
        for (var x = 0; x < $scope.feeds.length; x++) {
            if ($scope.feeds[x].id === feedId) {
                return $scope.feeds[x];
            }
        }
        return null;
    };


    feedService.user().get(function (response) {
        $scope.user = response;
    });
    $scope.getFeeds();
});