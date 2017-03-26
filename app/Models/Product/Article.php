<?php

namespace App\Models\Product;
use App\Models\BaseModel;

class Article extends BaseModel
{
    const TABLE = "zm_article";
    public static $fieldsMap = array(
        'id'            => array('name'=>'ID', 'desc'=>''),
        'item_id'       => array('name'=>'商品', 'desc'=>''),
        'title'         => array('name'=>'文章标题', 'desc'=>''),
        'image'         => array('name'=>'首页大图', 'desc'=>''),
        'video'         => array('name'=>'视频地址', 'desc'=>''),
        'vimg'          => array('name'=>'视频图片', 'desc'=>''),
        'category_id'   => array('name'=>'文章分类', 'desc'=>''),
        'tag'           => array('name'=>'标签', 'desc'=>''),
        'content'       => array('name'=>'详情信息', 'desc'=>''),
        'pageview'      => array('name'=>'浏览次数', 'desc'=>''),
        'favorite'      => array('name'=>'喜欢次数', 'desc'=>''),
        'comment'       => array('name'=>'评论次数', 'desc'=>''),
        'is_display'    => array('name'=>'是否显示', 'desc'=>''),
        'operator'      => array('name'=>'操作人', 'desc'=>''),
        'create_time'   => array('name'=>'创建时间', 'desc'=>''),
        'update_time'   => array('name'=>'更新时间', 'desc'=>''),
        
    );
    
    public static function getBreadcrumb()
    {
        return $breadcrumb = array(
            '首页'=>array(
                'uri'   =>'',
                'icon'  =>'fa fa-home',
            ),
            '文章'=>array(
                'uri'   =>'',
                'icon'  =>'fa fa-list-ul',
            ),
            '列表'=>array(
                'uri'   =>'#',
                'icon'  =>'',
            )
        );
    }
    
    public static function getFiledDistinct($fileds='')
    {
        $table = Category::TABLE;
        $query = "select {$fileds} from {$table} group by {$fileds}";
        \DB::reconnect()->setFetchMode(\PDO::FETCH_OBJ);
        return \DB::reconnect()->select($query);
    }
    
    public static function getQuery($page, $pageSize, $params, $order='')
    {
        $table = self::TABLE;
        $tableColumns = BaseModel::Factory()->getTableColumns($table);
        
        if (isset($params['title'])) $params['title'] = "%{$params['title']}%";
        list($where, $bindValues) = BaseModel::Factory()->setFieldsLikeCollect('title')->
        getConditions($params);

        $offset = ($page-1) * $pageSize;
        $limit = "limit $pageSize offset $offset";
        $where = empty($where) ? "" : "where $where";
        $order = empty($order) ? "" : "$order";
        $query = "select * from {$table} {$where} {$order} {$limit}";
        $result = \DB::reconnect()->select($query, $bindValues);
        $query = "select count(*)cnt from {$table} {$where}";
        $totalRecords = self::getTotalRecords($query, $bindValues);
        return array($totalRecords, $result, $tableColumns);
        
    }
    
    public static function getTotalRecords($query, $bindValues, $database="mysql")
    {
        $result = \DB::reconnect($database)->selectOne($query, $bindValues);
        return empty($result->cnt) ? 0 : $result->cnt;
    }
    
    public static function postAdd($params)
    {
        return \DB::table(Article::TABLE)->insertGetId($params);
    }
    
    public static function postUpdate($where, $params)
    {
        list($k, $v) = $where;
        return \DB::table(Article::TABLE)->where($k, $v)
        ->update($params);
    }
    
    public static function postDelete($params)
    {
        $table = Article::TABLE;
        list($where, $bindValues) = BaseModel::Factory()->getConditions($params);
        $query = "delete from {$table} where $where";
        \DB::connection()->delete($query, $bindValues);
        return;
    }
    
    public static function getTag($fetch_mode=\PDO::FETCH_OBJ, $params=array())
    {
        $table = Article::TABLE;
        list($where, $bindValues) = BaseModel::Factory()->getConditions($params);
        $where = empty($where) ? "" : "where {$where}";
        $query = "select distinct tag from {$table} {$where}";
        \DB::reconnect()->setFetchMode($fetch_mode);
        return \DB::connection()->select($query, $bindValues);
    }
    
    public static function getCategory($fetch_mode=\PDO::FETCH_OBJ, $params=array())
    {
        $table = Article::TABLE;
        list($where, $bindValues) = BaseModel::Factory()->getConditions($params);
        $where = empty($where) ? "" : "where {$where}";
        $query = "select category_id,count(*)cnt from {$table} {$where} group by category_id";
        \DB::reconnect()->setFetchMode($fetch_mode);
        return \DB::connection()->select($query, $bindValues);
    }
}
