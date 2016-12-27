<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2016/9/26
 * Time: 10:28
 */

namespace app\components\widgets;


use app\assets\JstreeAsset;
use yii\helpers\Html;

class JstreeWidget extends InputWidget
{
    public $field="field";
    public $action;
    /**
     * @var boolean If true, shows the widget as an inline calendar and the input as a hidden field.
     */
    public $inline = false;
    /**
     * @var array the HTML attributes for the container tag. This is only used when [[inline]] is true.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $containerOptions = [];
    /**
     * @var string the format string to be used for formatting the date value. This option will be used
     * to populate the [[clientOptions|clientOption]] `dateFormat`.
     * The value can be one of "short", "medium", "long", or "full", which represents a preset format of different lengths.
     *
     * It can also be a custom format as specified in the [ICU manual](http://userguide.icu-project.org/formatparse/datetime#TOC-Date-Time-Format-Syntax).
     * Alternatively this can be a string prefixed with `php:` representing a format that can be recognized by the
     * PHP [date()](http://php.net/manual/de/function.date.php)-function.
     *
     * For example:
     *
     * ```php
     * 'MM/dd/yyyy' // date in ICU format
     * 'php:m/d/Y' // the same date in PHP format
     * ```
     *
     * If not set the default value will be taken from `Yii::$app->formatter->dateFormat`.
     */
    public $clientOptions;
    public function init()
    {
        if ($this->inline && !isset($this->containerOptions['id'])) {
            $this->containerOptions['id'] = $this->options['id'] . '-container';
        }
        parent::init(); // TODO: Change the autogenerated stub

    }

    public function run()
    {
        echo $this->renderWidget()."\n";
        $containerID = $this->inline ? $this->containerOptions['id'] : $this->options['id'];
        $this->registerClientOptions('jstree', $containerID);
        JstreeAsset::register($this->getView());

        $jsform="
            $('#$this->id').on('changed.jstree', function(e, data) {
                r = [];
                var i, j;
                 $('.$this->field').remove();

                for (i = 0, j = data.selected.length; i < j; i++) {
                    var node = data.instance.get_node(data.selected[i]);
                    if(!node.original.value){
                        node.original.value=node.id;
                    }
                    if (data.instance.is_leaf(node)) {
                       $('#".$this->id."form').append('<input class=\"$this->field\" type=\"hidden\" name=\"".$this->field."[]\" value=\"'+node.original.value+'\"/>');
                    }
                }
                //alert('Selected: ' + r.join('@@'));
            })
        ";


        $js[]=$jsform;
        $this->getView()->registerJs(implode("\n",$js));



    }

    public function renderWidget(){
        $form=Html::beginForm($this->action,'post',['id'=>$this->id."form"])."\n";
        $form.=Html::endForm();
        return $form;
    }

}