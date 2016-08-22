
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
							<button type="button" class="btn btn-default">Settings&nbsp;<i class="fa fa-cog" aria-hidden="true"></i></button>
						</div>
						<div class="btn-group profile_buttons" ng-if="!info.self && info.relation.friends">
							<button type="button" class="btn btn-default">{{ info.user.prename }}'s Friends&nbsp;<i class="fa fa-users" aria-hidden="true"></i></button>
							<button type="button" class="btn btn-default">Send Message&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i></button>
							<button type="button" disabled="disabled" class="btn btn-default">Friends&nbsp;<i class="fa fa-check" aria-hidden="true"></i></button>
						</div>
						<div class="btn-group profile_buttons" ng-if="!info.self && !info.relation.friends && info.relation.status=='requested' && info.relation.requestedByMe">
							<button type="button" class="btn btn-default">{{ info.user.prename }}'s Friends&nbsp;<i class="fa fa-users" aria-hidden="true"></i></button>
							<button type="button" class="btn btn-default">Send Message&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i></button>
							<button type="button" disabled="disabled" class="btn btn-default">Request Sent&nbsp;<i class="fa fa-check" aria-hidden="true"></i></button>
						</div>
						<div class="btn-group profile_buttons" ng-if="!info.self && !info.relation.friends && info.relation.status=='requested' && !info.relation.requestedByMe">
							<button type="button" class="btn btn-default">{{ info.user.prename }}'s Friends&nbsp;<i class="fa fa-users" aria-hidden="true"></i></button>
							<button type="button" class="btn btn-default">Send Message&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i></button>
							<button type="button" ng-click="answerFriendRequest(true)" class="btn btn-default">Accept Request&nbsp;<i class="fa fa-thumbs-up" aria-hidden="true"></i></button>
						</div>
						<div class="btn-group profile_buttons" ng-if="!info.self && info.relation.status == 'guest'">
							<button type="button" class="btn btn-default">{{ info.user.prename }}'s Friends&nbsp;<i class="fa fa-users" aria-hidden="true"></i></button>
							<button type="button" class="btn btn-default">Send Message&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i></button>
							<button type="button" ng-click="sendFriendRequest()" class="btn btn-default">Send Friend Request&nbsp;<i class="fa fa-smile-o" aria-hidden="true"></i></button>
						</div>
					</div>
	    		</div>
	    	</div>
	    </div>
	</div>

	<div ng-include="'/app/templates/feed.php'" ng-controller="FeedController"></div>

</div>