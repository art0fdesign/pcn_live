<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'template-form',
    'htmlOptions'=>array('class'=>'form'),
	'enableAjaxValidation'=>true,
)); 
?>
<div class="middleContent">
    <fieldset>
    <div class="widget">
    
        <div class="title1"><h6>User Data</h6></div>
        


        <div class="formRow mt30">
            <?php echo $form->labelEx($model, 'user_name'); ?>
            <div class="formRight"><?php echo $form->textField($model,'user_name'); ?>
            <?php echo $form->error($model,'user_name'); ?></div>
            <div class="clear"></div>
        </div>
        

        <div class="formRow">
            <?php echo $form->labelEx($model, 'user_pwd'); ?>
            <div class="formRight"><?php echo $form->passwordField($model,'user_pwd'); ?>
            <?php echo $form->error($model,'user_pwd'); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'user_pwd_repeat'); ?>
            <div class="formRight"><?php echo $form->passwordField($model,'user_pwd_repeat'); ?>
            <?php echo $form->error($model,'user_pwd_repeat'); ?></div>
            <div class="clear"></div>
        </div>

        
        <div class="formRow">
            <?php echo $form->labelEx($model, 'first_name'); ?>
            <div class="formRight"><?php echo $form->textField($model,'first_name'); ?>
            <?php echo $form->error($model,'first_name'); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'last_name'); ?>
            <div class="formRight"><?php echo $form->textField($model,'last_name'); ?>
            <?php echo $form->error($model,'last_name'); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'email'); ?>
            <div class="formRight"><?php echo $form->textField($model,'email'); ?>
            <?php echo $form->error($model, 'email'); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'f_admin'); ?>
            <div class="formRight"><div class="select-list"><?php echo $form->dropDownList($model,'f_admin', $model->getAdminOptions()); ?></div></div>
            <div class="clear"></div>
        </div>

        <div class="formRow mb20">
            <?php echo $form->labelEx($model, 'f_status'); ?>
            <div class="formRight"><?php echo $form->checkBox($model,'f_status', array('id'=>'ch3','class'=>'styled')); ?>
                <label for="ch3">active</label></div>
            <div class="clear"></div>
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
