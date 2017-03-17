<?php
use App\Models\Zuimei\Menu;
use App\Models\Zuimei\Route;
use App\Models\BaseModel;
use Illuminate\Support\Facades\Route as Uri;
?>
<section>
  <section class="hbox stretch">
    <!-- .aside -->
    <?php if(isset($_COOKIE["leftBarOpen"]) && $_COOKIE["leftBarOpen"] == 'open'): ?>
    <aside class="bg-black dk aside hidden-print" id="nav">
    <?php else: ?>
    <aside class="bg-black dk nav-xs aside hidden-print" id="nav">
    <?php endif;?>
    <?php 

    ////获取路由、默认路由Map
    $routes = Route::getRoute();
    $routesMap = BaseModel::format2Array($routes, 'mid', 'route:name');
    $defaultRoutes = BaseModel::format2Array($routes, 'mid', 'route:is_default');
    
    ////获取菜单
    $menusOri = Menu::getMenu(\PDO::FETCH_ASSOC);
    ////sort
    $sortnum = array();
    foreach ($menusOri as $k=> $v) {
        $sortnum[$k] = $v['sortnum'];
    }
    array_multisort($sortnum, SORT_ASC, $menusOri);
    $menus = Menu::getTree($menusOri);
    
    //当前路由顶级菜单
    $currentRoute = Uri::getFacadeRoot()->current()->getActionName();
    $currentRouteMid = 0;
    
    foreach ($routesMap as $k=> $v) {
        if (array_key_exists($currentRoute, $v)) {
            $currentRouteMid = $k;
            break;
        }
    }
    $currentRouteMpath = Menu::getAssoMenuWithId($menusOri, $currentRouteMid);

    ?>
      <section class="vbox">
        <section class="w-f-md scrollable">
          <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railOpacity="0.2">
            <!-- nav -->
            <nav class="nav-primary hidden-xs">
<?php 

////目前通过菜单的根判断会出现多个子菜单都展开的情况
////TODO:当前访问路由焦点的获取办法
////先获取到当前路由菜单路径(如5/3/9/1)然后在遍历菜单时候判断是否存在于map，是则展开

////GET MENU ////!START
function getMenu(&$menus, &$routeMap, $defaultRoutes, $currentRoute, $currentRouteMpath, $id=0, $level=0) {
	$level ++;
	foreach ($menus as $k=> $v) {
		//获取当前菜单默认路由
		$url="#";
		$focus = "";
		$routeName = "";
		$controller = $action = "";
		if (isset($defaultRoutes[$v['id']])) {
			$routeName = array_search(1, $defaultRoutes[$v['id']]);
			$routeNameNoNamespace = Route::getStripNamespaceName($routeName);
			$url = Route::getActionName($routeNameNoNamespace);
			$focus = in_array($currentRoute, array_keys($defaultRoutes[$v['id']])) === true ? "active" : "";
		}
		//判断当前路由焦点需要注意的是:
		//因action方法会使用当前的命名空间构造,但录入的路由已携带命名空间需要截断
		//当前路由不能使用action生成URL,因为可能会带有参数,注入参数繁琐
		//通过接口比较当前路由合理,但不足之处在于菜单焦点获取不到深层子页面
		//因此,假设一个终端节点代表一组功能,即控制器一样,方法不同
		//可以考虑使用同一控制器来判断当前页面属于哪个终端节点菜单
		//DONE:更加简单的方法,直接在当前菜单对应的路由表里匹配

		$active = in_array($v['id'], $currentRouteMpath) ? "active" : "";
		$slidedown = in_array($v['id'], $currentRouteMpath) ? "style='display:block;'" : "style='display:none;'";
		$msgnum = ($v['msgnum'] == 0) ? "" : $v['msgnum']; 
		if ($v['pid'] == $id) {
			if ($level-1 == 0) {
echo <<<EOF
<ul class="nav" data-ride="collapse">
<li class="hidden-nav-xs padder m-t m-b-sm text-xs text-muted">{$v['name']}</li>
EOF;
			} else {
				$spam = "";
				if (!empty($v['son'])) {
					$spam = '<span class="pull-right text-muted">
							  <i class="fa fa-angle-left text"></i>
							  <i class="fa fa-angle-down text-active"></i>
							 </span>';
				}
echo <<<EOF
<li class="{$active} {$focus}">
<a href="{$url}" class="auto">
{$spam}
<i class="{$v['icon']}"></i>
<b class="{$v['badge']}">{$msgnum}</b>
<span>{$v['name']}</span>
</a>
EOF;
				if (!empty($v['son'])) {
echo <<<EOF
<ul class="nav dker" {$slidedown}>
EOF;
				}
			}
			getMenu($v['son'], $routeMap, $defaultRoutes, $currentRoute, $currentRouteMpath, $v['id'], $level);
			if ($level-1 == 0) {
echo <<<EOF
</ul>
EOF;
			} else {
				if (!empty($v['son'])) {
echo <<<EOF
</ul>
EOF;
				}
echo <<<EOF
</li>
EOF;
			}
		}
	}
}
getMenu($menus, $routeMap, $defaultRoutes, $currentRoute, $currentRouteMpath);
////GET MENU ////!END

?>

            </nav>
            <!-- / nav --></div>
        </section>
        <footer class="footer hidden-xs no-padder text-center-nav-xs">
          <div class="bg hidden-xs ">
            <div class="dropdown dropup wrapper-sm clearfix">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="thumb-sm avatar pull-left m-l-xs">
                  <img src="/public/template/amazing/images/a3.png" class="dker" alt="...">
                  <i class="on b-black"></i>
                </span>
                <span class="hidden-nav-xs clear">
                  <span class="block m-l">
                    <strong class="font-bold text-lt">John.Smith</strong>
                    <b class="caret"></b>
                  </span>
                  <span class="text-muted text-xs block m-l">Art Director</span></span>
              </a>
              <ul class="dropdown-menu animated fadeInRight aside text-left">
                <li>
                  <span class="arrow bottom hidden-nav-xs"></span>
                  <a href="#">Settings</a></li>
                <li>
                  <a href="profile.html">Profile</a></li>
                <li>
                  <a href="#">
                    <span class="badge bg-danger pull-right">3</span>Notifications</a></li>
                <li>
                  <a href="docs.html">Help</a></li>
                <li class="divider"></li>
                <li>
                  <a href="modal.lockme.html" data-toggle="ajaxModal">Logout</a></li>
              </ul>
            </div>
          </div>
        </footer>
      </section>
    </aside>
    <!-- /.aside -->
