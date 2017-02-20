<?php

namespace App\Http\Controllers\Zuimei;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Input;
use App\Models\Zuimei\Role;
use App\Models\Admin\User;
use App\Models\Zuimei\Route;
use App\Models\Zuimei\Menu;
use App\Models\BaseModel;
use App\Models\Zuimei\RoleRoute;

class RoleController extends BaseController
{
    public $defaultPage = 1;
    public $defaultPageSize = 20;

    public function getList()
    {
        $page = $this->defaultPage;
        $pageSize = $this->defaultPageSize;
        $params = array();
        list($total, $records, $columns) = Role::getQuery($page, $pageSize, $params);
        
        $totalPages = ceil($total / $pageSize);
        return \View::make("zuimei.role.list", array(
            'breadcrumb' => Role::getListBreadcrumb(),
            'columns' => $columns,
            'records' => $records,
            'total' => $total,
            'page'  => $page,
            'totalPages' => $totalPages,
            'pageSize' => $pageSize,
        ));
    }

    public function postQuery($params=array())
    {
        $page = Input::get('page') ? : $this->defaultPage;
        $pageSize = Input::get('pageSize') ? : $this->defaultPageSize;
        if (empty($params)) {
            $tableColumns = Input::get('tableColumns', '');
            $params = $this->getInputParams($tableColumns);
        }
        list($total, $records, $columns) = Role::getQuery($page, $pageSize, $params);

        $totalPages = ceil($total / $pageSize);
        return \View::make("zuimei.role.query", array(
            'columns' => $columns,
            'records' => $records,
            'total' => $total,
            'page'  => $page,
            'totalPages' => $totalPages,
            'pageSize' => $pageSize,
        ));
    }

    public function postAdd()
    {
        $tableColumns = Input::get('tableColumns', '');
        $params = $this->getInputParams($tableColumns);
        $params['operator'] = User::getUsername();
        $params['create_time'] = date("Y-m-d H:i:s");
        
        Role::postAdd($params);
        $this->setEmpty($params);
        return $this->postQuery($params);
    }
    
    public function postRow()
    {
        $tableColumns = Input::get('tableColumns', '');
        $params = $this->getInputParams($tableColumns);
        list($total, $records, $columns) = Role::getQuery($this->defaultPage, $this->defaultPageSize, $params);
        return \View::make("zuimei.role.inputgroup", array(
            'columns' => $columns,
            'fillData' => $records,
        ));
    }
    
    public function postUpdate()
    {
        $tableColumns = Input::get('tableColumns', '');
        $params = $this->getInputParams($tableColumns);
        $params['operator'] = User::getUsername();
        $id = 0;
        if (isset($params['id'])) $id = $params['id'];
        Role::postUpdate(array('id',$id), $params);
        $this->setEmpty($params);
        return $this->postQuery($params);
    }

    public function postDelete()
    {
        $tableColumns = Input::get('tableColumns', '');
        $params = $this->getInputParams($tableColumns);
        $id = 0;
        if (isset($params['id'])) $id = $params['id'];
        Role::postDelete($id);
        RoleRoute::removeRoleRoute($id);
        $this->setEmpty($params);
        return $this->postQuery($params);
    }
    
    public function setting($id)
    {
        $routes = Route::getRoute();
        $routesMap = BaseModel::format2Array($routes, 'mid', 'route:name');
        
        $hasRoutes = RoleRoute::getRoleRoute($id);
        $hasRoutesMap = BaseModel::format2Array($hasRoutes, 'has_route');
        
        $menus = Menu::getMenu(\PDO::FETCH_ASSOC);
        $menusTree = Menu::getTree($menus);
        $rolename = Role::getRole($id);
        
        return \View::make("zuimei.role.setting", array(
            'breadcrumb' => Role::getSettingBreadcrumb(),
            'rolename' => $rolename,
            'routeMap' => $routesMap,
            'menuMap' => $menusTree,
            'hasRouteMap' => $hasRoutesMap,
        ));
    }
    
    public function postSetting()
    {
        $params = $this->getInputParams('has_route,role_id');
        $params['username'] = User::getUsername();
        $result = RoleRoute::setRoleRoute($params);
        return;
    }
    
}