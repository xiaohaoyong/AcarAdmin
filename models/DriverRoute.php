<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%driver_route}}".
 *
 * @property string $id
 * @property string $userid
 * @property string $routeid
 */
class DriverRoute extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%driver_route}}';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbacar');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'routeid'], 'required'],
            [['userid', 'routeid'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => 'Userid',
            'routeid' => '路线',
        ];
    }
}
