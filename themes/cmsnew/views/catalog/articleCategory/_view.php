<?php

// array to disable input fields... if there MUST be inputs???
 
$disabled = array('disabled'=>'disabled');
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'article-category-form',
    'htmlOptions'=>array('class'=>'form'),
	'enableAjaxValidation'=>false,
)); ?>
<div class="middleContent">
    <fieldset>
    <div class="widget">
    
        <div class="title1"><h6>Category Data</h6></div>




    

        <div class="formRow mt30">
            <?php echo $form->labelEx($model, 'name'); ?>
            <div class="formRight">
                <?php echo $form->textField($model,'name',$disabled); ?>
            </div>            
            <div class="clear"></div>
        </div>
    

        <div class="formRow">
            <?php echo $form->labelEx($model, 'parent_id'); ?>
            <div class="formRight">
                <?php echo Chtml::textField('parent_id', @$model->parent->name, $disabled); ?>
            </div>            
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <?php echo $form->labelEx($model, 'order_by'); ?>
            <div class="formRight">
                <?php echo $form->textField($model,'order_by',$disabled); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow mb20">
            <?php echo $form->labelEx($model, 'f_status'); ?>
            <div class="formRight"><?php echo $form->checkBox($model,'f_status',CMap::mergeArray($disabled,array('id'=>'ch3','class'=>'styled'))); ?></div>
            <div class="clear"></div>
        </div>

    </fieldset>

    <fieldset>
        <div class="widget">

            <div class="title"><h6>Description</h6></div>

            <?php echo $form->textArea($model,'description',CMap::mergeArray($disabled,array('style'=>'width:458px;height:150px;'))); ?>

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
<?php $this->endWidget(); ?>
