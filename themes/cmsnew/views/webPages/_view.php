<?php
// array to disable input fields... if there MUST be inputs???
$disabled = array('disabled'=>'disabled');

$form=$this->beginWidget('CActiveForm', array(
    'id'=>'template-form',
    'htmlOptions'=>array('class'=>'form'),
    'enableAjaxValidation'=>true,
));
?>
<div class="middleContent">
<fieldset>
    <div class="widget">

        <div class="title1"><h6>Page Data</h6></div>





        <div class="formRow mt40">
            <?php echo $form->labelEx($model, 'name'); ?>
            <div class="formRight"><?php echo $form->textField($model,'name',$disabled); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'url'); ?>
            <div class="formRight"><?php echo $form->textField($model,'url',$disabled); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'parent_id'); ?>
            <div class="formRight"><div class="select-list"><?php echo $form->dropDownList($model,'parent_id',CMap::mergeArray(array("0"=>"no parent"),$model->getPagesOptions()),$disabled); ?></div></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'tpl_id'); ?>
            <div class="formRight"><div class="select-list"><?php echo $form->dropDownList($model,'tpl_id',Template::getTemplatesOptions(),$disabled); ?></div></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'lang_id'); ?>
            <div class="formRight"><div class="select-list"><?php echo $form->dropDownList($model,'lang_id',Language::getLanguagesOptions(),$disabled); ?></div></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'f_status'); ?>
            <div class="formRight"><?php echo $form->checkBox($model,'f_status',CMap::mergeArray($disabled,array('id'=>'ch3','class'=>'styled'))); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow mb20">
            <?php echo $form->labelEx($model, 'google_code'); ?>
            <div class="formRight"><?php echo $form->checkBox($model,'google_code',CMap::mergeArray($disabled, array('id'=>'ch4','class'=>'styled'))); ?></div>
            <div class="clear"></div>
        </div>
    </div>
</fieldset>
<fieldset>
    <div class="widget longWidget">

        <div class="title1"><h6>Meta Data</h6></div>

        <div class="formRow mt40">
            <?php echo $form->labelEx($model, 'meta_title'); ?>
            <div class="formRight"><?php echo $form->textField($model,'meta_title',$disabled); ?></div>

            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'meta_keywords'); ?>
            <div class="formRight"><?php echo $form->textArea($model,'meta_keywords',$disabled); ?></div>

            <div class="clear"></div>
        </div>

        <div class="formRow mb20">
            <?php echo $form->labelEx($model, 'meta_description'); ?>
            <div class="formRight"><?php echo $form->textArea($model,'meta_description',$disabled); ?></div>

            <div class="clear"></div>
        </div>

    </div>
</fieldset>
</div>
<div class="rightContent">
    <div class="rightWidget widget">
        <div class="title">
            <h6>System info</h6>
        </div>
        <div class="formRow mt30">
            <b>Created by: </b>
            <span><?= @$model->creator->first_name.' '.@$model->creator->last_name; ?></span>
        </div>
        <div class="formRow">
            <b>Created: </b>
            <span><?= $model->created_dt; ?></span>
        </div>
        <div class="formRow">
            <b>Modified by: </b>
            <span><?= @$model->editor->first_name.' '.@$model->editor->last_name; ?></span>
        </div>
        <div class="formRow mb20">
            <b>Modified: </b>
            <span><?= $model->changed_dt; ?></span>
        </div>
    </div>
    <div class="button-box mt20">
        <?php echo CHtml::link('Edit',array('update', 'id'=>$model->id), array('class'=>'saveBtn')); ?>
        <?php echo CHtml::link('or back to list',array('index'), array('class'=>'backBtn')); ?>
    </div>
</div>


<?php $this->endWidget(); ?>