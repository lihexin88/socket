<?php
namespace app\index\controller;
use app\common\model\UserInfo;
<<<<<<< HEAD
use GatewayWorker\Lib\Gateway;
=======
use app\gatewayapp\controller\GwEvents;

use app\index\controller\VerifyLogin;

use GatewayWorker\Lib\Gateway;
use think\Request;

>>>>>>> parent of 9edf1bf... change_gateway_version
class Index extends VerifyLogin
{
    /**
     * 显示首页
     * @return mixed
     */
    public function index()
    {
<<<<<<< HEAD

//        $onlines = Gateway::getAllUidCount();
//        var_export($onlines);
//        exit();
=======
>>>>>>> parent of 9edf1bf... change_gateway_version
        $this->assign('user_info',$this->user_info);
        $this->assign('uid',$this->uid);
        return $this->fetch();
    }

    /**
     * 绑定client_id和uid
     */
    public function bind()
    {
        print_r($_POST);
//        exit();
<<<<<<< HEAD
        $client_ids = Gateway::getClientIdByUid($this->uid);
        for($i = 0;$i<sizeof($client_ids);$i++){
            Gateway::closeClient($client_ids[$i]);
        }
=======
>>>>>>> parent of 9edf1bf... change_gateway_version
        $r = msg_handle(3,"登录成功");
        Gateway::bindUid($_POST['client_id'],$this->uid);
        $r = msg_handle('normal','已绑定uid');
        Gateway::sendToUid($this->uid,json_encode($r));
    }

    /**
     * 接收用户发来的消息
     */
    public function send()
    {
        $data = [
            'user_info'=>$this->user_info['username'],
            'time'=>date('H:m:s',time()),
            'message'=>$_POST['data']
        ];
        $r = msg_handle('normal',$data);
        Gateway::sendToAll(json_encode($r));
    }


}
