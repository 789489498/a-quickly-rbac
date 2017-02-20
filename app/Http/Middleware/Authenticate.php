<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Admin\User;
use App\Models\Zuimei\UserRole;
use App\Models\BaseModel;
use Illuminate\Support\Facades\Route as Uri;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //echo Route::getFacadeRoot()->current()->uri();
        //echo $request->route()->getUri();
        //echo $route->getUri();
        
        if (!User::isLogin()){
            return \Redirect::route('admin/login');
        }
        
        $currentRoute = Uri::getFacadeRoot()->current()->getActionName();
        $username = User::getUsername();
        $actionName=  $request->route()->getActionName();
        $userRoleCollect = UserRole::getRole(array('username' => $username));
        $userRoleCollect = BaseModel::format2Array($userRoleCollect, 'role_id');
        
        
        //当前用户无任何角色,退出
        if (empty($userRoleCollect)) {
            return $this->throwException();
        }
        
        //当前路由是否存在于授权角色的路由里
        $userRoleRouteCollect = UserRole::getRoleRouteCollect(
            implode(',', array_keys($userRoleCollect)));
        $userRoleRouteCollect = BaseModel::format2Array($userRoleRouteCollect, 'has_route');
        if (key_exists($currentRoute, $userRoleRouteCollect)) {
            return $next($request);
        } else {
            return $this->throwException();
        }
        
    }
    
    public function throwException()
    {
        return response('无权限访问', 401)
        ->header('Content-Type', 'text/plain');
    }
}
