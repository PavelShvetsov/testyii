<?php

use yii\db\Migration;

class m170823_043550_attribute_validate extends Migration
{
    public function safeUp()
    {
        /*$this->createTable('attribute_validate', [
            'id' => $this->primaryKey(),
            'attr_id' => $this->integer()->notNull(),
            'type' => "enum('string', 'integer') NOT NULL DEFAULT 'string'",
            'required' => "enum('1','0') NOT NULL DEFAULT '0'",
        ]);

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-attribute_validate-attr_id',
            'attribute_validate',
            'attr_id',
            'user_attributes',
            'id',
            'CASCADE'
        );*/
    }

    public function safeDown()
    {
        //drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-attribute_validate-attr_id',
            'attribute_validate'
        );
        $this->dropTable('attribute_validate');

        return true;
    }

}
