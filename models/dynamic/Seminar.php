<?php
namespace app\models\dynamic;

use yii\data\ActiveDataProvider;
use app\components\widgets\DatePicker;
use yii\helpers\Html;
use Yii;

class Seminar extends DcDynamicSeminar
{



   /* public $phase;//期号
    public $title;//标题

    public $complain;//主诉
    public $now_history;//现病史
    public $past_history;//既病史
    public $physical;//体格体检
    public $sup_exa;//辅助体检
    public $diagnosis;//诊断
    public $basis;//诊断依据
    public $further_exa;//进一步检查
    public $treatment;//治疗

    public $question;//问题
    public $answer;//答案
    public $reward;//奖励*/

    public $ranking;//排名
    public $integral;//积分
    public $start;
    public $end;
    const COURAGE_MEDIAID=98216833;

    public function rules()
    {
        return  [
            ['title', 'string', 'min' => 5, 'max' => 30, "tooLong" => "必填，5-30字符", "tooShort" => "必填，5-30字符",'on'=>['add','edit']],
            ['complain', 'string', 'min' => 0, 'max' =>100, "tooLong" => "选填，0-100字符", "tooShort" => "选填，0-100字符",'on'=>['add','edit']],
            ['treatment', 'string', 'min' => 0, 'max' =>500, "tooLong" => "选填，0-500字符", "tooShort" => "选填，0-500字符",'on'=>['add','edit']],
            ['diagnosis', 'string', 'min' => 0, 'max' => 200, "tooLong" => "选填，0-200字符", "tooShort" => "选填，0-200字符",'on'=>['add','edit']],
            ['phase', 'string', 'min' =>1, 'max' => 10, "tooLong" => "必填，1-10字符", "tooShort" => "必填，1-10字符",'on'=>['add','edit']],
            [['now_history','past_history','physical','sup_exa','further_exa'], 'string', 'min' => 0, 'max' => 500, "tooLong" => "选填，0-500字符", "tooShort" => "选填，0-500字符",'on'=>['add','edit']],
            [['answer'], 'string', 'min' =>20, 'max' => 500, "tooLong" => "必填，20-500字符", "tooShort" => "必填，20-500字符",'on'=>['add','edit']],
            ['question', 'string', 'min' =>20, 'max' => 200, "tooLong" => "必填，20-200字符", "tooShort" => "必填，20-200字符",'on'=>['add','edit']],
            ['basis', 'string', 'min' =>1, 'max' => 200, "tooLong" => "必填，1-200字符", "tooShort" => "必填，1-200字符",'on'=>['add','edit']],
            [['title', 'question', 'answer','phase'], 'required', 'message' => '必填内容！','on'=>['add','edit']],
            [['start', 'end'], 'date', 'format' => 'php:Y-m-d','message'=>'数据格式不正确','on'=>'list'],
        ];
    }


    public function searchAttr()
    {
        return [
            ['start',['widget' => [DatePicker::className(),['options'=>['placeholder' => '开始时间']]]]],
            ['end',['widget' => [DatePicker::className(),['options'=>['placeholder' => '结束时间']]]]],
        ];
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['add'] =['title', 'phase', 'question', 'answer','complain','now_history','past_history','physical','sup_exa','basis','further_exa','treatment','diagnosis'];
        $scenarios['edit'] =['title', 'phase', 'question', 'answer','complain','now_history','past_history','physical','sup_exa','basis','further_exa','treatment','diagnosis'];
        $scenarios['list'] = ['end', 'start'];
        return $scenarios;

    }

    public function DcSeminar($params)
    {

        $query = DcDynamic::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query->andFilterWhere(['source' => 4,'userid'=>self::COURAGE_MEDIAID])->andFilterWhere(['>', 'level', -1]),
            'sort' => [
                'defaultOrder' => [
                    'createtime' => SORT_DESC,
                ]
            ],
        ]);
        $this->scenario='list';
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if($this->start)
        {
            $query->andFilterWhere(['>=', DcDynamic::tableName().'.createtime', strtotime($this->start."00:00:00")]);
        }
        if($this->end)
        {
            $query->andFilterWhere(['<=', DcDynamic::tableName().'.createtime', strtotime($this->end."23:59:59")]);
        }
        return $dataProvider;
    }


    public function DcReply($id)
    {
        $query = DcComment::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query->andFilterWhere(['dynamicid' => $id]),
            'sort' => [
                'defaultOrder' => [
                    'createtime' => SORT_DESC,
                ]
            ],
        ]);
        return $dataProvider;
    }


    public function ranking($dynamicId, $type, $userId)
    {
        $redis = Yii::$app->rdmp;
        $answer = $redis->hkeys('mp:yimai:dynamic:seminar:answer:'.$dynamicId);
        foreach ($answer as  $v) {
            $get=$redis->hmget('mp:yimai:dynamic:seminar:answer:'.$dynamicId,$v);
            $row = explode('|', $get[0]);
            $ranking[$row[1]]['top'] = $v;
            $ranking[$row[1]]['integral'] = $row[0];

        }
        return empty($ranking) ? '' : $ranking[$userId][$type == 1 ? 'top' : 'integral'];
    }




    public function add($data)
    {
        //主体表
        $yimaisource = 2;
        $userid = self::COURAGE_MEDIAID;
        $createtime = time();
        $type = 1;
        $source = 4;
        $id = $data['Seminar']['dynamicid'];
        $dynamic = compact('userid',empty($id)?'createtime':'', 'type', 'source', 'yimaisource', empty($id) ? '' : 'id');
        $dynamicModel = new DcDynamic();
        if($id){
            DcDynamic::updateAll($dynamic,['id'=>$id]);
            $dynamicIds = $id;
        } else{
            $DcModel = clone $dynamicModel;
            foreach ($dynamic as $ks => $vs) {
                $DcModel->$ks =$vs;
            }
            $DcModel->save();
            $dynamicIds = Yii::$app->dbdc->getLastInsertID();
        }
        //分表
        $dynamicModel::$dynamicId = $dynamicIds;
        $seminars =  array('complain'=>'主诉','now_history'=>'现病史','past_history'=>'过往病史','physical'=>'体格检查','sup_exa'=>'辅助检查',
            'diagnosis'=>'诊断','basis'=>'诊断依据','further_exa'=>'进一步检查','treatment'=>'治疗');
        $contents=$data['Seminar']['phase']."——".$data['Seminar']['title']."\n";
        foreach($seminars as $k=>$v)
        {
            if(!empty($data['Seminar'][$k])){
                $contents.="[".$v."]：".$data['Seminar'][$k]."\n";
            }
        }
        if($id) {
            $dynamicModel::updateAll(['content'=>$this->substr_cut($contents,500,'','','utf-8')."请更新到最新版，获取完整病例。"],['dynamicid'=>$dynamicIds]);
        }else{
            $dynamicModel->content = $this->substr_cut($contents,500,'','','utf-8')."请更新到最新版，获取完整病例。";;
            $dynamicModel->dynamicid =$dynamicIds;
            $dynamicModel->save();
        }


        //病例表
        $data['Seminar']['dynamicid'] = $dynamicIds;
        $seminarModel = new DcDynamicSeminar();
        if($id){
            DcDynamicSeminar::updateAll($data['Seminar'],['dynamicid'=>$id]);
        }else {
            $_model = clone $seminarModel;
            foreach ($data['Seminar'] as $k => $v) {
                $_model->$k =$v;
            }
            $_model->save();
        }

    }

    public function del($id)
    {
        $seminarDel = DcDynamic::updateAll(['level' => -2], ['id' => $id]);
        return $seminarDel;
    }

    public function PublishDynamic($id)
    {
        $seminarid = DcDynamic::find()->select(['userid'])->where(['id' => $id, 'source' => 4])->asArray()->one();
        $seminarState = DcDynamicSeminar::find()->select(['state'])->where(['dynamicid' => $id])->asArray()->one();
        if (!empty($seminarid) && $seminarState['state'] == 1) {
            //病例研讨班推送队列
            DcDynamicSeminar::updateAll(['state' => 0], ['dynamicid' => $id]);
            $redis = Yii::$app->rdtask;
            $task['subid'] = $seminarid['userid'];
            $task['seminarid'] = $id;
            $taskstr = json_encode(($task));
            $key = "yimai:list:task";
            $redis->rpush($key, 'case|%push|@' . $taskstr);
            //动态推送队列
            $task = [];
            $task['userid'] = $seminarid['userid'];
            $task['dynamicid'] = $id;
            $taskstr = json_encode(($task));
            $key = "yimai:list:task";
            $serid = $redis->rpush($key, 'dynamic|%push|@' . $taskstr);
            return $serid;
        }

    }

    public function ReleaseAnswer($id)
    {
        $userid = DcDynamic::find()->select(['userid'])->where(['id' => $id,'source'=>4])->asArray()->one();
        $seminarState = DcDynamicSeminar::find()->select(['state'])->where(['dynamicid' => $id])->asArray()->one();
        if ($userid['userid'] ) {
            //更新研讨班状态为已结束
            DcDynamicSeminar::updateAll(['end_state' => 1,'state' => 0], ['dynamicid' => $id]);
            $redis = Yii::$app->rdtask;
            $task['subid'] = $userid['userid'];
            $task['seminarid'] = $id;
            $taskstr = json_encode(($task));
            $key = "yimai:list:task";
            $serid = $redis->rpush($key, 'case|%push|@' . $taskstr);
            return $serid;
        }elseif($seminarState['state']==0){
            return 0;
        }else{
            return false;
        }
    }

    public function Right($post)
    {

        $redis = Yii::$app->rdmp;
        if ($post['Seminar']['ranking'] && $post['Seminar']['integral']) {
            $level = 2;
            $redis->hset('mp:yimai:dynamic:seminar:answer:' . $post['dynamicid'], $post['Seminar']['ranking'], $post['Seminar']['integral'] . "|" . $post['userid']);
        } else {
            $level = 0;
            $redis->hdel('mp:yimai:dynamic:seminar:answer:' . $post['dynamicid'], $post['deleteTop']);
        }
        DcComment::updateAll(['level' => $level], ['id' => $post['commentid']]);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return ['code' => 10000, 'msg' => '奖励积分添加成功'];
    }

    public function substr_cut($string, $sublen, $ist = '..', $start = 0, $code = 'GBK')
    {
        if ($code == 'UTF-8') {
            $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
            preg_match_all($pa, $string, $t_string);

            if (count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen)) . "...";
            return join('', array_slice($t_string[0], $start, $sublen));
        } else {
            $start = $start * 2;
            $sublen = $sublen * 2;
            $strlen = strlen($string);
            $tmpstr = '';
            for ($i = 0; $i < $strlen; $i++) {
                if ($i >= $start && $i < ($start + $sublen)) {
                    if (ord(substr($string, $i, 1)) > 129) {
                        $tmpstr .= substr($string, $i, 2);
                    } else {
                        $tmpstr .= substr($string, $i, 1);
                    }
                }
                if (ord(substr($string, $i, 1)) > 129) $i++;
            }
            if (strlen($tmpstr) < $strlen) $tmpstr .= $ist;
            return $tmpstr;
        }
    }


}