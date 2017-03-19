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
        'video_uri'     => array('name'=>'视频地址', 'desc'=>''),
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
    
    public static function getQuery($page, $pageSize, $params)
    {
        $table = self::TABLE;
        $tableColumns = BaseModel::Factory()->getTableColumns($table);
        list($where, $bindValues) = BaseModel::Factory()->getConditions($params);

        $offset = ($page-1) * $pageSize;
        $limit = "limit $pageSize offset $offset";
        $where = empty($where) ? "" : "where $where";
        $query = "select * from {$table} {$where} {$limit}";
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
    
    public static function getMenu($fetch_mode=\PDO::FETCH_OBJ, $params=array())
    {
        $table = Category::TABLE;
        list($where, $bindValues) = BaseModel::Factory()->getConditions($params);
        $where = empty($where) ? "" : "where {$where}";
        $query = "select * from {$table} {$where}";
        \DB::reconnect()->setFetchMode($fetch_mode);
        return \DB::connection()->select($query, $bindValues);
    }
    
    public static function getTree(&$result, $id=0)
    {
        $record = array();
        foreach ($result as $k=> $v) {
            if ($v['pid'] == $id) {
                $v['son'] = self::getTree($result, $v['id']);
                $record[] = $v;
            }
        }
        return $record;
    }
    
    public static function getAssoMenu(&$result, $id=0)
    {
        $record = array();
        foreach ($result as $k=> $v) {
            if ($v['pid'] == $id) {
                $record = self::getAssoMenu($result, $v['id']);
                $record = array_merge($record, array($v['id']));
            }
        }
        return $record;
    }
    
    public static function getMenuPid(&$result, $id=0)
    {
        $pid = 0;
        foreach ($result as $k=> $v) {
            if ($v['id'] == $id) {
                if ($v['pid'] != 0) {
                    $pid = self::getMenuPid($result, $v['pid']);
                } else {
                    $pid = $v['id'];
                }
            }
        }
        return $pid;
    }
    
    public static function getTreeUseIsShow(&$result)
    {
        $record = self::getTree($result);
        foreach ($record as $k=> $v) {
            //删除顶级菜单且设置了隐藏的菜单
            if ($v['is_show'] == 0 && $v['pid'] == 0) {
                unset($record[$k]);
            }
        }
        return $record;
    }
}
