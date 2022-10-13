<?php
namespace app\components;

use Yii;
use yii\db\BaseActiveRecord;

class IpBehavior extends \yii\behaviors\AttributeBehavior {
    /** @var string $ipAttribute the attribute that will receive user ip value */
    public string $ipAttribute = 'ip';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_BEFORE_INSERT => [$this->ipAttribute],
                BaseActiveRecord::EVENT_BEFORE_UPDATE => $this->ipAttribute,
            ];
        }
    }

    protected function getValue($event)
    {
        if ($this->value === null) {
            return Yii::$app->getRequest()->getUserIP();
        }

        return parent::getValue($event);
    }
}