<?php

use app\models\Comment;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\CommentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Comment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'subject',
                'filter' => Comment::ENTITIES,
            ],
            'subject_id',
            'username',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d.m.Y H:i'],
                'filterInputOptions' => ['class' => 'form-control dateRange'],
            ],
            [
                'attribute' => 'comment',
                'value' => function (Comment $model) {
                    return StringHelper::truncate($model->comment, 150);
                }
            ],
            [
                'attribute' => 'status',
                'filter' => array_flip(Comment::STATUSES),
                'value' => function (Comment $model) {
                    return $model->status ? array_flip(Comment::STATUSES)[$model->status] : null;
                }
            ],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update}'],
        ],
    ]); ?>


</div>
