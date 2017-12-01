<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 */
class m170727_040054_create_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        /*$this->createTable('news', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'content' => $this->text(),
        ]);*/
    }

    public function down()
    {
        $this->dropTable('news');
    }
}
