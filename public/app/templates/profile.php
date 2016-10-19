
<div ng-include="'/app/templates/includes/navbar.php'" ng-controller="NavbarController"></div>

<div class="container-fluid">

	<!-- User metadata -->
	<div class="panel panel-default" style="width: 80%; margin: 15px auto;">
	    <div class="panel-heading">
	        <h2 class="text-center" style="margin: 0px auto;"><a href="/profile/{{ info.user.id }}">{{ info.user.username }}</a></h2>
	    </div>
	    <div class="panel-body">
	    	<div class="row">
	    		<div class="col-md-3 text-center" style="border-right: 1px solid #ddd;;">
	    			<img src="/img/default-profile.png" class="img-responsive center-block img-circle" width="150" height="150" style="vertical-align: center;" />
	    		</div>
	    		<div class="col-md-9 table-responsive">
	    			<table class="table" style="margin: 10px auto; font-size: medium; height: 100%;">
				        <tr style="height: 33%;">
					        <th>Member since</th>
					        <td>{{ info.user.created_at }}</td>
				        </tr>
				        <tr style="height: 33%;">
					        <th>Born on</th>
					        <td>{{ info.user.birthday }}</td>
				        </tr>
				        <tr>
				        	<td colspan="2" class="text-right">
				        	</td>
				        </tr>
			        </table>
			        <div class="text-right">
				        <div class="btn-group profile_buttons" ng-if="info.self">
							<button type="button" data-toggle="modal" data-target="#friends_list" class="btn btn-default">My Friends&nbsp;<i class="fa fa-users" aria-hidden="true"></i></button>
							<button type="button" class="btn btn-default">Messages&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i></button>
							<button type="button" data-toggle="modal" data-target="#settingsModal" class="btn btn-default">Settings&nbsp;<i class="fa fa-cog" aria-hidden="true"></i></button>
						</div>
						<div class="btn-group profile_buttons" ng-if="!info.self && info.relation.friends">
							<button type="button" class="btn btn-default">{{ info.user.prename }}'s Friends&nbsp;<i class="fa fa-users" aria-hidden="true"></i></button>
							<button type="button" ng-click="sendMessage(info.user.id)" class="btn btn-default">Send Message&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i></button>
							<button type="button" disabled="disabled" class="btn btn-default">Friends&nbsp;<i class="fa fa-check" aria-hidden="true"></i></button>
						</div>
						<div class="btn-group profile_buttons" ng-if="!info.self && !info.relation.friends && info.relation.status=='requested' && info.relation.requestedByMe">
							<button type="button" class="btn btn-default">{{ info.user.prename }}'s Friends&nbsp;<i class="fa fa-users" aria-hidden="true"></i></button>
							<button type="button" ng-click="sendMessage(info.user.id)" class="btn btn-default">Send Message&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i></button>
							<button type="button" disabled="disabled" class="btn btn-default">Request Sent&nbsp;<i class="fa fa-check" aria-hidden="true"></i></button>
						</div>
						<div class="btn-group profile_buttons" ng-if="!info.self && !info.relation.friends && info.relation.status=='requested' && !info.relation.requestedByMe">
							<button type="button" class="btn btn-default">{{ info.user.prename }}'s Friends&nbsp;<i class="fa fa-users" aria-hidden="true"></i></button>
							<button type="button" ng-click="sendMessage(info.user.id)" class="btn btn-default">Send Message&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i></button>
							<button type="button" ng-click="answerFriendRequest(true)" class="btn btn-default">Accept Request&nbsp;<i class="fa fa-thumbs-up" aria-hidden="true"></i></button>
						</div>
						<div class="btn-group profile_buttons" ng-if="!info.self && info.relation.status == 'guest'">
							<button type="button" class="btn btn-default">{{ info.user.prename }}'s Friends&nbsp;<i class="fa fa-users" aria-hidden="true"></i></button>
							<button type="button" ng-click="sendMessage(info.user.id)" class="btn btn-default">Send Message&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i></button>
							<button type="button" ng-click="sendFriendRequest()" class="btn btn-default">Send Friend Request&nbsp;<i class="fa fa-smile-o" aria-hidden="true"></i></button>
						</div>
					</div>
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
	                    <a href="#" class="list-group-item" onclick="settingsFactory.selectSettingGroup('notifications')">
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
										<p class="list-group-item-text">Change your family name.</p>
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
									<a href="#" class="list-group-item" onclick="settingsFactory.back(1)">
										<h4 class="list-group-item-heading"><i class="fa fa-arrow-left" aria-hidden="true"></i>
Return</h4>
										<p class="list-group-item-text">Return to last window without changes.</p>
									</a>
								</div>
							</div>

							<div class="modal-body" id="settingsModal_account_name">
								<form class="form-horizontal">
									<div class="form-group">
										<label for="input_prename" class="col-sm-4 control-label">Prename</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="input_prename" placeholder="Your Prename">
										</div>
									</div>
									<div class="form-group">
										<label for="input_lastname" class="col-sm-4 control-label">Lastname</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="input_lastname" placeholder="Lastname">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-4 col-sm-6">
											<button type="submit" class="btn btn-primary">Submit</button>
											<button type="button" class="btn btn-default" onclick="settingsFactory.back(2)">Back</button>
										</div>
									</div>
								</form>
							</div>

							<div class="modal-body" id="settingsModal_account_email">
								<form class="form-horizontal">
									<div class="form-group">
										<label for="input_currentEmail" class="col-sm-4 control-label">Current E-Mail</label>
										<div class="col-sm-6">
											<input type="email" class="form-control" id="input_currentEmail" value="{{ user.email }}" disabled="disabled">
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
											<button type="submit" class="btn btn-primary">Submit</button>
											<button type="button" class="btn btn-default" onclick="settingsFactory.back(2)">Back</button>
										</div>
									</div>
								</form>
							</div>

							<div class="modal-body" id="settingsModal_account_password">
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
											<button type="submit" class="btn btn-primary">Submit</button>
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
