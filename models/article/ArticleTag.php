<?php
/**
 * 文章/标签关系表
 */
namespace app\models\article;

use app\models\article\ArticleDB;

class ArticleTag extends ArticleDB
{
    public static function tableName()
    {
        return "info_tag_article";
    }

    public function rules()
    {
        return array_merge(parent::rules(),[
            [['tagid','artid'],'required'],
            ['artid','integer'],
            ['tagid','string'],
        ]);
    }

    //添加文章标签
    public function add($params)
    {
        $this->load($params,'');
        $this->validate();
        $error = $this->getErrors();
        if(!$error)
        {
            $tagId = explode(',',$this->tagid);
            $data = self::find()->select('tagid')->where(['=','artid',$this->artid])->asArray()->all();
            $oldTagId = array_map('array_shift',$data);
            $new = array_diff($tagId,$oldTagId);
            if(!empty($new))
            {
                foreach ($new as $key => $val)
                {
                    $model = clone $this;
                    $model->tagid = $val;
                    $model->save();
                    $result = $model->primaryKey;
                }
            }
            $old = array_diff($oldTagId,$tagId);
            if(!empty($old))
            {
                $result = $this->deleteAll(['and',['=','artid',$this->artid],['in','tagid',$old]]);
            }
            return $result;
        }else{
            return $error;
        }
    }
}