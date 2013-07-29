<?php
//$mdOptions = Doctor::getSelectOptions('md');
$mdOptions = CMap::mergeArray( array('0'=>'----'), DoctorDegree::getMdOptions( $model->doc_type ) ); 
$phdOptions = Doctor::getSelectOptions('phd');
//$practiceOptions = Doctor::getSelectOptions('in_practice');
//$specOptions = DoctorSpeciality::getSpecialityGroupedOptions();
//$subSpecOptions = array_merge( array('0'=>'---'), DoctorSubspeciality::getSubSpecialityGroupOptions(0) );
//$states = Doctor::getUSStates();
$genderOptions = array( 'M'=>'Male', 'F'=>'Female' );
// Sys Info Panel date format
$dtFormat = $this->getCMSSetting( 'sysinfo_dt_format', 'Y-m-d H:i' );
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'doctor-form',
    //'htmlOptions'=>array('class'=>'form'),
	'enableAjaxValidation'=>true,
)); ?>
<div class="middleContent">
    <fieldset>
        <div class="widget">
        
            <div class="title1"><h6>Doctor Data</h6></div>
            
            <div class="formRow">
                <div class="formRight">
                    <?php echo $form->errorSummary($model); ?>
                </div>
                <div class="clear"></div>
            </div>
    
            <div class="formRow mt30">
        		<?php echo $form->labelEx($model,'doc_type'); ?>
                <div class="formRight">
            		<?php //echo $form->dropDownList($model,'doc_type',$categories); ?>
                    <?php echo CHtml::textField( 'category', $model->category->cat_name, array('readonly'=>'readonly') ); ?>
            		<?php echo $form->error( $model, 'doc_type' ); ?>
                </div>
                <div class="clear"></div>
            </div>
    
            <div class="formRow">
        		<?php echo $form->labelEx($model,'first_name'); ?>
                <div class="formRight">
            		<?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>100)); ?>
            		<?php echo $form->error( $model, 'first_name' ); ?>
                </div>
                <div class="clear"></div>
            </div>
    
            <div class="formRow">
        		<?php echo $form->labelEx($model,'middle_name'); ?>
                <div class="formRight">
            		<?php echo $form->textField($model,'middle_name',array('size'=>60,'maxlength'=>100)); ?>
            		<?php echo $form->error( $model, 'middle_name' ); ?>
                </div>
                <div class="clear"></div>
            </div>
    
            <div class="formRow">
        		<?php echo $form->labelEx($model,'last_name'); ?>
                <div class="formRight">
            		<?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>100)); ?>
            		<?php echo $form->error( $model, 'last_name' ); ?>
                </div>
                <div class="clear"></div>
            </div>
    
            <div class="formRow">
        		<?php echo $form->labelEx($model,'email'); ?>
                <div class="formRight">
            		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
            		<?php echo $form->error( $model, 'email' ); ?>
                </div>
                <div class="clear"></div>
            </div>
    
            <div class="formRow">
        		<?php echo $form->labelEx($model,'md'); ?>
                <div class="formRight">
            		<?php echo $form->dropDownList($model, 'md', $mdOptions); ?>
            		<?php echo $form->error( $model, 'md' ); ?>
                </div>
                <div class="clear"></div>
            </div>
    
            <div class="formRow">
        		<?php echo $form->labelEx($model,'phd'); ?>
                <div class="formRight">
            		<?php echo $form->dropDownList($model, 'phd', $phdOptions); ?>
            		<?php echo $form->error( $model, 'phd' ); ?>
                </div>
                <div class="clear"></div>
            </div>
    
            <div class="formRow">
        		<?php echo $form->labelEx($model,'gender'); ?>
                <div class="formRight">
            		<?php echo $form->dropDownList($model,'gender',$genderOptions); ?>
            		<?php echo $form->error( $model, 'gender' ); ?>
                </div>
                <div class="clear"></div>
            </div>
    
            <div class="formRow">
        		<?php echo $form->labelEx($model,'in_practice'); ?>
                <div class="formRight">
            		<?php echo $form->textField($model,'in_practice'); ?>
            		<?php echo $form->error( $model, 'in_practice' ); ?>
                </div>
                <div class="clear"></div>
            </div>
    
            <div class="formRow">
                <?php echo $form->labelEx($model, 'f_status', array('for'=>'ch3')); ?>
                <div class="formRight"><?php echo $form->checkBox($model,'f_status', array('id'=>'ch3','class'=>'styled')); ?>
                    <label for="ch3">active</label></div>
                <div class="clear"></div>
            </div>
    
            <div class="formRow">
                <?php echo $form->labelEx($model, 'f_board', array('for'=>'ch_board')); ?>
                <div class="formRight"><?php echo $form->checkBox($model,'f_board', array('id'=>'ch_board','class'=>'styled')); ?>
                    <label for="ch_board">active</label></div>
                <div class="clear"></div>
            </div>
    
            <div class="formRow">
        		<?php echo $form->labelEx($model,'board_year'); ?>
                <div class="formRight">
            		<?php echo $form->textField($model, 'board_year'); ?>
            		<?php echo $form->error( $model, 'board_year' ); ?>
                </div>
                <div class="clear"></div>
            </div>
    
            <div class="formRow">
                <?php echo $form->labelEx($model, 'f_verified', array('for'=>'ch_verified')); ?>
                <div class="formRight"><?php echo $form->checkBox($model,'f_verified', array('id'=>'ch_verified','class'=>'styled')); ?>
                    <label for="ch_verified">active</label></div>
                <div class="clear"></div>
            </div>

        </div>
        <div class="widget">
    
            <div class="title1"><h6>Social Data</h6></div>
    
            <div class="formRow mt30">
        		<?php echo $form->labelEx($model,'soc_twitter'); ?>
                <div class="formRight">
            		<?php echo $form->textField($model,'soc_twitter',array('size'=>60,'maxlength'=>100)); ?>
            		<?php echo $form->error( $model, 'soc_twitter' ); ?>
                </div>
                <div class="clear"></div>
            </div>
    
            <div class="formRow">
        		<?php echo $form->labelEx($model,'soc_facebook'); ?>
                <div class="formRight">
            		<?php echo $form->textField($model,'soc_facebook',array('size'=>60,'maxlength'=>100)); ?>
            		<?php echo $form->error( $model, 'soc_facebook' ); ?>
                </div>
                <div class="clear"></div>
            </div>
    
            <div class="formRow">
        		<?php echo $form->labelEx($model,'soc_linkedin'); ?>
                <div class="formRight">
            		<?php echo $form->textField($model,'soc_linkedin',array('size'=>60,'maxlength'=>100)); ?>
            		<?php echo $form->error( $model, 'soc_linkedin' ); ?>
                </div>
                <div class="clear"></div>
            </div>
    
            <div class="formRow">
        		<?php echo $form->labelEx($model,'soc_google'); ?>
                <div class="formRight">
            		<?php echo $form->textField($model,'soc_google',array('size'=>60,'maxlength'=>100)); ?>
            		<?php echo $form->error( $model, 'soc_google' ); ?>
                </div>
                <div class="clear"></div>
            </div>
            
        </div>
        <div class="widget">
    
            <div class="title"><h6>Description</h6></div>
      		
              <?php echo $form->textArea($model,'description',array('class'=>'textEditor')); ?>
    
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
