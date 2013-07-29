<?php
/**
 * Created by Lemmy.
 * Date: 11/14/12
 * Time: 2:54 PM
 */?>
<?php

// Sys Info Panel date format
$dtFormat = $this->getCMSSetting( 'sysinfo_dt_format', 'Y-m-d H:i' );
// array to disable input fields... if there MUST be inputs???
$disabled = array('disabled'=>'disabled');
$readOnly = array('readonly'=>'readonly');
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'mod-setting-form',
    'htmlOptions'=>array('class'=>'form'),
    'enableAjaxValidation'=>false,
)); ?>
<div class="middleContent">
    <fieldset>
        <div class="widget">

            <div class="title1"><h6>Setting Data</h6></div>


            <div class="formRow mt30">
                <?php echo $form->labelEx($model,'id'); ?>
                <div class="formRight">
                    <?php echo $form->textField( $model, 'id', $readOnly ); ?>
                </div>
                <div class="clear"></div>
            </div>


            <div class="formRow">
                <?php echo $form->labelEx($model,'mod_id'); ?>
                <div class="formRight">
                    <?php echo Chtml::textField('mod_id', $model->getModIdOptions($model->mod_id), $readOnly); ?>
                </div>
                <div class="clear"></div>
            </div>

            <?php if(get_class($widget) === 'ModView'):?>
            <div class="formRow">
                <?php echo $form->labelEx($model,'view_id'); ?>
                <div class="formRight">
                    <?php echo CHtml::textField( 'view_id',$model->getWidgetName($model->view_id), $readOnly ); ?>
                </div>
                <div class="clear"></div>
            </div>
            <?php endif; ?>

            <div class="formRow">
                <?php echo $form->labelEx($model,'set_name'); ?>
                <div class="formRight">
                    <?php echo $form->textField( $model, 'set_name', $readOnly ); ?>
                </div>
                <div class="clear"></div>
            </div>


            <div class="formRow">
                <?php echo $form->labelEx($model,'set_key'); ?>
                <div class="formRight">
                    <?php echo $form->textField( $model, 'set_key', $readOnly ); ?>
                </div>
                <div class="clear"></div>
            </div>


 <?php /*   <div class="formRow">
                <?php echo $form->labelEx($model,'set_value'); ?>
                <div class="formRight">
                    <?php echo $form->textArea( $model, 'set_value', $readOnly ); ?>
                </div>
                <div class="clear"></div>
            </div>


            <div class="formRow">
                <?php echo $form->labelEx($model,'set_default'); ?>
                <div class="formRight">
                    <?php echo $form->textArea( $model, 'set_default', $readOnly ); ?>
                </div>
                <div class="clear"></div>
            </div>  */ ?>


            <div class="formRow">
                <?php echo $form->labelEx($model,'set_type'); ?>
                <div class="formRight">
                    <?php echo Chtml::textField('set_type', $model->typeText, $readOnly); ?>
                </div>
                <div class="clear"></div>
            </div>


            <div class="formRow">
                <?php echo $form->labelEx($model,'comment'); ?>
                <div class="formRight">
                    <?php echo $form->textArea( $model, 'comment', $readOnly ); ?>
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


            <div class="formRow mb20">
                <?php echo $form->labelEx($model,'f_editable'); ?>
                <div class="formRight">
                    <?php echo $form->checkBox($model, 'f_editable', CMap::mergeArray($disabled, array('id'=>'ch_editable', 'class'=>'styled'))); ?>
                    <label for="ch_editable">yes</label>
                </div>
                <div class="clear"></div>
            </div>

        </div>
    </fieldset>

    <fieldset>
        <div class="widget">
            <div class="title"><h6>Value</h6></div>
            <?php echo $form->textArea($model,'set_value',CMap::mergeArray($readOnly,array('style'=>'width:468px;height:150px;'))); ?>
        </div>
    </fieldset>

    <fieldset>
        <div class="widget">
            <div class="title"><h6>Default Value</h6></div>
            <?php echo $form->textArea($model,'set_default',CMap::mergeArray($readOnly,array('style'=>'width:468px;height:150px;'))); ?>
        </div>
    </fieldset>

</div>

<!-- INFO PANEL -->
<div class="rightContent">
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
        <?php echo CHtml::link( 'Edit', array('updateS', 'id'=>$model->id), array('class'=>'saveBtn')); ?>
        <?php echo CHtml::link( 'Back to List', array('indexSet', 'mod_id'=>$model->mod_id, 'view_id'=>$model->view_id), array('class'=>'backBtn')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>
