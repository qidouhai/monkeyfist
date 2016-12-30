
<div ng-include="'/app/templates/includes/navbar.php'" ng-controller="NavbarController"></div>

<div class="container-fluid">

    <!-- User metadata -->
    <div class="row">
        <div class="col-md-offset-1 col-md-10 col-sm-12 col-xs-12" style="margin-top:20px;">
            <div class="panel panel-default profile-panel">
                <div class="panel-heading profile-header">
                    <h2 class="text-center" style="margin: 0px auto;"><a href="/profile/{{ info.user.id}}">{{ info.user.username}}</a></h2>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 text-center" style="border-right: 1px solid #ddd;">
                            <img src="{{ info.user.thumbnail }}" class="img-responsive center-block img-thumbnail" style="vertical-align: middle; height: 150px; width: 150px;" />
                        </div>
                        <div class="col-md-9 table-responsive">
                            <table class="table" style="margin: 10px auto; font-size: medium; height: 100%;">
                                <tr style="height: 33%;">
                                    <th>Member since</th>
                                    <td>{{ info.user.created_at}}</td>
                                </tr>
                                <tr style="height: 33%;">
                                    <th>Born on</th>
                                    <td>{{ info.user.birthday}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-right">
                                    </td>
                                </tr>
                            </table>
                            <div class="text-right">
                                <div class="btn-group profile_buttons" ng-if="info.self">
                                    <button type="button" data-toggle="modal" data-target="#friends_list" class="btn btn-default">My Friends&nbsp;<i class="fa fa-users" aria-hidden="true"></i></button>
                                    <button type="button" ng-click="directToMessenger()" class="btn btn-default">Messages&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i></button>
                                    <button type="button" data-toggle="modal" data-target="#settingsModal" class="btn btn-default">Settings&nbsp;<i class="fa fa-cog" aria-hidden="true"></i></button>
                                </div>
                                <div class="btn-group profile_buttons" ng-if="!info.self && info.relation.friends">
                                    <button type="button" data-toggle="modal" data-target="#friends_friendlist" ng-click="getFriendsOfFriend(info.user.id)" class="btn btn-default">{{ info.user.prename}}'s Friends&nbsp;<i class="fa fa-users" aria-hidden="true"></i></button>
                                    <button type="button" ng-click="sendMessage(info.user.id)" class="btn btn-default">Send Message&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i></button>
                                    <button type="button" disabled="disabled" class="btn btn-default">Friends&nbsp;<i class="fa fa-check" aria-hidden="true"></i></button>
                                </div>
                                <div class="btn-group profile_buttons" ng-if="!info.self && !info.relation.friends && info.relation.status == 'requested' && info.relation.requestedByMe">
                                    <button type="button" data-toggle="modal" data-target="#friends_friendlist" ng-click="getFriendsOfFriend(info.user.id)" class="btn btn-default">{{ info.user.prename}}'s Friends&nbsp;<i class="fa fa-users" aria-hidden="true"></i></button>
                                    <button type="button" ng-click="sendMessage(info.user.id)" class="btn btn-default">Send Message&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i></button>
                                    <button type="button" disabled="disabled" class="btn btn-default">Request Sent&nbsp;<i class="fa fa-check" aria-hidden="true"></i></button>
                                </div>
                                <div class="btn-group profile_buttons" ng-if="!info.self && !info.relation.friends && info.relation.status == 'requested' && !info.relation.requestedByMe">
                                    <button type="button" data-toggle="modal" data-target="#friends_friendlist" ng-click="getFriendsOfFriend(info.user.id)" class="btn btn-default">{{ info.user.prename}}'s Friends&nbsp;<i class="fa fa-users" aria-hidden="true"></i></button>
                                    <button type="button" ng-click="sendMessage(info.user.id)" class="btn btn-default">Send Message&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i></button>
                                    <button type="button" ng-click="answerFriendRequest(true)" class="btn btn-default">Accept Request&nbsp;<i class="fa fa-thumbs-up" aria-hidden="true"></i></button>
                                </div>
                                <div class="btn-group profile_buttons" ng-if="!info.self && info.relation.status == 'guest'">
                                    <button type="button" data-toggle="modal" data-target="#friends_friendlist" ng-click="getFriendsOfFriend(info.user.id)" class="btn btn-default">{{ info.user.prename}}'s Friends&nbsp;<i class="fa fa-users" aria-hidden="true"></i></button>
                                    <button type="button" ng-click="sendMessage(info.user.id)" class="btn btn-default">Send Message&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i></button>
                                    <button type="button" ng-click="sendFriendRequest()" class="btn btn-default">Send Friend Request&nbsp;<i class="fa fa-smile-o" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Friends List(only used to display other users' friends) -->
    <div class="modal fade" id="friends_friendlist" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{ info.user.prename}}'s Friends</h4>
                </div>
                <div class="modal-body">
                    <table class="table" style="vertical-align: middle;">
                        <tr>
                            <th colspan="2">Name</th>
                            <th>Since</th>
                            <th>Relation</th>
                        </tr>
                        <tr ng-repeat="friend in friendsOfFriend.common">
                            <td><a href="/profile/{{ friend.user.id}}"><img class="img-responsive" src="/img/default-profile.png" width="45" /></a></td>
                            <td style="vertical-align: middle;" class="text-left"><a href="/profile/{{ friend.user.id}}">{{ friend.user.username}}</a></td>
                            <td style="vertical-align: middle;"><span>{{ friend.created}}</span></td>
                            <td style="vertical-align: middle;"><span>Common Friend</span></td>
                        </tr>
                        <tr ng-repeat="friend in friendsOfFriend.distinct">
                            <td><a href="/profile/{{ friend.user.id}}"><img class="img-responsive" src="/img/default-profile.png" width="45" /></a></td>
                            <td style="vertical-align: middle;" class="text-left"><a href="/profile/{{ friend.user.id}}">{{ friend.user.username}}</a></td>
                            <td style="vertical-align: middle;"><span>{{ friend.created}}</span></td>
                            <td style="vertical-align: middle;"><span ng-if="friend.user.id == user.id">Yourself</span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal containing the user settings -->
    <div class="modal fade" id="settingsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Settings</h4>
                </div>
                <div class="modal-body" id="settingsModal_overview">
                    <div class="list-group">
                        <a href="#" class="list-group-item" onclick="settingsFactory.selectSettingGroup('account')">
                            <h4 class="list-group-item-heading"><i class="fa fa-cog" aria-hidden="true"></i>
                                Account settings</h4>
                            <p class="list-group-item-text">Change username, email or password.</p>
                        </a>
                        <a href="#" class="list-group-item" onclick="settingsFactory.selectSettingGroup('privacy')">
                            <h4 class="list-group-item-heading"><i class="fa fa-user-secret" aria-hidden="true"></i>
                                Privacy settings</h4>
                            <p class="list-group-item-text">Determine who can see your posts, comments and profile information.</p>
                        </a>
                        <a href="#" class="list-group-item" onclick="settingsFactory.selectSettingGroup('notification')">
                            <h4 class="list-group-item-heading"><i class="fa fa-bell" aria-hidden="true"></i>
                                Notification settings</h4>
                            <p class="list-group-item-text">Set when and how you want to get notified about certain events.</p>
                        </a>
                    </div>
                </div>

                <div class="modal-body" id="settingsModal_account">
                    <div class="list-group">
                        <a href="#" class="list-group-item" onclick="settingsFactory.selectSetting('name')">
                            <h4 class="list-group-item-heading"><i class="fa fa-user" aria-hidden="true"></i>
                                Change name</h4>
                            <p class="list-group-item-text">Change your name settings.</p>
                        </a>
                        <a href="#" class="list-group-item" onclick="settingsFactory.selectSetting('email')">
                            <h4 class="list-group-item-heading"><i class="fa fa-envelope" aria-hidden="true"></i>
                                Change email</h4>
                            <p class="list-group-item-text">Change your email address.</p>
                        </a>
                        <a href="#" class="list-group-item" onclick="settingsFactory.selectSetting('password')">
                            <h4 class="list-group-item-heading"><i class="fa fa-key" aria-hidden="true"></i>
                                Change password</h4>
                            <p class="list-group-item-text">Change your account password.</p>
                        </a>
                        <a href="#" class="list-group-item" onclick="settingsFactory.selectSetting('image')">
                            <h4 class="list-group-item-heading"><i class="fa fa-camera" aria-hidden="true"></i>
                                Change profile picture</h4>
                            <p class="list-group-item-text">Change your profile picture.</p>
                        </a>
                        <a href="#" class="list-group-item" onclick="settingsFactory.back(1)">
                            <h4 class="list-group-item-heading"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Return</h4>
                            <p class="list-group-item-text">Return to last window without changes.</p>
                        </a>
                    </div>
                </div>

                <div class="modal-body" id="settingsModal_account_name">
                    <div class="alert alert-danger" ng-if="settings.account.name.error" role="alert">{{ settings.account.name.message}}</div>
                    <div class="alert alert-success" ng-if="settings.account.name.success" role="alert">{{ settings.account.name.message}}</div>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="input_prename" class="col-sm-4 control-label">Prename</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="input_prename" placeholder="Prename" value="{{ user.prename}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input_lastname" class="col-sm-4 control-label">Lastname</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="input_lastname" placeholder="Lastname" value="{{ user.lastname}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-6">
                                <button type="submit" class="btn btn-primary" ng-click="submitSettingName()">Submit</button>
                                <button type="button" class="btn btn-default" onclick="settingsFactory.back(2)">Back</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-body" id="settingsModal_account_email">
                    <div class="alert alert-danger" ng-if="settings.account.email.error" role="alert">{{ settings.account.email.message}}</div>
                    <div class="alert alert-success" ng-if="settings.account.email.success" role="alert">{{ settings.account.email.message}}</div>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="input_currentEmail" class="col-sm-4 control-label">Current E-Mail</label>
                            <div class="col-sm-6">
                                <input type="email" class="form-control" id="input_currentEmail" value="{{ user.email}}" disabled="disabled">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input_newEmail" class="col-sm-4 control-label">New E-Mail</label>
                            <div class="col-sm-6">
                                <input type="email" class="form-control" id="input_newEmail" placeholder="Enter new E-Mail">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-6">
                                <button type="submit" class="btn btn-primary" ng-click="submitSettingEmail()">Submit</button>
                                <button type="button" class="btn btn-default" onclick="settingsFactory.back(2)">Back</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-body" id="settingsModal_account_password">
                    <div class="alert alert-danger" ng-if="settings.account.password.error" role="alert">{{ settings.account.password.message}}</div>
                    <div class="alert alert-success" ng-if="settings.account.password.success" role="alert">{{ settings.account.password.message}}</div>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="input_newPassword1" class="col-sm-4 control-label">New Password</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" id="input_newPassword1" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input_newPassword2" class="col-sm-4 control-label">Repeat Password</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" id="input_newPassword2" placeholder="Repeat password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-6">
                                <button type="submit" class="btn btn-primary" ng-click="submitSettingPassword()">Submit</button>
                                <button type="button" class="btn btn-default" onclick="settingsFactory.back(2)">Back</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-body" id="settingsModal_account_image">
                    <div class="alert alert-danger" ng-if="settings.account.image.error" role="alert">{{ settings.account.image.message}}</div>
                    <div class="alert alert-success" ng-if="settings.account.image.success" role="alert">{{ settings.account.image.message}}</div>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-2 dropzone-previews text-center" style="margin-bottom:20px;" id="dropzone-preview">
                                <span class="preview">
                                    <img id="profile-preview" data-dz-thumbnail src="{{ user.thumbnail }}" width="250" height="250" class="img-responsive img-thumbnail" />
                                </span>
                            </div>
                            <button ng-if="!fileSelected" class="col-sm-4 col-sm-offset-4 dz-clickable btn btn-primary" dropzone="dropzoneConfig">Select</button>
                            <button ng-if="fileSelected" class="col-sm-4 col-sm-offset-4 dz-clickable btn btn-primary" ng-click="removeSelection()">Remove</button>
                            <div ng-if="uploading" class="progress col-sm-offset-4 col-sm-4" id="progressbar-upload">
                                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%;">
                                    <span class="sr-only">60% Complete</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-4">
                                <button type="submit" class="btn btn-success col-sm-6" ng-click="dropzone.processQueue()">Save</button>
                                <button type="button" class="btn btn-default col-sm-offset-1 col-sm-5" onclick="settingsFactory.back(2)">Back</button>
                            </div>
                        </div>
                    </form>
                </div>


                <div class="modal-body" id="settingsModal_privacy">
                    <div class="alert alert-danger" ng-if="settings.privacy.error" role="alert">{{ settings.privacy.message}}</div>
                    <div class="alert alert-success" ng-if="settings.privacy.success" role="alert">{{ settings.privacy.message}}</div>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="input_privacy_feed" class="col-sm-6 control-label">Make feeds public to monkeyfist community?</label>
                            <div class="col-sm-6">
                                <input type="checkbox" id="input_privacy_feed" checked data-toggle="toggle">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="input_privacy_collection" class="col-sm-6 control-label">Make collections public to monkeyfist community?</label>
                            <div class="col-sm-6">
                                <input type="checkbox" id="input_privacy_collection" data-toggle="toggle">
                            </div>
                        </div>
                        <hr>
                        <hr>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-6">
                                <button type="submit" class="btn btn-primary" ng-click="submitSettingPrivacy()">Submit</button>
                                <button type="button" class="btn btn-default" onclick="settingsFactory.back(2)">Back</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-body" id="settingsModal_notification">
                    <div class="alert alert-danger" ng-if="settings.notification.error" role="alert">{{ settings.notification.message}}</div>
                    <div class="alert alert-success" ng-if="settings.notification.success" role="alert">{{ settings.notification.message}}</div>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="input_notifyMessage" class="col-sm-6 control-label">Notify on new Message</label>
                            <div class="col-sm-6">
                                <input type="checkbox" id="input_notifyMessage" checked data-toggle="toggle">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="input_notifyFriendRequest" class="col-sm-6 control-label">Notify on new Friend Request</label>
                            <div class="col-sm-6">
                                <input type="checkbox" id="input_notifyFriendRequest" data-toggle="toggle">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="input_notifyComment" class="col-sm-6 control-label">Notify on new Comment</label>
                            <div class="col-sm-6">
                                <input type="checkbox" class="text-right" id="input_notifyComment" data-toggle="toggle">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="input_notifyFeed" class="col-sm-6 control-label">Notify on new Feed</label>
                            <div class="col-sm-6">
                                <input type="checkbox" id="input_notifyFeed" data-toggle="toggle">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-6">
                                <button type="submit" class="btn btn-primary" ng-click="submitSettingNotifications()">Submit</button>
                                <button type="button" class="btn btn-default" onclick="settingsFactory.back(2)">Back</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="settingsFactory.close()">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div ng-include="'/app/templates/feed.php'" ng-controller="FeedController"></div>

</div>
