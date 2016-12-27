<?php
/**
 * 标签表
 */
namespace app\models\article;

use app\models\article\ArticleDB;

class Tag extends ArticleDB
{
    public static function tableName()
    {
        return "info_tag";
    }

    public function rules()
    {
        return array_merge(parent::rules(),[
            ['name','required','message' => '请添加文章标签'],
            ['name','string','max' => 15, 'message' => '标签字数超过15字'],
            ['heat','default','value' => 1],
            ['createTime','default','value' => time()]
        ]);
    }

    public function getInfo($params)
    {
        return $this::findOne($params);
    }

    public function add($params)
    {
        $this->load($params);
        $this->validate();
        $error = $this->getErrors();
        if(!$error)
        {
            $name = explode(' ',$this->name);//新添加的
            $data = self::find()->select('name,id')->where(['in','name',$name])->asArray()->all();
            if(empty($data))
            {
                foreach ($name as $key => $val)
                {
                    $model = clone $this;
                    $model->name = $val;
                    $model->save();
                    $result[] = $model->primaryKey;
                }
                return implode(',',$result);
            }else{
                $id = array_map('array_pop',$data);
                $tag = array_map('array_shift',$data);//数据库已有的
                $new = array_diff($name,$tag);
                $old = array_diff($tag,$name);
                if(!empty($old))
                {
                    self::updateAllCounters(['heat' => 1],['in','name',$old]);
                }
                if(!empty($new))
                {
                    foreach ($new as $key => $val)
                    {
                        $model = clone $this;
                        $model->name = $val;
                        $model->save();
                        $result[] = $model->primaryKey;
                    }
                }
                $tagIds = !empty($result) ? array_merge($id,$result) : $id;

                return implode(',',$tagIds);
            }
        }else{
            return $error;
        }
    }
}