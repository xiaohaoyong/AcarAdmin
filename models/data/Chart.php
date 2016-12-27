<?php
namespace app\models\data;

use yii\db\ActiveRecord;
use  app\models\dynamic\DcDynamic;
use app\components\widgets\DatePicker;
use Yii;

class Chart extends ActiveRecord
{

    public $start;
    public $end;

    public function rules()
    {
        return [
            [['start', 'end'], 'date', 'format' => 'php:Y-m-d'],

        ];
    }

    public function searchAttr()
    {
        return [
            ['start',['widget' => [DatePicker::className(),['options'=>['placeholder' => '开始时间']]]]],
            ['end',['widget' => [DatePicker::className(),['options'=>['placeholder' => '结束时间']]]]],
        ];
    }

    public function DataLine($startDate, $endDate)
    {
        $endDate = strtotime($endDate . '23:59:59');
        $startDate = strtotime($startDate . '0:00:00');
        for ($i = $startDate; $i <= $endDate; $i += 3600 * 24) {
            $time = strtotime(date('Ymd', $i) . '23:59:59');
            //时间
            $date[] = date('Ymd', $i);
            //医圈发布全部动态量
            $dynamicAll[] = intval(DcDynamic::find()->andWhere(['yimaisource'=>2])->andFilterWhere(['between', 'createtime', $i, $time])->count('id'));
            //医圈分享动态量
            $dynamicShare[] = intval(DcDynamic::find()->andWhere(['source' => 3,'yimaisource'=>2])->andFilterWhere(['between', 'createtime', $i, $time])->count('id'));
            //医圈线上动态量
            $dynamicLine[] = intval(DcDynamic::find()->andWhere(['>', 'level', -1])->andWhere(['yimaisource'=>2])->andFilterWhere(['between', 'createtime', $i, $time])->count('id'));
            //医圈线上实名动态量
            $dynamicReal[] = intval(DcDynamic::find()->andWhere(['>', 'level', -1])->andWhere(['type' => 1,'yimaisource'=>2])->andFilterWhere(['between', 'createtime', $i, $time])->count('id'));
            //医圈线上匿名动态量
            $anonymous[] = intval(DcDynamic::find()->andWhere(['>', 'level',-1])->andWhere(['type' => 2,'yimaisource'=>2])->andFilterWhere(['between', 'createtime', $i, $time])->count('id'));

        }
        return $date = ['date' => $date, 'all' => $dynamicAll, 'share' => $dynamicShare, 'line' => $dynamicLine, 'real' => $dynamicReal, 'anonymous' => $anonymous,];
    }

    public function DataHide($startDate, $endDate)
    {
        $endDate = strtotime($endDate . '23:59:59');
        $startDate = strtotime($startDate . '0:00:00');
        for ($i = $startDate; $i <= $endDate; $i += 3600 * 24) {
            $time = strtotime(date('Ymd', $i) . '23:59:59');
            //时间
            $date[] = date('Ymd', $i);
            //医圈后台屏蔽动态数
            $dynamicHide[] = intval(DcDynamic::find()->andWhere(['level' => -3,'yimaisource'=>2])->andFilterWhere(['between', 'createtime', $i, $time])->count('id'));
            //医圈敏感词屏蔽动态数
            $sensitive[] = intval(DcDynamic::find()->andWhere(['level' => -4,'yimaisource'=>2])->andFilterWhere(['between', 'createtime', $i, $time])->count('id'));
            //用户删除的动态数
            $deleteUser[] = intval(DcDynamic::find()->andWhere(['level' => -1,'yimaisource'=>2])->andFilterWhere(['between', 'createtime', $i, $time])->count('id'));
            //后台删除的动态数
            $deleteAdmin[] = intval(DcDynamic::find()->andWhere(['level' => -2,'yimaisource'=>2])->andFilterWhere(['between', 'createtime', $i, $time])->count('id'));

        }
        return $date = ['date' => $date, 'hide' => $dynamicHide, 'sensitive' => $sensitive, 'user' => $deleteUser, 'admin' => $deleteAdmin];
    }

    public function DataClick($params)
    {
        $this->start = $params['Chart']['start'];
        $this->end = $params['Chart']['end'];
        $startDate = $params['Chart']['start'] ? $params['Chart']['start'] : date('Ymd', strtotime('-15 day'));
        $endDate = $params['Chart']['end'] ? $params['Chart']['end'] : date('Ymd', time());
        $endDate = strtotime($endDate . '23:59:59');
        $startDate = strtotime($startDate . '0:00:00');
        for ($i = $startDate; $i < $endDate; $i += 3600 * 24) {
            $list = array();
            $tima[] = date("Ymd ", $i);
            for ($z = $i; $z < $i + 3600 * 24; $z += 3600) {
                $y = $z + 3600;
                $timeH = date("YmdH", $z);
                $redis = Yii::$app->rdmp;
                $a[$timeH] = $redis->scard('doctoractive:load:' . $timeH);
            }
        }
        $sate['date'] = $tima;
        foreach ($a as $key => $val) {
            $str5 = substr($key, 8, 10);
            if ($str5 === '00') {
                $sate['one'][] = intval($a[$key]);
            }
            if ($str5 === '01') {
                $sate['two'][] = intval($a[$key]);
            }
            if ($str5 === '02') {
                $sate['three'][] = intval($a[$key]);
            }
            if ($str5 === '03') {
                $sate['four'][] = intval($a[$key]);
            }
            if ($str5 === '04') {
                $sate['five'][] = intval($a[$key]);
            }
            if ($str5 === '05') {
                $sate['six'][] = intval($a[$key]);
            }
            if ($str5 === '06') {
                $sate['seven'][] = intval($a[$key]);
            }
            if ($str5 === '07') {
                $sate['eight'][] = intval($a[$key]);
            }
            if ($str5 === '08') {
                $sate['nine'][] = intval($a[$key]);
            }
            if ($str5 === '09') {
                $sate['ten'][] = intval($a[$key]);
            }
            if ($str5 === '10') {
                $sate['eleven'][] = intval($a[$key]);
            }
            if ($str5 === '11') {
                $sate['twelve'][] = intval($a[$key]);
            }
            if ($str5 === '12') {
                $sate['thirteen'][] = intval($a[$key]);
            }
            if ($str5 === '13') {
                $sate['fourteen'][] = intval($a[$key]);
            }
            if ($str5 === '14') {
                $sate['fiveteen'][] = intval($a[$key]);
            }
            if ($str5 === '15') {
                $sate['sixteen'][] = intval($a[$key]);
            }
            if ($str5 === '16') {
                $sate['seventeen'][] = intval($a[$key]);
            }
            if ($str5 === '17') {
                $sate['eighteen'][] = intval($a[$key]);
            }
            if ($str5 === '18') {
                $sate['nineteen'][] = intval($a[$key]);
            }
            if ($str5 === '19') {
                $sate['twenty'][] = intval($a[$key]);
            }
            if ($str5 === '20') {
                $sate['twenty-one'][] = intval($a[$key]);
            }
            if ($str5 === '21') {
                $sate['twenty-two'][] = intval($a[$key]);
            }
            if ($str5 === '22') {
                $sate['twenty-three'][] = intval($a[$key]);
            }
            if ($str5 === '23') {
                $sate['twenty-four'][] = intval($a[$key]);
            }
        }
        return $sate;
    }


    public function DataRelease($params)
    {
        $this->start = $params['Chart']['start'];
        $this->end = $params['Chart']['end'];
        $startDate = $params['Chart']['start'] ? $params['Chart']['start'] : date('Ymd', strtotime('-15 day'));
        $endDate = $params['Chart']['end'] ? $params['Chart']['end'] : date('Ymd', time());
        $endDate = strtotime($endDate . '23:59:59');
        $startDate = strtotime($startDate . '0:00:00');
        for ($i = $startDate; $i <  $endDate; $i += 3600 * 24) {
            $list = array();
            for ($z = $i; $z < $i + 3600 * 24; $z += 3600) {
                $y = $z + 3600;
                $by = date("Y-m-d ", $i);
                $tima[] = date("Ymd ", $i);
                $aa[] = date('Y-m-d H:i:s', $y);
                $assa = date('Y-m-d H:i:s', $z);
                $list = intval(DcDynamic::find()->andFilterWhere(['between', 'createtime', $z, $y])->andWhere(['yimaisource'=>2])->count('id'));
                $total[$by][] = array('date' => $assa, 'list' => $list);
            }
        }
        $tima = array_values(array_unique($tima));
        $dynamic['date'] = $tima;
        foreach ($total as $k => $v) {
            $dynamic['one'][] = $v[0]['list'];
            $dynamic['two'][] = $v[1]['list'];
            $dynamic['three'][] = $v[2]['list'];
            $dynamic['four'][] = $v[3]['list'];
            $dynamic['five'][] = $v[4]['list'];
            $dynamic['six'][] = $v[5]['list'];
            $dynamic['seven'][] = $v[6]['list'];
            $dynamic['eight'][] = $v[7]['list'];
            $dynamic['nine'][] = $v[8]['list'];
            $dynamic['ten'][] = $v[9]['list'];
            $dynamic['eleven'][] = $v[10]['list'];
            $dynamic['twelve'][] = $v[11]['list'];
            $dynamic['thirteen'][] = $v[12]['list'];
            $dynamic['fourteen'][] = $v[13]['list'];
            $dynamic['fiveteen'][] = $v[14]['list'];
            $dynamic['sixteen'][] = $v[15]['list'];
            $dynamic['seventeen'][] = $v[16]['list'];
            $dynamic['eighteen'][] = $v[7]['list'];
            $dynamic['nineteen'][] = $v[18]['list'];
            $dynamic['twenty'][] = $v[19]['list'];
            $dynamic['twenty-one'][] = $v[20]['list'];
            $dynamic['twenty-two'][] = $v[21]['list'];
            $dynamic['twenty-three'][] = $v[22]['list'];
            $dynamic['twenty-four'][] = $v[23]['list'];
        }
        return $dynamic;
    }


}


