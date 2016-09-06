<!-- <div class="container-fluid"> -->

	<div ng-include="'/app/templates/includes/navbar.php'" ng-controller="NavbarController"></div>

<!-- </div> -->

<div id="messenger">

	<!-- Sidebar -->
	<div id="messenger_sidebar">
		<ul class="sidebar-nav">
			<li class="sidebar-brand" ng-repeat="conversation in conversations">
				<a href="/messenger/{{ conversation.id }}">
					<div>
						<div style="display: inline-block;" ng-repeat="participant in conversation.participants">
                            <img src="/img/default-profile.png" height="32" />
                        </div>
                        <div style="display: inline-block;" ng-repeat="participant in conversation.participants">
                            <span style="font-size: large">{{ participant.user.username }},</span>
                        </div>
					</div>
				</a>
			</li>
		</ul>
	</div>

	<!-- Main -->
	<div id="messenger_content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
                    <div style="width: 70%;">

                        <div class="message_wrapper">

                            <div class="message_container">
                                <div class="message_container_head">
                                    <a href="/profile/1">Axel Virnich</a>
                                    <span>17.09.2016 12:38</span>
                                </div>
                                <div class="message_container_body">
                                    <p>Sample text!</p>
                                </div>
                            </div>

                        </div>

                        <div class="message_input" class="form-group">
                            <textarea class="form-control" rows="3" placeholder="Write a message..."></textarea>
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
                        <td><a href="/profile/{{ request.user.id }}"><img class="img-responsive" src="/img/default-profile.png" width="45" /></a></td>
                        <td style="vertical-align: middle;" class="text-left"><a href="/profile/{{ request.user.id }}">{{ request.user.username }}</a></td>
                        <td style="vertical-align: middle;"><span>{{ request.created }}</span></td>
                        <td style="vertical-align: middle;" class="text-right">
                            <button class="btn btn-primary" ng-click="answerFriendRequest(request.user.id, true)">Accept</button>
                            <button class="btn btn-warning" ng-click="answerFriendRequest(request.user.id, false)">Deny</button>
                        </td>
                    </tr>
                    <tr ng-repeat="friend in social.friends">
                        <td><a href="/profile/{{ friend.user.id }}"><img class="img-responsive" src="/img/default-profile.png" width="45"></a></td>
                        <td style="vertical-align: middle;" class="text-left"><a href="/profile/{{ friend.user.id }}">{{ friend.user.username }}</a></td>
                        <td style="vertical-align: middle;"><span>{{ friend.created }}</span></td>
                        <td style="vertical-align: middle;" class="text-right">
                            <button class="btn btn-warning" ng-click="unfriend(friend.user.id)">Unfriend</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>