<?php

namespace Miaoxing\WxaCode\Controller;

use Miaoxing\Plugin\BaseController;
use Miaoxing\WxaCode\Service\WxaCodeModel;

class WxaCodeLogs extends BaseController
{
    public $guestPages = [
        'wxaCodeLogs',
    ];

    protected $validScenes = [
        1011, // 扫描二维码
        1012, // 长按图片识别二维码
        1013, // 手机相册选取二维码
        1047, // 扫描小程序码
        1048, // 长按图片识别小程序码
        1049, // 手机相册选取小程序码
    ];

    public function createAction($req)
    {
        $data = $this->request->getData();
        $data += (array) json_decode($this->request->getContent(), true);
        $this->request->fromArray($data);

        $this->logger->info('上报小程序onShow', $this->request->getContent());

        if (!in_array($req['scene'], $this->validScenes)) {
            return $this->err('场景不符合');
        }

        // 统一使用绝对的路径
        $data = [];
        foreach ($req['query'] as $key => $value) {
            $data[$key] = urldecode($value);
        }
        $path = $this->url->append('/' . $req['path'], $data);
        $wxaCode = wei()->wxaCodeModel()->find(['path' => $path]);
        if (!$wxaCode) {
            return $this->err('小程序码不存在' . $path);
        }

        $user = wei()->user()->find(['wechatOpenId' => $req['wechatOpenId']]);
        if (!$user) {
            return $this->err('用户不存在');
        }

        $log = wei()->wxaCodeLogModel()->find([
            'user_id' => $user['id'],
            'code_id' => $wxaCode->id,
        ]);

        /** @var WxaCodeModel $wxaCode */
        $wxaCode->incr('scan_count', 1);
        if (!$log) {
            $wxaCode->incr('scan_user', 1);
        }

        $wxaCode->save();
        wei()->wxaCodeLogModel()->save([
            'user_id' => $user['id'],
            'code_id' => $wxaCode->id,
        ]);

        return $this->suc();
    }
}
