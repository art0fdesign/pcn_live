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
<div class="middleContent">
    <fieldset>
    <div class="widget">
    
        <div class="title1"><h6>Menu Item Data</h6></div>

        <div class="formRow mt30">
            <?php echo $form->labelEx($model, 'parent_id'); ?>
            <div class="formRight"><?php echo CHtml::textField('', @$model->parent->name,$disabled); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'menu_order'); ?>
            <div class="formRight"><?php echo CHtml::textField('', $model->menu_order,$disabled); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'name'); ?>
            <div class="formRight"><?php echo $form->textField($model,'name',$disabled); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'caption'); ?>
            <div class="formRight"><?php echo $form->textField($model,'caption',$disabled); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'description'); ?>
            <div class="formRight"><?php echo $form->textField($model,'description',$disabled); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'li_options'); ?>
            <div class="formRight"><?php echo $form->textField($model,'li_options',$disabled); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'li_type'); ?>
            <div class="formRight"><?php echo CHtml::textField('', $model->getTypeText(),$disabled); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow"<?php echo $displayPageDiv; ?>>
            <?php echo $form->labelEx($model, 'li_page'); ?>
            <div class="formRight"><?php echo CHtml::textField('', @$model->page->name,$disabled); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'li_value'); ?>
            <div class="formRight"><?php echo $form->textField($model,'li_value',$disabled); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'f_status'); ?>
            <div class="formRight"><?php echo $form->checkBox($model,'f_status',CMap::mergeArray($disabled,array('id'=>'ch3','class'=>'styled'))); ?></div>
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
        <?php echo CHtml::link('Back to list',array('list', 'mid'=>$model->menu_id), array('class'=>'backBtn')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>
