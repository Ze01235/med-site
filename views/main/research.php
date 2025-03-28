<?php
use yii\helpers\Html;

$this->title = 'Детали исследования';
?>

<h1>Исследование #<?= Html::encode($research['number']) ?></h1>

<div class="research-details">
    <p>Статус: <?= Html::encode($research['status'] === 'completed' ? 'Завершено' : 'В процессе') ?></p>
    <p>Лаборатория: <?= Html::encode($research['laboratory']['name']) ?></p>
    <p>Адрес: <?= Html::encode($research['laboratory']['address']) ?></p>
    <p>Дата направления: <?= Yii::$app->formatter->asDate($research['directionDate']) ?></p>

    <?php if (!empty($pdf['pdf'])): ?>
        <div class="pdf-download">
            <a href="<?= $pdf['pdf'] ?>" download="research_<?= $research['number'] ?>.pdf">
                Скачать PDF документа
            </a>
        </div>
    <?php endif; ?>
</div>