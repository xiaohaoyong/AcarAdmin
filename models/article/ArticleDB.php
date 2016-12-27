<?php
/**
 * 资讯数据库
 */
namespace app\models\article;

use yii\db\ActiveRecord;

class ArticleDB extends ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->dbzx;
    }
}