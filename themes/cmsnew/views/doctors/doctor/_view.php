<?php

// Sys Info Panel date format
$dtFormat = $this->getCMSSetting( 'sysinfo_dt_format', 'Y-m-d H:i' );
// array to disable input fields... if there MUST be inputs???
 
$readOnly = array('readonly'=>'readonly');
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'doctor-form',
    'htmlOptions'=>array('class'=>'form'),
	'enableAjaxValidation'=>false,
)); ?>
<div class="middleContent">
    <fieldset>
        <div class="widget">
        
            <div class="title1"><h6>Doctor Data</h6></div>
    
        
            <div class="formRow mt30">
                <?php echo $form->labelEx($model,'id'); ?>
                <div class="formRight">
                    <?php echo $form->textField( $model, 'id', $readOnly ); ?>
                </div>            
                <div class="clear"></div>
            </div>
    
        
            <div class="formRow">
                <?php echo $form->labelEx($model,'doc_type'); ?>
                <div class="formRight">
                    <?php echo CHtml::textField( 'doc_type', $model->category->cat_name, $readOnly ); ?>
                </div>            
                <div class="clear"></div>
            </div>
    
        
            <div class="formRow">
                <?php echo $form->labelEx($model,'first_name'); ?>
                <div class="formRight">
                    <?php echo $form->textField( $model, 'first_name', $readOnly ); ?>
                </div>            
                <div class="clear"></div>
            </div>
    
        
            <div class="formRow">
                <?php echo $form->labelEx($model,'middle_name'); ?>
                <div class="formRight">
                    <?php echo $form->textField( $model, 'middle_name', $readOnly ); ?>
                </div>            
                <div class="clear"></div>
            </div>
    
        
            <div class="formRow">
                <?php echo $form->labelEx($model,'last_name'); ?>
                <div class="formRight">
                    <?php echo $form->textField( $model, 'last_name', $readOnly ); ?>
                </div>            
                <div class="clear"></div>
            </div>
    
        
            <div class="formRow">
                <?php echo $form->labelEx($model,'email'); ?>
                <div class="formRight">
                    <?php echo $form->textField( $model, 'email', $readOnly ); ?>
                </div>            
                <div class="clear"></div>
            </div>
    
        
            <div class="formRow">
                <?php echo $form->labelEx($model,'md'); ?>
                <div class="formRight">
                    <?php echo CHtml::textField( 'md_select', $model->degree->code, $readOnly ); ?>
                </div>            
                <div class="clear"></div>
            </div>
    
        
            <div class="formRow">
                <?php echo $form->labelEx($model,'phd'); ?>
                <div class="formRight">
                    <?php echo $form->textField( $model, 'phd', $readOnly ); ?>
                </div>            
                <div class="clear"></div>
            </div>
    
        
            <div class="formRow">
                <?php echo $form->labelEx($model,'gender'); ?>
                <div class="formRight">
                    <?php echo CHtml::textField( 'gender', $model->genderText, $readOnly ); ?>
                </div>            
                <div class="clear"></div>
            </div>
    
        
            <div class="formRow">
                <?php echo $form->labelEx($model,'in_practice'); ?>
                <div class="formRight">
                    <?php echo $form->textField( $model, 'in_practice', $readOnly ); ?>
                </div>            
                <div class="clear"></div>
            </div>

        
            <div class="formRow">
                <?php echo $form->labelEx($model,'f_status'); ?>
                <div class="formRight">
                    <?php echo $form->checkBox($model, 'f_status', CMap::mergeArray($readOnly, array('id'=>'ch_status', 'class'=>'styled'))); ?>
                </div>            
                <div class="clear"></div>
            </div>

        
            <div class="formRow">
                <?php echo $form->labelEx($model,'f_board'); ?>
                <div class="formRight">
                    <?php echo $form->checkBox($model, 'f_board', CMap::mergeArray($readOnly, array('id'=>'ch_board', 'class'=>'styled'))); ?>
                </div>            
                <div class="clear"></div>
            </div>
    
        
            <div class="formRow">
                <?php echo $form->labelEx($model,'board_year'); ?>
                <div class="formRight">
                    <?php echo $form->textField( $model, 'board_year', $readOnly ); ?>
                </div>            
                <div class="clear"></div>
            </div>

        
            <div class="formRow">
                <?php echo $form->labelEx($model,'f_verified'); ?>
                <div class="formRight">
                    <?php echo $form->checkBox($model, 'f_verified', CMap::mergeArray($readOnly, array('id'=>'ch_verified', 'class'=>'styled'))); ?>
                </div>            
                <div class="clear"></div>
            </div>
    
        </div>
        <div class="widget">
        
            <div class="title1"><h6>Social Data</h6></div>
    
            <div class="formRow mt30">
                <?php echo $form->labelEx($model,'soc_twitter'); ?>
                <div class="formRight">
                    <?php echo $form->textField( $model, 'soc_twitter', $readOnly ); ?>
                </div>            
                <div class="clear"></div>
            </div>
    
        
            <div class="formRow">
                <?php echo $form->labelEx($model,'soc_facebook'); ?>
                <div class="formRight">
                    <?php echo $form->textField( $model, 'soc_facebook', $readOnly ); ?>
                </div>            
                <div class="clear"></div>
            </div>
    
        
            <div class="formRow">
                <?php echo $form->labelEx($model,'soc_linkedin'); ?>
                <div class="formRight">
                    <?php echo $form->textField( $model, 'soc_linkedin', $readOnly ); ?>
                </div>            
                <div class="clear"></div>
            </div>
    
        
            <div class="formRow">
                <?php echo $form->labelEx($model,'soc_google'); ?>
                <div class="formRight">
                    <?php echo $form->textField( $model, 'soc_google', $readOnly ); ?>
                </div>            
                <div class="clear"></div>
            </div>

        </div>

        <div class="widget">
        
            <div class="title"><h6>Description</h6></div>
      		
              <?php echo $form->textArea($model,'description', CMap::mergeArray($readOnly,array('style'=>'width:472px;height:150px;'))); ?>
    
        </div>
    </fieldset>
</div>

<!-- INFO PANEL -->
<div class="rightContent">
    
    <div class="rightWidget widget">
        <div class="title"><h6>Image</h6></div>
        
        <div class="bgr_picframe"><img src="<?php echo $model->getThumbSrc('desk'); ?>" /></div>
        
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
        
        <div class="formRow">
            <b>Modified: </b>
            <span><?php echo date( $dtFormat, strtotime( @$model->changed_dt ) ); ?></span>
        </div>
        
        <div class="formRow">
            <b>Verified by: </b>
            <span><?php echo @$model->verified->first_name.' '.@$model->verified->last_name; ?></span>
        </div>
        
        <div class="formRow mb20">
            <b>Verified: </b>
            <span><?php echo date( $dtFormat, strtotime( @$model->verified_dt ) ); ?></span>
        </div>
    </div>
    
    <div class="button-box mt20">
        <?php echo CHtml::link( 'Edit', array('update', 'id'=>$model->id), array('class'=>'saveBtn')); ?>
        <?php echo CHtml::link( 'Back to List', array('index'), array('class'=>'backBtn')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>
