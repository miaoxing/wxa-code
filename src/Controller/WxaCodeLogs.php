<?php

namespace Miaoxing\WxaCode\Controller;

use Miaoxing\Plugin\BaseController;
use Miaoxing\WxaCode\Service\WxaCodeModel;

class WxaCodeLogs extends BaseController
{
    public $guestPages = [
        'wxaCodeLogs',
    ];

    public function createAction($req)
    {
        $data = $this->request->getData();
        $data += (array) json_decode($this->request->getContent(), true);
        $this->request->fromArray($data);

        $this->logger->info('上报小程序onShow', $this->request->getContent());

        // 统一使用绝对的路径
        $path = '/' . $req['path'];
        $wxaCode = wei()->wxaCodeModel()->find(['path' => $path]);
        if (!$wxaCode) {
            return $this->err('小程序码不存在');
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
