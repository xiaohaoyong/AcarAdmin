<?php
namespace app\models\dynamic;

use Yii;
use yii\base\Model;

class Sensitive extends Model
{

    public $keyword;

    public function  keywords()
    {
        $redis = Yii::$app->rdmp;
        $list = $redis->zrevrange('mp:dynamic:keywords', 0, -1);
        return $list;
    }

    public function rules()
    {
        return [
            ['keyword', 'string', 'min' => 1, 'max' => 30, "tooLong" => "所添加的内容不能超过5字符", "tooShort" => "所添加的内容不小于2字符"],
            [['keyword'], 'required', 'message' => '必填内容！'],
        ];
    }

    public function add($keyword)
    {
        $model = new Sensitive();
        if ($keyword) {
            $keywords = explode('|', $keyword['Sensitive']['keyword']);
            $redis = Yii::$app->rdmp;
            if ($model->load($keyword)) {
                foreach ($keywords as $v) {
                    if (!$redis->zscore('mp:dynamic:keywords', $v)) {
                        $redis->zadd('mp:dynamic:keywords', 0, $v);
                    }
                }
                return true;
            }
        }
    }

    public function delete($keyword)
    {
        if ($keyword) {
            $redis = Yii::$app->rdmp;
            $id = $redis->zrem('mp:dynamic:keywords', $keyword);
            return $id;
        }
    }


}