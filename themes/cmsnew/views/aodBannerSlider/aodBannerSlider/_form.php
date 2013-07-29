<?php

// Sys Info Panel date format
$dtFormat = $this->getCMSSetting( 'sysinfo_dt_format', 'Y-m-d H:i' );
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'aod-banner-slider-form',
    'htmlOptions'=>array('class'=>'form'),
	'enableAjaxValidation'=>true,
)); ?>
<div class="middleContent">
    <fieldset>
        <div class="widget">
    
        <div class="title1"><h6>Slider Data</h6></div>
        
        <div class="formRow mt30">
            <div class="formRight">
                <?php echo $form->errorSummary($model); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'img_id'); ?>
            <div class="formRight">
                <div class="select-list"><?php echo $form->dropDownList($model,'img_id', $model->getImagesOptions(), array(
                    'empty'=>'Select Image',
                    'ajax'=>array(
                        'type'=>'POST',
                        'url'=>array('getImagePreview'),
                        'success'=>'function(data){
                            $("#img-preview").html();
                            $("#img-preview").html(data);
                        }'
                    )
                )); ?>
        		<?php echo $form->error( $model, 'img_id' ); ?>
            </div></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model,'alt_tag'); ?>
            <div class="formRight">
                <?php echo $form->textField($model,'alt_tag',array('size'=>60,'maxlength'=>255)); ?>
                <?php echo $form->error( $model, 'alt_tag' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model,'order_by'); ?>
            <div class="formRight">
                <?php echo $form->textField($model,'order_by',array('size'=>60,'maxlength'=>255)); ?>
                <?php echo $form->error( $model, 'order_by' ); ?>
            </div>
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

    <div class="widget">
        <div class="title"><h6>Text</h6></div>
        <fieldset>
            <?php echo $form->textArea($model,'content',array('class'=>'textEditor')); ?>
        </fieldset>
    </div>

</div>    

<!-- INFO PANEL -->
<div class="rightContent">

    <div class="rightWidget widget">
        <div class="title"><h6>Image Preview</h6></div>
        <div id="img-preview" style="margin: 40px 0 15px 17px;">
            <?php echo CHtml::image( File::model()->getFileThumbUrl( true, 'preview', $model->img_id )); ?>
        </div>
    </div>
    <div class="clear"></div>

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
