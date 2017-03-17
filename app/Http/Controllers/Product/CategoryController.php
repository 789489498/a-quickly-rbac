<?php

namespace App\Http\Controllers\Product;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Route;
use App\Models\Product\Category;
use Illuminate\Support\Facades\Input;
use App\Models\Admin\User;

class CategoryController extends BaseController
{
    public $defaultPage = 1;
    public $defaultPageSize = 20;

    public function getList()
    {
        $page = $this->defaultPage;
        $pageSize = $this->defaultPageSize;
        $params = array();
        list($total, $records, $columns) = Category::getQuery($page, $pageSize, $params);
        
        $totalPages = ceil($total / $pageSize);
        return \View::make("product.category.list", array(
            'breadcrumb' => Category::getBreadcrumb(),
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
        list($total, $records, $columns) = Category::getQuery($page, $pageSize, $params);

        $totalPages = ceil($total / $pageSize);
        return \View::make("product.category.query", array(
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
        
        Category::postAdd($params);
        $this->setEmpty($params);
        return $this->postQuery($params);
    }
    
    public function postRow($params=array())
    {
        if (!empty($params)) {
            return Category::getQuery($this->defaultPage, 
                $this->defaultPageSize, $params);            
        }
        
        $tableColumns = Input::get('tableColumns', '');
        $params = $this->getInputParams($tableColumns);
        list($total, $records, $columns) = Category::getQuery($this->defaultPage, $this->defaultPageSize, $params);
        return \View::make("product.category.inputgroup", array(
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
        Category::postUpdate(array('id',$id), $params);
        $this->setEmpty($params);
        return $this->postQuery($params);
    }

    public function postDelete()
    {
        $tableColumns = Input::get('tableColumns', '');
        $params = $this->getInputParams($tableColumns);
        Category::postDelete(array('id'=>$params['id']));
        
        $this->setEmpty($params);
        return $this->postQuery($params);
    }
    
}