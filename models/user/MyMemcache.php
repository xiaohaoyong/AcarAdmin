<?php
namespace app\models\user;
use  linslin\yii2\curl\Curl;
use Yii;
class MyMemcache
{
    //获取医生信息
  public  function get_doctor($docid)
    {
        $docRow =[];
        $redis=Yii::$app->rdclub;
        $docRowJson = $redis->get('doctor_' . $docid);
        $docRow = $docRowJson ? unserialize($docRowJson) : '';

        $docRow = eval('return '.iconv('gbk','utf-8//IGNORE',var_export($docRow,true)).';');
        return $docRow;
    }
}

?>