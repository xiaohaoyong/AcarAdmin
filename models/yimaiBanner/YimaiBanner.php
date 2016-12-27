<?php

namespace app\models\yimaiBanner;

use Yii;
use app\components\helper\UploadHelper;

/**
 * This is the model class for table "yimai_banner".
 *
 * @property integer $id
 * @property string $title
 * @property string $imgurl
 * @property string $url
 * @property integer $status
 * @property integer $orderby
 * @property string $description
 * @property integer $extra_id
 * @property string $articleImageUrl
 * @property string $articleTitle
 * @property integer $params
 * @property integer $type
 */
class YimaiBanner extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'yimai_banner';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('dbdev');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['status', 'orderby', 'extra_id', 'params', 'type'], 'integer'],
            [['orderby', 'description', 'imgurl'], 'required'],
            [['title'], 'string', 'max' => 10],
            [['articleTitle'], 'string', 'max' => 30],
            [['imgurl', 'articleImageUrl'], 'string', 'max' => 100],
            [['url'], 'string', 'max' => 200],
            [['description'], 'string', 'max' => 50],
            ['orderby', 'integer', 'max' => 100],
            
            [['title', 'url'], 'default', 'value'=>''],
            [['extra_id', 'articleImageUrl'], 'default', 'value'=>0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', '标题'),
            'imgurl' => Yii::t('app', '上传小图'),
            'url' => Yii::t('app', '链接地址'),
            'status' => Yii::t('app', '类型'),
            'orderby' => Yii::t('app', '排序'),
            'description' => Yii::t('app', '图片文案'),
            'extra_id' => Yii::t('app', '帖子id'),
            'articleImageUrl' => Yii::t('app', '分享图标'),
            'articleTitle' => Yii::t('app', 'Article Title'),
            'params' => Yii::t('app', '正常/发现'),
            'type' => Yii::t('app', '肝友汇'),
        ];
    }
}
