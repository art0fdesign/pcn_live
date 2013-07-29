<?php

// Sys Info Panel date format
$dtFormat = $this->getCMSSetting( 'sysinfo_dt_format', 'Y-m-d H:i' );
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'listing-item-form',
    'htmlOptions'=>array('class'=>'form'),
	'enableAjaxValidation'=>false,
)); ?>
<div class="middleContent">
    <fieldset>
        <div class="widget">
        
            <div class="title1"><h6>membership Data</h6></div>
            
            <div class="formRow">
                <div class="formRight">
                    <?php echo $form->errorSummary($model); ?>
                </div>
                <div class="clear"></div>
            </div>

            <div class="formRow mt30">
                <?php echo $form->labelEx($model, 'cat_id'); ?>
                <div class="formRight">
                    <div class="select-list">
                        <?php echo $form->dropDownList($model,'cat_id',$model->getCategoryOptions()); ?>
                    </div>
                    <?php echo $form->error($model, 'cat_id') ?></div>
                <div class="clear"></div>
            </div>

            <div class="formRow mb20">
                <?php echo $form->labelEx($model, 'item_id'); ?>
                <div class="formRight">
                    <div class="select-list">
                        <?php echo $form->dropDownList($model,'item_id',$model->getMemberOptions()); ?>
                    </div>
                    <?php echo $form->error($model, 'item_id') ?></div>
                <div class="clear"></div>
            </div>
        </div>
    </fieldset>
</div>    

<!-- INFO PANEL -->
<div class="rightContent">
    
    <div class="button-box mt20">
        <?php echo CHtml::submitButton( $model->isNewRecord ? 'Create' : 'Save', array('name'=>'save', 'class'=>'saveBtn')); ?>
        <?php echo CHtml::link( 'Back to List', array('index'), array('class'=>'backBtn')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>
