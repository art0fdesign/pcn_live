<?php
// array to disable input fields... if there MUST be inputs??? 
$disabled = array('disabled'=>'disabled');
//
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'template-form',
    'htmlOptions'=>array('class'=>'form'),
    'enableAjaxValidation'=>false,
));
?>
<div class="middleContent">
<fieldset>
    <div class="widget">

        <div class="title1"><h6>File Data</h6></div>

        <div class="formRow mt30">
            <?php echo $form->labelEx($model, 'cat_name'); ?>
            <div class="formRight"><?php echo $form->textField($model,'cat_name',$disabled); ?></div>
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
        <?php echo CHtml::link('Back to List',array('index'), array('class'=>'backBtn')); ?>
    </div>
</div>

<?php $this->endWidget(); 