<?php
$pcn_our_team_locations = Yii::app()->params['pcnOurTeamLocations'];

// Sys Info Panel date format
$dtFormat = $this->getCMSSetting( 'sysinfo_dt_format', 'Y-m-d H:i' );
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'listing-item-form',
    'htmlOptions'=>array('class'=>'form'),
	'enableAjaxValidation'=>true,
)); ?>
<div class="middleContent">
    <fieldset>
        <div class="widget">
        
            <div class="title1"><h6>Listing Item Data</h6></div>
            
            <div class="formRow">
                <div class="formRight">
                    <?php echo $form->errorSummary($model); ?>
                </div>
                <div class="clear"></div>
            </div>

<?php if( $model->listingMain->f_use_cat && $model->listingMain->listing_id != 'ourteam'):?>
            <div class="formRow mt30">
                <?php echo $form->labelEx($model, 'cat_id'); ?>
                <div class="formRight">
                    <div class="select-list">
                        <?php echo $form->dropDownList($model,'cat_id',$categories); ?>
                    </div>
                    <?php echo $form->error($model, 'cat_id') ?></div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
<?php elseif( $model->listingMain->listing_id == 'ourteam' ): ?>
            <div class="formRow mt30">
                <label>Location</label>
                <div class="formRight">
                    <div class="select-list">
                        <?php echo $form->dropDownList($model,'cat_id',$pcn_our_team_locations); ?>
                    </div>
                    <?php echo $form->error($model, 'cat_id') ?></div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
<?php else: ?>
            <div class="formRow mt40">
<?php endif; ?>
        		<?php echo $form->labelEx($model,'item_title'); ?>
                <div class="formRight">
            		<?php echo $form->textField($model,'item_title',array('size'=>60,'maxlength'=>60)); ?>
            		<?php echo $form->error( $model, 'item_title' ); ?>
                </div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
        		<?php echo $form->labelEx($model,'item_order'); ?>
                <div class="formRight">
            		<?php echo $form->textField($model,'item_order'); ?>
            		<?php echo $form->error( $model, 'item_order' ); ?>
                </div>
                <div class="clear"></div>
            </div>
    
            <div class="formRow">
                <?php echo $form->labelEx($model, 'lang_id'); ?>
                <div class="formRight"><div class="select-list"><?php echo $form->dropDownList($model,'lang_id',Language::getLanguagesOptions()); ?></div>
                    <?php echo $form->error($model, 'lang_id') ?></div>
                <div class="clear"></div>
            </div>
    
            <div class="formRow mb10">
                <?php echo $form->labelEx($model, 'f_status'); ?>
                <div class="formRight"><?php echo $form->checkBox($model,'f_status', array('id'=>'ch3','class'=>'styled')); ?>
                    <label for="ch3">active</label></div>
                <div class="clear"></div>
            </div>
    
        </div>
    </fieldset>

    <fieldset>
        <div class="widget">
        
            <div class="title"><h6>List HTML</h6></div>

            <?php echo $form->textArea($model,'html_list',array('class'=>'textEditor')); ?>

        </div>
    </fieldset>

<?php if( $model->listingMain->f_use_detail ):?>    
    <fieldset>
        <div class="widget">
        
            <div class="title"><h6>Details HTML</h6></div>

            <?php echo $form->textArea($model,'html_content',array('class'=>'textEditor')); ?>

        </div>
    </fieldset>
<?php endif;?>

<?php if( $model->listingMain->f_use_widget ): // do we use widget functionality ?>        
    <fieldset>
        <div class="widget">
        
            <div class="title1"><h6>Widget Data</h6></div>
            
    
            <div class="formRow mt30">
                <?php echo $form->labelEx($model, 'f_widget'); ?>
                <div class="formRight"><?php echo $form->checkBox($model,'f_widget', array('id'=>'ch5','class'=>'styled')); ?>
                    <label for="ch5">Show</label></div>
                <div class="clear"></div>
            </div>

            <div class="formRow mb10">
        		<?php echo $form->labelEx($model,'widget_order'); ?>
                <div class="formRight">
            		<?php echo $form->textField($model,'widget_order'); ?>
            		<?php echo $form->error( $model, 'widget_order' ); ?>
                </div>
                <div class="clear"></div>
            </div>

        </div>
    </fieldset>
    <fieldset>
        <div class="widget">
        
            <div class="title"><h6>Widget HTML</h6></div>

            <?php echo $form->textArea($model,'html_widget',array('class'=>'textEditor')); ?>

        </div>
    </fieldset>
<?php endif; ?>    
</div>    

<!-- INFO PANEL -->
<div class="rightContent">
<?php if( $model->listingMain->f_use_image ): ?>
    <div class="rightWidget widget">
        <div class="title"><h6>Image Preview</h6></div>

        <div style="margin: 40px 0 0 17px;">
            <?php echo CHtml::image( $model->getIMagePreviewSrc() ); ?>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'image_url'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'image_url'); ?>
        		<?php echo $form->error( $model, 'image_url' ); ?>
            </div>
            <div class="clear"></div>
        </div>

    </div>
<?php endif; ?>
    
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
        <?php echo CHtml::link( 'Back to List', array('index', 'list'=>$model->listing_id), array('class'=>'backBtn')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>
