<?php

namespace app\models;


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
        'new' => 1,
        'approved' => 2,
        'rejected' => 3,
    ];

    const ENTITIES = [
        'place' => 'Place',
        'review' => 'Review',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string {
        return '{{%comment}}';
    }

    public function behaviors(): array {
        return [
            'yii\behaviors\TimestampBehavior',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array {
        return [
            [['subject', 'subject_id', 'comment'], 'required'],
            [['subject_id', 'status'], 'integer'],
            ['status', 'in', 'range' => array_values(self::STATUSES)],
            [['status'], 'default', 'value' => self::STATUSES['new']],
            [['comment'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['subject'], 'string', 'max' => 30],
            [['username', 'user_agent'], 'string', 'max' => 255],
            [['user_agent'], 'default', 'value' => $_SERVER['HTTP_USER_AGENT'] ?? php_sapi_name()],
            [['ip'], 'string', 'max' => 15],
            [['ip'], 'default', 'value' => $_SERVER['HTTP_CLIENT_IP'] ?? ($_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? gethostbyname(gethostname()))],
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
