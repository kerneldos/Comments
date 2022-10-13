<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%comment}}".
 *
 * @property int $id
 * @property string $subject
 * @property int $subject_id
 * @property string|null $username
 * @property string $comment
 * @property string|null $ip
 * @property string|null $user_agent
 * @property int|null $status
 * @property string $created_at
 * @property string $updated_at
 */
class Comment extends \yii\db\ActiveRecord
{
    const STATUSES = [
        1 => 'New',
        2 => 'Approved',
        3 => 'Rejected',
    ];

    const ENTITIES = [
        'place' => 'Place',
        'review' => 'Review',
    ];

    public function init() {
        parent::init();

        if ($this->isNewRecord) {
            $this->user_agent = Yii::$app->request->getUserAgent();
            $this->status = 1;
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string {
        return '{{%comment}}';
    }

    public function behaviors(): array {
        return [
            'yii\behaviors\TimestampBehavior',
            'app\components\IpBehavior',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array {
        return [
            [['subject', 'subject_id', 'comment'], 'required'],
            [['subject_id', 'status'], 'integer'],
            ['status', 'in', 'range' => array_keys(self::STATUSES)],
            [['comment'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['subject'], 'string', 'max' => 30],
            [['username', 'user_agent'], 'string', 'max' => 255],
            [['ip'], 'string', 'max' => 15],
        ];
    }

    public function fields() {
        return [
            'id', 'subject', 'subject_id', 'username', 'created_at', 'comment', 'status',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array {
        return [
            'id' => 'ID',
            'subject' => 'Subject',
            'subject_id' => 'Subject ID',
            'username' => 'Username',
            'comment' => 'Comment',
            'ip' => 'Ip',
            'user_agent' => 'User Agent',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
