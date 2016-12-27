<?php
/**
 * 文章添加/修改表单
 */
namespace app\models\article;

use app\components\UploadForm;
use yii\web\Response;
use yii\widgets\ActiveForm;

class ArticleForm extends Article
{
    public $tags;

    public function rules()
    {
        return array_merge(parent::rules(),[
            ['title','required','message' => '文章标题不能为空！'],
            ['title','unique','message' => '文章已存在，请不要重复添加！'],
            ['content','required','message' => '请添加文章内容'],
            ['content','string','length' => [10,5000],'tooShort' => '请输入10-5000字'],
            ['style','required','message' => '请选择文章类别'],
            ['style','integer'],
            [['catid','catpid','model'],'required'],
            [['catid','catpid','model'],'integer'],
            [['title','source'],'string','max' => 50],
            ['author','string','max' => 20],
            ['image','file','extensions' => ['jpg','jpeg'],'skipOnEmpty' => false, 'maxSize' => 1024*200,'tooBig' => '图片为小于200KB,格式为jpg','on' => 'create'],
            ['image','file','extensions' => ['jpg','jpeg'],'maxSize' => 1024*200,'tooBig' => '图片为小于200KB,格式为jpg','on' => 'update'],
            ['vector','string','max' => 500,'tooLong' => '导读字数不超过500字'],
            ['createtime','default','value' => time(),'on'=>'create'],
            ['praiseNum','default','value' => 0,'on'=>'create'],
            ['dept','default','value' => 0,'on'=>'create'],
            ['mediaid','default','value' => 0,'on'=>'create'],
            ['timing','default','value' => 0,'on'=>'create'],
            ['top','default','value' => 0,'on'=>'create'],
            ['level','default','value' => -1],
        ]);
    }

    //文章添加/修改
    public function add($file)
    {
        if(!empty($file))
        {
            $upload = new UploadForm();
            $upload->imageFile = $file;
            $upload->options = ['extensions' => ['jpg','jpeg'],'maxSize' => 1024*200];
            $result = $upload->upload();;
            if($upload->errors){
                return "";
            }else {
                return $result;
            }
        }
    }
}