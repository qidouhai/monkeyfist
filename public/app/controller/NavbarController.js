var app = angular.module("internal");

app.controller("NavbarController", function ($scope, $http, $location, $rootScope, socialService, msgService, socketService) {

    $scope.items = [];
    $rootScope.notifications = {
        subscribed: false,
        messenger: {
            conversations: []
        }
    };
    
    $scope.search = function (term) {
        if (term.trim() !== '') {
            $http.get('/search/' + term).then(
                    function (response) {
                        let result = [];

                        for (let i = 0; i < response.data.items.length; i++) {
                            result = result.concat(
                                    response.data.items[i].children.map(function (obj) {
                                obj.type = response.data.items[i].type;
                                return obj;
                            })
                                    );
                        }
                        $scope.items = result;
                    }, function () {
                console.log(response);
            });
        }
    };

    $scope.groupFN = function (item) {
        if (String(item.type) === String('user')) {
            return 'Users';
        }
        if (String(item.type) === String('feed')) {
            return 'Feeds';
        }
    };
    
    $scope.getUnreadConversations = function() {
        msgService.getUnreadConversations().then(function(response) {
            $rootScope.notifications.messenger.conversations = response;
        });
    };
    
    $scope.subscribeToMessages = function() {
        if(!$location.url().includes('messenger')) {
            socketService.on('messenger-channel:' + $scope.user.id, function (data) {
                if($.inArray(data.conversation_id, $rootScope.notifications.messenger.conversations) === -1) {
                    $rootScope.notifications.messenger.conversations.push(data.conversation_id);
                }
                console.log(data);
            });
        }
    }
    
    /**
     * Logs the user out.
     */
    $scope.logout = function () {
        window.location.href = '/logout';
    };

    /**
     * Directs the user to the profile with the given id.
     * @param {type} id (userid)
     */
    $scope.displayProfile = function (id) {
        $location.url('/profile/' + id);
    };

    // request all friends and friend requests
    $scope.getFriends = function () {
        socialService.list().then(function (friends) {
            $scope.social = friends;
        });
    };

    $scope.answerFriendRequest = function (id, answer) {
        socialService.answerFriendRequest({id: id, answer: answer}).then(function (response) {
            if (answer)
                acceptFriendRequest(id, response);
            else
                denyFriendRequest(id, response);
        });
    };

    /*
     * Removes the request send by the current user to 
     * another user.
     * @param {Number} requestId Id of the request(!) to remove. 
     */
    $scope.withdrawFriendRequest = function (requestId) {
        socialService.withdrawRequest({id: requestId}).then(function (response) {
            if (response && response.removed) {
                for (let i = 0; i < $scope.social.myrequests.length; i++) {
                    if (Number($scope.social.myrequests[i].id) === Number(requestId)) {
                        $scope.social.myrequests.splice(i, 1);
                    }
                }
            }
        });
    };

    $scope.unfriend = function (id) {
        socialService.removeFriend({id: id}).then(function (response) {
            if (response) {
                for (let i = 0; i < $scope.social.friends.length; i++) {
                    if ($scope.social.friends[i].user_id == response.friend_id) {
                        // remove friend from friends list
                        $scope.social.friends.splice(i, 1);
                    }
                }
            }
        });
    }

    function acceptFriendRequest(id, response) {
        let request = null;
        for (let i = 0; i < $scope.social.requests.length; i++) {
            if (Number($scope.social.requests[i].user_id) === Number(id)) {
                request = $scope.social.requests[i];
                $scope.social.requests.splice(i, 1);
                $scope.social.friends.push(request);
            }
        }
    };

    function denyFriendRequest(id, response) {
        for (let i = 0; i < $scope.social.requests.length; i++) {
            if (Number($scope.social.requests[i].user_id) === Number(id)) {
                // remove friend from friends list
                $scope.social.requests.splice(i, 1);
            }
        }
    };

    // stores the friends and requests
    $scope.social;
    $scope.getFriends();
    $scope.getUnreadConversations();
    $scope.subscribeToMessages()
});