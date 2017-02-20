<?php

namespace App\Models\Zuimei;
use App\Models\BaseModel;
use phpDocumentor\Reflection\Types\String_;

class RoleRoute extends BaseModel
{
    const TABLE = "zm_role_route";
    
    public static function postUpdate($where, $params)
    {
        list($k, $v) = $where;
        return \DB::table(Role::TABLE)->where($k, $v)
        ->update($params);
    }
    
    public static function postDelete($id)
    {
        \DB::table(Role::TABLE)->where('id',  '=', $id)->delete();
        return;
    }
    
    public static function getRole($id=0)
    {
        $table = Role::TABLE;
        $where = "";
        if ($id != 0) $where = "where id={$id}";
        $query = "select * from {$table} {$where}";
        return \DB::reconnect()->select($query);
    }
    
    public static function setRoleRoute($params)
    {
        self::removeRoleRoute($params['role_id']);
        if (!isset($params['has_route'])) return;
        foreach ($params['has_route'] as $route) {
            $segment['has_route']  = $route;
            $segment['role_id']  = $params['role_id'];
            $segment['operator'] = $params['username'];
            $segment['create_time'] = date("Y-m-d H:i:s");
            \DB::table(RoleRoute::TABLE)->insertGetId($segment);
        }
        return;
    }
    
    public static function removeRoleRoute($role_id)
    {
        $table = RoleRoute::TABLE;
        $condition = array('role_id'=>$role_id);
        list($where, $bindValues) = BaseModel::Factory()->getConditions($condition);
        return \DB::reconnect()->delete(
            "delete from {$table} where $where", $bindValues
        );
    }
    
    public static function getRoleRoute($ids)
    {
        //\DB::reconnect()->setFetchMode(\PDO::FETCH_ASSOC);
        $table = RoleRoute::TABLE;
        $where = empty($ids) ? "" : "where role_id in({$ids})";
        $query = "select * from $table $where";
        return \DB::reconnect()->select($query);
    }
    
}
