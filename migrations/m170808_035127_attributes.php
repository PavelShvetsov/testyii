<?php

use yii\db\Migration;

class m170808_035127_attributes extends Migration
{
    public function safeUp()
    {
        $this->createTable('user_attributes', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'label' => $this->string(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('user_attributes');
    }
}
