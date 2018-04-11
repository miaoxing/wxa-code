<?php

namespace Miaoxing\WxaCode\Service;

use Miaoxing\Plugin\BaseModelV2;
use Miaoxing\Plugin\Model\HasAppIdTrait;
use Miaoxing\WxaCode\Metadata\WxaCodeLogTrait;

/**
 * WxaCodeLogModel
 */
class WxaCodeLogModel extends BaseModelV2
{
    use WxaCodeLogTrait;
    use HasAppIdTrait;
}
