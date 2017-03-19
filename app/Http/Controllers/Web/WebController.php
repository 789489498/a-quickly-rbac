<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Input;
use App\Models\Admin\User;
use App\Models\Product\Article;

class WebController extends BaseController
{
    public $defaultPage = 1;
    public $defaultPageSize = 20;

    public function getList()
    {
        $page = $this->defaultPage;
        $pageSize = $this->defaultPageSize;
        $params = array();
        list($total, $records, $columns) = Article::getQuery($page, $pageSize, $params);
        
        $totalPages = ceil($total / $pageSize);
        return \View::make("web.index.list", array(
            'breadcrumb' => Article::getBreadcrumb(),
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
        list($total, $records, $columns) = Article::getQuery($page, $pageSize, $params);

        $totalPages = ceil($total / $pageSize);
        return \View::make("product.article.query", array(
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
        
        Article::postAdd($params);
        $this->setEmpty($params);
        return $this->postQuery($params);
    }
    
    public function postRow($params=array())
    {
        if (!empty($params)) {
            return Article::getQuery($this->defaultPage, 
                $this->defaultPageSize, $params);            
        }
        
        $tableColumns = Input::get('tableColumns', '');
        $params = $this->getInputParams($tableColumns);
        list($total, $records, $columns) = Article::getQuery($this->defaultPage, $this->defaultPageSize, $params);
        return \View::make("product.article.inputgroup", array(
            'columns' => $columns,
            'fillData' => $records,
        ));
    }
    
    public function postUpdate()
    {
        $tableColumns = Input::get('tableColumns', '');
        $params = $this->getInputParams($tableColumns);
        $id = 0;
        if (isset($params['id'])) $id = $params['id'];
        Article::postUpdate(array('id',$id), $params);
        $this->setEmpty($params);
        return $this->postQuery($params);
    }

    public function postDelete()
    {
        $tableColumns = Input::get('tableColumns', '');
        $params = $this->getInputParams($tableColumns);
        Article::postDelete(array('id'=>$params['id']));
        
        $this->setEmpty($params);
        return $this->postQuery($params);
    }
    
}