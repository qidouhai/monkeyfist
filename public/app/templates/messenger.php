<!-- <div class="container-fluid"> -->

<div ng-include="'/app/templates/includes/navbar.php'" ng-controller="NavbarController"></div>

<!-- </div> -->

<div id="messenger">

    <!-- Sidebar -->
    <div id="messenger_sidebar">
        <ul class="sidebar-nav">
            <li class="sidebar-brand" ng-repeat="conversation in conversations">
                <a href="#" ng-click="setConversation(conversation.id)">
                    <div class="row">
                        <div class="col-sm-3">
                            <img ng-if="conversation.participants.length == 2" src="/img/default-profile.png" class="img-responsive" />
                            <i ng-if="conversation.participants.length > 2" class="fa fa-globe fa-3x" aria-hidden="true" style="color: black;"></i>
                        </div>
                        <div class="col-sm-8" style="overflow: hidden; text-overflow: ellipsis;">
                            <span style="font-weight: bold;">
                                {{ conversation.participants | enumerateParticipants:user.id }}
                            </span>
                            <br>
                            <span>
                                Last Message: {{ conversation.last_message }}
                            </span>
                        </div>
                        <div ng-if="currentConversation.id !== conversation.id && !hasUnreadMessage(conversation.id)" class="col-sm-1" style="background-color: #f6f7f9; padding:0px; height: 60px;"></div>
                        <div ng-if="currentConversation.id !== conversation.id && hasUnreadMessage(conversation.id)" class="col-sm-1" style="background-color: #800000; padding:0px; height: 60px;"></div>
                        <div ng-if="currentConversation.id === conversation.id" class="col-sm-1" style="background-color: orange; padding:0px; height: 60px;"></div>
                    </div>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main -->
    <div id="messenger_content">
        <div class="container-fluid" style="padding: 0px;">
            <div class="row">
                <div class="col-lg-12" style="padding: 0px;">
                    <div style="width: 70%;">

                        <div class="message_wrapper" scroll-glue>

                            <div class="message_container" ng-repeat="message in currentConversation.messages">
                                <div class="message_container_head">
                                    <a href="/profile/{{ message.participant | mapById: currentConversation.participants:'user_id' }}">{{ message.participant | mapById: currentConversation.participants:'user.username' }}</a>
                                    <span>{{ message.created_at}}</span>
                                </div>
                                <div class="message_container_body">
                                    <ng-embed embed-data="message.body" embed-options="embedOptions"/></ng-embed>
                                </div>
                            </div>

                        </div>

                        <div class="message_input_wrapper" style="background-color: #f6f7f9;">

                            <div class="form-group message_input" style="background-color: white;">
                                <form ng-submit="submitMessage()">
                                    <div class="message_input_row1" style="border-top: 1px solid #ccc; border-right: 1px solid #ccc; border-left: 1px solid #ccc; border-bottom: 1px solid #e6e6e6;">
                                        <textarea id="message_input_field" style="border: none;" class="form-control" rows="3" placeholder="Write a message..."></textarea>
                                    </div>
                                    <div class="message_input_row2 text-right" style="border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; border-left: 1px solid #ccc;">
                                        <button class="btn btn-primary" style="border: none;">Send Message</button>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Create New Message Modal -->
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
