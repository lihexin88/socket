<?php

namespace app\gatewayapp\controller;


use GatewayWorker\Lib\Gateway;


/**
 * 主逻辑
 * 主要是处理 onConnect onMessage onClose 三个方法
 * onConnect 和 onClose 如果不需要可以不用实现并删除
 */
class GwEvents
{

    /**
     * 当客户端连接时触发
     * 如果业务不需此回调可以删除onConnect     *
     * @param int $client_id 连接id
     */
    public static function onConnect($client_id)
    {
<<<<<<< HEAD
        // 向当前client_id发送数据
        $r = msg_handle('init','已绑定');
        Gateway::sendToClient($client_id, json_encode($r));
        // 向所有人发送
//        $r['type']='normal';
//        $r['data'] = ['message'=>'上线'];
//        Gateway::sendToAll(json_encode($r));
=======
        $r['type']='2';
        $r['data']=$client_id;
        Gateway::sendToClient($client_id,json_encode($r));
        $r['type'] = "3";
        $r['data'] = "用户上线";
        Gateway::sendToAll(json_encode($r));

>>>>>>> parent of 9edf1bf... change_gateway_version
    }

    /**
     * 当客户端发来消息时触发
     * @param int $client_id 连接id
     * @param mixed $message 具体消息
     */
<<<<<<< HEAD
    public static function onMessage($client_id, $message)
    {
        // 向所有人发送
        $r = msg_handle('normal',$message);
        Gateway::sendToAll(json_encode($r));
=======
    public static function onMessage($client_id,$message)
    {
        $message = json_decode($message);
        $message->time = date("H:m:s",time());
        $r = [
            'type'=>1,
            'data'=>$message,
        ];
//        print_r($r);
        Gateway::sendToAll(json_encode($r));

>>>>>>> parent of 9edf1bf... change_gateway_version
    }

    /**
     * 当用户断开连接时触发
     * @param int $client_id 连接id
     */
    public static function onClose($client_id)
    {
        // 向所有人发送
        GateWay::sendToAll(sprintf('用户 %s 已退出！', $client_id));
    }

}
