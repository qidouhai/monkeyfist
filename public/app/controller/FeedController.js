var app = angular.module("internal");

app.controller("FeedController", function ($scope, $http, $routeParams, $location, feedService) {

    insertImageFactory = new InsertImageFactory();

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
                let imageLink = '<img src="' + response.filename + '" class="img-responsive">';
                insertImageFactory.dropzone.removeFile(file);
                insertImageFactory.insert(imageLink);
            }
        }
    };

    $scope.getFeeds = function () {
        feedService.getFeeds().then(function (response) {
            $scope.feeds = feedService.feeds();
            $scope.moreFeeds = feedService.moreFeeds();
        });
    };


    $scope.publishFeed = function () {
        let post_content = $('#post_content').val().trim();
        if (post_content !== "") {
            feedService.addPost({
                'created': moment().format('YYYY-MM-DD HH:mm:ss'),
                'content': post_content
            }).then(function (response) {
                $scope.feeds = feedService.feeds();
                $('#post_content').val('');
            });
        }
    };

    $scope.removeFeed = function (feedId) {
        feedService.removeFeed(feedId).then(function (response) {
            $scope.feeds = feedService.feeds();
            console.log(response);
        });
    };

    $scope.submitComment = function (feedId) {
        let comment_text = $('#comment-text-' + feedId).val().trim();

        if (comment_text && comment_text !== "") {
            feedService.addComment(feedId, {
                'feed_id': feedId,
                'content': comment_text,
                'created': moment().format('YYYY-MM-DD HH:mm:ss')
            }).then(function (response) {
                $scope.feeds = feedService.feeds();
                $('#comment-text-' + feedId).val('');
            });
        }
    };

    $scope.like = function (feedId) {
        feedService.like(feedId).then(function (response) {
            $scope.feeds = feedService.feeds();
        });
    };

    $scope.dislike = function (feedId) {
        feedService.dislike(feedId).then(function (response) {
            $scope.feeds = feedService.feeds();
        });
    };

    $scope.unlike = function (feedId) {
        feedService.unlike(feedId).then(function (response) {
            $scope.feeds = feedService.feeds();
        });
    };

    $scope.undislike = function (feedId) {
        feedService.undislike(feedId).then(function (response) {
            $scope.feeds = feedService.feeds();
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

    $scope.displayInput();
    $scope.getFeeds();

});
