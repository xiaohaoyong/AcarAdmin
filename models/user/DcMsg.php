<?php
namespace app\models\user;
use app\models\dynamic;
use Yii;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/5/18
 * Time: 11:02
 */
class DcMsg
{
    public function send($userlist, $userid, $dynamicid, $commentid, $anony, $content = '')
    {
        $message = new dynamic\DcMessage();
        $message->userid = $userid;
        $message->dynamicid = $dynamicid?$dynamicid:0;
        $message->commentid = $commentid?$commentid:0;
        $message->anonymous = $anony;
        $message->createtime = time();
        unset($userlist[$userid]);
        foreach ($userlist as $k => $v) {
            $message->touserid = $k;
            $message->type = $v;
            $message->save();
            $listId = Yii::$app->dbdc->getLastInsertID();
            $redis = Yii::$app->rdmp;
            $redis->hset("message:id", $listId, $content);
            $key ="club:mp:dc:message1:anony:{$anony}:" . $k;
            $redis->zadd($key, $message['createtime'], $dynamicid . "|" . $v . "|" . $content);
        }
       // return true;
    }

}