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

    <fieldset>
    <div class="widget">
    
        <div class="title"><h6>Menu Data</h6></div>

        <div class="formRow">
            <?php echo CHtml::encode($model->getAttributeLabel('name')); ?>
            <div class="formRight"><?php echo $form->textField($model,'name',$disabled); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo CHtml::encode($model->getAttributeLabel('description')); ?>
            <div class="formRight"><?php echo $form->textField($model,'description',$disabled); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo CHtml::encode($model->getAttributeLabel('ul_options')); ?>
            <div class="formRight"><?php echo $form->textField($model,'ul_options',$disabled); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo CHtml::encode($model->getAttributeLabel('f_status')); ?>
            <div class="formRight"><?php echo $form->checkBox($model,'f_status', CMap::mergeArray($disabled, array('id'=>'ch3'))); ?>
            <label for="ch3">active</label></div>
            <div class="clear"></div>
        </div>
    
    
    </div>
    </fieldset>
    
    <?php echo CHtml::link('Edit',array('update', 'id'=>$model->id), array('class'=>'btn floatR')); ?>

<?php $this->endWidget(); ?>
