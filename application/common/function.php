<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/30
 * Time: 15:12
 */
/**
 * 信息处理
 * @param $msg
 * @param $code
 * @param array $data
 * @return array
 */
function msg_handle($type, $data = array())
{
    //type 为类型：1，接收来自客户端消息   2，服务器反馈的消息  3, 服务器统一推送  -1 错误     。。。待加
    return array('type'=>$type,'data' => $data);
}
function GetUserInfoByUid($uid)
{
    return \app\common\model\UserInfo::get(['id'=>$uid]);
}