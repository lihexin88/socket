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
    return array('type'=>$type,'data' => $data);
}