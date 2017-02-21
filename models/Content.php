<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%content}}".
 *
 * @property integer $id
 * @property string $content
 * @property integer $createtime
 * @property integer $userid
 */
class Content extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%content}}';
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
            [['createtime', 'userid'], 'integer'],
            [['content'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => '内容',
            'createtime' => '添加时间',
            'userid' => '提交用户',
        ];
    }
}
