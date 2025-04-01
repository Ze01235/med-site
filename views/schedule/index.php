<?php

use yii\helpers\Html;

$this->title = 'Расписание исследований';
?>
<section>
    <div class="patients-list">
        <?php if (empty($schedule)): ?>
            <h1>На ближайшее время исследования не запланированы</h1>
        <?php else: ?>
        <?php foreach ($schedule as $date => $events): ?>
            <div class="shedule">
            <p>
                <?= Yii::$app->formatter->asDate($date, 'EEEE, d MMMM y') ?>
            </p>
            <?php foreach ($events as $event): ?>
                <p>Время: <?= Html::encode($event['time']) ?></p>
                <?php if ($event['priority']): ?>
                    <p>Приоритет: да</p>
                <?php endif; ?>
                <p><?= Html::encode($event['title']) ?></p>
                <p><?= Html::encode($event['description']) ?></p>
            <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</section>