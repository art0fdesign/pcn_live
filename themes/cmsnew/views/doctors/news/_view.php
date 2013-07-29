<?php

// Sys Info Panel date format
$dtFormat = $this->getCMSSetting( 'sysinfo_dt_format', 'Y-m-d H:i' );
// array to disable input fields... if there MUST be inputs???
 
$readOnly = array('readonly'=>'readonly');
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-form',
    'htmlOptions'=>array('class'=>'form'),
	'enableAjaxValidation'=>false,
)); ?>
<div class="middleContent">
    <fieldset>
        <div class="widget">
    
        <div class="title1"><h6>News Data</h6></div>

    
        <div class="formRow mt30">
            <?php echo $form->labelEx($model,'id'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'id', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>


        <div class="formRow">
            <?php echo $form->labelEx($model,'news_name'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'news_name', $readOnly ); ?>
            </div>
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'news_source'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'news_source', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <!--<div class="formRow">
            <?php //echo $form->labelEx($model,'news_text'); ?>
            <div class="formRight">
                <?php //echo $form->textField( $model, 'news_text', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>-->

    
        <!--<div class="formRow">
            <?php //echo $form->labelEx($model,'news_image'); ?>
            <div class="formRight">
                <?php //echo $form->textField( $model, 'news_image', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>-->

    
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
                <?php echo $form->checkBox($model, 'f_status', CMap::mergeArray($readOnly, array('id'=>'ch_status', 'class'=>'styled'))); ?>
            </div>            
            <div class="clear"></div>
        </div>

        </div>
    </fieldset>


    <div class="widget longWidget">
        <div class="title1"></div>
        <fieldset>
            <div class="formRow mt30">
                <?php /*<div align="center"><?php echo $form->textArea($model,'issue_text',CMap::mergeArray($disabled,array('style'=>'height:300px;'))); ?></div> */?>
                <?php echo CHtml::tag('p', array('disabled'=>'disabled')); echo $model->news_text; echo CHtml::closeTag('p') ?>
                <div class="clear"></div>
            </div>
        </fieldset>
    </div>


</div>

<!-- INFO PANEL -->
<div class="rightContent">

    <div class="rightWidget widget">
        <div class="title"><h6>News Image</h6></div>
        <div class="formRow mt30"></div>
        <div align="center" style="width:202px; height:157px; border: 1px solid #CDCDCD; margin:0 auto;">
            <img alt="img1" src="<?php echo $model->loadNewsImage(); ?>">
        </div><br />

        <div align="center"><?php echo $form->labelEx($model, 'news_image'); ?></div>
        <div align="center"><?php echo $form->textField($model, 'news_image', $readOnly); ?></div>
        <div class="clear"></div>
        <div class="formRow mt20"></div>

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
        <?php echo CHtml::link( 'Back to List', array('index'), array('class'=>'backBtn')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>
