<div ng-repeat="feed in feeds">

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

<div class="well" id="feedloader">
    <a href="" ng-click="getFeeds()">I want more!</a>
</div>