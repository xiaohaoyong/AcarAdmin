<?php
/**
 * 资讯model
 */
namespace app\models\article;

use yii\bootstrap\Html;

class Article extends ArticleDB
{
    public $styleData = [1 => "资讯", 2 => "专题", 3 => "视频", 4 => "活动",
        5 => "独家", 6 => "病例", 7 => "访谈", 8 => "考试",
        9 => "科研", 10 => "手术", 11 => "药品", 12 => "用药",
        13 => "政策", 14 => "指南", 15 => "推广", 16 => "会议"];
    public static function tableName()
    {
        return "info_article";
    }

    public function getTag()
    {
        return $this->hasMany(Tag::className(),['id' => 'tagid'])->viaTable('info_tag_article',['artid' => 'id']);
    }

    //文章详情
    public function info($params)
    {
        $data = $this::find()->joinWith('tag')->where(['=',self::tableName().'.id',$params])->one();
        if(!empty($data))
        {
            $data->content = Html::decode($data->content);

            $tags = "";
            foreach ($data->tag as $key => $val)
            {
                $tags .= $val->name." ";
            }

            $data->tags = trim($tags);
        }
        return $data;
    }

    //文章删除
    public function del($params)
    {
        $model = self::findOne($params);
        return $model->delete();
    }

    //文章发布
    public function publish($params)
    {
        $model = self::findOne($params);
        $model->level = 1;
        $result = $model->save();
        return $result;
    }

    //文章置顶
    public function top($params)
    {
        $model = self::findOne($params);
        $model->top = 1;
        $result = $model->save();
        return $result;
    }

    //隐藏文章
    public function hidden($params)
    {
        $model = self::findOne($params);
        $model->level = -1;
        $result = $model->save();
        return $result;
    }
}