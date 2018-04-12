<?php

namespace Miaoxing\WxaCode\Migration;

use Miaoxing\Plugin\BaseMigration;

class V20180411121402CreateWxaCodeLogsTable extends BaseMigration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->schema->table('wxa_code_logs')
            ->id()
            ->int('app_id')
            ->int('user_id')
            ->int('code_id')
            ->tinyInt('action')
            ->timestamp('created_at')
            ->exec();
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->schema->dropIfExists('wxa_code_logs');
    }
}
