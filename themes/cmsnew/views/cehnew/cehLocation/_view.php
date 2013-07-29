<?php

// Sys Info Panel date format
$dtFormat = $this->getCMSSetting( 'sysinfo_dt_format', 'Y-m-d H:i' );
// array to disable input fields... if there MUST be inputs???
$disabled = array('disabled'=>'disabled');
$readOnly = array('readonly'=>'readonly');
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'ceh-location-form',
    'htmlOptions'=>array('class'=>'form'),
	'enableAjaxValidation'=>false,
)); ?>
<div class="middleContent">
    <fieldset>
        <div class="widget">
    
        <div class="title1"><h6>Ceh Location Data</h6></div>

    
        <div class="formRow mt30">
            <?php echo $form->labelEx($model,'id'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'id', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'facility'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'facility', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'address'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'address', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'city'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'city', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'zip_code'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'zip_code', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'state'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'state', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'state_code'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'state_code', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'longitude'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'longitude', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'latitude'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'latitude', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model,'intro_text'); ?>
            <div class="formRight">
                <?php echo $form->textArea( $model, 'intro_text', $readOnly ); ?>
            </div>
            <div class="clear"></div>
        </div>


        <div class="formRow mb20">
            <?php echo $form->labelEx($model,'f_status'); ?>
            <div class="formRight">
                <?php echo $form->checkBox($model, 'f_status', CMap::mergeArray($disabled, array('id'=>'ch_status', 'class'=>'styled'))); ?>
                <label for="ch_status">active</label>
            </div>
            <div class="clear"></div>
        </div>

        </div>
    </fieldset>

    <fieldset>
        <div class="widget">

            <div class="title"><h6>Directions</h6></div>

            <?php echo $form->textArea($model,'directions',CMap::mergeArray($disabled,array('style'=>'width:468px;height:150px;'))); ?>

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
            <span><?php echo date( $dtFormat, strtotime( @$model->created_dt ) ); ?></span>
        </div>
        
        <div class="formRow">
            <b>Modified by: </b>
            <span><?php echo @$model->editor->first_name.' '.@$model->editor->last_name; ?></span>
        </div>
        
        <div class="formRow mb20">
            <b>Modified: </b>
            <span><?php echo date( $dtFormat, strtotime( @$model->changed_dt ) ); ?></span>
        </div>
    </div>
    
    <div class="button-box mt20">
        <?php echo CHtml::link( 'Edit', array('update', 'id'=>$model->id), array('class'=>'saveBtn')); ?>
        <?php echo CHtml::link( 'Back to List', array('index'), array('class'=>'backBtn')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>
