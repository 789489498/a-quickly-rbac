<?php

namespace App\Models\Zuimei;
use App\Models\BaseModel;

class Menu extends BaseModel
{
    const TABLE = "zm_menu";
    public static $fieldsMap = array(
        'id'         => array('name'=>'ID',  'desc'=>''),
        'pid'        => array('name'=>'父级菜单', 'desc'=>''),
        'is_show'    => array('name'=>'是否显示', 'desc'=>''),
        'is_node'    => array('name'=>'是否节点', 'desc'=>''),
        'name'       => array('name'=>'菜单名称', 'desc'=>''),
        'icon'       => array('name'=>'图标样式', 'desc'=>''),
        'badge'      => array('name'=>'通知样式', 'desc'=>''),
        'msgnum'     => array('name'=>'消息条数', 'desc'=>''),
        'sortnum'    => array('name'=>'排列顺序', 'desc'=>''),
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
            '菜单'=>array(
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
        $table = Menu::TABLE;
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
        return \DB::table(Menu::TABLE)->insertGetId($params);
    }
    
    public static function postUpdate($where, $params)
    {
        list($k, $v) = $where;
        return \DB::table(Menu::TABLE)->where($k, $v)
        ->update($params);
    }
    
    public static function postDelete($params)
    {
        $table = Menu::TABLE;
        list($where, $bindValues) = BaseModel::Factory()->getConditions($params);
        $query = "delete from {$table} where $where";
        \DB::connection()->delete($query, $bindValues);
        return;
    }
    
    public static function getMenu($fetch_mode=\PDO::FETCH_OBJ, $params=array())
    {
        $table = Menu::TABLE;
        list($where, $bindValues) = BaseModel::Factory()->getConditions($params);
        $where = empty($where) ? "" : "where {$where}";
        $query = "select * from {$table} {$where}";
        \DB::reconnect()->setFetchMode($fetch_mode);
        return \DB::connection()->select($query, $bindValues);
    }
    
    public static function getTreeUseIsShow(&$result)
    {
        $record = self::getTree($result);
        foreach ($record as $k=> $v) {
            if ($v['is_show'] == 0 && $v['pid'] == 0) {
                unset($record[$k]);
            }
        }
        return $record;
    }
}
