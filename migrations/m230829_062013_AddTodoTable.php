<?php

use yii\db\Migration;

/**
 * Class m230829_062013_AddTodoTable
 */
class m230829_062013_AddTodoTable extends Migration
{
    /**
     * @return void
     */
    public function safeUp()
    {
        $this->createTable('{{%todo}}', [
            'id' => $this->primaryKey(10)->unsigned(),
            'title' => $this->text()->notNull(),
            'priority' => $this->integer(10)->unsigned()->notNull()->defaultValue(0),
            'done' => $this->boolean()->notNull()->defaultValue(0),
            'version' => $this->integer(10)->unsigned()->notNull()->defaultValue(0),
        ], 'Engine=InnoDB charset=utf8mb4');
    }

    /**
     * @return void
     */
    public function safeDown()
    {
        $this->dropTable('{{%todo}}');
    }
}
