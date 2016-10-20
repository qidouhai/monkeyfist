<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <base href="/">

    <title>Monkeyfist</title>

    <!--
        IE8 support, see AngularJS Internet Explorer Compatibility http://docs.angularjs.org/guide/ie
        For Firefox 3.6, you will also need to include jQuery and ECMAScript 5 shim
    -->
    <!--[if lt IE 9]>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/es5-shim/2.2.0/es5-shim.js"></script>
        <script>
        document.createElement('ui-select');
        document.createElement('ui-select-match');
        document.createElement('ui-select-choices');
        </script>
    <![endif]-->
    <link rel="stylesheet" href="/lib/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/lib/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/lib/angular-ui-select/dist/select.css">
    <link rel="stylesheet" href="/lib/select2/dist/css/select2.css">
    <link rel="stylesheet" type="text/css" href="/lib/dropzone/dist/dropzone.css">
    <link href='http://fonts.googleapis.com/css?family=Bungee+Inline|Kalam' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/style.css">

</head>
<body id="app-layout" ng-app="internal">

    <div ng-view>

    </div>

    <!-- Frameworks and Libraries -->
    <script type="text/javascript" src="/lib/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="/lib/bootstrap/dist/js/bootstrap.js"></script>
    <script type="text/javascript" src="/lib/moment/moment.js"></script>
    <script type="text/javascript" src="/lib/bootbox.js/bootbox.js"></script>
    <script type="text/javascript" src="/lib/dropzone/dist/dropzone.js"></script>
    <script type="text/javascript" src="/lib/angular/angular.js"></script>
    <script type="text/javascript" src="/lib/angular-route/angular-route.js"></script>
    <script type="text/javascript" src="/lib/angular-sanitize/angular-sanitize.js"></script>
    <script type="text/javascript" src="/lib/angular-ui-select/dist/select.js"></script>
    <script type="text/javascript" src="/lib/angular-scroll-glue/src/scrollglue.js"></script>
    <script type="text/javascript" src="/lib/socket.io-client/socket.io.js"></script>

    <!-- Custom Scripts -->
    <script type="text/javascript" src="/js/InsertImageToPost.js"></script>
    <script type="text/javascript" src="/js/SettingsFactory.js"></script>

    <!-- Angular App -->
    <script type="text/javascript" src="/app/app.js"></script>

    <!-- Angular Services -->
    <script type="text/javascript" src="/app/services/socialService.js"></script>
    <script type="text/javascript" src="/app/services/msgService.js"></script>
    <script type="text/javascript" src="/app/services/socketService.js"></script>
    <script type="text/javascript" src="/app/services/settingService.js"></script>

    <!-- Angular Controller -->
    <script type="text/javascript" src="/app/controller/NavbarController.js"></script>
    <script type="text/javascript" src="/app/controller/DashboardController.js"></script>
    <script type="text/javascript" src="/app/controller/FeedController.js"></script>
    <script type="text/javascript" src="/app/controller/ProfileController.js"></script>
    <script type="text/javascript" src="/app/controller/MessengerController.js"></script>
</body>
</html>
