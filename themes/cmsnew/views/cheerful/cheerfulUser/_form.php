<?php

// Sys Info Panel date format
$dtFormat = $this->getCMSSetting( 'sysinfo_dt_format', 'Y-m-d H:i' );
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'cheerful-user-form',
    'htmlOptions'=>array('class'=>'form'),
	'enableAjaxValidation'=>true,
)); ?>
<div class="middleContent">
    <fieldset>
        <div class="widget">
    
        <div class="title1"><h6>Cheerful User Data</h6></div>
        
        <div class="formRow mt30">
            <div class="formRight">
                <?php echo $form->errorSummary($model); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'id'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'id',array('size'=>11,'maxlength'=>11)); ?>
        		<?php echo $form->error( $model, 'id' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'church_name'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'church_name',array('size'=>60,'maxlength'=>100)); ?>
        		<?php echo $form->error( $model, 'church_name' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'ein'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'ein',array('size'=>60,'maxlength'=>60)); ?>
        		<?php echo $form->error( $model, 'ein' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'phone'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>100)); ?>
        		<?php echo $form->error( $model, 'phone' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'address_state'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'address_state',array('size'=>2,'maxlength'=>2)); ?>
        		<?php echo $form->error( $model, 'address_state' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'address_zip'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'address_zip',array('size'=>60,'maxlength'=>100)); ?>
        		<?php echo $form->error( $model, 'address_zip' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'address_city'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'address_city',array('size'=>60,'maxlength'=>100)); ?>
        		<?php echo $form->error( $model, 'address_city' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'address_street'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'address_street',array('size'=>60,'maxlength'=>100)); ?>
        		<?php echo $form->error( $model, 'address_street' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'address_number'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'address_number',array('size'=>60,'maxlength'=>100)); ?>
        		<?php echo $form->error( $model, 'address_number' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'contact_name'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'contact_name',array('size'=>60,'maxlength'=>100)); ?>
        		<?php echo $form->error( $model, 'contact_name' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'pastor_name'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'pastor_name',array('size'=>60,'maxlength'=>100)); ?>
        		<?php echo $form->error( $model, 'pastor_name' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'hear_from'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'hear_from'); ?>
        		<?php echo $form->error( $model, 'hear_from' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'gtw_account'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'gtw_account'); ?>
        		<?php echo $form->error( $model, 'gtw_account' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'gtw_tsys_bin'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'gtw_tsys_bin',array('size'=>20,'maxlength'=>20)); ?>
        		<?php echo $form->error( $model, 'gtw_tsys_bin' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'gtw_tsys_merchant_num'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'gtw_tsys_merchant_num',array('size'=>20,'maxlength'=>20)); ?>
        		<?php echo $form->error( $model, 'gtw_tsys_merchant_num' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'gtw_tsys_store_num'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'gtw_tsys_store_num',array('size'=>20,'maxlength'=>20)); ?>
        		<?php echo $form->error( $model, 'gtw_tsys_store_num' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'gtw_tsys_terminal_id'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'gtw_tsys_terminal_id',array('size'=>20,'maxlength'=>20)); ?>
        		<?php echo $form->error( $model, 'gtw_tsys_terminal_id' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'gtw_tsys_terminal_num'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'gtw_tsys_terminal_num',array('size'=>20,'maxlength'=>20)); ?>
        		<?php echo $form->error( $model, 'gtw_tsys_terminal_num' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'gtw_tsys_merchant_cat_code'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'gtw_tsys_merchant_cat_code',array('size'=>20,'maxlength'=>20)); ?>
        		<?php echo $form->error( $model, 'gtw_tsys_merchant_cat_code' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'gtw_tsys_location_code'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'gtw_tsys_location_code',array('size'=>20,'maxlength'=>20)); ?>
        		<?php echo $form->error( $model, 'gtw_tsys_location_code' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'gtw_cnet_merchant_num'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'gtw_cnet_merchant_num',array('size'=>20,'maxlength'=>20)); ?>
        		<?php echo $form->error( $model, 'gtw_cnet_merchant_num' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'gtw_cnet_terminal_id'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'gtw_cnet_terminal_id',array('size'=>20,'maxlength'=>20)); ?>
        		<?php echo $form->error( $model, 'gtw_cnet_terminal_id' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'gtw_cnet_merchant_cat_code'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'gtw_cnet_merchant_cat_code',array('size'=>20,'maxlength'=>20)); ?>
        		<?php echo $form->error( $model, 'gtw_cnet_merchant_cat_code' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'gtw_chase_tdn'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'gtw_chase_tdn',array('size'=>20,'maxlength'=>20)); ?>
        		<?php echo $form->error( $model, 'gtw_chase_tdn' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'gtw_chase_currency'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'gtw_chase_currency',array('size'=>20,'maxlength'=>20)); ?>
        		<?php echo $form->error( $model, 'gtw_chase_currency' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'gtw_mes_profile_id'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'gtw_mes_profile_id',array('size'=>20,'maxlength'=>20)); ?>
        		<?php echo $form->error( $model, 'gtw_mes_profile_id' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'gtw_mes_merchant_key'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'gtw_mes_merchant_key',array('size'=>60,'maxlength'=>400)); ?>
        		<?php echo $form->error( $model, 'gtw_mes_merchant_key' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'payment_method'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'payment_method'); ?>
        		<?php echo $form->error( $model, 'payment_method' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'f_status'); ?>
            <div class="formRight">
        		<?php echo $form->checkBox($model,'f_status',array('id'=>'ch_status', 'class'=>'styled')); ?>
        		<?php echo $form->error( $model, 'f_status' ); ?>
                <label for="ch_status">active</label>
            </div>
            <div class="clear"></div>
        </div>

        <?php if($this->getAction()->getId() === 'update'): ?>
        <div class="formRow">
    		<?php echo $form->labelEx($model,'f_deleted'); ?>
            <div class="formRight">
        		<?php echo $form->checkBox($model,'f_deleted',array('class'=>'styled')); ?>
        		<?php echo $form->error( $model, 'f_deleted' ); ?>
            </div>
            <div class="clear"></div>
        </div>
        <?php endif; ?>

<?php /*
        <div class="formRow">
    		<?php echo $form->labelEx($model,'deleted_id'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'deleted_id',array('size'=>11,'maxlength'=>11)); ?>
        		<?php echo $form->error( $model, 'deleted_id' ); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'deleted_dt'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'deleted_dt'); ?>
        		<?php echo $form->error( $model, 'deleted_dt' ); ?>
            </div>
            <div class="clear"></div>
        </div>
*/ ?>

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
    </div> */ ?>
    
    <div class="button-box mt20">
        <?php echo CHtml::submitButton( $model->isNewRecord ? 'Create' : 'Save', array('name'=>'save', 'class'=>'saveBtn')); ?>
        <?php echo CHtml::link( 'Back to List', array('index'), array('class'=>'backBtn')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>
