<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/29
 * Time: 15:00
 */
namespace app\gatewayapp\controller;

use think\Controller;

class Index extends Controller {

    public function index() {
        return $this->fetch();
    }

}