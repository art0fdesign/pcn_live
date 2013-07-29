<?php
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'template-form',
    'htmlOptions'=>array('class'=>'form' /*'enctype' => 'multipart/form-data'*/),
    'enableAjaxValidation'=>true,
));
?>
<div class="middleContent">
<fieldset>
    <div class="widget">

        <div class="title1"><h6>Create Category</h6></div>

        <div class="formRow mt30">
            <div class="formRight">
                <?php echo $form->errorSummary($model); ?>
            </div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'cat_name'); ?>
            <div class="formRight"><?php echo $form->textField($model,'cat_name'); ?>
                <?php echo $form->error($model,'cat_name'); ?></div>
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