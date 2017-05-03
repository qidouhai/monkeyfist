<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Monkeyfist</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">

    <!-- css -->
    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('css/emoticons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('bower_components/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css">

</head>
<body ng-app="internal">


@section('navbar')

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="navbar-top-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">M</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-top-collapse">
                <form class="navbar-form navbar-left">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search" id="navbar-top-input">
                    </div>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/profile">{{ $user->username }}</a></li>
                    <li><a href="/dashboard">Dashboard</a></li>
                    <li><a href="#"><i class="fa fa-users" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
                    <li>
                        <form action="/logout" method="post" id="logout-form">
                            {{ csrf_field() }}
                            <button type="submit" role="link" class="btn btn-link"><i class="fa fa-sign-out" aria-hidden="true"></i></button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

@show


    <div class="container" style="padding:0px;">

        @yield('content')

    </div>
</div>


<!-- Scripts -->
<script src="{{ URL::asset('js/app.js') }}"></script>
<script src="{{ URL::asset('js/dashboard.js') }}"></script>
{{--<script src="{{ URL::asset('bower_components/moment/moment.js') }}"></script>--}}
{{--<script src="{{ URL::asset('bower_components/angular/angular.js') }}"></script>--}}
{{--<script src="{{ URL::asset('bower_components/angular-resource/angular-resource.js') }}"></script>--}}
{{--<script src="{{ URL::asset('bower_components/angular-sanitize/angular-sanitize.js') }}"></script>--}}

{{--<script src="{{ URL::asset('js/main.js') }}"></script>--}}

{{-- Angular Services --}}
{{--<script src="{{ URL::asset('js/services/feedService.js') }}"></script>--}}

{{-- Angular Filters --}}
{{--<script src="{{ URL::asset('js/filters/mediaEmbed.js') }}"></script>--}}
{{--<script src="{{ URL::asset('js/filters/util.js') }}"></script>--}}

{{-- Angular Controller --}}
{{--<script src="{{ URL::asset('js/controllers/FeedController.js') }}"></script>--}}

</body>
</html>
