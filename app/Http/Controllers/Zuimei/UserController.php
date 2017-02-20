<?php

namespace App\Http\Controllers\Zuimei;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Input;
use App\Models\Admin\User;
use \App\Models\Zuimei\User as Users;
use App\Models\Zuimei\Route;
use App\Models\Zuimei\Menu;
use App\Models\BaseModel;
use App\Models\Zuimei\RoleRoute;
use App\Models\Zuimei\UserRole;

class UserController extends BaseController
{
    public $defaultPage = 1;
    public $defaultPageSize = 20;

    public function getList()
    {
        $page = $this->defaultPage;
        $pageSize = $this->defaultPageSize;
        $params = array();
        list($total, $records, $columns) = Users::getQuery($page, $pageSize, $params);
        
        $totalPages = ceil($total / $pageSize);
        return \View::make("zuimei.user.list", array(
            'breadcrumb' => Users::getListBreadcrumb(),
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
        list($total, $records, $columns) = Users::getQuery($page, $pageSize, $params);

        $totalPages = ceil($total / $pageSize);
        return \View::make("zuimei.user.query", array(
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
        
        Users::postAdd($params);
        $this->setEmpty($params);
        return $this->postQuery($params);
    }
    
    public function postRow()
    {
        $tableColumns = Input::get('tableColumns', '');
        $params = $this->getInputParams($tableColumns);
        list($total, $records, $columns) = Users::getQuery($this->defaultPage, $this->defaultPageSize, $params);
        return \View::make("zuimei.user.inputgroup", array(
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
        Users::postUpdate(array('id',$id), $params);
        $this->setEmpty($params);
        return $this->postQuery($params);
    }

    public function postDelete()
    {
        $tableColumns = Input::get('tableColumns', '');
        $params = $this->getInputParams($tableColumns);
        Users::postDelete($params);
        UserRole::postDelete($params);
        $this->setEmpty($params);
        return $this->postQuery($params);
    }
    
}