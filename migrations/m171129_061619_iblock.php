<?php

use yii\db\Migration;

class m171129_061619_iblock extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%iblock_type}}', [
            'id' => $this->string()->notNull(),
            'sort' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
        ]);

        $this->addPrimaryKey('pk-iblock_type', '{{%iblock_type}}', 'id');

        $this->createTable('{{%iblock}}', [
            'id' => $this->primaryKey(),
            'iblock_type_id' => $this->string(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'active' => $this->smallInteger(1)->notNull()->defaultValue(0),
            'sort' => $this->integer()->notNull(),
            'list_page_url' => $this->string(),
            'detail_page_url' => $this->string(),
            'section_page_url' => $this->string(),
            'canonical_page_url' => $this->string(),
        ]);

        $this->createIndex(
            'idx-iblock-iblock_type_id-active',
            '{{%iblock}}',
            ['iblock_type_id', 'active'],
            true
        );

        $this->addForeignKey(
            'fk-iblock-iblock_type_id',
            '{{%iblock}}',
            'iblock_type_id',
            '{{%iblock_type}}',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%iblock}}');
        $this->dropTable('{{%iblock_type}}');
    }
}
