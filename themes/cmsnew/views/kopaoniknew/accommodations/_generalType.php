<?php
/**
 * Created by Lemmy.
 * Date: 12/8/12
 * Time: 8:09 PM
 */?>
<div class="titleBlock">
    <span>ACCOMMODATIONS: Create New Accommodations</span>
</div>

<?php

// Sys Info Panel date format
$dtFormat = $this->getCMSSetting( 'sysinfo_dt_format', 'Y-m-d H:i' );
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'accommodations-general-type-form',
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
                <?php //echo $form->labelEx($model,'id'); ?>
                <label for="gentype">General Type</label>
                <div class="formRight">
                    <div class="select-list"><?php echo $form->dropDownList($model,'id', AccommodationsGeneralType::model()->getGeneralTypeOptions(), array('empty'=>'---select---', 'id'=>'gentype')); ?>
                        <?php echo $form->error( $model, 'id' ); ?></div>
                </div>
                <div class="clear"></div>
            </div>

            <div class="formRow mb20"></div>

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
        <?php echo CHtml::submitButton( $model->isNewRecord ? 'Next' : 'Save', array('name'=>'save', 'class'=>'saveBtn')); ?>
        <?php echo CHtml::link( 'Back to List', array('index'), array('class'=>'backBtn')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>