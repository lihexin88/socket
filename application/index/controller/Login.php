<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/30
 * Time: 8:38
 */

namespace app\index\controller;

use app\common\model\UserInfo;
use app\gatewayapp\controller\GwEvents;
use think\Controller;
use think\Db;

class Login extends Controller
{
    /**
     * 返回登录页面
     * @return mixed
     */
    public function login()
    {
        return $this->fetch();
    }

    /**
     * 登录处理
     * @throws \think\exception\DbException
     */
    public function post_login()
    {
        if(!$_POST){
            return "error";
        }
//        print_r($_POST);
        $User = UserInfo::get(['username'=>$_POST['username'],'password'=>$_POST['password']]);
        if(!$User) {
            $this->redirect("login");
        }
            session_start();
            $_SESSION['uid'] = $User['id'];
            $this->redirect('../index');
    }
    public function logout()
    {
        return $this->fetch('login/loign');
    }
}