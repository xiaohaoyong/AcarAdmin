<?php
namespace app\models\user;
use Yii;
use app\models\user\MyMemcache;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/5/25
 * Time: 15:47
 */
class Doctor
{
    public function get($userid,$type = 1,$red='rdmp')
    {
        $mem = new MyMemcache();
        $doctor = $mem->get_doctor($userid, 'utf8');
        $docRow=$doctor;
        if($doctor) {
            if ($type == 2) {
               // $redis=Register::get($red);
                $redis=Yii::$app->rdyimai;
                $nickname = $redis->HGet('club:mp:dc:anonymous', $userid);
                // echo json_encode(array(2=>$nickname));
                if (!$nickname) {
                    //生成用户匿名
                    include  'anonymous.php';
                    $anonyArr = explode(',', $anonymous);
                    $k = array_rand($anonyArr);
                    $nickname = $anonyArr[$k];
                    $redis->hset('club:mp:dc:anonymous', $userid, $nickname);
                }
                $doctor['nickname'] = $nickname;
                if($doctor['isdoctor']==12 || $doctor['isdoctor']==13 || $doctor['isdoctor']==14)
                {

                    $anonyimg = 'yxs.png';
                }else {
                    switch ($doctor['profess_job']) {
                        case '药师':
                            $anonyimg = 'ys.png';
                            break;
                        case '心理咨询师':
                            $anonyimg = 'xlzxs.png';
                            break;
                        case '康复治疗师':
                            $anonyimg = 'kfzls.png';
                            break;
                        case '针灸按摩师':
                            $anonyimg = 'zjams.png';
                            break;
                        case '护士':
                            $anonyimg = 'hs.png';
                            break;
                        case '营养师':
                            $anonyimg = 'yys.png';
                            break;
                        default:
                            if ($doctor['subject']>0 and $doctor['subject'] != 345) {
                                $anonyimg = $doctor['subject'] . ".png";
                            } else {
                                $anonyimg = 'moren.png';
                            }
                            break;
                    }
                }
                $docRow['photo'] = 'http://static.img.xywy.com/club/niming/'.$anonyimg;
            }
            $docRow['userid'] = $userid;
            $docRow['nickname'] = $doctor['nickname'] ? $doctor['nickname'] : '';
            $docRow['realname'] = $docRow['nickname'];
            $docRow['isdoctor'] = $doctor['isdoctor'];
            $docRow['isdoc'] = $doctor['isdoc'];
            //var_dump($doctor);
            if ($doctor['isdoctor'] == 12 || $doctor['isdoctor'] == 13 || $doctor['isdoctor'] == 14) {
                $docRow['job'] = '医学生';
                $docRow['subject'] = empty($doctor['profession']) ?"": $doctor['profession'];
                $docRow['hospital'] = empty($doctor['school']) ?"": $doctor['school'];
                $docRow['doctortype'] = 2;
            } else {
                if ($doctor['isjob'] == 2 && $doctor['zdepart']) {
                    $docRow['subject'] = $doctor['zdepart'];
                } else {
                    $docRow['subject'] = !intval($doctor['subject']) && $doctor['zdepart'] ? $doctor['zdepart'] : getSubjectName($doctor['subject'], 'utf8', true);
                }

                $docRow['hospital'] = $doctor['hospital'] ? $doctor['hospital'] : '';
                $docRow['job'] = $doctor['job'] ? $doctor['job'] : '';
                $docRow['doctortype'] = 1;
                if($doctor['isdoc']=='专家团医生'){
                    $docRow['doctortype']=3;
                }

            }

            if((!$docRow['job'] || !$docRow ['subject'] || !$docRow['nickname']) and $doctor['isjob']!=2)
            {
                $docRow['is_doctor']=0;
            }else{
                $docRow['is_doctor']=1;
            }
            $docRow['synopsis'] = $doctor['synopsis'] ? $doctor['synopsis'] : '';
            $docRow['sex'] = $doctor['sex'] ? $doctor['sex'] : '';
            return $docRow;
        }else{
            return array();
        }
    }

   public  function get_real_userphoto($photo, $docid)
    {
        if (empty($photo)) {
            return '';
        }
        if (strstr($photo, 'http://') !== false) {
            return $photo;
        } else {
            return "http://doctor.club.xywy.com/images/$photo";
        }
    }
}

/**
 * 根据科室id获取科室名称，默认返回的编码是utf-8
 * @param int $id 科室id
 * @param string $charset 默认为utf-8
 * @return string 科室名称
 */
function getSubjectName($id, $charset = "utf-8")
{
    static $depts = null;

    if (!$depts) {
        $depts = include  'depts.php';
    }
    $name = isset($depts[$id]) ? $depts[$id]['keyword'] : '常见疾病';
    if ($charset == 'gbk') {
        $name = iconv("utf-8", "gbk//IGNORE", $name);
    }
    return $name;
}
