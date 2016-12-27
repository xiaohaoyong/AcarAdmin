<?php
$this->title = "病例研讨班病例图片上传";
\app\assets\FileuploadAsset::register($this);



$jsform="FormFileUpload.init();";
$js[]=$jsform;
$this->registerJs(implode("\n",$js));
?>
<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-12">
        <blockquote>
            <p style="font-size:16px">
                操作方法：<br>
                1.选择需要上传的图片，可选多张。<br>
                2.图片上传：选择图片后可单个上传或者点击批量上传<br>
                3.清除：点击后选择并未上传的图片会清除<br>
                4.删除：上传后的图片可单个清除或批量清除。
            </p>
        </blockquote>
        <br>
        <?php $form = \yii\widgets\ActiveForm::begin([
            'action' => ['image-upload','id'=>\Yii::$app->request->get('id',0),'type'=>2],
            'method' => 'post',
            'options' => ['class' => 'form-horizontal t-margin20r', 'id' => 'fileupload', 'enctype' => "multipart/form-data"],
        ]); ?>
            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="col-lg-7">

                <!-- The fileinput-button span is used to style the file input field as button -->

                   <?= \yii\helpers\Html::a( '<div  class="btn yellow"> <i class="fa fa fa-share"></i><span>返回列表页</span> </div>',['list'],[])?>

								<span class="btn green fileinput-button">
								<i class="fa fa-plus"></i>
								<span>
								添加图片</span>
								<input type="file" name="files[]" multiple="">
								</span>
                <button type="submit" class="btn blue start">
                    <i class="fa fa-upload"></i>
								<span>
								批量上传</span>
                </button>
                <button type="reset" class="btn warning cancel">
                    <i class="fa fa-ban-circle"></i>
								<span>
								清除</span>
                </button>
                <button type="button" class="btn red delete">
                    <i class="fa fa-trash"></i>
								<span>
								批量删除</span>
                </button>
                <input type="checkbox" class="toggle">
                <!-- The global file processing state -->
								<span class="fileupload-process">
								</span>
            </div>
            <!-- The global progress information -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;">
                    </div>
                </div>
                <!-- The extended global progress information -->
                <div class="progress-extended">
                    &nbsp;
                </div>
            </div>
        </div>
            <!-- The table listing the files available for upload/download -->
            <table role="presentation" class="table table-striped clearfix">
                <tbody class="files">
                </tbody>
            </table>
            <?php \yii\widgets\ActiveForm::end(); ?>
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">注意：</h3>
            </div>
            <div class="panel-body">
                <ul>

                    <li>
                        仅支持(<strong>JPG, GIF, PNG</strong>)，每条病例只可上传9张图片
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview" ></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger label label-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
            </div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn blue start" disabled>
                    <i class="fa fa-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn red cancel">
                    <i class="fa fa-ban"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
        {% for (var i=0, file; file=o.files[i]; i++) { %}
            <tr class="template-download fade">
                <td>
                    <span class="preview">
                        {% if (file.thumbnailUrl) { %}
                            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img style="width:200px"  src="{%=file.thumbnailUrl%}"></a>
                        {% } %}
                    </span>
                </td>
                <td>
                    <p class="name">
                        {% if (file.url) { %}
                            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                        {% } else { %}
                            <span>{%=file.name%}</span>
                        {% } %}
                    </p>
                    {% if (file.error) { %}
                        <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                    {% } %}
                </td>
                <td>
                    <span class="size">{%=o.formatFileSize(file.size)%}</span>
                </td>
                <td>
                    {% if (file.deleteUrl) { %}
                        <button class="btn red delete btn-sm" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                            <i class="fa fa-trash-o"></i>
                            <span>Delete</span>
                        </button>
                        <input type="checkbox" name="delete" value="1" class="toggle">
                    {% } else { %}
                        <button class="btn yellow cancel btn-sm">
                            <i class="fa fa-ban"></i>
                            <span>Cancel</span>
                        </button>
                    {% } %}
                </td>
            </tr>
        {% } %}
    </script>