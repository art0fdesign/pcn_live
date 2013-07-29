<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'file-form',
    'htmlOptions'=>array('class'=>'form', 'enctype' => 'multipart/form-data'),
	'enableAjaxValidation'=>true,
)); 
?>
<div class="middleContent">
    <fieldset>
    <div class="widget">
    
        <div class="title1"><h6>File Data</h6></div>
        
        <div class="formRow mt30">
            <div class="formRight">
                <?php echo $form->errorSummary($model); ?>
            </div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'file'); ?>
            <div class="formRight"> <?php echo $form->fileField($model,'file'); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'file_name'); ?>
            <div class="formRight">
                <?php echo $form->textField($model,'file_name'); ?>
                <?php echo $form->error($model, 'file_name');?>
                <?php //echo $form->error($model, 'file_seo');?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'cat_id'); ?>
            <div class="formRight"><div class="select-list"><?php echo $form->dropDownList($model,'cat_id', $model->getCategoryOptions(), array('empty'=>'No Category Selected')); ?></div></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'file_alt'); ?>
            <div class="formRight"><?php echo $form->textField($model,'file_alt'); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'file_title'); ?>
            <div class="formRight"><?php echo $form->textField($model,'file_title'); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'file_comment'); ?>
            <div class="formRight"><?php echo $form->textarea($model,'file_comment'); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow mb20">
            <?php echo $form->labelEx($model, 'f_status'); ?>
            <div class="formRight"><?php echo $form->checkBox($model,'f_status', array('id'=>'ch3','class'=>'styled')); ?>
                <label for="ch3">active</label></div>
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
