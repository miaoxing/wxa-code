<?php

namespace Miaoxing\WxaCode\Service;

use Miaoxing\Plugin\BaseModelV2;
use Miaoxing\Plugin\Model\HasAppIdTrait;
use Miaoxing\WxaCode\Metadata\WxaCodeTrait;

/**
 * WxaCodeModel
 */
class WxaCodeModel extends BaseModelV2
{
    use WxaCodeTrait;
    use HasAppIdTrait;

    public function getWidthAttribute()
    {
        return $this->data['width'] ?: 430;
    }
}
