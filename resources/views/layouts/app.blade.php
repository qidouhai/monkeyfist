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
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="color: white; font-size: xx-large; font-weight: bold; padding-top: 25px; padding-bottom: 35px; font-family: Bungee Inline;" href="/">Monkeyfist</a>
            </div>
        </div>
    </nav>

    @yield('content')


    <div class="container">

        <hr>

        <a href="/">Return to Login</a>

    </div>

    <script type="text/javascript" src="/lib/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="/lib/bootstrap/dist/js/bootstrap.js"></script>
</body>
</html>
