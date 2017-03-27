<?php

namespace App\Models;

class BaseModel
{
    private $_connection;
    private $_table;
    protected  $fetch_mode = \PDO::FETCH_OBJ;
    
    /**
     * 
     * @var $FieldsRangeMinCollect  标识范围左临界字段k,(a>=1)
     * @var $FieldsRangeMaxCollect  标识范围右临界字段k,(a<=1)
     * @var $FieldsLikeCollect      标识模糊匹配的字段k,(a like 'aa')
     * @var $FieldsNotLikeCollect   标识不包含模糊匹配的字段k,(a not like 'aa')
     * @var $FieldsNotEqualCollect  标识不等的字段k,(a!='2')
     * @var $FieldsRegexpCollect    标识正则匹配的字段k,(a regexp '^a')
     * @var $FieldsNotRegexpCollect 标识正则不能匹配的字段k,(a not regexp '^a')
     */
    protected $FieldsRangeMinCollect    = [];
    protected $FieldsRangeMaxCollect 	= [];
    protected $FieldsLikeCollect        = [];
    protected $FieldsNotLikeCollect     = [];
    protected $FieldsEqualCollect       = [];
    protected $FieldsNotEqualCollect 	= [];
    protected $FieldsRegexpCollect      = [];
    protected $FieldsNotRegexpCollect   = [];
    protected $ParametersFromSend       = [];
    protected $PreparedBindingValues    = [];
    protected $FillParamType            = 'FillKey';
    protected $DefaultDatabase          = 'mysql';
    
    public function setFieldsRangeMinCollect($value) {$this->FieldsRangeMinCollect[$value] = '';return $this;}
    public function setFieldsRangeMaxCollect($value) {$this->FieldsRangeMaxCollect[$value] = '';return $this;}
    public function setFieldsLikeCollect($value) {$this->FieldsLikeCollect[$value] = '';return $this;}
    public function setFieldsNotLikeCollect($value) {$this->FieldsNotLikeCollect[$value] = '';return $this;}
    public function setFieldsEqualCollect($value) {$this->FieldsEqualCollect[$value] = '';return $this;}
    public function setFieldsNotEqualCollect($value) {$this->FieldsNotEqualCollect[$value] = '';return $this;}
    public function setFieldsRegexpCollect($value) {$this->FieldsRegexpCollect[$value] = '';return $this;}
    public function setFieldsNotRegexpCollect($value) {$this->FieldsNotRegexpCollect[$value] = '';return $this;}
    
    public function setConnection($connection)
    {
        $this->_connection = $connection;
        return $this;
    }
    
    public function setTable($table)
    {
        $this->_table = $table;
        return $this;
    }
    
    public function setPDOFetchMode($fetchMode)
    {
        $this->FETCH_MODE = $fetchMode;
        return $this;
    }
    
    /**
     * desc if no sub-class new itself, otherwise new sub-class
     * @return \App\Models\BaseModel|NULL|\App\Models\BaseModel
     */
    public static function Factory()
    {
        return new static();
    }
    
    //指定参数绑定类型
    public function setFillParamType($value)
    {
        $this->FillParamType = $value;
        return $this;
    }
    
    /**
     * 根据params生成where条件,仅适用于一个字段一个条件限制
     * 要生成多个条件限制可拆分params分别调用并最后合并所有条件
     * @param unknown $params
     * @return string
     */    
    public function getConditions(&$params)
    {
        $conditions = array();
        $this->ParametersFromSend = $params;
        foreach ($params as $k=> $v) {
            if ($v == '' || $k == '') continue;
            $conditions[$k] = $this->getInnerConditions($k, $v);
        }
        $where = implode(' and ', $conditions);
        return array(
            $where,
            $this->PreparedBindingValues,
        );
    }
    
    public function getInnerConditions($k, $v)
    {
        $inner = array();
        $v = explode(',', str_replace(array('|'), ',', trim($v)));
        foreach ($v as $v1) {
            $inner[] = $this->getFilledSegments($k, $v1); 
        }
        if (count($v) == 1) {
            return  implode(' or ', $inner);
        }
        return '('. implode(' or ', $inner) .')';
    }
    
    //FillKey:用key填充
    public function fillWithKey($k, $with)
    {
        return "{$k} {$with} :{$k}";
    }
    
    //FillSym:用符号填充
    public function fillWithSym($k, $with)
    {
        return "{$k} {$with} ?";
    }
    
    //FillKvs:用k-v填充
    public function fillWithKvs($k, $v, $with)
    {
        return "{$k} {$with} '{$v}'";
    }
    
    public function doFill($k, $v='', $with, $rule)
    {
        $segment  = "";
        $fillType = $this->FillParamType;
        
        if ($rule != '') {
            $v = str_replace('?', $v, $rule);
        }
        
        //FillKey:用key填充
        if ($fillType == 'FillKey') {
            $segment  = $this->fillWithKey($k, $with);
            $this->PreparedBindingValues[$k] = $v;
        }
        //FillSym:用符号填充
        if ($fillType == 'FillSym') {
            $segment  = $this->fillWithSym($k, $with);
            $this->PreparedBindingValues[] = $v;
        }
        //FillKvs:用k-v填充
        if ($fillType == 'FillKvs') {
            $segment  = $this->fillWithKvs($k, $v, $with);
        }
        return $segment;
    }
    
    //完成参数填充和绑定工作
    public function getFilledSegments($k, $v='')
    {
        $segment = "";
        if (array_key_exists($k, $this->FieldsLikeCollect))         {
            $rule = $this->FieldsLikeCollect[$k];
            $segment = $this->doFill($k, $v, 'like', $rule);
        }
        elseif (array_key_exists($k, $this->FieldsNotEqualCollect)) {
            $rule = $this->FieldsNotEqualCollect[$k];
            $segment = $this->doFill($k, $v, '!=', $rule);
        }
        elseif (array_key_exists($k, $this->FieldsNotLikeCollect))  {
            $rule = $this->FieldsNotLikeCollect[$k];
            $segment = $this->doFill($k, $v, 'not like', $rule);
        }
        elseif (array_key_exists($k, $this->FieldsNotRegexpCollect)){
            $rule = $this->FieldsNotRegexpCollect[$k];
            $segment = $this->doFill($k, $v, 'not regexp', $rule);
        }
        elseif (array_key_exists($k, $this->FieldsRangeMaxCollect)) {
            $rule = $this->FieldsRangeMaxCollect[$k];
            $segment = $this->doFill($k, $v, '<=', $rule);
        }
        elseif (array_key_exists($k, $this->FieldsRangeMinCollect)) {
            $rule = $this->FieldsRangeMinCollect[$k];
            $segment = $this->doFill($k, $v, '>=' ,$rule);
        }
        elseif (array_key_exists($k, $this->FieldsRegexpCollect))   {
            $rule = $this->FieldsRegexpCollect[$k];
            $segment = $this->doFill($k, $v, 'regexp', $rule);
        }
        elseif (array_key_exists($k, $this->FieldsEqualCollect))    {
            $rule = $this->FieldsEqualCollect[$k];
            $segment = $this->doFill($k, $v, '=', $rule);
        }
        else {
            $segment = $this->doFill($k, $v, '=', '');
        }
        return $segment;
    }
    
    public function md5($key, &$params)
    {
        if (isset($params[$key])) {
            $params[$key] = md5($params[$key]);
        }
    }
    
    /**
     * 
     * @param return array
     */
    public function getTableColumns($table)
    {
        $result = array();
        $pdo = \DB::reconnect($this->DefaultDatabase)->getPdo();
        $statement = $pdo->query('DESCRIBE ' . $table);
        $v = $statement->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($v as $k1=> $v1) {
            $result[] = $v1['Field'];
        }
        return $result;
    }
    
    /**
     * 
     * @param $result
     * @param string $key1,one field only
     * @param string $key2,more fields,like "a:b,c:d"
     * @return array
     */
    public static function format2Array(&$result, $key1, $key2='')
    {
        $records = array();
        //if param $key2 formatted kv group like "a:b" or "a:b,c:d"
        if (substr_count($key2, ',') != 0 || substr_count($key2, ':') != 0) {
            $key2 = explode(',', $key2);
            foreach ($result as $k=> $v) {
                if (count($key2) == 1 ) {       //a:b
                    list($seg1, $seg2) = explode(':', $key2[0]);
                    $segValue = self::getSegValue($v, $seg2);
                    $records[$v->$key1][$v->$seg1] = $segValue;
                    continue;
                }
                $row = array();
                foreach ($key2 as $k2) {        //a:b,c:d...
                    list($seg1, $seg2) = explode(':', $k2);
                    $segValue = self::getSegValue($v, $seg2);
                    $row[$v->$seg1] = $segValue;
                }
                $records[$v->$key1][] = $row;
            }
            return $records;
        }
        //if param $key2 is just a key or empty
        foreach ($result as $k=> $v) {
            if ($key2 === '') $records[$v->$key1] = (array) $v;
            else $records[$v->$key1] = $v->$key2;
        }
        return $records;
    }
    
    public static function getSegValue(&$v, $k)
    {
        if ($k === '') {
            return '';
        }
        return $v->$k;
    }
    
    
    /**
     * insert with update
     *
     * @param $pairs array 单行数据key/value对
     * @param $update_cols array 唯一键冲突时更新的字段
     * @return boolean
     */
    public function insertDup($pairs, $update_cols)
    {
        $columns = array_keys($pairs);
        $values  = array_values($pairs);
        $update  = $field = $char = '';
        foreach($columns as $v) {
            $field .= "{$char}{$v} = ? ";
            $char   = ',';
        }
        $char = '';
        foreach($update_cols as $col) {
            $update .= "{$char}{$col} = ? ";
            $char    = ',';
            array_push($values, $pairs[$col]);
        }
        $sql = "insert `{$this->_table}` set {$field} on duplicate key update {$update}";
        return $this->_connection->insert($sql, $values);
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
    
    public static function getTreeByPid(&$result, $id=0)
    {
        $record = array();
        foreach ($result as $k=> $v) {
            if ($v['pid'] == $id) {
                $record = self::getTreeById($result, $v['id']);
                $record = array_merge($record, array($v['id']));
            }
        }
        return $record;
    }
    
    public static function getTreeById(&$result, $id=0)
    {
        $record = array();
        foreach ($result as $k=> $v) {
            if ($v['id'] == $id) {
                $record = self::getTreeById($result, $v['pid']);
                $record = array_merge($record, array($v['id']));
            }
        }
        return $record;
    }
    
    public static function getTreePid(&$result, $id=0)
    {
        $pid = 0;
        foreach ($result as $k=> $v) {
            if ($v['id'] == $id) {
                if ($v['pid'] != 0) {
                    $pid = self::getTreePid($result, $v['pid']);
                } else {
                    $pid = $v['id'];
                }
            }
        }
        return $pid;
    }
    
    public static function humanTimeDiffFormat($timestamp, $curTs=0)
    {
        $diff = "";

        if ($curTs == 0) $curTs = time();
        $ts = $curTs - $timestamp;
        
        if ($ts <= 0 ) $diff = "刚刚";
        if ($ts > 1 && $ts < 60) $diff = "{$ts} 秒前";
        else if (($ts >= 60 && $ts < 360) && ($ts = ceil($ts / 60)))
            $diff = "{$ts} 分钟前";
        else if (($ts >= 360 && $ts < 86400) && ($ts = ceil($ts / 360)))
            $diff = "{$ts} 小时前";
        else if (($ts >= 86400 && $ts < 604800) && ($ts = ceil($ts / 86400)))
            $diff = "{$ts} 天前";
        else if (($ts >= 604800 && $ts < 2592000) && ($ts = ceil($ts / 604800)))
            $diff = "{$ts} 周前";
        else if (($ts >= 2592000 && $ts < 31536000) && ($ts = ceil($ts / 2592000)))
            $diff = "{$ts} 月前";
        else if (($ts >= 31536000) && ($ts = ceil($ts / 31536000)))
            $diff = "{$ts} 年前";
        return $diff;
    }
    
    
}