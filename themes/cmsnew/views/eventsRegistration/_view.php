<?php
// array to disable input fields... if there MUST be inputs???
$disabled = array('readonly'=>'readonly');
//
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'events-form',
    'htmlOptions'=>array('class'=>'form'),
    'enableAjaxValidation'=>false,
));
?>
<div class="middleContent">
    <fieldset>
        <div class="widget">

        <div class="title1"><h6>Event Data</h6></div>


        <div class="formRow mt30">
            <?php echo $form->labelEx($model, 'name'); ?>
            <div class="formRight"><?php echo $form->textField($model,'name',$disabled); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow mb20">
            <?php echo $form->labelEx($model, 'f_status'); ?>
            <div class="formRight"><?php echo $form->checkBox($model,'f_status',CMap::mergeArray($disabled,array('id'=>'ch3','class'=>'styled'))); ?></div>
            <div class="clear"></div>
        </div>

    </div>
    </fieldset>

    <fieldset>
        <div class="widget">
            <div class="title"><h6>Content Above</h6></div>
            <?php echo $form->textArea($model,'content_above',CMap::mergeArray($readOnly,array('style'=>'width:468px;height:150px;'))); ?>
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
            <span><?= date( $dtFormat, strtotime( $model->created_dt ) ); ?></span>
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
        <?php echo CHtml::link('Back to List',array('index'), array('class'=>'backBtn')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
