<?php
/**
 * Created by PhpStorm.
 * User: xywy
 * Date: 2016/9/19
 * Time: 14:51
 */
namespace app\models\dynamic;

use Yii;
use yii\base\Model;
use app\models\club;
use yii\data\ActiveDataProvider;
use app\components\widgets\DatePicker;

/**
 * ArticleSearch represents the model behind the search form about `backend\models\Article`.
 */
class CommentSearch extends DcComment
{
    /**
     * @inheritdoc
     */
    public $content;
    public $type;
    public $level;
    public $style;
    public $start;
    public $end;
    public $dynamicId;


    public function rules()
    {
        return [
            [['type', 'content', 'style','dynamicId','level'], 'trim'],
            [['start', 'end'], 'date', 'format' => 'php:Y-m-d'],
           /* [
                'style',
                "in",
                'range'=>[1,2,3,4],
                'when' => function ($model) {
                    return !empty($model->content);
                },
                'whenClient' => "function (attribute, value) { return $('#commentsearch-content').val()!=''; }",
                'message' => '搜索类型必选'
            ],
            [
                'content',
                'required',
                'when' => function ($model) {
                    return $model->style>0;
                },
                'whenClient' => "function (attribute, value) { return $('#commentsearch-style').val()<0; }",
                'message' => '搜索内容必填'
            ],*/
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }


    public function searchAttr()
    {
        return [
            ['style', ['dropDownList' => [0 => '请选择', 1 => '评论ID', 2 => '用户ID', 3 => '用户名', 4 => '用户姓名']],],
            ['content', ['textInput' => ['placeholder' => '请输入搜索内容']]],
            ['level', ['dropDownList' => [1=> '线上', 2 => '线下', 3 => '管理员删除', 4 => '用户删除', 5 => '线上/线下']]],
            ['type', ['dropDownList' =>[1 => '实(匿)名', 2 => '实名', 3 => '匿名']]],
            ['start',['widget' => [DatePicker::className(),['options'=>['placeholder' => '开始时间']]]]],
            ['end',['widget' => [DatePicker::className(),['options'=>['placeholder' => '结束时间']]]]],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = DcComment::find()->joinwith(['dcdynamic']);
        $lev = empty($params) ? ['dc_comment.level' => 0] :[];
        $dataProvider = new ActiveDataProvider([
            'query' => $query->andFilterWhere($lev),
            'sort' => [
                'defaultOrder' => [
                    'createtime' => SORT_DESC,
                ]
            ],
        ]);




        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if($this->dynamicId){
            $query->andFilterWhere(['=', 'dc_comment.dynamicid', $this->dynamicId]);
        }

        if ($this->content && $this->style) {
            switch ($this->style) {
                case 1:
                    $query->andFilterWhere(['=', 'dc_comment.id', $this->content]);
                    break;
                case 2:
                    $query->andFilterWhere(['=', 'dc_comment.userid', $this->content]);
                    break;
                case 3:
                    $userId = club\UserNew::find()->select(['id'])->where(['username' => $this->content])->asArray()->one();
                    $this->content = $userId['id'];
                    $query->andFilterWhere(['=', 'dc_comment.userid', $this->content]);
                    break;
                case 4:
                    $name = iconv('utf-8', 'gbk//IGNORE', $this->content);
                    $userId = club\UserDoctorNew::find()->select(['pid'])->where(['realname' => $name])->asArray()->all();
                    foreach($userId as $vs){
                        $userIds= DcDynamic::find()->select(['userid'])->where(['userid' => $vs['pid']])->asArray()->one();
                        if($userIds) {
                            $userArr[] = $vs['pid'];
                        }
                    }
                    $query->andFilterWhere(['dc_comment.userid' =>$userArr]);
                    break;
            }
        }


        if ($this->level) {
            switch ($this->level) {
                case 1:
                    $query->andFilterWhere(['=', 'dc_comment.level', 0]);
                    break;
                case 2:
                    $query->andFilterWhere(['<', 'dc_comment.level', 0]);
                    break;
                case 3:
                    $query->andFilterWhere(['=', 'dc_comment.level', -2]);
                    break;
                case 4:
                    $query->andFilterWhere(['=', 'dc_comment.level', -1]);
                    break;
                case 5:
                    $query->andFilterWhere(['>', 'dc_comment.level', -5]);
                    break;
            }
        }


        if ($this->type) {
            switch ($this->type) {
                case 1:
                    $query->andFilterWhere(['<', 'dc_comment.type', 3]);
                    break;
                case 2:
                    $query->andFilterWhere(['=', 'dc_comment.type', 1]);
                    break;
                case 3:
                    $query->andFilterWhere(['=', 'dc_comment.type', 2]);
                    break;
            }
        }

        if ($this->start) {
            $query->andFilterWhere(['>=', DcDynamic::tableName() . '.createtime', strtotime($this->start . "00:00:00")]);
        }
        if ($this->end) {
            $query->andFilterWhere(['<=', DcDynamic::tableName() . '.createtime', strtotime($this->end . "23:59:59")]);
        }

        return $dataProvider;
    }
}