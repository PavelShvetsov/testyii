<?php

use yii\db\Migration;

class m170803_103922_rbac extends Migration
{
    public function safeUp()
    {
        /*$this->batchInsert('auth_item', [
            'name',
            'type',
        ],[
            ['admin', 1],
            ['user', 1],
            ['create', 2],
            ['read', 2],
            ['update', 2],
            ['delete', 2],
        ]);

        $this->batchInsert('auth_item_child', [
            'parent',
            'child',
        ],[
            ['admin', 'update'],
            ['admin', 'delete'],
            ['user', 'create'],
            ['user', 'read'],
            ['admin', 'user'],
        ]);

        $this->batchInsert('auth_assignment', [
            'item_name',
            'user_id',
        ],[
            ['admin', 1],
            ['user', 2],
        ]);*/
        return true;
    }

    public function safeDown()
    {
        $this->delete('auth_assignment');
        $this->delete('auth_item');
        $this->delete('auth_item_child');
        $this->delete('auth_rule');
        return true;
    }
}
