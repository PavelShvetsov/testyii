<?php

use yii\db\Migration;

class m170808_040036_user_attribute_values extends Migration
{
    public function safeUp()
    {
        $this->createTable('user_attribute_values', [
            'id' => $this->primaryKey(),
            'attr_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'value' => $this->string(),
        ]);

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-attr_id',
            'user_attribute_values',
            'attr_id',
            'user_attributes',
            'id',
            'CASCADE'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-user_id',
            'user_attribute_values',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('user_attribute_values');
    }
}
