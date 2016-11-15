<nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: #800000; margin-bottom: 0px;">
    <div class="container">
        <div class="row">
            <div class="col-md-1">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/" style="padding-top: 7px;">
                        <img alt="Brand" src="/img/monkeyfist_thumbnail.png" class="img-rounded" height="37" style="margin-top: 1px;">
                    </a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            </div>
            <div class="col-md-11">
                <div id="internal_navbar" class="collapse navbar-collapse">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" style="margin-bottom: 0px;">
                                <ui-select ng-model="selectedItem" theme="bootstrap">
                                    <ui-select-match placeholder="Search for persons or feeds...">
                                        <span ng-bind="$select.selected.name"></span>
                                    </ui-select-match>
                                    <ui-select-choices group-by="groupFN" repeat="item in (items | filter: $select.search) track by item.id" refresh="search($select.search)" refresh-delay="0">
                                        <div ng-if="item.type == 'user'" ng-click="displayProfile(item.id)">                                            
                                            <div style="display: inline-block;">
                                                <img src="/img/default-profile.png" height="32" />
                                            </div>
                                            <div style="display: inline-block; margin-left: 15px;">
                                                <a style="font-size: large; color: #800000;" href="/profile/{{ item.id}}" ng-bind-html="item.username | highlight: $select.search"></a>
                                            </div>                                           
                                        </div>
                                        <span ng-bind="item.id" ng-if="item.type == 'feed'"></span>
                                    </ui-select-choices>
                                </ui-select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="navbar_links text-right">
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="/profile/{{ user.id}}" title="Profile">{{ user.username}}</a></li>
                                    <li><a href="/dashboard" title="Dashboard">Dashboard</a></li>
                                    <li><a href="#" data-toggle="modal" data-target="#friends_list" title="Your Friends"><i class="fa fa-users"></i></a></li>
                                    <!-- <li><a href="#" title="Friend Requests"><i class="fa fa-user-plus"></i></a></li> -->
                                    <li><a href="/messenger" title="Messages"><i class="fa fa-envelope-o"></i></a></li>
                                    <li><a href="#" ng-click="logout()" title="Sign Out"><i class="fa fa-sign-out"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Friends List -->
<div class="modal fade" id="friends_list" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Your Friends</h4>
            </div>
            <div class="modal-body">
                <table class="table" style="vertical-align: middle;">
                    <tr>
                        <th colspan="2">Name</th>
                        <th>Since</th>
                        <th>Options</th>
                    </tr>
                    <tr ng-repeat="request in social.requests">
                        <td><a href="/profile/{{ request.user.id}}"><img class="img-responsive" src="/img/default-profile.png" width="45" /></a></td>
                        <td style="vertical-align: middle;" class="text-left"><a href="/profile/{{ request.user.id}}">{{ request.user.username}}</a></td>
                        <td style="vertical-align: middle;"><span>{{ request.created}}</span></td>
                        <td style="vertical-align: middle;" class="text-right">
                            <button class="btn btn-primary" ng-click="answerFriendRequest(request.user.id, true)">Accept</button>
                            <button class="btn btn-warning" ng-click="answerFriendRequest(request.user.id, false)">Deny</button>
                        </td>
                    </tr>
                    <tr ng-repeat="request in social.myrequests">
                        <td><a href="/profile/{{ requests.target_user.id}}"><img class="img-responsive" src="/img/default-profile.png" width="45" /></a></td>
                        <td style="vertical-align: middle;" class="text-left"><a href="/profile/{{ request.target_user.id}}">{{ request.target_user.username}}</a></td>
                        <td style="vertical-align: middle;"><span>{{ request.created}}</span></td>
                        <td style="vertical-align: middle;" class="text-right">
                            <button class="btn btn-primary" ng-click="withdrawFriendRequest(request.id)">Withdraw</button>
                        </td>
                    </tr>
                    <tr ng-repeat="friend in social.friends">
                        <td><a href="/profile/{{ friend.user.id}}"><img class="img-responsive" src="/img/default-profile.png" width="45"></a></td>
                        <td style="vertical-align: middle;" class="text-left"><a href="/profile/{{ friend.user.id}}">{{ friend.user.username}}</a></td>
                        <td style="vertical-align: middle;"><span>{{ friend.created}}</span></td>
                        <td style="vertical-align: middle;" class="text-right">
                            <button class="btn btn-warning" ng-click="unfriend(friend.user.id)">Unfriend</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>