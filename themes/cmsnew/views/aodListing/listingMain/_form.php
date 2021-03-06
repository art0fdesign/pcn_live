<?php

// Sys Info Panel date format
$dtFormat = $this->getCMSSetting( 'sysinfo_dt_format', 'Y-m-d H:i' );
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'listing-main-form',
    'htmlOptions'=>array('class'=>'form'),
	'enableAjaxValidation'=>true,
)); ?>
<div class="middleContent">
    <fieldset>
        <div class="widget">
        
            <div class="title1"><h6>Listing Main Data</h6></div>
            
            <div class="formRow">
                <div class="formRight">
                    <?php echo $form->errorSummary($model); ?>
                </div>
                <div class="clear"></div>
            </div>

            <div class="formRow mt40">
        		<?php echo $form->labelEx($model,'listing_id'); ?>
                <div class="formRight">
            		<?php echo $form->textField($model,'listing_id',array('size'=>20,'maxlength'=>20)); ?>
            		<?php echo $form->error( $model, 'listing_id' ); ?>
                </div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model, 'f_use_cat'); ?>
                <div class="formRight"><?php echo $form->checkBox($model,'f_use_cat', array('id'=>'ch2','class'=>'styled')); ?>
                    <label for="ch2">Yes/No</label></div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model, 'f_use_image'); ?>
                <div class="formRight"><?php echo $form->checkBox($model,'f_use_image', array('id'=>'ch6','class'=>'styled')); ?>
                    <label for="ch2">Yes/No</label></div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model, 'f_use_detail'); ?>
                <div class="formRight"><?php echo $form->checkBox($model,'f_use_detail', array('id'=>'ch5','class'=>'styled')); ?>
                    <label for="ch5">Yes/No</label></div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model, 'f_use_widget'); ?>
                <div class="formRight"><?php echo $form->checkBox($model,'f_use_widget', array('id'=>'ch4','class'=>'styled')); ?>
                    <label for="ch4">Yes/No</label></div>
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
