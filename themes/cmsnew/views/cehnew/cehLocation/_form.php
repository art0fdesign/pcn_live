<?php

// Sys Info Panel date format
$dtFormat = $this->getCMSSetting( 'sysinfo_dt_format', 'Y-m-d H:i' );
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'ceh-location-form',
    'htmlOptions'=>array('class'=>'form'),
	'enableAjaxValidation'=>true,
)); ?>
<div class="middleContent">
    <fieldset>
        <div class="widget">
    
        <div class="title1"><h6>Ceh Location Data</h6></div>
        
        <div class="formRow mt30">
            <div class="formRight">
                <?php echo $form->errorSummary($model); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'facility'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'facility',array('size'=>60,'maxlength'=>100)); ?>
        		<?php echo $form->error( $model, 'facility' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'address'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>100)); ?>
        		<?php echo $form->error( $model, 'address' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'city'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>100)); ?>
        		<?php echo $form->error( $model, 'city' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'zip_code'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'zip_code',array('size'=>10,'maxlength'=>10)); ?>
        		<?php echo $form->error( $model, 'zip_code' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'state'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'state',array('size'=>60,'maxlength'=>100)); ?>
        		<?php echo $form->error( $model, 'state' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'state_code'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'state_code',array('size'=>2,'maxlength'=>2)); ?>
        		<?php echo $form->error( $model, 'state_code' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'longitude'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'longitude'); ?>
        		<?php echo $form->error( $model, 'longitude' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'latitude'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'latitude'); ?>
        		<?php echo $form->error( $model, 'latitude' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model,'intro_text'); ?>
            <div class="formRight">
                <?php echo $form->textArea($model,'intro_text'); ?>
                <?php echo $form->error( $model, 'intro_text' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow mb20">
            <?php echo $form->labelEx($model,'f_status'); ?>
            <div class="formRight">
                <?php echo $form->checkBox($model,'f_status', array('id'=>'ch_status', 'class'=>'styled')); ?>
                <?php echo $form->error( $model, 'f_status' ); ?>
                <label for="ch_status">active</label>
            </div>
            <div class="clear"></div>
        </div>

        </div>
    </fieldset>

    <fieldset>
        <div class="widget">

            <div class="title"><h6>Directions</h6></div>

            <?php echo $form->textArea($model,'directions',array('class'=>'textEditor')); ?>

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
