<?php
namespace app\components;

use Yii;
use app\models\ScheduleTask;

class Notifier extends \yii\base\Component
{
    public function checkUpcomingTasks()
    {
        $upcomingTasks = ScheduleTask::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->andWhere(['is_completed' => false])
            ->andWhere(['between', 'task_date', date('Y-m-d'), date('Y-m-d', strtotime('+3 days'))])
            ->all();

        foreach ($upcomingTasks as $task) {
            $this->sendNotification($task);
        }
    }

    protected function sendNotification($task)
    {
        Yii::$app->session->addFlash('info',
            "Напоминание: {$task->task_title} запланировано на {$task->task_date} в {$task->task_time}");
    }
}