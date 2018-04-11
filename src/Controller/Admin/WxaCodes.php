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

    public function showImageAction($req)
    {
        $wxaCode = wei()->wxaCodeModel()->findOrInit(['path' => $req['path']]);

        $account = wei()->wechatAccount->getCurrentAccount();
        $api = $account->createApiService();
        $image = $api->getWxaCode([
            'path' => $wxaCode->path,
            'width' => $wxaCode->width,
            'auto_color' => $wxaCode->autoColor,
        ]);

        if ($req['download']) {
            $this->setDownloadHeader($wxaCode->path . '.jpg');
        } else {
            $this->response->setHeader('Content-type', 'image/jpeg');
        }

        $this->response->send();
        echo $image;
    }

    protected function setDownloadHeader($name)
    {
        $name = rawurlencode($name);

        // For IE
        $userAgent = $this->request->getServer('HTTP_USER_AGENT');
        if (preg_match('/MSIE ([\w.]+)/', $userAgent)) {
            $filename = '=' . $name;
        } else {
            $filename = "*=UTF-8''" . $name;
        }

        // Step2 构造下载头部
        $this->response->setHeader([
            'Content-Description' => 'File Transfer',
            'Content-Type' => 'application/x-download',
            'Content-Disposition' => 'attachment;filename' . $filename,
            'Content-Transfer-Encoding' => 'binary',
            'Expires' => '0',
            'Cache-Control' => 'must-revalidate',
            'Pragma' => 'public',
        ]);
    }
}
