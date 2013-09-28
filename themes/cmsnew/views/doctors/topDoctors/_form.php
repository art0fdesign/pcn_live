<?php

// Sys Info Panel date format
$dtFormat = $this->getCMSSetting( 'sysinfo_dt_format', 'Y-m-d H:i' );
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'top-doctors-form',
    'htmlOptions'=>array('class'=>'form'),
	'enableAjaxValidation'=>true,
)); ?>
<div class="middleContent">
    <fieldset>
        <div class="widget">
    
        <div class="title1"><h6>Top Doctor Data</h6></div>
        
        <div class="formRow">
            <div class="formRight">
                <?php echo $form->errorSummary($model); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow mt30">
            <?php echo $form->labelEx($model,'month'); ?>
            <div class="formRight"><div class="select-list">
                <?php echo $form->dropDownList($model,'month',$model->_months, array('empty'=>'--select month--')); ?>
                <?php echo $form->error( $model, 'month' ); ?>
            </div></div>
            <div class="clear"></div>
        </div>


            <?php
            $selectedCategory = intval(Yii::app()->request->getParam('cat', 0));
            $categories = DoctorCategory::getCategoryOptions('cat_name');
            ?>

        <div class="formRow">
            <?php  echo CHtml::label('Category','categ', array());?>
            <div class="formRight">
                <div class="select-list"><?php echo CHtml::dropDownList('cat', $selectedCategory, $categories, $htmlOptions = array('id'=>'categ', 'empty'=>'---select category---', 'autocomplete'=>'off', 'ajax'=>array(
                    'type'=>'POST',
                    'url'=>CController::createUrl('topDoctors/setCatId')/*('topDoctors/getDoctorsByCat')*/,
                    //'dataType'=>'json',
                    //'success'=>'function(data) {
                      //      $("#doc_id").html(data.pageTemp);
                        // }',

                ) ));?></div>
            </div>
            <div class="clear"></div>
        </div>

        <?php /*<div class="formRow">
            <?php echo $form->labelEx($model, 'dtr_id'); ?>
            <div class="formRight">
                <div class="select-list"><?php echo $form->dropDownList($model,'dtr_id', array(), array('id'=>'doc_id') ); ?></div>
                <?php echo $form->error($model,'dtr_id'); ?></div>
            <div class="clear"></div>
        </div> */ ?>

        <div class="formRow">
            <?php echo $form->labelEx($model,'dtr_id'); ?>
            <div class="formRight">
                <?php echo $form->textField($model,'dtr_id', array('id'=>'doc_ac', 'ajax_id'=>'')); ?>
                <?php echo $form->error( $model, 'dtr_id' ); ?>
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

        <div class="formRow">
    		<?php echo $form->labelEx($model,'f_status'); ?>
            <div class="formRight">
        		<?php echo $form->checkBox($model,'f_status', array('class'=>'styled')); ?>
                <label for="ch3">active</label>
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
