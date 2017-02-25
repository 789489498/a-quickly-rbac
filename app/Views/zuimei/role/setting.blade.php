@include('zuimei.layout.header')
@include('zuimei.layout.toolbar')
@include('zuimei.layout.leftbar')
<section id="content">
  <section class="vbox">
    <section class="scrollable wrapper">
      <?php if(!empty($breadcrumb)): ?>
	  <div class="row">
        <div class="col-lg-12">
          <!-- .breadcrumb -->
          <ul class="breadcrumb" id="breadcrumb">
           <?php foreach ($breadcrumb as $k=> $v): ?>
            <li>
              <a href="<?= $v['uri'] ?>">
                <i class="<?= $v['icon'] ?>"></i>
                <?= $k ?>
              </a>
            </li>
            <?php endforeach; ?>
          </ul>
          <!-- / .breadcrumb -->
        </div>
      </div>
      <?php endif; ?>
      <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <i class="icon-info"></i>
        M(Menu)代表菜单名称，R(Route)代表路由名称。
      </div>
	  <section class="panel panel-default">
      <header class="panel-heading"><?= $rolename[0]['name'] ?></header>
      <div class="panel-body">
        <form role="form" id="query_form">
        <input type="hidden" name="role_id" value="<?= $rolename[0]['id'] ?>"/>
        <?php 
            function getMenuCollect(&$routeMap, &$result, &$hasRouteMap, $level=-1) {
                $level++;
                foreach ($result as $k=> $v) {?>
                <ul class='list-unstyled'>
                <li class="">
                <div class='form-group' style="margin-left:<?= $level*50 ?>px;">
                    <div class='checkbox i-checks'>
                      <label>
                        <input type="checkbox" class='checkbox_all'  value="<?= $v['id'] ?>">
                        <i></i><?= $v['name'] ?>(M)
                      </label>
                    </div>
                </div>
                
        <?php 
                    if (!empty($routeMap[$v['id']])) { ?>
        			<div class='form-group' style="margin-left:<?= $level*76 ?>px;">
        <?php
                        foreach ($routeMap[$v['id']] as $k1=> $v1) { 
                            $checked = isset($hasRouteMap[$k1]) ? "checked" : "";
        ?>
                        <label class="checkbox-inline i-checks">
                          <input type="checkbox" name="has_route[]" value="<?= $k1 ?>" <?= $checked ?>>
                          <i></i><?= $v1 ?>(R)
                        </label>
        <?php           }?>
        			</div>
        <?php       }?>
        
        <?php
                    if (!empty($v['son'])) {
                        getMenuCollect($routeMap, $v['son'], $hasRouteMap, $level);
                    }
                    echo "</li></ul>";   
                }
            }
            getMenuCollect($routeMap, $menuMap, $hasRouteMap);
        ?>
        </form>
        </div>
        <footer class="panel-footer">
          <div class="row">
            <div class="col-sm-4 hidden-xs">
              <button class="btn btn-info submit_btn">提交</button>
             </div>
          </div>
      </footer>
      </section>
    </section>
  </section>
  <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
  @include('zuimei.layout.modal')
</section>
</section>
</section>
</section>
<!-- Bootstrap -->
<script src="/public/template/amazing/js/bootstrap.js"></script>
<!-- App -->
<script src="/public/template/amazing/js/app.js"></script>
<script src="/public/template/amazing/js/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/public/template/amazing/js/app.plugin.js"></script>
<script type="text/javascript" src="/public/template/amazing/js/jPlayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="/public/template/amazing/js/jPlayer/add-on/jplayer.playlist.min.js"></script>
<script type="text/javascript" src="/public/template/amazing/js/bs_pagination/jquery.bs_pagination.min.js"></script>
<script type="text/javascript" src="/public/template/amazing/js/bs_pagination/localization/en.min.js"></script>
<script type="text/javascript" src="/public/template/amazing/js/jPlayer/demo.js"></script>
<script>
$(document).on('change', '.checkbox_all' ,function(){
	var is_checked = $(this).is(":checked");
	var that = $(this).closest('ul').find("input[type='checkbox']");
	if (is_checked) {
		that.prop("checked",true);
	}else {
		that.prop("checked",false);
	}
});

////Submit
var hanlder = function(that) {
  var requestUrl = "<?= url("role/postsetting") ?>";
  var params = getParams();
  $.ajax({
    "url": requestUrl,
    "type": "post",
    "data" : params,
    "dataType" : "html",
    "error" : function (jqXHR, 
         textStatus, errorThrown) {
     console.log(jqXHR);
    },
    "success" : function (data) {
  	  	window.location.reload();
    }
  });
}
bindEvent(".submit_btn", "click", hanlder);
</script>
@include('zuimei.event.bindevents')
</body>
</html>
