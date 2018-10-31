<?php
namespace app\index\controller;
use app\common\model\UserInfo;

use app\gatewayapp\controller\GwEvents;

use app\index\controller\VerifyLogin;
use \think\Db as Dbmodel;
use GatewayWorker\Lib\Db;
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

        $this->assign('user_info',$this->user_info);
        return $this->fetch();
    }

    /**
     * 绑定client_id和uid
     */
    public function bind()
    {
//        print_r($_POST);
//        exit();


        $client_ids = Gateway::getClientIdByUid($this->uid);
        for($i = 0;$i<sizeof($client_ids);$i++){
            Gateway::closeClient($client_ids[$i]);
        }
        Gateway::bindUid($_POST['client_id'],$this->uid);
//        print_r($_POST);
//        print_r($this->uid);
//        exit();
        $r = msg_handle(3,['message'=>'绑定成功']);
        Gateway::sendToUid($this->uid,json_encode($r));
//        print_r($this->user_info);
        $r = msg_handle(3,['message'=>$this->user_info['username']."上线"]);
        Gateway::sendToAll(json_encode($r));
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

    /**
     * 更改用户信息
     * @return bool
     */
    public function change()
    {
//        $new_name = UserInfo::get(['id'=>$this->uid]);
//        $new_name->username = $_POST['new_name'];
//        $new_name->save();
        //更新用户信息
        Dbmodel::name('user_info')->where(['id'=>$this->uid])->update(['username'=>$_POST['new_name']]);
        $this->user_info['username'] = $_POST['new_name'];
        return $this->user_info['username'];
    }

    /**
     *
     * 下线处理
     * @throws \Exception
     */
    public function offline()
    {
//        print_r($_POST);
//        exit;
        $r = msg_handle(3,['message'=>$this->user_info['username']."已下线"]);
        Gateway::sendToAll(json_encode($r));
    }


}
