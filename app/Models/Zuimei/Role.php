<?php

namespace App\Models\Zuimei;
use App\Models\BaseModel;

class Role extends BaseModel
{
    const TABLE = "zm_role";
    public static $fieldsMap = array(
        'id'         => array('name'=>'ID',  'desc'=>''),
        'name'       => array('name'=>'角色名称', 'desc'=>''),
        'operator'   => array('name'=>'操作人', 'desc'=>''),
        'create_time'=> array('name'=>'创建时间', 'desc'=>''),
        'update_time'=> array('name'=>'更新时间', 'desc'=>''),
        
    );
    
    public static function getListBreadcrumb()
    {
        return $breadcrumb = array(
            '首页'=>array(
                'uri'   =>'',
                'icon'  =>'fa fa-home',
            ),
            '角色'=>array(
                'uri'   =>'',
                'icon'  =>'fa fa-list-ul',
            ),
            '列表'=>array(
                'uri'   =>'#',
                'icon'  =>'',
            )
        );
    }
    
    public static function getSettingBreadcrumb()
    {
        return $breadcrumb = array(
            '首页'=>array(
                'uri'   =>'',
                'icon'  =>'fa fa-home',
            ),
            '角色'=>array(
                'uri'   =>'',
                'icon'  =>'fa fa-list-ul',
            ),
            '权限配置'=>array(
                'uri'   =>'#',
                'icon'  =>'',
            )
        );
    }
    
    public static function getFiledDistinct($fileds='')
    {
        $table = Role::TABLE;
        $query = "select {$fileds} from {$table} group by {$fileds}";
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
        return \DB::table(Role::TABLE)->insertGetId($params);
    }
    
    public static function postUpdate($where, $params)
    {
        list($k, $v) = $where;
        return \DB::table(Role::TABLE)->where($k, $v)
        ->update($params);
    }
    
    public static function postDelete($id)
    {
        return \DB::table(Role::TABLE)->where('id',  '=', $id)->delete();
    }
    
    public static function getRole($id=0)
    {
        $table = Role::TABLE;
        $where = "";
        if ($id != 0) $where = "where id={$id}";
        $query = "select * from {$table} {$where}";
        return \DB::reconnect()->select($query);
    }
    
}
