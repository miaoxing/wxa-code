<?php

namespace Miaoxing\WxaCode\Controller;

use Miaoxing\Plugin\BaseController;
use Miaoxing\WxaCode\Service\WxaCodeModel;

class WxaCodeLogs extends BaseController
{
    public function createAction($req)
    {
        $wxaCode = wei()->wxaCodeModel()->find(['path' => $req['path']]);
        if (!$wxaCode) {
            return $this->err('小程序码不存在');
        }

        $log = wei()->wxaCodeLogModel()->find([
            'user_id' => $this->curUser['id'],
            'code_id' => $wxaCode->id,
        ]);

        /** @var WxaCodeModel $wxaCode */
        $wxaCode->incr('scan_count', 1);
        if (!$log) {
            $wxaCode->incr('scan_user', 1);
        }

        $wxaCode->save();
        wei()->wxaCodeLogModel()->save([
            'user_id' => $this->curUser['id'],
            'code_id' => $wxaCode->id,
        ]);

        return $this->suc();
    }
}
