<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Monkeyfist</title>

    <link rel="stylesheet" href="/lib/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/lib/bootstrap/dist/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Bungee+Inline|Kalam' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/style.css">

</head>
<body id="app-layout">
    <nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: #800000">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="/" style="padding-top: 7px;">
                    <img alt="Brand" src="{{URL::asset('/img/monkeyfist_thumbnail.png')}}" class="img-rounded" height="35">
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
                    <div class="input-group" style="width: 125%;">
                        <input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">{{ $user->prename }}</a></li>
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#"><i class="fa fa-envelope"></i> Messages</a></li>
                    <li><a href="/logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <script type="text/javascript" src="/lib/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="/lib/bootstrap/dist/js/bootstrap.js"></script>
</body>
</html>
