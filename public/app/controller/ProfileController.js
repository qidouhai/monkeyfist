var app = angular.module("internal");

app.controller("ProfileController", function ($scope, $rootScope, $routeParams, $location, msgService, settingService, socialService) {
    
    $scope.fileSelected = false;
    $scope.dropzoneConfig = {
        'options': {
            'url': '/upload/profile',
            'method': 'post',
            'maxFileSize': 15,
            'uploadMultiple': false,
            'maxFiles': 2,
            'acceptedFiles': 'image/*',
            'previewsContainer': '.dropzone-previews',
            'thumbnailWidth': 250,
            'thumbnailHeight': 250,
            'previewTemplate': '<span class="preview test42" id="test42" style="display:none;"><img data-dz-thumbnail src="/img/default-profile.png" width="130" height="130" class="img-responsive img-thumbnail" /></span>',
            'autoProcessQueue': false,
            'headers': {
                'X-CSRF-Token': $scope.csrf
            },
            'init': function () {
                $scope.dropzone = this;
            }
        },
        'eventHandlers': {
            'success': function (file, response) {
                $scope.fileSelected = false;
                $scope.uploading = false;
                $scope.$apply();
                $scope.submitSettingImage(response.image, response.thumbnail);                
            },
            'sending': function(file) {
                $scope.uploading = true;
                $scope.fileSelected = null;
            },
            'uploadprogress': function(file,progress,bytesSent) {
                $('#progressbar-upload').children().first().width(progress);
            },
            'thumbnail': function(file, dataUrl) {
                $scope.fileSelected = true;
                $scope.$apply();
                $('#profile-preview').attr('src', dataUrl);
            }
        }
    };
    
    $scope.removeSelection = function() {
        $scope.dropzone.removeAllFiles();
        $scope.fileSelected = false;
        $('#profile-preview').attr('src', $scope.user.picture);
    };

    $scope.sendMessage = function (userId) {
        msgService.searchConversation({user1: $scope.user.id, user2: userId}).save(function (response) {
            $location.url('messenger/' + response.conversation_id);
        });
    };

    $scope.directToMessenger = function () {
        $location.url('messenger');
    };

    /**
     * Queries the friends of the current user
     * and the friends of the user with the
     * given id. Sorts the user to common and 
     * distinct friend arrays.
     * @param {type} id (user)
     */
    $scope.getFriendsOfFriend = function (id) {
        socialService.getFriends().query(function (response) {
            $scope.friends = response.friends;
            socialService.getFriendsOfFriend(id).query(function (response) {
                $scope.friendsOfFriend = {
                    common: [],
                    distinct: []
                };
                for (let x = 0; x < response.friends.length; x++) {
                    if (isCommonFriend(response.friends[x].user.id)) {
                        $scope.friendsOfFriend.common.push(response.friends[x]);
                    } else {
                        $scope.friendsOfFriend.distinct.push(response.friends[x]);
                    }
                }
            });
        });
    };

    $scope.sendFriendRequest = function () {
        socialService.sendFriendRequest($routeParams.id).save(function (response) {
            if (response) {
                $scope.info.relation.status = "requested";
                $scope.info.relation.requestedByMe = true;
            }
        });
    };

    $scope.answerFriendRequest = function (answer) {
        if (answer) {
            socialService.answerFriendRequest({id: $routeParams.id, answer: answer}).save(function (response) {
                acceptFriendRequest(response);
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
            settingService.setNames({'prename': prename, 'lastname': lastname}).save(function (response) {
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
            settingService.setEmail({'email': email}).save(function (response) {
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
            settingService.setPassword({'password': pw1, 'password_confirmation': pw2}).save(function (response) {
                if (response.error)
                    $scope.settings.account.password.error = true;
                else
                    $scope.settings.account.password.success = true;
                $scope.settings.account.password.message = response.message;
            });
        }
    };
    
    $scope.submitSettingImage = function(imagePath, thumbnailPath) {
        $scope.resetSettingStates();
        
        settingService.setImage({'imagePath': imagePath, 'thumbnailPath': thumbnailPath}).save(function (response) {
            if(response.error)
                $scope.settings.account.image.error = true;
            else {
                $scope.settings.account.image.success = true;
                $rootScope.user = response.user;
                // as user can change pic only on his own profile, no check required
                $scope.info.picture = response.user.picture;
            }
            $scope.settings.account.image.message = response.message;
        });
    };

    $scope.submitSettingNotifications = function () {
        $scope.resetSettingStates();
        let requestBody = {
            notifyMessage: $('#input_notifyMessage')[0].checked,
            notifyFriendRequest: $('#input_notifyFriendRequest')[0].checked,
            notifyComment: $('#input_notifyComment')[0].checked,
            notifiyFeed: $('#input_notifyFeed')[0].checked
        };
        settingService.setNotifications(requestBody).save(function (response) {
            if (response.error)
                $scope.settings.notification.error = true;
            else
                $scope.settings.notification.success = true;
            $rootScope.preferences.notifications = response.settings;
            $scope.settings.notification.message = response.message;
        });
    };

    $scope.getSettingPrivacy = function () {
        settingService.getPrivacy().get(function (response) {
            String(response.feeds) === String('private') ? $('#input_privacy_feed').bootstrapToggle('off') : $('#input_privacy_feed').bootstrapToggle('on');
            String(response.collections) === String('private') ? $('#input_privacy_collection').bootstrapToggle('off') : $('#input_privacy_collection').bootstrapToggle('on');
        });
    };

    $scope.submitSettingPrivacy = function () {
        $scope.resetSettingStates();
        let requestBody = {
            feeds: $('#input_privacy_feed')[0].checked ? String('public') : String('private'),
            collections: $('#input_privacy_collection')[0].checked ? String('public') : String('private')
        };
        settingService.setPrivacy(requestBody).save(function (response) {
            if (response.error)
                $scope.settings.privacy.error = true;
            else
                $scope.settings.privacy.success = true;
            $scope.settings.privacy.message = response.message;
        });
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
                },
                image: {
                    error: false,
                    success: false,
                    message: null
                }
            },
            privacy: {
                error: false,
                success: false,
                message: null
            },
            notification: {
                error: false,
                success: false,
                message: null
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
        for (let x = 0; x < $scope.friends.length; x++) {
            if (Number($scope.friends[x].user.id) === Number(id)) {
                return true;
            }
        }
        return false;
    }

    function acceptFriendRequest() {
        $scope.info.relation.status = 'friend';
        $scope.info.relation.friends = true;
    }

    $(".modal-backdrop").hide();

    socialService.getFriend($routeParams.id).get(function (response) {
        $scope.info = response;
    });

    settingsFactory = new SettingsFactory();

    $scope.settings = {};

    if (Number($routeParams.id) === Number($scope.user.id)) {
        $scope.resetSettingStates();
        $scope.getSettingPrivacy();
        $('#input_notifyMessage').prop('checked', $scope.preferences.notifications.message).change();
        $('#input_notifyFriendRequest').prop('checked', $scope.preferences.notifications.friend_request).change();
        $('#input_notifyComment').prop('checked', $scope.preferences.notifications.comment).change();
        $('#input_notifyFeed').prop('checked', $scope.preferences.notifications.feed).change();
    }
});
