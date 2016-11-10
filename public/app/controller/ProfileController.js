var app = angular.module("internal");

app.controller("ProfileController", function ($scope, $route, $http, $routeParams, $location, msgService, settingService, socialService) {

    $(".modal-backdrop").hide();

    settingsFactory = new SettingsFactory();

    $scope.settings = {};

    $http.get('/friend/' + $routeParams.id).success(function (response) {
        $scope.info = response;
    });

    $scope.sendMessage = function (userId) {
        msgService.searchConversation({participants: [$scope.user.id, userId]}).then(function (response) {
            $location.url('messenger/' + response.conversation_id);
        });
    };
    
    $scope.directToMessenger = function() {
        $location.url('messenger');
    };
    
    /**
     * Queries the friends of the current user
     * and the friends of the user with the
     * given id. Sorts the user to common and 
     * distinct friend arrays.
     * @param {type} id (user)
     */
    $scope.getFriendsOfFriend = function(id) {
        socialService.getFriends().then(function(response) {
            $scope.friends = response.friends;
            socialService.getFriendsOfFriend(id).then(function(response) {
                $scope.friendsOfFriend = {
                    common: [],
                    distinct: []
                };
                for(let x = 0; x < response.friends.length; x++) {
                    if(isCommonFriend(response.friends[x].user.id)){
                        $scope.friendsOfFriend.common.push(response.friends[x]);
                    } else {
                        $scope.friendsOfFriend.distinct.push(response.friends[x]);
                    }
                }            
            });
        });
    };

    $scope.sendFriendRequest = function () {
        let id = $routeParams.id;
        $http.post('/user/friends/request/' + id).then(
                function success(response) {
                    if (response.data) {
                        $scope.info.relation.status = "requested";
                        $scope.info.relation.requestedByMe = true;
                    }
                }, function error(response) {
            console.log(response);
        });
    };

    $scope.answerFriendRequest = function (answer) {
        let id = $routeParams.id;
        if (answer) {
            $http.post('/user/friends/' + id).then(
                    function (response) {
                        // as this is only for the profile page,
                        // there is no need for a deny option
                        acceptFriendRequest(response);
                    }, function (response) {
                handleError(response);
            });
        }
    };

    $scope.submitSettingName = function () {
        $scope.resetSettingStates();
        let prename = $('#input_prename').val().trim();
        let lastname = $('#input_lastname').val().trim();

        if (prename === '' || lastname === '' || (prename === $scope.user.prename && lastname === $scope.user.lastname)) {
            // do nothing
        } else {
            settingService.setNames({'prename': prename, 'lastname': lastname}).then(function (response) {
                if (response.error)
                    $scope.settings.account.name.error = true;
                else
                    $scope.settings.account.name.success = true;
                $scope.settings.account.name.message = response.message;
                $scope.info.user = response.user;
            });
        }
    };

    $scope.submitSettingEmail = function () {
        $scope.resetSettingStates();
        let email = $('#input_newEmail').val().trim();
        if (email === '' || email === $scope.user.email) {
            // do nothing
        } else {
            settingService.setEmail({'email': email}).then(function (response) {
                console.log(response);
                if (response.error)
                    $scope.settings.account.email.error = true;
                else
                    $scope.settings.account.email.success = true;
                $scope.settings.account.email.message = response.message;
                $scope.user = response.user;
            });
        }
    };

    $scope.submitSettingPassword = function () {
        $scope.resetSettingStates();
        let pw1 = $('#input_newPassword1').val().trim();
        let pw2 = $('#input_newPassword2').val().trim();

        if (pw1 === '' || pw2 === '') {
            console.log('Both fields have to be completed!');
        } else {
            settingService.setPassword({'password': pw1, 'password_confirmation': pw2}).then(function (response) {
                if (response.error)
                    $scope.settings.account.password.error = true;
                else
                    $scope.settings.account.password.success = true;
                $scope.settings.account.password.message = response.message;
            });
        }
    };

    $scope.resetSettingStates = function () {
        $scope.settings = {
            account: {
                name: {
                    error: false,
                    success: false,
                    message: null
                },
                email: {
                    error: false,
                    success: false,
                    message: null
                },
                password: {
                    error: false,
                    success: false,
                    message: null
                }
            }
        };
    };
    
    /**
     * Checks if the user id is a common friend
     * of the current user.
     * @param {type} id (user)
     * @returns {Boolean}
     */
    function isCommonFriend(id) {
        for(let x = 0; x < $scope.friends.length; x++) {
            if(Number($scope.friends[x].user.id) === Number(id)) {
                return true;
            }
        }
        return false;
    }

    function acceptFriendRequest(response) {
        $scope.info.relation.status = 'friend';
        $scope.info.relation.friends = true;
    }

    $scope.resetSettingStates();

});
