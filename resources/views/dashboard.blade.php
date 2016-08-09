@extends('layouts.internal')

@section('content')

    <div class="container-fluid">

        @for($x = 0; $x < 10; $x++)
            <div class="panel panel-default feed">
                <div class="panel-heading feed-header">
                    <table style="width: 100%;">
                    <tr>
                        <td rowspan="2" style="width: 5%; padding-right: 5px;"><img src="{{URL::asset('/img/default-profile.png')}}" height="48" class="img-rounded"></td>
                        <td><a href="#">{{ $user->username }}</a></td>
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
                        <td>{{ $feeds[$x]->created }}</td>
                    </tr>
                    </table>
                </div>
                <div class="panel-body" style="padding-bottom: 0px;">
                    <div class="feed-content">
                        {!! $feeds[$x]->content !!}
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
                    <div class="feed-footer-comment row">
                        <div class="comment-image col-lg-1">
                            <a href="#">
                                <img src="{{URL::asset('/img/default-profile.png')}}" class="img-rounded" height="32">
                            </a>
                        </div>
                        <div class="comment-non-image col-lg-10">
                            <span class="comment-user">
                                <a href="#">{{ $user->username }}</a>
                            </span>
                            <span class="comment-text">
                                Lorem ipsum dolores de la vagina.
                            </span>
                            <span class="comment-date">
                                <br>15.02.1992 15:46
                            </span>
                        </div>
                    </div>

                    <!-- Comment input -->
                    <div class="comment-input row">
                        <div class="comment-image col-lg-1">
                            <a href="#">
                                <img src="{{URL::asset('/img/default-profile.png')}}" class="img-rounded" height="32">
                            </a>
                        </div>
                        <div class="input-group col-lg-11" style="left: -20px;">
                            <input type="text" class="form-control" placeholder="Comment..." name="comment">
                        </div>
                    </div>

                </div>
            </div>
        @endfor

        <div class="panel panel-default" style="width: 80%; margin: auto;" class="feed">
            <div class="panel-heading feed-header">
                <table style="width: 100%;">
                <tr>
                    <td rowspan="2" style="width: 5%; padding-right: 5px;"><img src="{{URL::asset('/img/default-profile.png')}}" height="48" class="img-rounded"></td>
                    <td><a href="#">{{ $user->username }}</a></td>
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
                    <td>15.02.1992 16:54</td>
                </tr>
                </table>
            </div>
            <div class="panel-body" style="padding-bottom: 0px;">
                <div class="feed-content">
                    Ray Charles goes Country
                    <iframe src="//www.youtube.com/embed/x8A9Y1Dq_cQ" allowfullscreen="" frameborder="0"></iframe>
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
                <div class="feed-footer-comment row">
                    <div class="comment-image col-lg-1">
                        <a href="#">
                            <img src="{{URL::asset('/img/default-profile.png')}}" class="img-rounded" height="32">
                        </a>
                    </div>
                    <div class="comment-non-image col-lg-10">
                        <span class="comment-user">
                            <a href="#">{{ $user->username }}</a>
                        </span>
                        <span class="comment-text">
                            Lorem ipsum dolores de la vagina.
                        </span>
                        <span class="comment-date">
                            <br>15.02.1992 15:46
                        </span>
                    </div>
                </div>

                <!-- Comment input -->
                <div class="comment-input row">
                    <div class="comment-image col-lg-1">
                        <a href="#">
                            <img src="{{URL::asset('/img/default-profile.png')}}" class="img-rounded" height="32">
                        </a>
                    </div>
                    <div class="input-group col-lg-11" style="left: -20px;">
                        <input type="text" class="form-control" placeholder="Comment..." name="comment">
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
