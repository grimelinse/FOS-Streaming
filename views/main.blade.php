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

</head>

<body>
<!-- start: Header -->
<div class="navbar">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="javascript:;"><span>FOS-Streaming panel <small style="font-size: 10px;">by Tyfix</small></span></a>

            <!-- start: Header Menu -->
            <div class="nav-no-collapse header-nav">
                <ul class="nav pull-right">

                    <!-- start: User Dropdown -->
                    <li class="dropdown">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="halflings-icon white user"></i> {{ $_SESSION['user_id'] }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu-title">
                                <span>Account Settings</span>
                            </li>
                            <li><a href="index.php?logout=true"><i class="halflings-icon off"></i> Logout</a></li>
                        </ul>
                    </li>
                    <!-- end: User Dropdown -->
                </ul>
            </div>
            <!-- end: Header Menu -->

        </div>
    </div>
</div>
<!-- start: Header -->

<div class="container-fluid-full">
    <div class="row-fluid">

        <!-- start: Main Menu -->
        <div id="sidebar-left" class="span2">
            <div class="nav-collapse sidebar-nav">
                <ul class="nav nav-tabs nav-stacked main-menu">
                    <li><a href="dashboard.php"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>
                    <li><a href="streams.php"><i class="icon-tasks"></i><span class="hidden-tablet"> Streams</span></a></li>
                    <li><a href="manage_stream.php"><i class="icon-plus"></i><span class="hidden-tablet"> Add streams</span></a></li>
                    <li><a href="users.php"><i class="icon-user"></i><span class="hidden-tablet"> Users</span></a></li>
                    <li><a href="manage_user.php"><i class="icon-plus"></i><span class="hidden-tablet"> Add users</span></a></li>
                    <li><a href="categories.php"><i class="icon-user"></i><span class="hidden-tablet"> Category</span></a></li>
                    <li><a href="manage_category.php"><i class="icon-list"></i><span class="hidden-tablet"> Add category</span></a></li>
                    <li><a href="transcodes.php"><i class="icon-tasks"></i><span class="hidden-tablet"> Transcode profile</span></a></li>
                    <li><a href="manage_transcode.php"><i class="icon-plus"></i><span class="hidden-tablet"> Add transcode profile</span></a></li>
                    <li><a href="admins.php"><i class="icon-user"></i><span class="hidden-tablet"> Admin</span></a></li>
                    <li><a href="manage_admin.php"><i class="icon-plus"></i><span class="hidden-tablet"> Add admin</span></a></li>
                    <li><a href="settings.php"><i class="icon-list"></i><span class="hidden-tablet"> Settings</span></a></li>

                </ul>
            </div>
        </div>
        <!-- end: Main Menu -->

        <noscript>
            <div class="alert alert-block span10">
                <h4 class="alert-heading">Warning!</h4>
                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
            </div>
        </noscript>

        <div id="content" class="span10">
            @yield('content')
        </div>

    </div>
</div>

<div class="clearfix"></div>

<footer>
    <p>
        <span style="text-align:left;float:left; color: #FFF;">&copy; 2015 <a style="color: #FFF;" href="http://tyfix.nl" alt="Tyfix">Tyfix</a></span>
    </p>
</footer>

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
