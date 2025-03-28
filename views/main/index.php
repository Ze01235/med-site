<?php

use yii\helpers\Html;

$this->title = 'Лабораторные исследования';
?>
<section class="toolbar" id="aq">
    <form action="<?= Yii::$app->urlManager->createUrl(['main/index']) ?>" method="get">
        <input name="s" placeholder="Поиск по ФИО, ОМС, СНИЛС" type="search"
               value="<?= Html::encode($searchQuery ?? '') ?>">
        <button type="submit"></button>
    </form>
</section>

<section>
    <div class="attributes" id="aw">
        <p id="f">ФИО</p>
        <p id="s">Дата рождения</p>
        <p id="t">ОМС</p>
        <p id="fr">Снилс</p>
    </div>

    <div class="patients-list">
        <?php if (empty($patients)): ?>
            <div class="no-results">
                <?php if (!empty($searchQuery)): ?>
                    <div class="patient">
                        <p>Пациенты по запросу "<?= Html::encode($searchQuery) ?>" не найдены</p>
                    </div>
                <?php else: ?>
                    <div class="patient">
                        <p>Нет доступных пациентов</p>
                    </div>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <?php foreach ($patients as $patient): ?>
                <div class="patient">
                    <p id="f"><?= Html::encode("{$patient['lastName']} {$patient['firstName']} {$patient['middleName']}") ?></p>
                    <p id="s"><?= Html::encode($patient['birthDate']) ?></p>
                    <span id="fr"><p id="oms"><?= Html::encode($patient['oms']) ?></p></span>
                    <p id="t"><?= Html::encode($patient['snils']) ?></p>
                    <button class="patient-card"></button>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>


<!--<h1>Исследования</h1>-->
<!--<div class="researches-list">-->
<!--    --><?php //foreach ($researches as $research): ?>
<!--        <div class="research-card">-->
<!--            <h3>-->
<!--                <a href="--><?php //= Yii::$app->urlManager->createUrl(['main/research', 'guid' => $research['labDirectionGuid']]) ?><!--">-->
<!--                    Исследование #--><?php //= Html::encode($research['number']) ?>
<!--                </a>-->
<!--            </h3>-->
<!--            <p>Статус: --><?php //= Html::encode($research['status'] === 'completed' ? 'Завершено' : 'В процессе') ?><!--</p>-->
<!--            <p>Лаборатория: --><?php //= Html::encode($research['laboratory']['name']) ?><!--</p>-->
<!--            <p>Дата создания: --><?php //= Yii::$app->formatter->asDate($research['createDate']) ?><!--</p>-->
<!--        </div>-->
<!--    --><?php //endforeach; ?>
<!--</div>-->