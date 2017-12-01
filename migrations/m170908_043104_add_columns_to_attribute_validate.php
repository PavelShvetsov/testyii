<?php

use yii\db\Migration;

class m170908_043104_add_columns_to_attribute_validate extends Migration
{
    public function safeUp()
    {
        /*$this->dropColumn('attribute_validate', 'type');
        $this->dropColumn('attribute_validate', 'required');
        $this->addColumn('attribute_validate', 'valid_id', $this->integer());
        $this->addColumn('attribute_validate', 'value', $this->integer());

        $this->addForeignKey(
            'fk-attribute_validate-valid_id',
            'attribute_validate',
            'valid_id',
            'validate',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-attribute_validate-value',
            'attribute_validate',
            'value',
            'attribute_properties',
            'id',
            'CASCADE'
        );*/
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-attribute_validate-value',
            'attribute_validate'
        );
        $this->dropForeignKey(
            'fk-attribute_validate-valid_id',
            'attribute_validate'
        );
        $this->dropColumn('attribute_validate', 'valid_id');
        $this->dropColumn('attribute_validate', 'value');
        $this->addColumn('attribute_validate', 'type', $this->string());
        $this->addColumn('attribute_validate', 'required', $this->integer());
    }
}
