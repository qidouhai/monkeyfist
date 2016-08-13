
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
							<button type="button" class="btn btn-default">My Friends&nbsp;<i class="fa fa-users" aria-hidden="true"></i></button>
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
							<button type="button" class="btn btn-default">Accept Request&nbsp;<i class="fa fa-thumbs-up" aria-hidden="true"></i></button>
						</div>
						<div class="btn-group" ng-if="!info.self && info.relation.status == 'guest'">
							<button type="button" class="btn btn-default">{{ info.user.prename }}'s Friends&nbsp;<i class="fa fa-users" aria-hidden="true"></i></button>
							<button type="button" class="btn btn-default">Send Message&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i></button>
							<button type="button" class="btn btn-default">Send Friend Request&nbsp;<i class="fa fa-smile-o" aria-hidden="true"></i></button>
						</div>
					</td>
				</tr>
			</table>	
		</div>
	</div>
</div>

<!-- Create Post Panel -->
<div class="panel panel-default" style="width: 80%; margin: 15px auto;" ng-if="info.self">
	<div class="panel-heading">
        <h3 style="margin: 0px auto;">Create new Post</h3>
    </div>
    <div class="panel-body">
    	<div class="form-group">
    		<textarea class="form-control" id="post_content" rows="5" placeholder="Write a post..."></textarea>
    	</div>
    </div>
    <div class="panel-footer">
    	<div class="row">
    		<div class="col-md-4" >
    			<div class="btn-toolbar" role="toolbar">
    				<div class="btn-group" role="group">
    					<button type="button" ng-click="addLinkToPost()" title="Insert Link" class="btn btn-default"><i class="fa fa-link" aria-hidden="true"></i></button>
    					<button type="button" ng-click="addYoutubeToPost()" title="Insert Youtube Video" class="btn btn-default"><i class="fa fa-youtube" aria-hidden="true"></i></button>
    					<button type="button" title="Insert Image" class="btn btn-default"><i class="fa fa-picture-o" aria-hidden="true"></i></button>
    				</div>
    			</div>
    		</div>
    		<div class="col-md-8 text-right">
    			<button type="button" title="Publish Post" ng-click="publishPost()" class="btn btn-success">Publish</button>
    		</div>
    	</div>
    </div>
</div>

<!-- User's feeds -->
<div ng-repeat="feed in feeds" ng-if="info.self || info.relation.friends">

	<div class="panel panel-default feed">
        <div class="panel-heading feed-header">
            <table style="width: 100%;">
            <tr>
                <td rowspan="2" style="width: 5%; padding-right: 5px;"><img src="/img/default-profile.png" height="48" class="img-rounded"></td>
                <td><a href="#">{{ feed.user.username }}</a></td>
                <td rowspan="2" style="text-align: right;">
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="border: none; background-color: inherit;">
                            <!-- Name of Drodown Menu -->
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                            <li><a href="#">Remove Feed</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            <tr>
                <td>{{ feed.created | date:'medium' }}</td>
            </tr>
            </table>
        </div>
        <div class="panel-body" style="padding-bottom: 0px;">
            <div class="feed-content" ng-bind-html="feed.content | trustHTML">
            	<!-- Feed Content -->
             </div>
             <div class="feed-links">
                <hr>
                <ul>
                    <li><a href="#">Thumbs Up <i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>
                    <li><span>&nbsp;-&nbsp;</span></li>
                    <li><a href="#">Thumbs Down <i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a></li>
                    <li><span>&nbsp;-&nbsp;</span>
                    <li><a href="#">Comment <i class="fa fa-comment-o" aria-hidden="true"></i></a></li>
                </ul>
             </div>
        </div>
        <div class="panel-footer feed-footer">
            <!-- Overview of likes, disliked and comment -->
            <ul>
                <li><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i>&nbsp;3</a></li>
                <li><a href="#"><i class="fa fa-thumbs-down" aria-hidden="true"></i>&nbsp;0</a></li>
                <li><a href="#"><i class="fa fa-comment" aria-hidden="true"></i>&nbsp;23</a></li>
            </ul>
            <!-- Comments list -->
            <div ng-repeat="comment in feed.comments">
                <div class="feed-footer-comment row">
                    <div class="comment-image col-md-1">
                        <a href="#">
                            <img src="/img/default-profile.png" class="img-rounded" height="32">
                        </a>
                    </div>
                    <div class="comment-non-image col-md-10">
                        <span class="comment-user">
                            <a href="#">{{ comment.user.username }}</a>
                        </span>
                        <span class="comment-text">
                            {{ comment.content }}
                        </span>
                        <span class="comment-date">
                            <br>{{ comment.created }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Comment input -->
            <div class="comment-input row">
                <div class="comment-image col-md-1">
                    <a href="#">
                        <img src="/img/default-profile.png" class="img-rounded" height="32">
                    </a>
                </div>
                <div class="input-group col-md-10 comment-input-textfield">
                    <form ng-submit="submitComment( feed.id )">
                        <input type="text" class="form-control" id="comment-text-{{ feed.id }}" placeholder="Comment..." name="comment">
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="well" id="feedloader" ng-if="(info.self || info.relation.friends) && !noMoreFeeds">
    <a href="" ng-click="getFeeds()">Load more of {{ info.user.prename }}'s posts</a>
</div>