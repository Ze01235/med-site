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
                    <span id="t"><p id="oms"><?= Html::encode($patient['oms']) ?></p></span>
                    <p id="fr"><?= Html::encode($patient['snils']) ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>