<?php

namespace Miaoxing\WxaCode;

use Miaoxing\Plugin\BasePlugin;

class Plugin extends BasePlugin
{
    /**
     * {@inheritdoc}
     */
    protected $name = '小程序码';

    protected $adminNavId = 'wechat';

    public function onAdminNavGetNavs(&$navs, &$categories, &$subCategories)
    {
        $navs[] = [
            'parentId' => 'wechat-account',
            'url' => 'admin/wxa-codes',
            'name' => '小程序码管理',
        ];
    }
}
