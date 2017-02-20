<?php

namespace App\Models\Admin;
use App\Models\BaseModel;
use DB;

class User extends BaseModel
{
    const LOGIN_TABLE = "zm_admin_user";
    const ZMES_KEY = "494c3c27fc4a6fb7c728ae0b";
    const ZMES_IV = "0eaddb87";
    const ZMES_EXPIRE = 86400;
    
    
    public static function doRegister(&$params, $table='zm_admin_user')
    {
        $params['create_time'] = date("Y-m-d H:i:s");
        return DB::table($table)->insert($params);
    }
    
    public static function getUsername()
    {
        $user = self::getUser();
        return $user['username'];
    }

    public static function getMail()
    {
        $user = self::getUser();
        return $user['mail'];
    }

    public static function getDisplay()
    {
        $user = self::getUser();
        return $user['display'];
    }

    public static function isLogin()
    {
        $user = self::getUser();

        if (!empty($user["username"]) 
            && !empty($user["time"]) 
            && (time() - $user["time"]) <= self::ZMES_EXPIRE ) {
            return true;
        } else {
            return false;
        }
    }

    public static function getUser()
    {
        $user = array();
        if (!empty($_COOKIE["admin_user"])) {
            $pfadmin = $_COOKIE["admin_user"];
            $u = json_decode(trim(mcrypt_decrypt(MCRYPT_3DES, self::ZMES_KEY, base64_decode($pfadmin), MCRYPT_MODE_CBC, self::ZMES_IV)), true);
            if (!empty($u["user"])) {
                $user = array(
                    "username" => $u["user"],
                    "time"     => $u["time"],
                    "ip"       => $u["ip"],
                );
            }
        }
        return $user;
    }

    public static function logout()
    {
        setcookie("admin_user", "", time() - 3600, "/");
    }

    public static function login(&$params)
    {
        $user = self::doLogin($params);
        if (empty($user['user'])) {
            return false;
        }
        $user["time"] = time();
        $user["ip"] = request()->getClientIp();
        $encrypt = base64_encode(mcrypt_encrypt(MCRYPT_3DES, self::ZMES_KEY, json_encode($user), MCRYPT_MODE_CBC, self::ZMES_IV));
        setcookie("admin_user", $encrypt, 0, "/");
        $_COOKIE["admin_user"] = $encrypt; // 由于此时cookie还未传给浏览器，$_COOKIE取不到已登录的信息，因此需要在这里未$_COOKIE补齐相关信息
        return true;
    }
    
    public static function doLogin(&$params, $table="zm_admin_user")
    {
        list($where, $bindValues) = BaseModel::Factory()->getConditions($params);
        \DB::reconnect()->setFetchMode(\PDO::FETCH_ASSOC);
        $userInfo = \DB::selectOne("select * from {$table} where {$where}", $bindValues);
        $userInfo = array(
            'user' => $userInfo['username'],
        );
        return $userInfo;
    }
    

    /*
    #author=wizard 2011-7-22
          参数说明
    D_URL:跳转地址
    B_URL:备份的跳转地址
    Flag:访问者所使用的协议，http/https二选一。默认为http。
          返回结果：邮箱
     */
    public static function urlLogin($D_URL='https://login.ops.ZMES.net:4430/sec/login',$B_URL='https://tool4.ops.dxt.ZMES.net:4430/sec/login',$Flag='http')
    {
        #判断D_URL是否有效,无效换备份跳转地址B_URL
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$D_URL);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  FALSE);
        $contents = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if($http_code!=200) {
            $D_URL = $B_URLz;
        }
        //跳转
        $sid = \Input::get('sid');
        //获取sid
        if(empty($sid)) {
            self::jumpToLogin($D_URL, $Flag);
        } else {
            $url = $D_URL.'?sid='.$sid;
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  FALSE);
            $result = curl_exec($ch);
            curl_close($ch);

            $userInfo = array();
            if($result != 'None')
            {
                //解码
                $decoded  = json_decode($result,true);  
                if (empty($decoded)) {
                    self::jumpToLogin($D_URL, $Flag);
                } else {
                    $userInfo = array(
                        'mail'    => $decoded['mail'],
                        'user'    => $decoded['user'],
                        'display' => $decoded['display'],
                    );
                }
            } else {
                self::jumpToLogin($D_URL, $Flag);
            }
            return $userInfo;
        }
    }

    public static function jumpToLogin($D_URL, $Flag)
    {
        $S_URL = $Flag.'://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
        $d_url = $D_URL.'?ref='.$S_URL;
        header("Location:$d_url");
        exit;
    }
}