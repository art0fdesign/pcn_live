<?php

// Sys Info Panel date format
$dtFormat = $this->getCMSSetting( 'sysinfo_dt_format', 'Y-m-d H:i' );
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'accommodations-form',
    'htmlOptions'=>array('class'=>'form'),
	'enableAjaxValidation'=>true,
)); ?>
<div class="middleContent">
    <fieldset>
        <div class="widget">
    
        <div class="title1"><h6>Data</h6></div>
        
        <div class="formRow mt30">
            <div class="formRight">
                <?php echo $form->errorSummary($model); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model,'general_type_id'); ?>
            <div class="formRight">
                <?php echo $form->textField($model,'general_type_id', array('disabled'=>'disabled', 'value'=>$model->getGeneralType())); ?>
                    <?php echo $form->error( $model, 'general_type_id' ); ?>
            </div>
            <div class="clear"></div>
        </div>



        <div class="formRow">
    		<?php echo $form->labelEx($model,'type_id'); ?>
            <div class="formRight">
        		<div class="select-list"><?php echo $form->dropDownList($model,'type_id', $model->getTypeOptions(), array('empty'=>'---select---')); ?>
        		<?php echo $form->error( $model, 'type_id' ); ?></div>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'name'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'name',array()); ?>
        		<?php echo $form->error( $model, 'name' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'location_id'); ?>
            <div class="formRight">
        		<div class="select-list"><?php echo $form->dropDownList($model,'location_id', AccommodationsLocation::model()->getLocationsText()); ?>
        		<?php echo $form->error( $model, 'location_id' ); ?></div>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'owner'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'owner',array()); ?>
        		<?php echo $form->error( $model, 'owner' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'phone'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'phone',array()); ?>
        		<?php echo $form->error( $model, 'phone' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'email'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'email',array()); ?>
        		<?php echo $form->error( $model, 'email' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'website'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'website',array()); ?>
        		<?php echo $form->error( $model, 'website' ); ?>
            </div>
            <div class="clear"></div>
        </div>


        <div class="formRow">
    		<?php echo $form->labelEx($model,'description'); ?>
            <div class="formRight">
        		<?php echo $form->textArea($model,'description',array()); ?>
        		<?php echo $form->error( $model, 'description' ); ?>
            </div>
            <div class="clear"></div>
        </div>

<?php if($model->general_type_id == 1): ?>

        <div class="formRow">
            <?php echo $form->labelEx($model,'rooms_num'); ?>
            <div class="formRight">
                <?php echo $form->textField($model,'rooms_num'); ?>
                <?php echo $form->error( $model, 'rooms_num' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model,'beds_num'); ?>
            <div class="formRight">
                <?php echo $form->textField($model,'beds_num'); ?>
                <?php echo $form->error( $model, 'beds_num' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model,'beds_per_room'); ?>
            <div class="formRight">
                <?php echo $form->listBox($model,'beds_per_room', $model->getBedsPerRoomOptions(), array('multiple'=>'multiple', 'title'=>'Press ctrl for multiple selestion')); ?>
                <?php echo $form->error( $model, 'beds_per_room' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model,'price_person_min'); ?>
            <div class="formRight">
                <?php echo $form->textField($model,'price_person_min',array('size'=>60,'maxlength'=>256)); ?>
                <?php echo $form->error( $model, 'price_person_min' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model,'price_person_max'); ?>
            <div class="formRight">
                <?php echo $form->textField($model,'price_person_max',array('size'=>60,'maxlength'=>256)); ?>
                <?php echo $form->error( $model, 'price_person_max' ); ?>
            </div>
            <div class="clear"></div>
        </div>

<?php endif; ?>

        <div class="formRow">
            <?php echo $form->labelEx($model,'distance_from_center'); ?>
            <div class="formRight">
                <div class="select-list"><?php echo $form->dropDownList($model,'distance_from_center', $model->getDistances()); ?>
                <?php echo $form->error( $model, 'distance_from_center' ); ?>
            </div></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model,'details'); ?>
            <div class="formRight">
                <?php echo Chtml::activeListBox($model,'details', AccommodationsDetails::model()->getDetails(), array('multiple'=>'multiple', 'title'=>'Press ctrl for multiple selestion')); ?>
                <?php echo $form->error( $model, 'details' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'tags'); ?>
            <div class="formRight">
                <?php echo CHtml::activeListBox($model, 'tags', AccommodationsTags::model()->getTagsText(), array('multiple'=>'multiple', 'title'=>'Press ctrl for multiple selestion')); ?>
        		<?php echo $form->error( $model, 'tags' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'order_by'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'order_by'); ?>
        		<?php echo $form->error( $model, 'order_by' ); ?>
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
