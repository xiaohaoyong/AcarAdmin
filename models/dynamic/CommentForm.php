<?php
namespace app\models\dynamic;
use \yii\base\Model;


class CommentForm extends Model
{

    public $delInfo;
    public $warInfo;
    public $delete;
    public $warningNum;
    public $warning;
    public function rules()
    {
        return [
            // [[ 'content'], 'required', 'message' => '删除理由不能为空！'],
            [['delInfo'], 'required', 'message' => '删除理由为必选数据！'],
            [['warInfo'], 'required', 'message' => '删除理由为必选数据！'],
            [['warningNum'], 'required', 'message' => '删除理由为必选数据！'],

            //  ['content', 'required', 'when' => function($model) { return $model->info== 5;},'message'=>'内容必填'],
            //  ['content',checkcontentinfo, 'skipError' => false, 'skipEmpty' => false],
            ['delete', 'string', 'min' => 2, 'max' =>20,"tooLong"=>"所添加的内容不能超过20字符", "tooShort"=>"所添加的内容不小于2字符"],
            [
                'delete',
                "required",
                'when' => function ($model) {
                    return $model->delInfo==5;
                },
                'whenClient' => "function (attribute, value) { return $('#dynamicform-delinfo').val() == 5; }",
                'message' => '内容必填'
            ],

            [
                'warning',
                "required",
                'when' => function ($model) {
                    return $model->warInfo==5;
                },
                'whenClient' => "function (attribute, value) { return $('#dynamicform-warinfo').val() == 5; }",
                'message' => '内容必填'
            ],


        ];
    }




}