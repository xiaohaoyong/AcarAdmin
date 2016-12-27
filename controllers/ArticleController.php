<?php
/**
 * 资讯
 */
namespace app\controllers;

use app\models\article\Article;
use app\models\article\ArticleForm;
use app\models\article\ArticleList;
use app\models\article\ArticleTag;
use app\models\article\Tag;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

class ArticleController extends BaseController
{
    public function actions()
    {
        return [
            'Kupload' => [
                'class' => 'pjkui\kindeditor\KindEditorAction',
            ]
        ];
    }

    public function actionAdd()
    {
        $article = new ArticleForm();
        $article->scenario = "create";
        $tag = new Tag();
        $relation = new ArticleTag();
        $params = \Yii::$app->request->post();
        $file = UploadedFile::getInstance($article,'image');
        $article->load($params);
        $article->image = $file;
        if(\Yii::$app->request->isPost && \Yii::$app->request->isAjax){
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($article);
        }
        if(!empty($params)) {
            $article->save();
            $artRes = $article->primaryKey;
            if(is_numeric($artRes))
            {
                $image = $article->add($file);
                if(!empty($image))
                {
                    $newObj = Article::findOne($artRes);
                    $newObj->image = $image;
                    $newObj->save();
                }
            }
            $tagRes = $tag->add($params);
            if(!is_numeric($artRes) || is_array($tagRes))
            {
                \Yii::$app->getSession()->setFlash('error', '输入信息有误');
                return $this->redirect('add');
            }else{
                $res = $relation->add(['artid' => $artRes,'tagid' => $tagRes]);
                if($res)
                {
                    \Yii::$app->getSession()->setFlash('success', '文章添加成功');
                    return $this->redirect('list');
                }
            }
        }else{
            return $this->render('article',[
                'article' => $article,
                'tag' => $tag,
            ]);
        }
    }

    public function actionEdit()
    {
        $params = \Yii::$app->request->post();
        $id = \Yii::$app->request->get('id');
        $article = ArticleForm::findOne($id);
        $file = UploadedFile::getInstance($article,'image');
        $tag = new Tag();
        $relation = new ArticleTag();
        $article->load($params);
        if(!empty($file))
        {
            $article->image = $file;
        }
        if(\Yii::$app->request->isPost && \Yii::$app->request->isAjax){
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($article);
        }
        if(!empty($params)) {
            $image = $article->add($file);
            if (!empty($image))
            {
                $article->image = $image;
            }
            $artRes = $article->save();
            $tagRes = $tag->add($params);
            if(!$artRes || is_array($tagRes))
            {
                \Yii::$app->getSession()->setFlash('error', '输入信息有误');
            }else{
                $relation->add(['artid' => $id,'tagid' => $tagRes]);
                \Yii::$app->getSession()->setFlash('success', '文章编辑成功');
            }
            return $this->redirect('list');
        }else{
            $data = $article->info(\Yii::$app->request->get('id',0));
            if(!empty($data))
            {
                $article = $data;
                $tag->name = $data->tags;
            }
            $article->scenario = "update";
            return $this->render('article',[
                'article' => $article,
                'tag' => $tag,
            ]);
        }
    }

    public function actionList()
    {
        $searchModel = new ArticleList();
        $dataProvider = $searchModel->search(\Yii::$app->request->get());
        return $this->render('list',[
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    public function actionDelete()
    {
        $model = new Article();
        $id = \Yii::$app->request->get('id');
        $model->del($id);
        $relation = new ArticleTag();
        $result = $relation->deleteAll(['=','artid',$id]);
        if($result)
        {
            \Yii::$app->getSession()->setFlash('success', '文章删除成功');
        }
        return $this->redirect('list');
    }

    public function actionHidden()
    {
        $model = new Article();
        $id = \Yii::$app->request->get('id');
        $result = $model->hidden($id);
        if($result)
        {
            \Yii::$app->getSession()->setFlash('success', '文章隐藏成功');
        }
        return $this->redirect('list');
    }

    public function actionPublish()
    {
        $model = new Article();
        $id = \Yii::$app->request->get('id');
        $result = $model->publish($id);
        if($result)
        {
            \Yii::$app->getSession()->setFlash('success', '文章显示成功');
        }
        return $this->redirect('list');
    }

    public function actionCheckUnique()
    {
        $params['title'] = \Yii::$app->request->get('title');
        $params['id'] = \Yii::$app->request->get('artid');
        $model = new Article();
        $result = $model->checkUnique($params);
        return $result;
    }
}