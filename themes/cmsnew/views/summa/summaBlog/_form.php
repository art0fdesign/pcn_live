<?php

// Sys Info Panel date format
$dtFormat = $this->getCMSSetting( 'sysinfo_dt_format', 'Y-m-d H:i' );
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'summa-blog-form',
    'htmlOptions'=>array('class'=>'form'),
	'enableAjaxValidation'=>true,
)); ?>
<div class="middleContent">
    <fieldset>
        <div class="widget">
    
        <div class="title1"><h6>Post Data</h6></div>
        
        <div class="formRow mt30">
            <div class="formRight">
                <?php echo $form->errorSummary($model); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'cat_id'); ?>
            <div class="formRight">
                <div class="select-list"><?php echo $form->dropDownList($model,'cat_id', $model->getCategoryOptions()); ?></div>
        		<?php echo $form->error( $model, 'cat_id' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'blog_date'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'blog_date',array('title'=>'Type date in format: yyyy-mm-dd')); ?>
        		<?php echo $form->error( $model, 'blog_date' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'blog_name'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'blog_name',array('size'=>60,'maxlength'=>256)); ?>
        		<?php echo $form->error( $model, 'blog_name' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'blog_author'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'blog_author',array('size'=>60,'maxlength'=>256)); ?>
        		<?php echo $form->error( $model, 'blog_author' ); ?>
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

    <div class="widget">
        <div class="title"><h6>Post Text</h6></div>
        <fieldset>
            <?php echo $form->textArea($model,'blog_content',array('class'=>'textEditor')); ?>
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
                <?php  echo CHtml::image($model->loadBlogCmsImage()); ?>
            </div><br />

            <div align="center"><?php echo $form->labelEx($model, 'blog_image'); ?></div>
            <div align="center"><?php echo $form->textField($model, 'blog_image', array()); ?></div>
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
