<?php

namespace Miaoxing\WxaCode\Migration;

use Miaoxing\Plugin\BaseMigration;

class V20180411095248CreateWxaCodesTable extends BaseMigration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->schema->table('wxa_codes')
            ->id()
            ->int('app_id')
            ->string('name', 16)
            ->tinyInt('type')
            ->string('path', 128)
            ->string('scene', 32)
            ->smallInt('width')
            ->bool('auto_color')
            ->string('line_color', 64)
            ->int('scan_user')
            ->int('scan_count')
            ->timestamps()
            ->userstamps()
            ->softDeletable()
            ->exec();
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->schema->dropIfExists('wxa_codes');
    }
}
