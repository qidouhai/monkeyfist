@extends('layouts.inside')

@section('content')

    <div class="content row" ng-controller="FeedController">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-default create-feed-panel">
                <div class="panel-heading create-feed-header">
                    <h3 style="margin: 0px auto;">Create new Post</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <textarea class="form-control" id="feed_content" rows="5"
                                  placeholder="Write a post..."></textarea>
                    </div>
                </div>
                <div class="panel-footer create-feed-footer">
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="btn-toolbar" role="toolbar">
                                {{--<div class="btn-group" role="group">--}}
                                {{--<button type="button" data-toggle="modal" data-target="#insertImageModal"--}}
                                {{--onclick="insertImageFactory.reset()" title="Insert Image"--}}
                                {{--class="btn btn-default"><i class="fa fa-upload" aria-hidden="true"></i>--}}
                                {{--</button>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                        <div class="col-xs-8 text-right">
                            <button type="button" title="Publish Feed" ng-click="publishFeed()" class="btn btn-success">
                                Publish
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @verbatim
        <div class="col-md-12">
            <div class="panel panel-default feed-panel" ng-repeat="feed in feeds">
                <div class="panel-heading feed-header">
                    <table style="width: 100%;">
                        <tr>
                            <td rowspan="2" style="width: 5%; padding-right: 5px;">
                                <img src="" class="img-thumbnail" style="width:48px;height:48px;">
                            </td>
                            <td><a href="#">{{ feed.user.username  }}</a></td>
                            <td ng-if="feed.user.id === user.id" rowspan="2" style="text-align: right;">
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"
                                            style="border: none; background-color: inherit;">
                                        <!-- Name of Drodown Menu -->
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                        <li><a href="#">Remove</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="feed-date" title="{{ feed.created_at }}">{{ feed.created_at | formatTime }}</span></td>
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
                            <li><a href="#">Thumbs Up <i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>
                            <li><span>&nbsp;-&nbsp;</span></li>
                            <li><a href="#">Thumbs Down <i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a></li>
                            <li><span>&nbsp;-&nbsp;</span></li>
                            <li><a href="#">Comment <i class="fa fa-comment-o" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-footer feed-footer">
                    <!-- Overview of likes, disliked and comment -->
                    <ul>
                        <li><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i>&nbsp0</a></li>
                        <li><a href="#"><i class="fa fa-thumbs-down" aria-hidden="true"></i>&nbsp0</a></li>
                        <li><a href="#"><i class="fa fa-comment" aria-hidden="true"></i>&nbsp{{ feed.comments.length }}</a></li>
                    </ul>

                    <!--Comment List-->
                    <div>
                        <div class="input-group feed-footer-comment" ng-repeat="comment in feed.comments">
                            <a href="/profile/{{ comment.user.id }}" class="input-group-addon" id="comment-" style="padding: 0px 6px;background-color:inherit;border:none;vertical-align:top;">
                                <img src="" style="border:1px solid #ccc; background-color:white; width: 34px; height: 34px;">
                            </a>
                            <div class="comment-wrapper" aria-describedby="comment-">
                                <span class="comment-user">
                                    <a href="/profile/{{ comment.user.id }}">
                                        {{ comment.user.username }}
                                    </a>
                                </span>
                                <span class="comment-text" style="word-wrap:break-word;" ng-bind-html="comment.content | mediaEmbed: false">
                                </span>
                                <span class="comment-date" title="{{ comment.created_at }}">
                                    <br/>{{ comment.created_at | formatTime }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Comment input -->
                    <form ng-submit="submitComment(feed.id)">
                        <div class="input-group">
                            <a href="#" class="input-group-addon" id="comment-input-"
                               style="padding: 0px 6px;background-color:inherit;border:none;">
                                <img src=""
                                     style="border:1px solid #ccc; background-color:white; width:34px; height: 34px;">
                            </a>
                            <input type="text" class="form-control" placeholder="Comment..." aria-describedby="comment-input-" id="comment-text-{{ feed.id }}">
                        </div>
                    </form>

                </div>

            </div>

            <div class="well col-md-12" id="feedloader" ng-if="moreFeeds">
                <a href="" ng-click="getFeeds()">I want more!</a>
            </div>

        </div>
        @endverbatim


    </div>

@endsection