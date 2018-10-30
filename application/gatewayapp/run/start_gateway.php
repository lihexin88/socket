<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/29
 * Time: 15:01
 */
use Workerman\Worker;
use GatewayWorker\Gateway;
use Workerman\Autoloader;

$gatewayInstance = new GwGateway();
call_user_func_array(array($gatewayInstance,'index'),array());

class GwGateway {

    private $gatewayAddress;

    public function __construct() {
        require_once dirname(__FILE__) . '/../../../vendor/autoload.php';
        include_once dirname(__FILE__).'/../const.php';
        // gateway 进程，这里使用websocket协议
        $this->gatewayAddress = sprintf('websocket://%s',GW_GATEWAY_ADDRESS);
    }

    public function index() {
        $gateway = new Gateway($this->gatewayAddress);
        // 设置名称，方便status时查看
        $gateway->name = GW_GATEWAY_NAME;
        // 设置进程数，gateway进程数建议与cpu核数相同
        $gateway->count = GW_GATEWAY_COUNT;
        // 本机ip，分布式部署时请设置成内网ip（非127.0.0.1）
        $gateway->lanIp = GW_LOCAL_HOST_IP;
        // 内部通讯起始端口，假如$gateway->count=4，起始端口为4000
        // 则一般会使用4000 4001 4002 4003 4个端口作为内部通讯端口
        $gateway->startPort = GW_GATEWAY_START_PORT;
        // 服务注册地址
        $gateway->registerAddress = GW_REGISTER_ADDRESS;

        // 心跳间隔，单位：秒，0 表示不发送心跳检测
        $gateway->pingInterval = GW_GATEWAY_PING_INTERVAL;
        // 心跳数据
        $gateway->pingData = '';

        /*
        // 当客户端连接上来时，设置连接的onWebSocketConnect，即在websocket握手时的回调
        $gateway->onConnect = function($connection) {
            $connection->onWebSocketConnect = function($connection , $http_header) {
                // 可以在这里判断连接来源是否合法，不合法就关掉连接
                // $_SERVER['HTTP_ORIGIN']标识来自哪个站点的页面发起的websocket链接
                if($_SERVER['HTTP_ORIGIN'] != 'http://kedou.workerman.net') {
                    $connection->close();
                }
                // onWebSocketConnect 里面$_GET $_SERVER是可用的
                // var_dump($_GET, $_SERVER);
            };
        };
        */

        // 如果不是在根目录启动，则运行runAll方法
        if(!defined('GLOBAL_START')) {
            Worker::runAll();
        }
    }

}