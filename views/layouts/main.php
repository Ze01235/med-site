<?php
/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use yii\helpers\Html;


AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<header id="ae">
    <nav>
        <ul>
            <?= Html::a('Реестр', ['/main/index']) ?>
            <?= Html::a('Расписание', '/schedule/index') ?>
            <?= Html::a('Чаты', '#') ?>
        </ul>
    </nav>
    <div class="buttons">
<!--        <button id="bell"></button>-->
<!--        <button id="arrow"></button>-->
<!--        <button id="f">-->
<!--            <p>Иван И.</p>-->
<!--            --><?php //= Html::img('@web/images/icon-account.png', [
//                'width' => 27,
//                'height' => 27,
//                'alt' => 'Профиль'
//            ]) ?>
<!--        </button>-->
    </div>
</header>


<main>
    <div class="container">
        <?= $content ?>
    </div>
</main>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>