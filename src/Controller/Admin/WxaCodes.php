<?php

namespace Miaoxing\WxaCode\Controller\Admin;

use Miaoxing\Admin\Action\CrudTrait;
use Miaoxing\Plugin\BaseController;
use Miaoxing\Plugin\BaseModelV2;
use Miaoxing\Plugin\Service\Request;

class WxaCodes extends BaseController
{
    use CrudTrait;

    protected $controllerName = '小程序码';

    protected $actionPermissions = [
        'index' => '列表',
        'new,create' => '创建',
        'edit,update' => '更新',
        'destroy' => '删除',
    ];

    public function beforeIndexFind(Request $req, BaseModelV2 $models)
    {
        $models->like(['name', 'path']);
    }
}
