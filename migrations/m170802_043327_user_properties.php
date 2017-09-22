<?php

use yii\db\Migration;

class m170802_043327_user_properties extends Migration
{
    public function safeUp()
    {
        /*$this->createTable('user_properties', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string(),
        ]);

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-user_properties-user_id',
            'user_properties',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );*/
    }

    public function safeDown()
    {
        $this->dropTable('user_properties');
        /*
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-user_properties-user_id',
            'user_properties'
        );*/
        return true;
    }
}
