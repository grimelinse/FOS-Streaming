<?php
include('config.php');
if(isset($_SESSION['user_id'])){
    header("location: dashboard.php");
}

$error='';
if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
    }
    else
    {
        $username = stripslashes($_POST['username']);
        $password = stripslashes($_POST['password']);

        $userfind = Admin::where('username', '=', $username)->where('password', '=', md5($password))->count();

        if ($userfind > 0) {
            $_SESSION['user_id'] = $username;
            header("location: dashboard.php");
        } else {

            $error = "Username or Password is invalid";

        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>FOS-Streaming panel by Tyfix</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    <link id="base-style" href="css/style.css" rel="stylesheet">
    <link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <link id="ie-style" href="css/ie.css" rel="stylesheet">
    <![endif]-->

    <!--[if IE 9]>
    <link id="ie9style" href="css/ie9.css" rel="stylesheet">
    <![endif]-->


    <link rel="shortcut icon" href="favicon.ico">
    <style type="text/css">
        body { background: #eee }
    </style>
</head>
<body>
<div class="container-fluid-full">
    <div class="row-fluid">


        <div class="row-fluid">


            <div class="login-box">
                <div class="box span12">
                    <?php
                        if($error != "") {
                            echo "<div class=\"alert alert-error\">
                                    " . $error . "
                                </div>";
                        }
                    ?>
                    <h1><b>FOS-Streaming panel</b></h1>
                </div>

                <h2>Login to your account</h2>
                <form class="form-horizontal" action="" method="post">

                    <fieldset>

                        <div class="input-prepend" title="Username">
                            <span class="add-on"><i class="halflings-icon user"></i></span>
                            <input class="input-large span10" name="username" id="username" type="text" placeholder="type username"/>
                        </div>
                        <div class="clearfix"></div>

                        <div class="input-prepend" title="Password">
                            <span class="add-on"><i class="halflings-icon lock"></i></span>
                            <input class="input-large span10" name="password" id="password" type="password" placeholder="type password"/>
                        </div>
                        <div class="clearfix"></div>

                        <div class="button-login">
                            <button type="submit" name="submit" class="btn btn-primary">Login</button>
                        </div>
                        <div class="clearfix"></div>
                </form>
            </div><!--/span-->
        </div><!--/row-->
    </div>
</div>

<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/jquery-migrate-1.0.0.min.js"></script>
<script src="js/jquery-ui-1.10.0.custom.min.js"></script>
<script src="js/jquery.ui.touch-punch.js"></script>
<script src="js/modernizr.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src='js/fullcalendar.min.js'></script>
<script src='js/jquery.dataTables.min.js'></script>
<script src="js/excanvas.js"></script>
<script src="js/jquery.flot.js"></script>
<script src="js/jquery.flot.pie.js"></script>
<script src="js/jquery.flot.stack.js"></script>
<script src="js/jquery.flot.resize.min.js"></script>
<script src="js/jquery.chosen.min.js"></script>
<script src="js/jquery.uniform.min.js"></script>
<script src="js/jquery.cleditor.min.js"></script>
<script src="js/jquery.noty.js"></script>
<script src="js/jquery.elfinder.min.js"></script>
<script src="js/jquery.raty.min.js"></script>
<script src="js/jquery.iphone.toggle.js"></script>
<script src="js/jquery.uploadify-3.1.min.js"></script>
<script src="js/jquery.gritter.min.js"></script>
<script src="js/jquery.imagesloaded.js"></script>
<script src="js/jquery.masonry.min.js"></script>
<script src="js/jquery.knob.modified.js"></script>
<script src="js/jquery.sparkline.min.js"></script>
<script src="js/counter.js"></script>
<script src="js/retina.js"></script>
<script src="js/custom.js"></script>

</body>
</html>
