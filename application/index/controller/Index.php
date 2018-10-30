<?php
namespace app\index\controller;
use app\common\model\UserInfo;
use app\gatewayapp\controller\GwEvents;

use app\index\controller\VerifyLogin;

use GatewayWorker\Lib\Gateway;
use think\Request;

class Index extends VerifyLogin
{
    /**
     * 显示首页
     * @return mixed
     */
    public function index()
    {
        $this->assign('uid',$this->uid);
        return $this->fetch();
    }

    /**
     * 绑定client_id和uid
     */
    public function bind()
    {
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
