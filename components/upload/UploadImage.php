<?php
/**
 * 上传图片
 */
namespace app\components\upload;

use yii\base\Model;

class UploadImage extends Model
{
    /*
     * $name 字段名
     * $file 表单上传字段
     * $project 图片所属站点
     * $path 图片保存路径
     * $size 图片大小限制 单位是: 字节
     * $ext 图片类型 数组
     */
    public $params;
    public function upload()
    {
        require("XywyService/XywyStorageService/XywyStorageService.php");
        $accessKey = "SYS000000000010086";
        $secretKey = "1111111111111111111111111111111111111111";
        $project = $this->params['project'];
        $o = XywyStorageService::getInstance($project, $accessKey, $secretKey);
        $o->setCURLOPTs(array(CURLOPT_VERBOSE => 1));
        $file = $this->params['file'];
        $tmpFile = !empty($file->tempName) ? $file->tempName : "";
        $type = trim(strrchr($file->type,'/'),'/');
        //验证文件类型
        $ext = $this->params['ext'];
        if(!in_array($type,$ext))
        {
            return -1;
        }
        //验证文件大小
        $size = $this->params['size'];
        if($file->size > $size)
        {
            return -2;
        }
        $f =date('Ymd',time());
        $file_new_name = substr(md5(time().'@$%&'),15, -2).'.'.$type;
        $path = $this->params['path'];
        $file = $path. "/" . $f . "/" . $file_new_name;
        $file_con = file_get_contents($tmpFile);
        $result = "";
        $o->uploadFile($file, $file_con, $result);
        $o->getFileUrl($file,$result);
        $result=str_replace('?', '', $result);

        return $result;
    }

    public function rules()
    {
        return array_merge(parent::rules(),[
            [$this->params['name'],'file','extensions' => $this->params['ext'],'maxSize' => $this->params['size']]
        ]);
    }
}