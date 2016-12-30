var app = angular.module("internal");

app.controller("FeedController", function ($scope, $routeParams, $location, feedService) {

    insertImageFactory = new InsertImageFactory();

    this.$onInit = () => {
        $scope.displayInput();
        $scope.getFeeds();
    };

    let querySize = 4;
    $scope.moreFeeds = true;
    $scope.feeds = [];

    $scope.dropzoneConfig = {
        'options': {
            'url': '/feed/images',
            'method': 'post',
            'maxFileSize': 3,
            'uploadMultiple': false,
            'maxFiles': 1,
            'acceptedFiles': 'image/*',
            'init': function () {
                insertImageFactory.dropzone = this;
            }
        },
        'eventHandlers': {
            'success': function (file, response) {
                let imageLink = '<img src="' + response.image + '" class="img-responsive">';
                insertImageFactory.dropzone.removeFile(file);
                insertImageFactory.insert(imageLink);
            }
        }
    };

    $scope.getFeeds = function () {
        feedService.getFeeds($scope.feeds.length, querySize).query(function (response) {
            $scope.feeds.push.apply($scope.feeds, response);
            $scope.moreFeeds = response.length === querySize;
        });
    };


    $scope.publishFeed = function () {
        let post_content = $('#post_content').val().trim();
        if (post_content !== "") {
            feedService.addFeed({
                'created': moment().format('YYYY-MM-DD HH:mm:ss'),
                'content': post_content
            }).save(function (response) {
                $scope.feeds.splice(0, 0, response);
                $('#post_content').val('');
            });
        }
    };

    $scope.removeFeed = function (feedId) {
        feedService.removeFeed(feedId).remove(function (response) {
            $scope.feeds.splice(searchFeedIndex(feedId), 1);
        });
    };

    $scope.submitComment = function (feedId) {
        let comment_text = $('#comment-text-' + feedId).val().trim();

        if (comment_text && comment_text !== "") {
            feedService.addComment(feedId, {
                'feed_id': feedId,
                'content': comment_text,
                'created': moment().format('YYYY-MM-DD HH:mm:ss')
            }).save(function (response) {
                searchFeed(feedId).comments.push(response);
                $('#comment-text-' + feedId).val('');
            });
        }
    };

    $scope.like = function (feedId) {
        feedService.like(feedId).save(function (response) {
            let feed = searchFeed(feedId);
            if(feed.likes === null)
                feed.likes = {count: 0};
            feed.likes.count++;
            feed.votes[0] = {feed_id: feedId, id: $scope.user.id, like: 1};
        });
    };

    $scope.dislike = function (feedId) {
        feedService.dislike(feedId).save(function (response) {
            let feed = searchFeed(feedId);
            if(feed.dislikes === null)
                feed.dislikes = {count: 0};
            feed.dislikes.count++;
            feed.votes[0] = {feed_id: feedId, id: $scope.user.id, like: 0};
        });
    };

    $scope.unlike = function (feedId) {
        feedService.unlike(feedId).save(function (response) {
            let feed = searchFeed(feedId);
            feed.likes.count--;
            console.log(feed.likes);
            feed.votes = [];
        });
    };

    $scope.undislike = function (feedId) {
        feedService.undislike(feedId).save(function (response) {
            let feed = searchFeed(feedId);
            feed.dislikes.count--;
            feed.votes = [];
        });
    };

    // force focus on comment input with given feedId
    $scope.focus = function (feedId) {
        $('#comment-text-' + feedId).focus();
    };


    $scope.displayInput = function () {
        if ($location.url().includes('profile')) {
            $scope.displayPostInput = (Number($scope.user.id) === Number($routeParams.id));
        } else {
            $scope.displayPostInput = true;
        }
    };

    // search and return feed index in array
    let searchFeedIndex = function (feedId) {
        for (let x = 0; x < $scope.feeds.length; x++) {
            if ($scope.feeds[x].id === feedId)
                return x;
        }
        return -1;
    };

    // search and return feed in array
    let searchFeed = function (feedId) {
        for (let x = 0; x < $scope.feeds.length; x++) {
            if ($scope.feeds[x].id === feedId)
                return $scope.feeds[x];
        }
        return null;
    };

});
