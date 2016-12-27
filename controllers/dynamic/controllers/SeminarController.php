<?php
namespace app\controllers\dynamic\controllers;
use app\components\helper\UploadHelper;
use app\components\UploadForm;
use app\controllers\BaseController;
use app\models\dynamic\DcDynamicImg;
use app\models\dynamic\DcDynamicSeminar;
use app\models\dynamic\Seminar;
use Yii;
use yii\helpers\Url;

class SeminarController extends BaseController
{



    public function actionList()
    {
        $searchModel = new Seminar();
        $data = $searchModel->DcSeminar(Yii::$app->request->get());
        return $this->render('list', ['data' => $data, 'searchModel' => $searchModel]);
    }


    public function actionAnswer()
    {
        $model = new Seminar();
        $id = Yii::$app->request->get('id', 0);
        $data = $model->DcReply($id);
        return $this->render('answer', ['data' => $data, 'model' => $model]);
    }

    public function actionRight()
    {
        $post = Yii::$app->request->post();
        $model = new Seminar();
        if ($model->load($post)) {
            return $model->Right($post);
        }
    }

    public function actionAdd()
    {
        $model = new Seminar();
        $data = \Yii::$app->request->post();
        if ($model->load($data)) {

            if ($model->validate()) {
                $model->add($data);
                \Yii::$app->getSession()->setFlash('success', '添加成功');
                return $this->redirect('list');
            } else {
                Yii::$app->getSession()->setFlash('error', '添加失败,数据错误！');
                return $this->render('add', ['model' => $model]);
            }
        }
        $model->scenario = 'add';
        return $this->render('add', ['model' => $model]);

    }


    public function actionEdit()
    {
        $id = \Yii::$app->request->get('id');
        $data = \Yii::$app->request->post();
        $seminar=new Seminar();
        $model= Seminar::findOne($id);
        if (!empty($data) ) {
            $seminar->add($data);
            \Yii::$app->getSession()->setFlash('success', '编辑成功');
            return $this->redirect('list');
        }
        $model->scenario = 'edit';
        return $this->render('edit', [ 'model' =>$model]);
    }

    public function actionDelete()
    {
        $id = \Yii::$app->request->get('id', 0);
        $model = new Seminar();
        $del = $model->del($id);
        if ($del) {
            \Yii::$app->getSession()->setFlash('success', '删除成功');
            return $this->redirect('list');
        } else {
            Yii::$app->getSession()->setFlash('error', '删除失败,请重新操作！');
            return $this->redirect('list');
        }
    }

    public function actionPublish()
    {
        //发布动态
        $id = \Yii::$app->request->get('id', 0);
        $model = new Seminar();
        $publish = $model->PublishDynamic($id);
        if ($publish) {
            \Yii::$app->getSession()->setFlash('success', '已发送至队列中，请等待........');
            return $this->redirect('list');
        } else {
            Yii::$app->getSession()->setFlash('error', '发布失败,请重新操作！');
            return $this->redirect('list');
        }
    }

    public function actionRelease()
    {
        $id = \Yii::$app->request->get('id', 0);
        $model = new Seminar();
        $relese = $model->ReleaseAnswer($id);
        if ($relese===0) {
            \Yii::$app->getSession()->setFlash('error', '答案正在发布中，请等待........');
            return $this->redirect('list');
        } elseif($relese===false){
            Yii::$app->getSession()->setFlash('error', '答案已发布过,请勿重复操作！');
            return $this->redirect('list');
        }else{
            \Yii::$app->getSession()->setFlash('success', '答案正在发布中，请等待........');
            return $this->redirect('list');
        }
    }
    public function actionImageUpload(){
        $dynamicid=\Yii::$app->request->get('id',0);

        if($_FILES && $dynamicid)
        {
            $v=$_FILES['files'];
            if($v["tmp_name"])
            {
                UploadHelper::$fileName=$v['tmp_name'][0];
                $result = UploadHelper::Uimpage();
                DcDynamicImg::$dynamicId=$dynamicid;
                $model=new DcDynamicImg();
                $model->src = $result;
                $model->createtime = time();
                $model->dynamicid= $dynamicid;
                $model->save();
                $img1 =preg_replace("/\/([0-9a-zA-Z]+)\.jpg/","/150_150_$1.jpg",$result);
            }
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return array(
                'files'=>array(
                    array(
                        'name'=>$img1,
                        'size'=>$v['size'][0],
                        'type'>'image/jpeg',
                        'url'=>$result,
                        'thumbnailUrl'=>$img1,
                        'deleteUrl'=>Url::to(['image-delete','id'=>$model->id,'dynamicid'=>$dynamicid]),
                        'deleteType'=>'DELETE'
                    )
                )
            );
        }

        if(\Yii::$app->request->get('type',0)==2)
        {
            DcDynamicImg::$dynamicId=$dynamicid;
            $list=DcDynamicImg::findAll(['dynamicid'=>$dynamicid]);
            foreach($list as $k=>$v)
            {
                $imgs['name']=$v['src'];
                $imgs['size']=0;
                $imgs['type']='image/jpeg';
                $imgs['url']=$v['src'];
                $img1 =preg_replace("/\/([0-9a-zA-Z]+)\.jpg/","/150_150_$1.jpg",$v['src']);
                $imgs['thumbnailUrl']=$img1;
                $imgs['deleteUrl']=Url::to(['image-delete','id'=>$v['id'],'dynamicid'=>$v['dynamicid']]);
                $imgs['deleteType']='DELETE';
                $return['files'][]=$imgs;
            }
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $return;
        }

        return $this->render('image');
    }
    public function actionImageDelete(){
        $id=\Yii::$app->request->get('id',0);
        DcDynamicImg::$dynamicId=\Yii::$app->request->get('dynamicid',0);
        $rest=DcDynamicImg::deleteAll("id=".$id);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if($rest){
            return ['img'=>true];
        }else{
            return ['img'=>false];
        }
    }
}


