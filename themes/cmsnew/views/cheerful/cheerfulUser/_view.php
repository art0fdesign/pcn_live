<?php

// Sys Info Panel date format
$dtFormat = $this->getCMSSetting( 'sysinfo_dt_format', 'Y-m-d H:i' );
// array to disable input fields... if there MUST be inputs???
$disabled = array('disabled'=>'disabled');
$readOnly = array('readonly'=>'readonly');
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'cheerful-user-form',
    'htmlOptions'=>array('class'=>'form'),
	'enableAjaxValidation'=>false,
)); ?>
<div class="middleContent">
    <fieldset>
        <div class="widget">
    
        <div class="title1"><h6>Cheerful User Data</h6></div>

    
        <div class="formRow mt30">
            <?php echo $form->labelEx($model,'id'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'id', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'church_name'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'church_name', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'ein'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'ein', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'phone'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'phone', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'address_state'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'address_state', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'address_zip'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'address_zip', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'address_city'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'address_city', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'address_street'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'address_street', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'address_number'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'address_number', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'contact_name'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'contact_name', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'pastor_name'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'pastor_name', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'hear_from'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'hear_from', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'gtw_account'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'gtw_account', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'gtw_tsys_bin'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'gtw_tsys_bin', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'gtw_tsys_merchant_num'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'gtw_tsys_merchant_num', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'gtw_tsys_store_num'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'gtw_tsys_store_num', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'gtw_tsys_terminal_id'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'gtw_tsys_terminal_id', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'gtw_tsys_terminal_num'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'gtw_tsys_terminal_num', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'gtw_tsys_merchant_cat_code'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'gtw_tsys_merchant_cat_code', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'gtw_tsys_location_code'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'gtw_tsys_location_code', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'gtw_cnet_merchant_num'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'gtw_cnet_merchant_num', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'gtw_cnet_terminal_id'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'gtw_cnet_terminal_id', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'gtw_cnet_merchant_cat_code'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'gtw_cnet_merchant_cat_code', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'gtw_chase_tdn'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'gtw_chase_tdn', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'gtw_chase_currency'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'gtw_chase_currency', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'gtw_mes_profile_id'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'gtw_mes_profile_id', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'gtw_mes_merchant_key'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'gtw_mes_merchant_key', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'payment_method'); ?>
            <div class="formRight">
                <?php echo $form->textField( $model, 'payment_method', $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'f_status'); ?>
            <div class="formRight">
                <?php echo $form->checkBox($model, 'f_status', CMap::mergeArray($disabled, array('id'=>'ch_status', 'class'=>'styled'))); ?>
                <label for="ch_status">active</label>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow">
            <?php echo $form->labelEx($model,'f_deleted'); ?>
            <div class="formRight">
                <?php echo $form->checkBox( $model, 'f_deleted', CMap::mergeArray($disabled, array('class'=>'styled'))); ?>
            </div>            
            <div class="clear"></div>
        </div>



        <?php if($model->f_deleted == 1): ?>
        <div class="formRow">
            <?php echo $form->labelEx($model,'deleted_id'); ?>
            <div class="formRight">
                <?php echo CHtml::textField('deleted_id', $model->getDeletedId(),  $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>

    
        <div class="formRow mb20">
            <?php echo $form->labelEx($model,'deleted_dt'); ?>
            <div class="formRight">
                <?php echo CHtml::textField('deleted_dt', $model->getDeletedTime(), $readOnly ); ?>
            </div>            
            <div class="clear"></div>
        </div>
        <?php endif; ?>



        </div>
    </fieldset>
</div>

<!-- INFO PANEL -->
<div class="rightContent">
    <?php /*<div class="rightWidget widget">
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
    </div>*/ ?>
    
    <div class="button-box mt20">
        <?php echo CHtml::link( 'Edit', array('update', 'id'=>$model->id), array('class'=>'saveBtn')); ?>
        <?php echo CHtml::link( 'Back to List', array('index'), array('class'=>'backBtn')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>
