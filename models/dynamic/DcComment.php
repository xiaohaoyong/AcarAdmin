<?php
namespace app\models\dynamic;
use yii\db\ActiveRecord;
use Yii;
use app\models\user\DcMsg;


class DcComment extends ActiveRecord
{

    static public $commentId;
    /**
     * @return array|string
     */
    public static function tableName()
    {
        if(empty(self::$commentId)) {
            return 'dc_comment';
        }else{
            $tm = (self::$commentId) % 50;
            return 'dc_comment_' . $tm;
        }
    }


    public static function getDb() {

        return Yii::$app->get('dbdc');
    }


    public function getdcdynamic()
    {

        return $this->hasOne(DcDynamic::className(), ['id' => 'dynamicid'])->andFilterWhere(['=', 'dc_dynamic.yimaisource', 2]);
    }

    public function attributeLabels()
    {
        return [
            'id' => '动态id',
            'userid' => '用户id',
            'createtime' => '动态发布时间',
        ];
    }

    public function Del($post)
    {
        $CommentForm = new CommentForm();
        if ($CommentForm->load($post)) {
            $redis = Yii::$app->rdmp;
            $infos = ['1' => '广告等垃圾内容', '2' => '不友善内容', '3' => '违反法律法规内容', '4' => '无意义内容', '5' => '其他'];
            //当为其他是自填内容
            $info = $post['CommentForm']['delInfo'];
            $info == 5 ? $content = $post['CommentForm']['delete'] : $content = $infos[$info];
            $redis->hset('dc:comment:manage', $post['id'], '1-|-' . $content);
            $userList[$post['userid']] =10;
            $dcMsg = new DcMsg();
            $dcMsg->send($userList, '55959219', '', $post['id'], $post['type'], $content);
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
        $CommentForm = new CommentForm();
        if ($CommentForm->load($post)) {
            $redis = Yii::$app->rdmp;
            $infos = ['1' => '广告等垃圾内容', '2' => '不友善内容', '3' => '违反法律法规内容', '4' => '无意义内容', '5' => '其他'];
            //当为其他是自填内容
            $info = $post['CommentForm']['warInfo'];
            /*$day = $post['CommentForm']['warningNum'];
            $times = time();
            if ($day) {
                //禁言结束时间
                $endTime = date('Y-m-d H:i', strtotime("+$day day", $times));
                //禁言开始时间
                $starTime = date('Y-m-d H:i', $times);
                $redis->hset('dc:warning:time:', $post['userid'], $day . '|' . $starTime . '|' . $endTime);
            }*/
            //警告理由
            $info == 5 ? $content = $post['CommentForm']['warning'] : $content = $infos[$info];
            //警告次数
            $click = $redis->ZSCORE('club:mp:warning:' . $post['userid'], $post['userid']);
            //记录警告次数
            $redis->zincrby('club:mp:warning:' . $post['userid'], 1, $post['userid']);
           /* $redis->hset('dc:comment:manage', $post['id'], '2-|-' . $content . '-|-' . $click . '-|-' . $day . '-|-' . $times);*/
            $redis->hset('dc:comment:manage', $post['id'], '2-|-' . $content);
            $redis->sadd('warlist', $post['userid']);
            $click > 2 ? $redis->hset('dc:warning:id:Num', $post['userid'], $post['id']) : '';
            $userlist[$post['userid']] = $click > 2 ? 14 : 12;
            $dcMsg = new DcMsg();
            $dcMsg->send($userlist, '55959219','',  $post['id'], $post['type'], $content);
            self::updateAll(['level' => -2], ['id' => $post['id']]);
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['code' => 10000, 'msg' => '成功'];
        } else {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['code' => 10000, 'msg' => '失败'];
        }
    }

}