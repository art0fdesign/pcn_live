<?php

// Sys Info Panel date format
$dtFormat = $this->getCMSSetting( 'sysinfo_dt_format', 'Y-m-d H:i' );
// array to disable input fields... if there MUST be inputs???
$disabled = array('disabled'=>'disabled');
$readOnly = array('readonly'=>'readonly');
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'accommodations-form',
    'htmlOptions'=>array('class'=>'form'),
	'enableAjaxValidation'=>false,
)); ?>
<div class="middleContent">
    <fieldset>
        <div class="widget">
    
        <div class="title1"><h6>Data</h6></div>

    
        <div class="formRow mt30">
            <?php echo $form->labelEx($model,'id'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'id', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>


        <div class="formRow">
            <?php echo $form->labelEx($model,'general_type_id'); ?>
            <div class="formRight">
                <?php echo CHtml::textField('general_type_id', $model->getGeneralType(),  $readOnly ); ?>
            </div>
            <div class="clear"></div>
        </div>


        <div class="formRow">
            <?php echo $form->labelEx($model,'type_id'); ?>
            <div class="formRight">
                <?php echo CHtml::textField('type_id', $model->getType(),  $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'name'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'name', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'location_id'); ?>
            <div class="formRight">
                <?php echo CHtml::textField('location_id', $model->getLocation(),  $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'owner'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'owner', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'phone'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'phone', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'email'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'email', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'website'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'website', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <?php /*<div class="formRow">
            <?php echo $form->labelEx($model,'details_id'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'details_id', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>*/?>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'description'); ?>
            <div class="formRight">
                <?php echo $form->textArea( $model, 'description', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

<?php if($model->general_type_id == 1): ?>

        <div class="formRow">
            <?php echo $form->labelEx($model,'rooms_num'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'rooms_num', $readOnly ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model,'beds_num'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'beds_num', $readOnly ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model,'beds_per_room'); ?>
            <div class="formRight">
                <?php echo CHtml::activeListBox($model, 'beds_per_room',$model->getBedsPerRoom(), $readOnly); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model,'price_person_min'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'price_person_min', $readOnly ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model,'price_person_max'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'price_person_max', $readOnly ); ?>
            </div>
            <div class="clear"></div>
        </div>

<?php endif; ?>

        <div class="formRow">
            <?php echo $form->labelEx($model,'distance_from_center'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'distance_from_center', $readOnly ); ?>
            </div>
            <div class="clear"></div>
        </div>


        <div class="formRow">
            <?php echo $form->labelEx($model,'details'); ?>
            <div class="formRight">
                <?php echo CHtml::activeListBox($model, 'details',$model->getAccommDetailsNames(), $readOnly); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model,'tags'); ?>
            <div class="formRight">
                <?php echo CHtml::activeListBox( $model, 'tags', $model->getAccommTags(),  $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'order_by'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'order_by', $readOnly ); ?>
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
