
<!-- User metadata -->
<div style="margin: auto; border: 1px solid black; width: 80%;">
	<div class="row" style="height: inherit;">
		<div class="col-md-3 text-center" style="padding-right: 0px;">
			<img src="/img/default-profile.png" class="img-responsive center-block img-circle" width="175" height="175" style="vertical-align: center;" />
		</div>
		<div class="col-md-9" style="padding-left: 0px;">
			<table class="table" style="margin-bottom: 0px;">
				<tr>
					<td colspan="3" class="text-center"><a href="#" style="font-size: x-large; color: #800000;"> {{ info.user.username }}</a></td>
				</tr>
				<tr>
					<th>Member since</th>
					<td colspan="2">{{ info.user.created_at }}</td>
				</tr>
				<tr>
					<th>Born on</th>
					<td colspan="2">{{ info.user.birthday }}</td>
				</tr>
				<tr>
					<td colspan="3" class="text-right">
						<div class="btn-group" ng-if="info.self">
							<button type="button" data-toggle="modal" data-target="#friendsList" class="btn btn-default">My Friends&nbsp;<i class="fa fa-users" aria-hidden="true"></i></button>
							<button type="button" class="btn btn-default">Messages&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i></button>
							<button type="button" class="btn btn-default">Settings&nbsp;<i class="fa fa-cog" aria-hidden="true"></i></button>
						</div>
						<div class="btn-group" ng-if="!info.self && info.relation.friends">
							<button type="button" class="btn btn-default">{{ info.user.prename }}'s Friends&nbsp;<i class="fa fa-users" aria-hidden="true"></i></button>
							<button type="button" class="btn btn-default">Send Message&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i></button>
							<button type="button" disabled="disabled" class="btn btn-default">Friends&nbsp;<i class="fa fa-check" aria-hidden="true"></i></button>
						</div>
						<div class="btn-group" ng-if="!info.self && !info.relation.friends && info.relation.status=='requested' && info.relation.requestedByMe">
							<button type="button" class="btn btn-default">{{ info.user.prename }}'s Friends&nbsp;<i class="fa fa-users" aria-hidden="true"></i></button>
							<button type="button" class="btn btn-default">Send Message&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i></button>
							<button type="button" disabled="disabled" class="btn btn-default">Request Sent&nbsp;<i class="fa fa-check" aria-hidden="true"></i></button>
						</div>
						<div class="btn-group" ng-if="!info.self && !info.relation.friends && info.relation.status=='requested' && !info.relation.requestedByMe">
							<button type="button" class="btn btn-default">{{ info.user.prename }}'s Friends&nbsp;<i class="fa fa-users" aria-hidden="true"></i></button>
							<button type="button" class="btn btn-default">Send Message&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i></button>
							<button type="button" ng-click="answerFriendRequest(true)" class="btn btn-default">Accept Request&nbsp;<i class="fa fa-thumbs-up" aria-hidden="true"></i></button>
						</div>
						<div class="btn-group" ng-if="!info.self && info.relation.status == 'guest'">
							<button type="button" class="btn btn-default">{{ info.user.prename }}'s Friends&nbsp;<i class="fa fa-users" aria-hidden="true"></i></button>
							<button type="button" class="btn btn-default">Send Message&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i></button>
							<button type="button" ng-click="sendFriendRequest()" class="btn btn-default">Send Friend Request&nbsp;<i class="fa fa-smile-o" aria-hidden="true"></i></button>
						</div>
					</td>
				</tr>
			</table>	
		</div>
	</div>
</div>

<div class="modal fade" id="friendsList" tabindex="-1" role="dialog">
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
					<tr>
						<td><a href="/profile/6"><img class="img-responsive" src="/img/default-profile.png" width="45" /></a></td>
						<td style="vertical-align: middle;" class="text-left"><a href="/profile/6">Axel Virnich</a></td>
						<td style="vertical-align: middle;"><span>20.07.2016</span></td>
						<td style="vertical-align: middle;" class="text-right"><button class="btn btn-danger">Unfriend</button></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>

<div ng-include="templates.feeds" ng-controller="FeedController"></div>