
<div ng-if="displayNavbar" ng-include="templates.navbar" ng-controller="NavbarController"></div>

<!-- Create Post Panel -->
<div class="panel panel-default" style="width: 80%; margin: 15px auto;" ng-if="displayPostInput">
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
                        <button type="button" data-toggle="modal" data-target="#insertImageModal" onclick="insertImageFactory.reset()" title="Insert Image" class="btn btn-default"><i class="fa fa-upload" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-md-8 text-right">
                <button type="button" title="Publish Post" ng-click="publishPost()" class="btn btn-success">Publish</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Image To Post Modal -->
<div class="modal fade" id="insertImageModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Image</h4>
            </div>
            <div class="modal-body" id="insertImageModal_selection">
                <div class="list-group">
                    <a href="#" class="list-group-item" onclick="insertImageFactory.select('uploadImage')">
                        <h4 class="list-group-item-heading">Upload Image</h4>
                        <p class="list-group-item-text">Upload an image from your device to Monkeyfist.</p>
                    </a>
                    <a href="#" class="list-group-item" onclick="insertImageFactory.select('uploadVideo')">
                        <h4 class="list-group-item-heading">Upload Video</h4>
                        <p class="list-group-item-text">Upload a video from your device to Monkeyfist.</p>
                    </a>
                </div>
            </div>
            <!-- Insert from URL body -->
            <div class="modal-body" id="insertImageModal_imageURL">
                <div class="form-group">
                    <label for="inputImageURL">Image URL</label>
                    <input type="url" class="form-control" id="inputImageURL" placeholder="URL">
                </div>
            </div>
            <!-- Upload Image body -->
            <div class="modal-body" id="insertImageModal_uploadImage">
                <div class="dropzone" dropzone="dropzoneConfig" id="insertImageModal_dropzone"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onclick="insertImageFactory.next()" id="insertImageModal_submit" class="btn btn-primary">Add to Post</button>
            </div>
        </div>
    </div>
</div>

<div ng-repeat="feed in feeds">

    <div class="panel panel-default feed">
        <div class="panel-heading feed-header">
            <table style="width: 100%;">
            <tr>
                <td rowspan="2" style="width: 5%; padding-right: 5px;"><img src="/img/default-profile.png" height="48" class="img-rounded"></td>
                <td><a href="#">{{ feed.user.username}}</a></td>
                <td rowspan="2" style="text-align: right;">
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="border: none; background-color: inherit;">
                            <!-- Name of Drodown Menu -->
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                            <li><a href="#"  ng-click="removeFeed(feed.id)">Remove</a></li>
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
            <div class="feed-content" ng-bind-html="feed.content | mediaEmbed">
            	<!-- Feed Content -->
             </div>
             <div class="feed-links">
                <hr>
                <ul ng-if="feed.votes.length == 0">
                    <li><a href="#" ng-click="like(feed.id)">Thumbs Up <i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>
                    <li><span>&nbsp;-&nbsp;</span></li>
                    <li><a href="#" ng-click="dislike(feed.id)">Thumbs Down <i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a></li>
                    <li><span>&nbsp;-&nbsp;</span></li>
                    <li><a href="#" ng-click="focus(feed.id)">Comment <i class="fa fa-comment-o" aria-hidden="true"></i></a></li>
                </ul>
                <ul ng-if="feed.votes.length == 1 && feed.votes[0].like == 1">
                    <li><a href="#" ng-click="unlike(feed.id)" title="Unlike">You like it&nbsp;<i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>
                    <li><span>&nbsp;-&nbsp;</span></li>
                    <li><a href="#" ng-click="focus(feed.id)">Comment <i class="fa fa-comment-o" aria-hidden="true"></i></a></li>
                </ul>
                <ul ng-if="feed.votes.length == 1 && feed.votes[0].like == 0">
                    <li><a href="#" ng-click="undislike(feed.id)" title="Undislike">You don't like it&nbsp;<i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>
                    <li><span>&nbsp;-&nbsp;</span></li>
                    <li><a href="#" ng-click="focus(feed.id)">Comment <i class="fa fa-comment-o" aria-hidden="true"></i></a></li>
                </ul>
             </div>
        </div>
        <div class="panel-footer feed-footer">
            <!-- Overview of likes, disliked and comment -->
            <ul>
                <li><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i>&nbsp;{{ feed.likes.count == null ? 0 : feed.likes.count }}</a></li>
                <li><a href="#"><i class="fa fa-thumbs-down" aria-hidden="true"></i>&nbsp;{{ feed.dislikes.count == null ? 0 : feed.dislikes.count }}</a></li>
                <li><a href="#"><i class="fa fa-comment" aria-hidden="true"></i>&nbsp;{{ feed.comment_count.count == null ? 0 : feed.comment_count.count}}</a></li>
            </ul>
            
            <!--Comment List-->
            <div ng-repeat="comment in feed.comments">
                <div class="input-group feed-footer-comment">
                    <a href="/profile/{{ comment.user.id }}" class="input-group-addon" id="comment-{{ comment.id}}" style="padding: 0px 6px;background-color:inherit;border:none;vertical-align:top;">
                        <img src="/img/default-profile.png" width="34" height="34" style="border:1px solid #ccc; background-color:white;">
                    </a>
                    <div class="" aria-describedby="comment-{{ comment.id}}">
                        <span class="comment-user">
                            <a href="/profile/{{ comment.user.id }}">
                                {{ comment.user.username }}
                            </a>
                        </span>
                        <span class="comment-text" style="word-wrap:break-word;">
                            {{ comment.content}}
                        </span>
                        <span class="comment-date">
                            {{ comment.created}}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Comment input -->
            <form ng-submit="submitComment(feed.id)">
                <div class="input-group">
                    <a href="#" class="input-group-addon" id="comment-input-{{ feed.id}}" style="padding: 0px 6px;background-color:inherit;border:none;">
                        <img src="/img/default-profile.png" width="34" height="34" style="border:1px solid #ccc; background-color:white;">
                    </a>
                    <input type="text" class="form-control" placeholder="Comment..." aria-describedby="comment-input-{{ feed.id}}" id="comment-text-{{ feed.id}}">
                </div>
            </form>

        </div>
    </div>

</div>

<div class="well" id="feedloader" ng-if="!noMoreFeeds">
    <a href="" ng-click="getFeeds()">I want more!</a>
</div>
