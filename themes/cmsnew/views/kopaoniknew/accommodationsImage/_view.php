<?php

// Sys Info Panel date format
$dtFormat = $this->getCMSSetting( 'sysinfo_dt_format', 'Y-m-d H:i' );
// array to disable input fields... if there MUST be inputs???
$disabled = array('disabled'=>'disabled');
$readOnly = array('readonly'=>'readonly');
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'accommodations-image-form',
    'htmlOptions'=>array('class'=>'form'),
    'enableAjaxValidation'=>false,
)); ?>
<div class="middleContent">
    <fieldset>
        <div class="widget">

            <div class="title1"><h6>Image Data</h6></div>


            <div class="formRow mt30">
                <?php echo $form->labelEx($model,'id'); ?>
                <div class="formRight">
                    <?php echo $form->textField( $model, 'id', $readOnly ); ?>
                </div>
                <div class="clear"></div>
            </div>


            <div class="formRow">
                <?php echo $form->labelEx($model,'accomm_id'); ?>
                <div class="formRight">
                    <?php echo CHtml::textField('accomm_id', $model->getAccommName(), $readOnly ); ?>
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
        <div class="title"><h6>File Preview</h6></div>
        <div style="margin: 40px 0 15px 17px;">
            <?php echo CHtml::image( $model->getPreviewThumb(), '', array()); ?>
        </div>
    </div>

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
        <?php echo CHtml::link( 'Back to List', array('index','id'=>$model->accomm_id), array('class'=>'backBtn')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>
