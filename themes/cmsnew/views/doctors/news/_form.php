<?php

// Sys Info Panel date format
$dtFormat = $this->getCMSSetting( 'sysinfo_dt_format', 'Y-m-d H:i' );
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-form',
    'htmlOptions'=>array('class'=>'form'),
	'enableAjaxValidation'=>true,
)); ?>
<div class="middleContent">
    <fieldset>
        <div class="widget">
    
        <div class="title1"><h6>News Data</h6></div>
        
        <div class="formRow mt30">
            <div class="formRight">
                <?php echo $form->errorSummary($model); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow mt30">
            <?php echo $form->labelEx($model,'news_name'); ?>
            <div class="formRight">
                <?php echo $form->textField($model,'news_name',array('size'=>50,'maxlength'=>50)); ?>
                <?php echo $form->error( $model, 'news_name' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'news_source'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'news_source',array('size'=>50,'maxlength'=>50)); ?>
        		<?php echo $form->error( $model, 'news_source' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <!--<div class="formRow">
    		<?php //echo $form->labelEx($model,'news_text'); ?>
            <div class="formRight">
        		<?php //echo $form->textArea($model,'news_text',array('rows'=>6, 'cols'=>50)); ?>
        		<?php //echo $form->error( $model, 'news_text' ); ?>
            </div>
            <div class="clear"></div>
        </div>-->

        <!--<div class="formRow">
    		<?php //echo $form->labelEx($model,'news_image'); ?>
            <div class="formRight">
        		<?php //echo $form->textField($model,'news_image',array('size'=>60,'maxlength'=>256)); ?>
        		<?php //echo $form->error( $model, 'news_image' ); ?>
            </div>
            <div class="clear"></div>
        </div>-->

        <div class="formRow">
    		<?php echo $form->labelEx($model,'order_by'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'order_by'); ?>
        		<?php echo $form->error( $model, 'order_by' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <!--<div class="formRow">
    		<?php //echo $form->labelEx($model,'f_status'); ?>
            <div class="formRight">
        		<?php //echo $form->textField($model,'f_status'); ?>
        		<?php //echo $form->error( $model, 'f_status' ); ?>
            </div>
            <div class="clear"></div>
        </div>-->

        <div class="formRow mb20">
            <?php echo $form->labelEx($model, 'f_status'); ?>
            <div class="formRight">
                <?php echo $form->checkBox($model,'f_status', array('id'=>'ch3','class'=>'styled')); ?>
                <?php echo $form->error( $model, 'f_status' ); ?>
                <label for="ch3">active</label>
            </div>
            <div class="clear"></div>
        </div>

        </div>
    </fieldset>

    <div class="widget">

        <fieldset>
            <?php /*<div class="title1"><h6><?php echo $form->labelEx($model,'description'); ?></h6></div>
                <div class="formRow mt30"></div>*/ ?>
            <div class="formRight">
                <?php echo $form->textArea($model,'news_text',array('class'=>'textEditor')); ?>
                <?php echo $form->error( $model, 'news_text' ); ?>
            </div>
        </fieldset>
    </div>
</div>    

<!-- INFO PANEL -->
<div class="rightContent">

    <div class="rightWidget widget">
        <fieldset>
        <div class="title"><h6>News Image</h6></div>
        <div class="formRow mt30"></div>
        <div align="center" style="width:202px; height:157px; border: 1px solid #CDCDCD; margin:0 auto;">
            <img alt="img1" src="<?php echo $model->loadNewsImage(); ?>">
        </div><br />

        <div align="center"><?php echo $form->labelEx($model, 'news_image'); ?></div>
        <div align="center"><?php echo $form->textField($model, 'news_image', array()); ?></div>
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
