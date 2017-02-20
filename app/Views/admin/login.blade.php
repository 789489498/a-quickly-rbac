<html lang="en" class="app js touch no-android chrome no-firefox no-iemobile no-ie no-ie8 no-ie10 no-ie11 no-ios no-ios7 ipad">

<head>
  <meta charset="utf-8" />
  <title>Musik | Web Application</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="../template/amazing/js/jPlayer/jplayer.flat.css" type="text/css" />
  <link rel="stylesheet" href="../template/amazing/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="../template/amazing/css/animate.css" type="text/css" />
  <link rel="stylesheet" href="../template/amazing/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../template/amazing/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="../template/amazing/css/font.css" type="text/css" />
  <link rel="stylesheet" href="../template/amazing/css/app.css" type="text/css" />
  <!--[if lt IE 9]>
    <script src="../template/amazing/js/ie/html5shiv.js"></script>
    <script src="../template/amazing/js/ie/respond.min.js"></script>
    <script src="../template/amazing/js/ie/excanvas.js"></script>
  <![endif]-->
</head>

<body class="bg-info dker">
  <section id="content" class="m-t-lg wrapper-md animated fadeInUp">
    <div class="container aside-xl"> <a class="navbar-brand block" href="index.html"><span class="h1 font-bold">Musik</span></a> 
      <section class="m-b-lg">
        <header class="wrapper text-center"> <strong>Sign in to get in touch</strong>
        </header>
        <form action="<?= url("admin/dologin") ?>" method="post">
          <div class="form-group">{!! csrf_field() !!}</div>
          <div class="form-group">
            <input placeholder="Account" name="username" class="form-control rounded input-lg text-center no-border">
          </div>
          <div class="form-group">
            <input type="password" name="password" placeholder="Password" class="form-control rounded input-lg text-center no-border">
          </div>
          <button type="submit" class="btn btn-lg btn-warning lt b-white b-2x btn-block btn-rounded"><i class="icon-arrow-right pull-right"></i><span class="m-r-n-lg">Sign in</span>
          </button>
          <div class="text-center m-t m-b"> <a href="#"><small>Forgot password?</small></a>
          </div>
          <div class="line line-dashed"></div>
          <p class="text-muted text-center"><small>Do not have an account?</small>
          </p> <a href="<?= url("admin/register") ?>" class="btn btn-lg btn-info btn-block rounded">Create an account</a> 
        </form>
      </section>
    </div>
  </section>
  <!-- footer -->
  <footer id="footer">
    <div class="text-center padder">
      <p> <small>Web app framework base on Bootstrap<br />&copy; 2014</small> 
      </p>
    </div>
  </footer>
  <!-- / footer -->
  <script src="../template/amazing/js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../template/amazing/js/bootstrap.js"></script>
  <!-- App -->
  <script src="../template/amazing/js/app.js"></script>
  <script src="../template/amazing/js/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="../template/amazing/js/app.plugin.js"></script>
  <script type="text/javascript" src="../template/amazing/js/jPlayer/jquery.jplayer.min.js"></script>
  <script type="text/javascript" src="../template/amazing/js/jPlayer/add-on/jplayer.playlist.min.js"></script>
  <script type="text/javascript" src="../template/amazing/js/jPlayer/demo.js"></script>
</body>

</html>