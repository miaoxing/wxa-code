<?php

namespace Miaoxing\WxaCode\Metadata;

/**
 * WxaCodeLogTrait
 *
 * @property int $id
 * @property int $appId
 * @property int $userId
 * @property int $codeId
 * @property int $action
 * @property string $createdAt
 */
trait WxaCodeLogTrait
{
    /**
     * @var array
     * @see CastTrait::$casts
     */
    protected $casts = [
        'id' => 'int',
        'app_id' => 'int',
        'user_id' => 'int',
        'code_id' => 'int',
        'action' => 'int',
        'created_at' => 'datetime',
    ];
}
