<?php
/**
 * 资讯列表
 */
namespace app\models\article;

use app\models\article\Article;
use yii\data\ActiveDataProvider;

class ArticleList extends Article
{
    public $start;//开始时间

    public $end;//结束时间

    public function rules()
    {
        return array_merge(parent::rules(),[
            [['id'],'integer'],
            [['start','end'], 'date', 'format'=>'php:Y-m-d'],
        ]);
    }

    public function search($params)
    {
        $query = Article::find();
        $query->where(['=','catid','57']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => [
                'id' => SORT_DESC,
            ]],
            'pagination' => [
                'pageSize' => 10
            ],
        ]);
        // 从参数的数据中加载过滤条件，并验证
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // 增加过滤条件来调整查询对象
        if($this->id)
        {
            $query->andFilterWhere([Article::tableName().'.id' => $this->id]);
        }
        if($this->start)
        {
            $query->andFilterWhere(['>=', Article::tableName().'.createtime', strtotime($this->start."00:00:00")]);
        }
        if($this->end)
        {
            $query->andFilterWhere(['<=', Article::tableName().'.createtime', strtotime($this->end."23:59:59")]);
        }

        return $dataProvider;
    }
}