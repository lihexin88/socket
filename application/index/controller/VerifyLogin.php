<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/30
 * Time: 11:37
 */

namespace app\index\controller;

use app\common\model\UserInfo;

use think\Controller;
use think\Request;

class VerifyLogin extends Controller
{
    public $uid;
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        if(UserInfo::is_login()){
           $this->uid = $_SESSION['uid'];
           $this->user_info = UserInfo::get($this->uid);
           return true;
        }
        $this->error("请先登录",url("login/login"));
    }
}