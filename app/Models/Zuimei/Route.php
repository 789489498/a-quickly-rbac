<?php

namespace App\Models\Zuimei;
use App\Models\BaseModel;

class Route extends BaseModel
{
    const TABLE = "zm_route";
    public static $fieldsMap = array(
        'id'         => array('name'=>'ID',  'desc'=>''),
        'name'       => array('name'=>'路由名称', 'desc'=>''),
        'route'      => array('name'=>'路由', 'desc'=>''),
        'mid'        => array('name'=>'绑定菜单', 'desc'=>''),
        'is_default' => array('name'=>'默认路由', 'desc'=>''),
        'operator'   => array('name'=>'操作人', 'desc'=>''),
        'create_time'=> array('name'=>'创建时间', 'desc'=>''),
        'update_time'=> array('name'=>'更新时间', 'desc'=>''),
        
    );
    
    public static function getBreadcrumb()
    {
        return $breadcrumb = array(
            '首页'=>array(
                'uri'   =>'',
                'icon'  =>'fa fa-home',
            ),
            '路由'=>array(
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
        $table =Route::TABLE;
        $query = "select {$fileds} from {$table} group by {$fileds}";
        return \DB::reconnect()->select($query);
    }
    
    public static function format2Array(&$result, $key1='', $key2='')
    {
        $records = array();
        foreach ($result as $k=> $v) {
            $records[$v->$key1] = $v->$key2;
        }
        return $records;
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
        return \DB::table(Route::TABLE)->insertGetId($params);
    }
    
    public static function postUpdate($where, $params)
    {
        list($k, $v) = $where;
        return \DB::table(Route::TABLE)->where($k, $v)
        ->update($params);
    }
    
    public static function postDelete($params)
    {
        $table = Route::TABLE;
        list($where, $bindValues) = BaseModel::Factory()->getConditions($params);
        $query = "delete from {$table} where {$where}";
        \DB::connection()->delete($query, $bindValues);
        return;
    }
    
    public static function getRoute($params=array())
    {
        $table = Route::TABLE;
        list($where, $bindValues) = BaseModel::Factory()->getConditions($params);
        $where = empty($where) ? "" : "where {$where}";
        $query = "select * from {$table} {$where}";
        \DB::reconnect()->setFetchMode(\PDO::FETCH_OBJ);
        return \DB::connection()->select($query, $bindValues);
    }
    
    public static function getActionName($name, $namespace='App\\Http\\Controllers\\')
    {
        $name = self::getStripNamespaceName($name, $namespace);
        return action($name);
    }
    
    public static function getStripNamespaceName($name, $namespace='App\\Http\\Controllers\\')
    {
        return str_replace($namespace, '', trim($name));
    }
    
    public static function getRouteControllerActionWithNameSpace($name)
    {
        //FORMAT::App\Http\Controllers\Zuimei\RouteController@getList
        return explode('@', trim($name));
    }
    
}
