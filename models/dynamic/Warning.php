<?php
namespace app\models\dynamic;

use app\models\user\Doctor;
use yii\data\ArrayDataProvider;
use app\models\user\DcMsg;
use \yii\base\Model;
use app\models\club;
use app\components\widgets\DatePicker;
use Yii;


class Warning extends Model
{

    public $style;
    public $content;


    public function rules()
    {
        return [
            [['content', 'style'], 'trim'],
            [
                'style',
                "in",
                'range' => [1, 2],
                'when' => function ($model) {
                    return !empty($model->content);
                },
                'whenClient' => "function (attribute, value) { return $('#warning-content').val()!==''; }",
                'message' => '搜索类型必选'
            ],
            [
                'content',
                'required',
                'when' => function ($model) {
                    return $model->style > 0;
                },
                'whenClient' => "function (attribute, value) { return $('#warning-style').val()>0; }",
                'message' => '搜索内容必填'
            ],
        ];
    }


    public function searchAttr()
    {
        return [
            ['style', ['dropDownList' => [0 => '请选择类型', 1 => '用户ID', 2 => '用户姓名']],],
            ['content', ['textInput' => ['placeholder' => '请输入搜索内容']]],
        ];
    }


    public function warningData()
    {
        $redis = Yii::$app->rdmp;
        $warningList = $redis->SMEMBERS('warlist');
        $stopSays = $redis->HKEYS('dc:warning:time:');
        if ($this->style && $this->content) {
            if ($this->style == 1) {
                $listAll = [$this->content];
            } else {
                $name = iconv('utf-8', 'gbk//IGNORE', $this->content);
                $lists = club\UserDoctorNew::find()->select(['pid'])->where(['realname' => $name])->asArray()->column();
                $All = array_flip(array_flip(array_merge($warningList, $stopSays)));
                $listAll = array_intersect($All, $lists);
            }
        } else {
            $listAll = array_flip(array_flip(array_merge($warningList, $stopSays)));
        }

        $doctor = new Doctor();
        $data = [];
        foreach ($listAll as $k => $v) {
            $warning = $redis->HGet('dc:warning:time:', $v);
            $clicks = $redis->ZSCORE('club:mp:warning:' . $v, $v);
            if ($clicks || $warning) {
                $doctors = $doctor->get($v, 1);
                $data[$k]['userId'] = $v;
                $data[$k]['username'] =  $doctors['nickname'];
                $data[$k]['warningNum'] = $redis->ZSCORE('club:mp:warning:' . $v, $v);
                $data[$k]['stopSays'] = $redis->hget('dc:warning:time:', $v);
            }
        }


        return $data;
    }


    public function warning($data)
    {
        $this->style = $data['Warning']['style'];
        $this->content = $data['Warning']['content'];
        $provider = new ArrayDataProvider([
            'allModels' => $this->warningData(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $provider;
    }

    public function reset($userid, $click)
    {
        if ($userid) {
            $redis = Yii::$app->rdmp;
            $redis->zrem('club:mp:warning:' . $userid, $userid);
            $war = $redis->SMEMBERS('warning' . $userid);
            foreach ($war as $v) {
                $wa = explode('-|-', $v);
                if ($wa[0] == 'warning') {
                    $redis->srem('warning' . $userid, $v);
                }
            }
            $userlist[$userid] = 15;
            $id = $redis->hget('dc:warning:id:Num', $userid);
            if ($click > 2) {
                $dcmsg = new DcMsg();
                $dcmsg->send($userlist, '55959219', $id, '', 1, '您的违规记录已被清空');
            }
            return true;
        } else {
            return false;
        }

    }

    function clearTime($data)
    {
        $redis = Yii::$app->rdmp;
        $clear = $redis->HDEL('dc:warning:time:', $data['userid']);
        if ($clear) {
            return true;
        } else {
            return false;
        }

    }

}