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
            <p id="f">
                <?= Yii::$app->formatter->asDate($date, 'EEEE, d MMMM y') ?>
            </p>
            <?php foreach ($events as $event): ?>
                <p id="s">Время: <?= Html::encode($event['time']) ?></p>
                <?php if ($event['priority']): ?>
                    <p id="s">Приоритет: да</p>
                <?php endif; ?>
                <p id="t"><?= Html::encode($event['title']) ?></p>
                <p id="fr"><?= Html::encode($event['description']) ?></p>
            <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</section>