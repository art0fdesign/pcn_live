<?php
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'events-form',
    'htmlOptions'=>array('class'=>'form'),
    'enableAjaxValidation'=>true,
));
?>
<div class="middleContent">
    <fieldset>
    <div class="widget">

        <div class="title1"><h6>Event Data</h6></div>



        <div class="formRow mt30">
            <?php echo $form->labelEx($model, 'name'); ?>
            <div class="formRight"><?php echo $form->textField($model,'name'); ?>
            <?php echo $form->error($model,'name'); ?></div>
            <div class="clear"></div>
        </div>


        <div class="formRow mb20">
            <?php echo $form->labelEx($model, 'f_status'); ?>
            <div class="formRight"><?php echo $form->checkBox($model,'f_status', array('id'=>'ch3','class'=>'styled')); ?>
                <label for="ch3">active</label></div>
            <div class="clear"></div>
        </div>

    </fieldset>

    <fieldset>
        <div class="widget">
            <div class="title"><h6>Content Above</h6></div>
            <?php echo $form->textArea($model,'content_above',array('style'=>'width:468px;height:150px;', 'class'=>'textEditor')); ?>
        </div>
    </fieldset>


    <fieldset>
        <div class="widget">
            <div class="title"><h6>Comming Soon Message</h6></div>
            <?php echo $form->textArea($model,'comming_soon',array('style'=>'width:468px;height:150px;', 'class'=>'textEditor')); ?>
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
            <span><?if( !$model->isNewRecord ) echo @$model->creator->first_name.' '.@$model->creator->last_name; ?></span>
        </div>
        <div class="formRow">
            <b>Created: </b>
            <span><?if( !$model->isNewRecord ) echo $model->created_dt; ?></span>
        </div>
        <div class="formRow">
            <b>Modified by: </b>
            <span><?if( !$model->isNewRecord ) echo @$model->editor->first_name.' '.@$model->editor->last_name; ?></span>
        </div>
        <div class="formRow mb20">
            <b>Modified: </b>
            <span><?if( !$model->isNewRecord ) echo $model->changed_dt; ?></span>
        </div>
    </div>
    <div class="button-box mt20">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('name'=>'save', 'class'=>'saveBtn')); ?>
        <?php echo CHtml::link('or back to list',array("index"),array('class'=>'backBtn')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>
