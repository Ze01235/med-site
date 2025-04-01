<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%schedule_tasks}}`.
 */
class m250330_134539_create_schedule_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%schedule_tasks}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'task_title' => $this->string()->notNull(),
            'task_description' => $this->text(),
            'task_date' => $this->date()->notNull(),
            'task_time' => $this->time()->notNull(),
            'task_type' => $this->string(20),
            'is_important' => $this->boolean()->defaultValue(false),
            'is_completed' => $this->boolean()->defaultValue(false),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'fk-schedule_tasks-user_id',
            'schedule_tasks',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%schedule_tasks}}');
    }
}
