<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/29
 * Time: 15:50
 */
namespace app\common\model;

use think\Model;

class UserInfo extends Model
{
    static public function is_login()
    {
        session_start();
        if(!empty($_SESSION['uid'])){
            return true;
        }
        return false;
    }
}