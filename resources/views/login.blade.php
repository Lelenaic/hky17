<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="description" content="Miminium Admin Template v.1">
    <meta name="author" content="Isna Nur Azis">
    <meta name="keyword" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hackath'yon login</title>

    <!-- start: Css -->
    <link rel="stylesheet" type="text/css" href="/asset/css/bootstrap.min.css">

    <!-- plugins -->
    <link rel="stylesheet" type="text/css" href="/asset/css/plugins/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="/asset/css/plugins/simple-line-icons.css"/>
    <link rel="stylesheet" type="text/css" href="/asset/css/plugins/animate.min.css"/>
    <link rel="stylesheet" type="text/css" href="/asset/css/plugins/icheck/skins/flat/aero.css"/>
    <link href="/asset/css/style.css" rel="stylesheet">
    <!-- end: Css -->

    <link rel="shortcut icon" href="/asset/img/logomi.png">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="mimin" class="dashboard form-signin-wrapper">

<div class="container">

    <form class="form-signin" action="{{route('loginPost')}}" method="post">
        {{csrf_field()}}
        <div class="panel periodic-login">
            <div class="panel-body text-center">
                <h1 class="atomic-symbol">HK</h1>
                <p class="element-name">Hackath'yon</p>
                <i class="icons icon-arrow-down"></i>
                @include('layout.errors')
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="text" name="username" class="form-text" required>
                    <span class="bar"></span>
                    <label>Nom d'utilisateur</label>
                </div>
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="password" name="password" class="form-text" required>
                    <span class="bar"></span>
                    <label>Mot de passe</label>
                </div>
                <label class="pull-left">
                    <input type="checkbox" class="icheck pull-left" name="checkbox1"/> Se souvenir de moi
                </label>
                <input type="submit" class="btn col-md-12" value="SignIn"/>
            </div>
            <div class="text-center" style="padding:5px;">
                <a href="forgotpass.html">Mot de passe oublié </a>
                <a href="reg.html">| Inscription</a>
            </div>
        </div>
    </form>

</div>

<!-- end: Content -->
<!-- start: Javascript -->
<script src="/asset/js/jquery.min.js"></script>
<script src="/asset/js/jquery.ui.min.js"></script>
<script src="/asset/js/bootstrap.min.js"></script>

<script src="/asset/js/plugins/moment.min.js"></script>
<script src="/asset/js/plugins/icheck.min.js"></script>

<!-- custom -->
<script src="/asset/js/main.js"></script>
<script src="/js/laroute.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_flat-aero',
            radioClass: 'iradio_flat-aero'
        });

        console.log(laroute.route('test', {name: 'Pierre'}));
    });
</script>
<!-- end: Javascript -->
</body>
</html>