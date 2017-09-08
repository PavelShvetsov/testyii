<?php

use yii\db\Migration;

class m170807_065902_add_group extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'group', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('user', 'group');
    }
}
