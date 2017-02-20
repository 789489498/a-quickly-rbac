<?php

namespace App\Models\Zuimei;
use App\Models\BaseModel;

class UserRole extends BaseModel
{
    const TABLE = "zm_user_role";
    public static $fieldsMap = array(
        'id'         => array('name'=>'ID',  'desc'=>''),
        'username'   => array('name'=>'账号', 'desc'=>''),
        'role_id'    => array('name'=>'角色', 'desc'=>''),
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
            '用户'=>array(
                'uri'   =>'',
                'icon'  =>'fa fa-list-ul',
            ),
            '授权'=>array(
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
        $table = UserRole::TABLE;
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
        $update_cols = array(
            'username','role_id','operator','create_time'
        );
        $connection = \DB::reconnect(); 
        return BaseModel::Factory()->setTable(UserRole::TABLE)
        ->setConnection($connection)->insertDup($params, $update_cols);
    }
    
    public static function postUpdate($where, $params)
    {
        list($k, $v) = $where;
        return \DB::table(UserRole::TABLE)->where($k, $v)
        ->update($params);
    }
    
    public static function postDelete($params)
    {
        $table = UserRole::TABLE;
        list($where, $bindValues) = BaseModel::Factory()->getConditions($params);
        $query = "delete from {$table} where {$where}";
        return \DB::connection()->delete($query, $bindValues);
    }
    
    public static function getRole($params)
    {
        $table = UserRole::TABLE;
        list($where, $bindValues) = BaseModel::Factory()->getConditions($params);
        $where = empty($where) ? "" : "where {$where}";
        $query = "select * from {$table} {$where}";
        return \DB::reconnect()->select($query, $bindValues);
    }
    
    public static function getRoleRouteCollect($params)
    {
        return RoleRoute::getRoleRoute($params);
    }
    
}
