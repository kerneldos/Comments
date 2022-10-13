<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%place}}".
 *
 * @property int $id
 * @property string|null $name
 */
class Place extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string {
        return '{{%place}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getComments(): ActiveQuery {
        return $this->hasMany('app\models\Comment', ['subject_id' => 'id'])->andFilterWhere(['subject' => 'place']);
    }
}
