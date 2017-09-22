<?php

use yii\db\Migration;

class m170908_042458_validate extends Migration
{
    public function safeUp()
    {
        $this->createTable('validate', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'label' => $this->string(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('validate');
        return true;
    }
}
