<?php

use yii\db\Migration;

/**
 * Handles the creation of table `test`.
 */
class m170727_111712_create_test_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        /*$this->createTable('test', [
            'id' => $this->primaryKey(),
        ]);*/
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('test');
    }
}
