<?php
namespace app\models;

use yii\db\ActiveRecord;

class ScheduleTask extends ActiveRecord
{
    const TYPE_ROUND = 'round';
    const TYPE_RECEPTION = 'reception';
    const TYPE_DOCUMENTS = 'documents';

    public static function tableName()
    {
        return 'schedule_tasks';
    }

    public function rules()
    {
        return [
            [['user_id', 'task_title', 'task_date', 'task_time'], 'required'],
            [['task_description'], 'string'],
            [['task_date'], 'date', 'format' => 'php:Y-m-d'],
            [['task_time'], 'date', 'format' => 'php:H:i'],
            [['is_important', 'is_completed'], 'boolean'],
            [['task_type'], 'in', 'range' => [self::TYPE_ROUND, self::TYPE_RECEPTION, self::TYPE_DOCUMENTS]],
        ];
    }

    public function attributeLabels()
    {
        return [
            'task_title' => 'Название задачи',
            'task_description' => 'Описание',
            'task_date' => 'Дата',
            'task_time' => 'Время',
            'task_type' => 'Тип задачи',
            'is_important' => 'Важно',
            'is_completed' => 'Выполнено',
        ];
    }
}