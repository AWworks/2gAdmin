<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>2Go - Login Admin</title>

    <link href="{{URL::asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"/>

    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/base/jquery-ui.css" rel="stylesheet"/>

    <link rel="shortcut icon" href="http://admin:admin@bastisapp.com/kmrs/favicon.ico"/>

    <!--START Google FOnts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans|Podkova|Rosario|Abel|PT+Sans|Source+Sans+Pro:400,600,300|Roboto'
          rel='stylesheet' type='text/css'>
    <!--END Google FOnts-->

    <!--FONT AWESOME-->
    <link href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    <!--END FONT AWESOME-->

    <!--UIKIT-->
    <link href="{{URL::asset('assets/pe-icon-7-stroke/css/pe-icon-7-stroke.cs')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/dist/css/stylecrm.css')}}" rel="stylesheet"/>
    <!--UIKIT-->


</head>
<body style="background:#094255 !IMPORTANT;">

<div class="login-wrapper">

    <div class="container-center">
        <img src="assets/store-logo4.png" style="padding-left:90px;width:250px;padding-bottom:10px;">
        <div class="login-area">
            <div class="panel panel-bd panel-custom">
                <div class="panel-heading">
                    <div class="view-header">

                        <div class="header-title" style="margin-left:0;">
                            <h3>Login</h3>
                            <small><strong>Please enter your credentials to login.</strong></small>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    @yield('content')


                </div>
            </div>
        </div>
    </div>
</div>

</body>

<script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</html>
