<?php

// Sys Info Panel date format
$dtFormat = $this->getCMSSetting( 'sysinfo_dt_format', 'Y-m-d H:i' );
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'doctor-degree-form',
    //'htmlOptions'=>array('class'=>'form'),
	'enableAjaxValidation'=>true,
)); ?>
<div class="middleContent">
    <fieldset>
        <div class="widget">
        
            <div class="title1"><h6>Doctor Degree Data</h6></div>
            
            <div class="formRow">
                <div class="formRight">
                    <?php echo $form->errorSummary($model); ?>
                </div>
                <div class="clear"></div>
            </div>

            <div class="formRow mt30">
        		<?php echo $form->labelEx($model,'cat_id'); ?>
                <div class="formRight">
            		<?php echo Chtml::textField( 'category', $model->category->cat_name, array( 'readonly'=>'readonly' ) ); ?>
                    <?php echo $form->hiddenField( $model, 'cat_id' ); ?>
            		<?php echo $form->error( $model, 'cat_id' ); ?>
                </div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
        		<?php echo $form->labelEx($model,'code'); ?>
                <div class="formRight">
            		<?php echo $form->textField($model,'code',array('size'=>10,'maxlength'=>10)); ?>
            		<?php echo $form->error( $model, 'code' ); ?>
                </div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
        		<?php echo $form->labelEx($model,'description'); ?>
                <div class="formRight">
            		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>200)); ?>
            		<?php echo $form->error( $model, 'description' ); ?>
                </div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
        		<?php echo $form->labelEx($model,'order_by'); ?>
                <div class="formRight">
            		<?php echo $form->textField($model,'order_by',array('size'=>11,'maxlength'=>11)); ?>
            		<?php echo $form->error( $model, 'order_by' ); ?>
                </div>
                <div class="clear"></div>
            </div>
    
            <div class="formRow mb20">
                <?php echo $form->labelEx($model, 'f_status', array('for'=>'ch3')); ?>
                <div class="formRight"><?php echo $form->checkBox($model,'f_status', array('id'=>'ch3','class'=>'styled')); ?>
                    <label for="ch3">active</label></div>
                <div class="clear"></div>
            </div>

        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('name'=>'save', 'class'=>'btn floatR')); ?>
    
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
