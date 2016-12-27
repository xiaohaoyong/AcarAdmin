<?php
namespace app\models\dynamic;

use yii\db\ActiveRecord;
use app\models\plat\Subscription;
use app\models\user\DcMsg;
use Yii;

class DcDynamic extends ActiveRecord
{

    static public $dynamicId;

    /**
     * @return array|string
     */
    public static function tableName()
    {
        if (empty(self::$dynamicId)) {
            return 'dc_dynamic';
        } else {
            $tm = (self::$dynamicId) % 100;
            return 'dc_dynamic_' . $tm;
        }
    }


    public static function getDb()
    {

        return Yii::$app->get('dbdc');
    }


    //病例研讨班关联列表
    public function getdcdynamicseminar()
    {

        return $this->hasOne(DcDynamicSeminar::className(), ['dynamicid' => 'id']);
    }

    //媒体号关联表

    public function getsubscription()
    {
        return $this->hasOne(Subscription::className(), ['id' => 'userid']);
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => '用户id',
            'type' => '实名（匿名）',
            'level' => '状态',
            'createtime' => '动态发布时间',
        ];
    }


    public static function content($content, $ids, $level, $type)
    {
        if ($level == 3) {
            $redis = Yii::$app->rdmp;
            if ($type == 1) {
                $keys = $redis->hget('mp:keywords:list', $ids);
            } elseif ($type == 2) {
                $keys = $redis->hget('mp:keywords:comment', $ids);
            }
            $arrs = explode('|', $keys);
            foreach ($arrs as $vs) {
                if (!empty($vs)) {
                    $replace[] = '<span style="color:#f53c63;">' . $vs . '</span>';
                }
            }
            $content = str_replace($arrs, $replace, $content);
        }
        return $content;
    }


    public function Del($post)
    {
        $dynamicForm = new DynamicForm();
        if ($dynamicForm->load($post)) {
            $redis = Yii::$app->rdmp;
            $infos = ['1' => '广告等垃圾内容', '2' => '不友善内容', '3' => '违反法律法规内容', '4' => '无意义内容', '5' => '其他'];
            //当为其他是自填内容
            $info = $post['DynamicForm']['delInfo'];
            $info == 5 ? $content = $post['DynamicForm']['delete'] : $content = $infos[$info];
            $redis->hset('dc:dynamic:manage', $post['id'], '1-|-' . $content);
            $userList[$post['userid']] = 9;
            $dcMsg = new DcMsg();
            $dcMsg->send($userList, '55959219', $post['id'], '', $post['type'], $content);
            self::updateAll(['level' => -2], ['id' => $post['id']]);
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['code' => 10000, 'msg' => '成功'];
        } else {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['code' => 10000, 'msg' => '失败'];
        }
    }


    public function Warning($post)
    {
        $dynamicForm = new DynamicForm();
        if ($dynamicForm->load($post)) {
            $redis = Yii::$app->rdmp;
            $infos = ['1' => '广告等垃圾内容', '2' => '不友善内容', '3' => '违反法律法规内容', '4' => '无意义内容', '5' => '其他'];
            //当为其他是自填内容
            $info = $post['DynamicForm']['warInfo'];
            /* $day = $post['DynamicForm']['warningNum'];
             $times = time();
             if ($day) {
                 //禁言结束时间
                 $endTime = date('Y-m-d H:i', strtotime("+$day day", $times));
                 //禁言开始时间
                 $starTime = date('Y-m-d H:i', $times);
                 $redis->hset('dc:warning:time:', $post['userid'], $day . '|' . $starTime . '|' . $endTime);

             }*/
            //警告理由
            $info == 5 ? $content = $post['DynamicForm']['warning'] : $content = $infos[$info];
            //警告次数
            $click = $redis->ZSCORE('club:mp:warning:' . $post['userid'], $post['userid']);
            //记录警告次数
            $redis->zincrby('club:mp:warning:' . $post['userid'], 1, $post['userid']);

            /*$redis->hset('dc:dynamic:manage', $post['id'], '2-|-' . $content . '-|-' . $click . '-|-' . $day . '-|-' . $times);*/
            $redis->hset('dc:dynamic:manage', $post['id'], '2-|-' . $content);
            $redis->sadd('warlist', $post['userid']);
            $click > 2 ? $redis->hset('dc:warning:id:Num', $post['userid'], $post['id']) : '';
            $num = $click > 2 ? 13 : 11;
            $userlist[$post['userid']] = $num;
            $dcMsg = new DcMsg();
            $dcMsg->send($userlist, '55959219', $post['id'], '', $post['type'], $content);
            self::updateAll(['level' => -2], ['id' => $post['id']]);
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['code' => 10000, 'msg' =>'成功'];
        } else {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['code' => 10000, 'msg' => '失败'];
        }
    }

    public function Push($id)
    {
        if ($id) {
            $task['dynamicid'] = $id;
            $task['type'] = 'pushallusers';
            $taskstr = json_encode(($task));
            $key = "yimai:list:task";
            $redis = Yii::$app->rdmp;
            $redis->rpush($key, 'dynamic|%push|@' . $taskstr);
            $redis->sadd('yimai:recommend:dynamic:id', $id);
            return true;
        } else {
            return false;
        }
    }

    public function Screen($id)
    {
        $dynamic = DcDynamic::updateAll(['level' => -3], ['id' => $id]);
        if ($dynamic) {
            return true;
        } else {
            return false;
        }


    }

    public function Recovery($data)
    {
        //重新推送恢复的这条动态
        DcDynamic::updateAll(['level' => 0], ['id' => $data['id']]);
        $data['type']=0;
        $taskstr = json_encode(($data));
        $key = "yimai:list:task";
        $redis = Yii::$app->rdtask;
        $redis->rpush($key, 'dynamic|%push|@' . $taskstr);
        $redis->sadd('yimai:recommend:dynamic:id', $data['id']);
        return true;
    }

}