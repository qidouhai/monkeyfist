<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <base href="/">

    <title>Monkeyfist</title>

    <link rel="stylesheet" href="/lib/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/lib/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/lib/select2/dist/css/select2.css">
    <link href='http://fonts.googleapis.com/css?family=Bungee+Inline|Kalam' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/style.css">

</head>
<body id="app-layout" ng-app="internal">
    <nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: #800000">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="/" style="padding-top: 7px;">
                    <img alt="Brand" src="{{URL::asset('/img/monkeyfist_thumbnail.png')}}" class="img-rounded" height="37" style="margin-top: 1px;">
                </a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div id="internal_navbar" class="collapse navbar-collapse">
                <form class="navbar-form navbar-left">
                    <div class="input-group">
                        <select class="search-bar form-control" multiple="multiple" style="width: 300px;">
                        </select>
                        <!-- <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                        </span> -->
                    </div>
                </form>
                <div class="navbar_links">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="/profile/{{ $user->id }}" title="Profile">{{ $user->prename }}</a></li>
                        <li><a href="/dashboard" title="Dashboard">Dashboard</a></li>
                        <li><a href="#" title="Friend Requests"><i class="fa fa-user-plus"></i></a></li>
                        <li><a href="#" title="Messages"><i class="fa fa-envelope-o"></i></a></li>
                        <li><a href="/logout" title="Sign Out"><i class="fa fa-sign-out"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        @yield('content')
    </div>
    <div class="container-fluid" ng-view>

    </div>

    <script type="text/javascript" src="/lib/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="/lib/bootstrap/dist/js/bootstrap.js"></script>
    <script type="text/javascript" src="/lib/moment/moment.js"></script>
    <script type="text/javascript" src="/lib/select2/dist/js/select2.full.js"></script>
    <script type="text/javascript" src="/lib/bootbox.js/bootbox.js"></script>
    <script type="text/javascript" src="/lib/angular/angular.js"></script>
    <script type="text/javascript" src="/lib/angular-route/angular-route.js"></script>

    <!-- Custom Scripts -->
    <script type="text/javascript" src="/js/Search.js"></script>

    <!-- Angular Controller -->
    <script type="text/javascript" src="/app/app.js"></script>
    <script type="text/javascript" src="/app/controller/DashboardController.js"></script>
    <script type="text/javascript" src="/app/controller/FeedController.js"></script>
    <script type="text/javascript" src="/app/controller/ProfileController.js"></script>
</body>
</html>
