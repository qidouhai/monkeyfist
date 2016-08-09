<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Monkeyfist</title>

    <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="lib/bootstrap/dist/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Bungee+Inline|Kalam' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: #800000">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="color: white; font-size: xx-large; font-weight: bold; padding-top: 25px; font-family: Bungee Inline;" href="#">Monkeyfist</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <form action="{{ url('/login') }}" method="POST">
                {{ csrf_field() }}
                    <table style="float: right; margin-top: 15px;">
                        <tr>
                            <td>
                                 <div class="form-group form-group-sm">
                                    <input type="email" class="form-control" placeholder="Email" name="email">
                                    <a href="#registration" style="color: white;">Not yet registered?</a>
                                </div>
                            </td>
                            <td>
                                 <div class="form-group form-group-sm">
                                    <input type="password" class="form-control" placeholder="Password" name="password">
                                    <a href="/password/reset" style="color: white;">Forgot password?</a>
                                </div>
                            </td>
                            <td colspan="1" style="vertical-align: top;">
                                <div class="form-group form-group-sm">
                                    <input type="submit" class="form-control" value="Login" name="">
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div style="width: 60%; margin: auto;">

                    <h1 style="font-size: 4em;" class="text-center">Welcome to Monkeyfist</h1>

                    <p style="font-size: x-large; font-color: #BDBDBD; padding: 5%;" class="text-center">
                        Monkeyfist is a small community of internet enthusiasts. We try to differentiate from the big social mass networks by taking care of the personal needs of our users. Our community is small yet powerful. We love what we do and if you do not believe, <a href="#registration">register below</a> and find out. And this is a banana, as bananas are not just delicious, but also very healthy.
                    </p>

                    <img class="center-block" src="{{URL::asset('/img/banana.png')}}" alt="This is where a banana should appear." class="img-rounded center">

                </div>

            </div>
        </div>

        <hr />

        <div class="row">
            <div class="col-md-12" id="registration">

                <div style="width: 60%; margin: auto;">

                    <h1 style="font-size: 4em;" class="text-center">Join us - it's free <i class="fa fa-smile-o fa-lg"></i></h1>

                    <form class="form-horizontal" action="{{ url('/register') }}" method="POST" role="form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-7">
                                <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" placeholder="Password" name="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password-repeat" class="col-sm-3 control-label">Repeat Password</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" placeholder="Repeat Password" name="password_confirmation">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="prename" class="col-sm-3 control-label">Prename</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="prename" placeholder="Don" name="prename">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">Lastname</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="lastname" placeholder="Quijote" name="lastname">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="birthday" class="col-sm-3 control-label">Birthday</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="birthday_day">
                                    @for ($i = 1; $i < 32; $i++)
                                        <option>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <select name="birthday_month" class="form-control">
                                    @for ($i = 1; $i < 13; $i++)
                                        <option>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <select name="birthday_year" class="form-control">
                                    @for ($i = 2016; $i > 1916; $i--)
                                        <option>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-7">
                                <button type="submit" style="width: 100%;" class="btn btn-default">Register</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>

        <hr>

    </div>

    <script type="text/javascript" src="/lib/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="/lib/bootstrap/dist/js/bootstrap.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>