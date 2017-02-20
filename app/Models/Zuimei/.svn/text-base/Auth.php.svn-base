<?php

namespace Qihoo;

class Auth
{
    public static function filter()
    {
        $current = \Route::currentRouteAction();

        if (stripos($current, "Api\\") === 0) {
            return;
        }

        //新版自助查询，权限通过配置页面id实现
        if (substr($current, 0, 5) == "Hive2") {
            return;
        }

        if ($current === "Qihoo\UserController@logoutAction") {
            return;
        }

        if (!User::isLogin()) User::login();

        // HomeController下的action允许所有登录用户访问
        if (!UserRole::hasRoute(User::getUsername(), \Route::currentRouteAction())
            && stripos(\Route::currentRouteAction(), 'Qihoo\HomeController') !== 0) {

            $title = "拒绝访问";
            $message = "你没有权限访问此页面，如果需要开通权限，请联系<a href='mailto:g-zhushou-data@360.cn?subject=【自助查询系统 - 权限申请】'>服务端数据组</a>";
            $view = \View::make('qihoo.home.index', array(
                "title" => $title,
                "message" => $message,
            ));

            $view->setStatusCode(403);

            return $view;
        }
    }
}
