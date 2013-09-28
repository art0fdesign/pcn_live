<?php
$pcn_our_team_locations = Yii::app()->params['pcnOurTeamLocations'];

// Sys Info Panel date format
$dtFormat = $this->getCMSSetting( 'sysinfo_dt_format', 'Y-m-d H:i' );
// array to disable input fields... if there MUST be inputs???
 
$readOnly = array('readonly'=>'readonly');
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'listing-item-form',
    'htmlOptions'=>array('class'=>'form'),
	'enableAjaxValidation'=>false,
)); ?>
<div class="middleContent">
    <fieldset>
        <div class="widget">
    
            <div class="title1"><h6>Item Data</h6></div>

    
            <div class="formRow mt30">
                <?php echo $form->labelEx($model,'id'); ?>
                <div class="formRight">
                    <?php echo $form->textField( $model, 'id', $readOnly ); ?>
                </div>            
                <div class="clear"></div>
            </div>

<?php if( $model->listingMain->f_use_cat && $model->listingMain->listing_id != 'ourteam'): ?>    
            <div class="formRow">
                <?php echo $form->labelEx($model,'cat_id'); ?>
                <div class="formRight">
                    <?php echo CHtml::textField( 'cat_id', $model->listingCategory->cat_title, $readOnly ); ?>
                </div>            
                <div class="clear"></div>
            </div>
<?php elseif( $model->listingMain->listing_id == 'ourteam' ): ?>
            <div class="formRow">
                <label>Location</label>
                <div class="formRight">
                    <?php echo CHtml::textField( 'cat_id', $pcn_our_team_locations[$model->cat_id], $readOnly ); ?>
                </div>            
                <div class="clear"></div>
            </div>
<?php endif; ?>    
            <div class="formRow">
                <?php echo $form->labelEx($model,'item_title'); ?>
                <div class="formRight">
                    <?php echo $form->textField( $model, 'item_title', $readOnly ); ?>
                </div>            
                <div class="clear"></div>
            </div>

    
            <div class="formRow">
                <?php echo $form->labelEx($model,'item_order'); ?>
                <div class="formRight">
                    <?php echo $form->textField( $model, 'item_order', $readOnly ); ?>
                </div>            
                <div class="clear"></div>
            </div>

    
            <div class="formRow">
                <?php echo $form->labelEx($model,'lang_id'); ?>
                <div class="formRight">
                    <?php echo CHtml::textField( 'lang', $model->language->lang_name, $readOnly ); ?>
                </div>            
                <div class="clear"></div>
            </div>


            <div class="formRow mb20">
                <?php echo $form->labelEx($model, 'f_status'); ?>
                <div class="formRight"><?php echo $form->checkBox($model,'f_status',array('id'=>'ch3','class'=>'styled')); ?></div>
                <div class="clear"></div>
            </div>


        </div>
    </fieldset>
    <fieldset>
        <div class="widget">
    
            <div class="title"><h6>List HTML</h6></div>
    
            <?php echo $form->textArea($model,'html_list',CMap::mergeArray($readOnly,array('style'=>'width:468px;height:150px;'))); ?>

        </div>
    </fieldset>
<?php if( $model->listingMain->f_use_detail ):?>
    <fieldset>
        <div class="widget">
    
            <div class="title"><h6>Details HTML</h6></div>
    
            <?php echo $form->textArea($model,'html_content',CMap::mergeArray($readOnly,array('style'=>'width:468px;height:150px;'))); ?>

        </div>
    </fieldset>
<?php endif;?>

<?php if( $model->listingMain->f_use_widget ): ?>        
    <fieldset>
        <div class="widget">
        
            <div class="title1"><h6>Widget Data</h6></div>
            

            <div class="formRow mt30">
                <?php echo $form->labelEx($model, 'f_widget'); ?>
                <div class="formRight"><?php echo $form->checkBox($model,'f_widget',array('id'=>'ch5','class'=>'styled')); ?></div>
                <div class="clear"></div>
            </div>

    
            <div class="formRow mb20">
                <?php echo $form->labelEx($model,'widget_order'); ?>
                <div class="formRight">
                    <?php echo $form->textField( $model, 'widget_order', $readOnly ); ?>
                </div>            
                <div class="clear"></div>
            </div>

        </div>
    </fieldset>
    <fieldset>
        <div class="widget">
    
            <div class="title"><h6>Widget HTML</h6></div>
    
            <?php echo $form->textArea($model,'html_widget',CMap::mergeArray($readOnly,array('style'=>'width:468px;height:150px;'))); ?>

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
                <?php echo $form->textField( $model, 'image_url', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    </div>
<?php endif;?>
    
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
        <?php echo CHtml::link( 'Back to List', array('index', 'list'=>$model->listing_id), array('class'=>'backBtn')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>
