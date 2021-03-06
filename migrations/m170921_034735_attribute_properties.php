<?php

use yii\db\Migration;

class m170921_034735_attribute_properties extends Migration
{
    public function safeUp()
    {
        $this->createTable('attribute_properties', [
            'id' => $this->primaryKey(),
            'valid_id' => $this->integer(),
            'code' => $this->string(),
            'label' => $this->string(),
        ]);

        $this->addForeignKey(
            'fk-attribute_properties-valid_id',
            'attribute_properties',
            'valid_id',
            'validate',
            'id',
            'CASCADE'
        );

        $this->addColumn('user_attributes', 'active', $this->boolean());
    }

    public function safeDown()
    {
        $this->dropColumn('user_attributes', 'active');

        $this->dropForeignKey(
            'fk-attribute_properties-valid_id',
            'attribute_properties'
        );
        $this->dropTable('attribute_properties');
    }
}
