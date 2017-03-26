<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Input;
use App\Models\Admin\User;
use App\Models\Product\Article;
use App\Models\Product\Category;
use App\Models\BaseModel;

class WebController extends BaseController
{
    public $defaultPage = 1;
    public $defaultPageSize = 1;

    public function getList()
    {
        $page = Input::get('page') ? : $this->defaultPage;
        $pageSize = $this->defaultPageSize;
        $tableColumns = base64_decode(Input::get('tableColumns', ''));
        $params = $this->getInputParams($tableColumns);
        $outerParams = $this->getInputParams('type', true);
        
        list($total, $records, $columns) = Article::getQuery($page, $pageSize, $params);
        $totalPages = ceil($total / $pageSize);
        return \View::make("web.index.list", array(
            'outerParams'=> $outerParams,
            'breadcrumb' => Article::getBreadcrumb(),
            'columns' => $columns,
            'records' => $records,
            'total' => $total,
            'page'  => $page,
            'totalPages' => $totalPages,
            'pageSize' => $pageSize,
        ));
    }
    
    public function getRecentArticle($view='web.index.recent')
    {
        $pageSize = 10;
        $params = array();
        $order  = "order by create_time desc";
        list($total, $records, $columns) = Article::getQuery($this->defaultPage, 
            $pageSize, $params, $order);
        return \View::make($view, array(
            'recentArticles' => $records,
        ));
    }
    
    public function getCategory($view='web.index.category')
    {
        $params   = $this->getInputParams('category_id');
        $category = Category::getCategory();
        $category = BaseModel::format2Array($category, 'id');
        $articleCategory = Article::getCategory();
        return \View::make($view, array(
            'params'          => $params,
            'categoryMap'     => $category,
            'articleCategory' => $articleCategory,
        ));
    }
    
    public function getTag($view='web.index.tag')
    {
        $params = $this->getInputParams('tag');
        $tag = Article::getTag();
        return \View::make($view, array(
            'params' => $params,
            'tag'    => $tag,
        ));
    }

}