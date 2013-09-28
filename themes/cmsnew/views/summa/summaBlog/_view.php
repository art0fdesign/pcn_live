<?php

// Sys Info Panel date format
$dtFormat = $this->getCMSSetting( 'sysinfo_dt_format', 'Y-m-d H:i' );
// array to disable input fields... if there MUST be inputs???
 
$readOnly = array('readonly'=>'readonly');
$disabled = array('disabled'=>'disabled');
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'summa-blog-form',
    'htmlOptions'=>array('class'=>'form'),
	'enableAjaxValidation'=>false,
)); ?>
<div class="middleContent">
    <fieldset>
        <div class="widget">
    
        <div class="title1"><h6>Summa Blog Data</h6></div>

    
        <div class="formRow mt30">
            <?php echo $form->labelEx($model,'id'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'id', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'cat_id'); ?>
            <div class="formRight">
                <?php echo CHtml::textField( '', $model->getCategoryText(), $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'blog_date'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'blog_date', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'blog_name'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'blog_name', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'blog_author'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'blog_author', $readOnly ); ?>
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
            </div>            
            <div class="clear"></div>
        </div>

        </div>
    </fieldset>

    <div class="widget">
        <div class="title"><h6><?php echo $form->labelEx($model, 'blog_content'); ?></h6></div>
        <fieldset>
            <?php echo $form->textArea($model,'blog_content',CMap::mergeArray($disabled,array('style'=>'width:468px;height:150px;'))); ?>
            <div class="clear"></div>
        </fieldset>
    </div>
</div>

<!-- INFO PANEL -->
<div class="rightContent">

    <div class="rightWidget widget">
        <fieldset>
            <div class="title"><h6>Blog Image</h6></div>
            <div class="formRow mt30"></div>
            <div align="center" style="width:200px; height:200px; border: 1px solid #CDCDCD; margin:0 auto;">
                <!--<img alt="img1" src="<?php //echo $model->loadBlogCmsImage(); ?>">-->
                <?php  echo CHtml::image($model->loadBlogCmsImage()); ?>
            </div><br />

            <div align="center"><?php echo $form->labelEx($model, 'blog_image'); ?></div>
            <div align="center"><?php echo $form->textField($model, 'blog_image', $readOnly); ?></div>
            <div class="clear"></div>
            <!--<div class="formRow mt20"></div>--><br />
        </fieldset>
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
