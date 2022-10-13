<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "{{%review}}".
 *
 * @property int $id
 * @property string|null $content
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%review}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getComments(): ActiveQuery {
        return $this->hasMany('app\models\Comment', ['subject_id' => 'id'])->andFilterWhere(['subject' => 'review']);
    }
}
