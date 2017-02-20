<?php 
    use Illuminate\Support\Facades\Input;
    $msg = Input::get('msg', '');
    $msg = base64_decode($msg);
    $msg = json_decode($msg, true);
?>
<!DOCTYPE html>
<html lang="en" class="app">
  <head>
    <meta charset="utf-8" />
    <title>Musik | Web Application</title>
    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!--[if lt IE 9]>
      <script src="../js/ie/html5shiv.js"></script>
      <script src="../js/ie/respond.min.js"></script>
      <script src="../js/ie/excanvas.js"></script>
    <![endif]-->
   </head>
  
  <body class="">
    <section class="vbox">
    <?php if (isset($msg['errmsg'])) {
        echo $msg['errmsg'];
    }?>
    </section>
  </body>
</html>
<script>
var ref="<?= $msg['data'] ?>";
if (ref != "") {
window.setTimeout(function(){
	route(ref);
},1500);
}

function route(ref) {
window.location.href=ref;
}
</script>

