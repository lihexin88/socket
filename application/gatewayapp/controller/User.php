<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/29
 * Time: 16:50
 */

namespace app\gatewayapp\controller;

use app\common\model\UserInfo;

class User
{
    public function user_info()
    {
        return true;
    }

    /**
     * 获取用户信息
     * @return string
     */
    static public function get_user_info()
    {
        $b = UserInfo::get(2);
        $c = $b['username'];
//        $a = "sadf";
        return $c;
    }
}