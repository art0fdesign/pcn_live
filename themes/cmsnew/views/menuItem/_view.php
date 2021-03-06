<?php
// array to disable input fields... if there MUST be inputs??? 
$disabled = array('disabled'=>'disabled');
//
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'template-form',
    'htmlOptions'=>array('class'=>'form'),
	'enableAjaxValidation'=>false,
)); 
// hide page div 
$displayPageDiv = '';
if( $model->li_type == 1 ) $displayPageDiv = ' style="display:none;"';
?>

    <fieldset>
    <div class="widget">
    
        <div class="title"><h6>Menu Item Data</h6></div>

        <div class="formRow">
            <?php echo CHtml::encode($model->getAttributeLabel('parent_id')); ?>
            <div class="formRight"><?php echo CHtml::textField('', @$model->parent->name,$disabled); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo CHtml::encode($model->getAttributeLabel('menu_order')); ?>
            <div class="formRight"><?php echo CHtml::textField('', $model->menu_order,$disabled); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo CHtml::encode($model->getAttributeLabel('name')); ?>
            <div class="formRight"><?php echo $form->textField($model,'name',$disabled); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo CHtml::encode($model->getAttributeLabel('caption')); ?>
            <div class="formRight"><?php echo $form->textField($model,'caption',$disabled); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo CHtml::encode($model->getAttributeLabel('description')); ?>
            <div class="formRight"><?php echo $form->textField($model,'description',$disabled); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo CHtml::encode($model->getAttributeLabel('li_options')); ?>
            <div class="formRight"><?php echo $form->textField($model,'li_options',$disabled); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo CHtml::encode($model->getAttributeLabel('li_type')); ?>
            <div class="formRight"><?php echo CHtml::textField('', $model->getTypeText(),$disabled); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow"<?php echo $displayPageDiv; ?>>
            <?php echo CHtml::encode($model->getAttributeLabel('li_page')); ?>
            <div class="formRight"><?php echo CHtml::textField('', @$model->page->name,$disabled); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo CHtml::encode($model->getAttributeLabel('li_value')); ?>
            <div class="formRight"><?php echo $form->textField($model,'li_value',$disabled); ?></div>
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
