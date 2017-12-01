<?php

use yii\db\Migration;

class m171130_051034_iblock_section extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%iblock_section}}', [
            'id' => $this->primaryKey(),
            'iblock_id' => $this->integer()->notNull(),
            'iblock_section_id' => $this->integer(),
            'code' => $this->string(),
            'name' => $this->string()->notNull(),
            'active' => $this->smallInteger(1)->defaultValue(0),
            'sort' => $this->integer(),
            'picture' => $this->string(),
            'detail_picture' => $this->string(),
            'description' => $this->text(),
            'left_margin' => $this->integer(),
            'right_margin' => $this->integer(),
            'depth_level' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk-iblock_section-iblock_id',
            '{{%iblock_section}}',
            'iblock_id',
            '{{%iblock}}',
            'id',
            'CASCADE'
        );

        $this->createIndex('idx-category-iblock_section_id', '{{%iblock_section}}', 'iblock_section_id');

        $this->addForeignKey('fk-category-parent', '{{%iblock_section}}', 'iblock_section_id', '{{%iblock_section}}', 'id', 'SET NULL', 'RESTRICT');

        $this->createIndex(
            'idx-iblock_section-left_margin',
            '{{%iblock_section}}',
            ['iblock_id', 'left_margin','right_margin'],
            true
        );

        $this->createIndex(
            'idx-iblock_section-code',
            '{{%iblock_section}}',
            ['iblock_id', 'code'],
            true
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%iblock_section}}');
    }
}
