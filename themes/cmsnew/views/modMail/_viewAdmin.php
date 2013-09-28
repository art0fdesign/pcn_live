<?php

// Sys Info Panel date format
$dtFormat = $this->getCMSSetting( 'sysinfo_dt_format', 'Y-m-d H:i' );
// array to disable input fields... if there MUST be inputs???

$disabled = array('disabled'=>'disabled');
$readOnly = array('readonly'=>'readonly');
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'mod-mail-form',
    'htmlOptions'=>array('class'=>'form'),
    'enableAjaxValidation'=>false,
)); ?>

<div class="middleContent">
    <fieldset>
        <div class="widget">

            <div class="title1"><h6>Main Data</h6></div>


            <div class="formRow mt30">
                <?php echo $form->labelEx($model,'id'); ?>
                <div class="formRight">
                    <?php echo $form->textField( $model, 'id', $readOnly ); ?>
                </div>
                <div class="clear"></div>
            </div>


            <div class="formRow">
                <?php echo $form->labelEx($model,'mail_ident'); ?>
                <div class="formRight">
                    <?php echo $form->textField( $model, 'mail_ident', $readOnly ); ?>
                </div>
                <div class="clear"></div>
            </div>


            <div class="formRow">
                <?php echo $form->labelEx($model,'from_mail'); ?>
                <div class="formRight">
                    <?php echo $form->textField( $model, 'from_mail', $readOnly ); ?>
                </div>
                <div class="clear"></div>
            </div>


            <div class="formRow">
                <?php echo $form->labelEx($model,'from_name'); ?>
                <div class="formRight">
                    <?php echo $form->textField( $model, 'from_name', $readOnly ); ?>
                </div>
                <div class="clear"></div>
            </div>


            <div class="formRow">
                <?php echo $form->labelEx($model,'user_subject'); ?>
                <div class="formRight">
                    <?php echo $form->textField( $model, 'user_subject', $readOnly ); ?>
                </div>
                <div class="clear"></div>
            </div>


            <div class="formRow">
                <?php echo $form->labelEx($model,'user_html'); ?>
                <div class="formRight">
                    <?php echo $form->textArea( $model, 'user_html', $readOnly ); ?>
                </div>
                <div class="clear"></div>
            </div>


            <div class="formRow">
                <?php echo $form->labelEx($model,'description'); ?>
                <div class="formRight">
                    <?php echo $form->textArea( $model, 'description', $readOnly ); ?>
                </div>
                <div class="clear"></div>
            </div>


            <div class="formRow mb20">
                <?php echo $form->labelEx($model,'f_status'); ?>
                <div class="formRight">
                    <?php echo $form->checkBox($model, 'f_status', CMap::mergeArray($disabled, array('id'=>'ch_status', 'class'=>'styled'))); ?>
                    <label for="ch_status">active</label>
                </div>
                <div class="clear"></div>
            </div>


        </div>

        <div class="widget">

            <div class="title1"><h6>Admin Mail Data</h6></div>


            <div class="formRow mt30">
                <?php echo $form->labelEx($model,'f_send_to_admin'); ?>
                <div class="formRight">
                    <?php echo $form->checkBox($model, 'f_send_to_admin', CMap::mergeArray($disabled, array('id'=>'admin_send', 'class'=>'styled'))); ?>
                    <label for="admin_send">active</label>
                </div>
                <div class="clear"></div>
            </div>


            <div class="formRow">
                <?php echo $form->labelEx($model,'admin_mail'); ?>
                <div class="formRight">
                    <?php echo $form->textField( $model, 'admin_mail', $readOnly ); ?>
                </div>
                <div class="clear"></div>
            </div>


            <div class="formRow">
                <?php echo $form->labelEx($model,'admin_subject'); ?>
                <div class="formRight">
                    <?php echo $form->textField( $model, 'admin_subject', $readOnly ); ?>
                </div>
                <div class="clear"></div>
            </div>


            <div class="formRow">
                <?php echo $form->labelEx($model,'admin_html'); ?>
                <div class="formRight">
                    <?php echo $form->textArea( $model, 'admin_html', $readOnly ); ?>
                </div>
                <div class="clear"></div>
            </div>
            
        </div>
    </fieldset>
</div>

<!-- INFO PANEL -->
<div class="rightContent">

<?php echo $this->renderPartial('_tags', array('tags'=>$tags)); ?>
    
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
        <?php echo CHtml::link( 'Edit', array('updateAdmin', 'id'=>$model->id), array('class'=>'saveBtn')); ?>
        <?php echo CHtml::link( 'Back to List', array('index', 'mod_id'=>$model->mod_id), array('class'=>'backBtn')); ?>
    </div>
</div>
<?php /**/?>

<?php $this->endWidget(); ?>

