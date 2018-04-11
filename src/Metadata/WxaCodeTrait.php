<?php

namespace Miaoxing\WxaCode\Metadata;

/**
 * WxaCodeTrait
 *
 * @property int $id
 * @property int $appId
 * @property string $name
 * @property int $type
 * @property string $path
 * @property string $scene
 * @property int $width
 * @property bool $autoColor
 * @property string $lineColor
 * @property bool $deletable 是否可删除
 * @property int $scanUser
 * @property int $scanCount
 * @property string $createdAt
 * @property string $updatedAt
 * @property int $createdBy
 * @property int $updatedBy
 * @property string $deletedAt
 * @property int $deletedBy
 */
trait WxaCodeTrait
{
    /**
     * @var array
     * @see CastTrait::$casts
     */
    protected $casts = [
        'id' => 'int',
        'app_id' => 'int',
        'name' => 'string',
        'type' => 'int',
        'path' => 'string',
        'scene' => 'string',
        'width' => 'int',
        'auto_color' => 'bool',
        'line_color' => 'string',
        'deletable' => 'bool',
        'scan_user' => 'int',
        'scan_count' => 'int',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'created_by' => 'int',
        'updated_by' => 'int',
        'deleted_at' => 'datetime',
        'deleted_by' => 'int',
    ];
}
