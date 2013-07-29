<?php

// Sys Info Panel date format
$dtFormat = $this->getCMSSetting( 'sysinfo_dt_format', 'Y-m-d H:i' );
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'testimonials-form',
    'htmlOptions'=>array('class'=>'form'),
	'enableAjaxValidation'=>true,
)); ?>
<div class="middleContent">
    <fieldset>
        <div class="widget">
    
        <div class="title1"><h6>Testimonial Data</h6></div>
        
        <div class="formRow mt30">
            <div class="formRight">
                <?php echo $form->errorSummary($model); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model,'name'); ?>
            <div class="formRight">
                <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>
                <?php echo $form->error( $model, 'name' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model,'title'); ?>
            <div class="formRight">
                <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>200)); ?>
                <?php echo $form->error( $model, 'title' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model,'image'); ?>
            <div class="formRight">
                <?php echo $form->textField($model,'image',array('size'=>60,'maxlength'=>200)); ?>
                <?php echo $form->error( $model, 'image' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'f_widget'); ?>
            <div class="formRight">
                <?php echo $form->checkBox($model,'f_widget', array('id'=>'ch4','class'=>'styled')); ?>
                <label for="ch4">display</label>
                <?php echo $form->error( $model, 'f_widget' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'content'); ?>
            <div class="formRight">
        		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
        		<?php echo $form->error( $model, 'content' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow mb20">
    		<?php echo $form->labelEx($model,'f_status'); ?>
            <div class="formRight">
                <?php echo $form->checkBox($model,'f_status', array('id'=>'ch3','class'=>'styled')); ?>
                <label for="ch3">active</label>
                <?php echo $form->error( $model, 'f_status' ); ?>
            </div>
            <div class="clear"></div>
        </div>

    </fieldset>
</div>    

<!-- INFO PANEL -->
<div class="rightContent">
    <div class="rightWidget widget">
        <div class="title"><h6>System Info</h6></div>
        
        <div class="formRow mt30">
            <b>Created by: </b>
            <span><?php echo @$model->creator->first_name.' '.@$model->creator->last_name; ?></span>
        </div>
        
        <div class="formRow">
            <b>Created: </b>
            <span><?php echo $model->isNewRecord ? '': date( $dtFormat, strtotime( @$model->created_dt ) ); ?></span>
        </div>
        
        <div class="formRow">
            <b>Modified by: </b>
            <span><?php echo @$model->editor->first_name.' '.@$model->editor->last_name; ?></span>
        </div>
        
        <div class="formRow mb20">
            <b>Modified: </b>
            <span><?php echo $model->isNewRecord ? '': date( $dtFormat, strtotime( @$model->changed_dt ) ); ?></span>
        </div>
    </div>
    
    <div class="button-box mt20">
        <?php echo CHtml::submitButton( $model->isNewRecord ? 'Create' : 'Save', array('name'=>'save', 'class'=>'saveBtn')); ?>
        <?php echo CHtml::link( 'Back to List', array('index'), array('class'=>'backBtn')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>
