<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'template-form',
    'htmlOptions'=>array('class'=>'form'),
	'enableAjaxValidation'=>true,
)); 
?>

    <fieldset>
    <div class="widget">
    
        <div class="title"><h6>Menu Data</h6></div>
        
        <div class="formRow">
            <div class="formRight">
                <?php echo $form->errorSummary($model); ?>
            </div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'name'); ?>
            <div class="formRight"><?php echo $form->textField($model,'name'); ?>
            <?php echo $form->error($model,'name'); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'description'); ?>
            <div class="formRight"><?php echo $form->textField($model,'description'); ?>
            <?php echo $form->error($model,'description'); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'ul_options'); ?>
            <div class="formRight"><?php echo $form->textField($model,'ul_options'); ?>
            <?php echo $form->error($model,'ul_options'); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'f_status'); ?>
            <div class="formRight"><?php echo $form->checkBox($model,'f_status', array('id'=>'ch3')); ?>
            <label for="ch3">active</label></div>
            <div class="clear"></div>
        </div>
    </div>
    </fieldset>

    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('name'=>'save', 'class'=>'btn floatR')); ?>

<?php $this->endWidget(); ?>
