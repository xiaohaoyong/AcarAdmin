<?php
namespace app\models\data;
use yii\db\ActiveRecord;
use Yii;
class Retention extends ActiveRecord
{


    public  function userRetention($startDate,$endDate)
    {

        $redis=Yii::$app->rdmp;
        $data=[];
        for ($i = strtotime($endDate); strtotime($startDate)<=$i; $i-= 86400) {
            $list['date']=date('Y-m-d',$i);
            $j=date('Ymd',$i);
            $a=$redis->smembers('doctoractive:dc:new:'.$j);
            $list['new']=count($a);
            $q=date('Ymd',$i+3600 * 24);
            $b=$redis->smembers('doctoractive:dc'.$q);
            $first=$redis->sinter('doctoractive:dc'.$q,'doctoractive:dc:new:'.$j);//交机
            $list['one']=$a?number_format((count($first)/count($a)*100),2,'.','').'%':'0%';


            $w=date('Ymd',$i+3600 * 24*2);
            $redis->smembers("doctoractive:dc:".$w);
            $sceond=$redis->sinter("doctoractive:dc:new:".$j,"doctoractive:dc:".$w);//交机
            $list['two']=$a?number_format((count($sceond)/count($a)*100),2,'.','').'%':'0%';


            $t=date('Ymd',$i+3600 * 24*3);
            $redis->smembers("doctoractive:dc:".$t);
            $three=$redis->sinter("doctoractive:dc:new:".$j,"doctoractive:dc:".$t);//交机
            $list['three']=$a?number_format((count($three)/count($a)*100),2,'.','').'%':'0%';


            $v=date('Ymd',$i+3600 * 24*4);
            $redis->smembers("doctoractive:dc:".$v);
            $four=$redis->sinter("doctoractive:dc:new:".$j,"doctoractive:dc:".$v);//交机
            $list['four']=$a?number_format((count($four)/count($a)*100),2,'.','').'%':'0%';


            $o=date('Ymd',$i+3600 * 24*6);
            $redis->smembers("doctoractive:dc:".$o);
            $five=$redis->sinter("doctoractive:dc:new:".$j,"doctoractive:dc:".$o);//交机
            $list['five']=$a?number_format((count($five)/count($a)*100),2,'.','').'%':'0%';


            $z=date('Ymd',$i+3600 * 24*7);
            $redis->smembers("doctoractive:dc:".$z);
            $six=$redis->sinter("doctoractive:dc:new:".$j,"doctoractive:dc:".$z);//交机
            $list['six']=$a?number_format((count($six)/count($a)*100),2,'.','').'%':'0%';


            $l=date('Ymd',$i+3600 * 24*15);
            $redis->smembers("doctoractive:dc:".$l);
            $seven=$redis->sinter("doctoractive:dc:new:".$j,"doctoractive:dc:".$l);//交机
            $list['seven']=$a?number_format((count($seven)/count($a)*100),2,'.','').'%':'0%';



            $x=date('Ymd',$i+3600 * 24*30);
            $redis->smembers("doctoractive:dc:".$x);
            $eight=$redis->sinter("doctoractive:dc:new:".$j,"doctoractive:dc:".$x);//交机
            $list['eight']=$a?number_format((count($eight)/count($a)*100),2,'.','').'%':'0%';
            $data[]=$list;


        }

        return  $data;

    }









}