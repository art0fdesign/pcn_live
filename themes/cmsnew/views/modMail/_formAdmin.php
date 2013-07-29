<?php
// Sys Info Panel date format
$dtFormat = $this->getCMSSetting( 'sysinfo_dt_format', 'Y-m-d H:i' );
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'mod-mail-form',
    'htmlOptions'=>array('class'=>'form'),
    'enableAjaxValidation'=>true,
)); ?>
<div class="middleContent">
    <fieldset>
        <div class="widget">

            <div class="title1"><h6>Main Data</h6></div>

            <div class="formRow mt30">
                <div class="formRight">
                    <?php echo $form->errorSummary($model); ?>
                </div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model,'mod_id'); ?>
                <div class="formRight">
                    <?php echo CHtml::textField( 'mod_id', $model->module->mod_name, array('readonly'=>'readonly') ); ?>
                    <?php echo $form->error( $model, 'mod_id' ); ?>
                </div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model,'mail_ident'); ?>
                <div class="formRight">
                    <?php echo $form->textField($model,'mail_ident',array('size'=>60,'maxlength'=>100)); ?>
                    <?php echo $form->error( $model, 'mail_ident' ); ?>
                </div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model,'from_mail'); ?>
                <div class="formRight">
                    <?php echo $form->textField($model,'from_mail',array('size'=>60,'maxlength'=>100)); ?>
                    <?php echo $form->error( $model, 'from_mail' ); ?>
                </div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model,'from_name'); ?>
                <div class="formRight">
                    <?php echo $form->textField($model,'from_name',array('size'=>50,'maxlength'=>100)); ?>
                    <?php echo $form->error( $model, 'from_name' ); ?>
                </div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model,'user_subject'); ?>
                <div class="formRight">
                    <?php echo $form->textField($model,'user_subject',array('size'=>50,'maxlength'=>100)); ?>
                    <?php echo $form->error( $model, 'user_subject' ); ?>
                </div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model,'description'); ?>
                <div class="formRight">
                    <?php echo $form->textArea($model,'description',array('size'=>60,'maxlength'=>500)); ?>
                    <?php echo $form->error( $model, 'description' ); ?>
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

    <fieldset>
        <div class="widget">
            <div class="title"><h6>User Html</h6></div>
            <?php echo $form->textArea($model,'user_html',array('style'=>'width:468px;height:150px;', 'class'=>'textEditor')); ?>
        </div>
    </fieldset>

    <fieldset>
        <div class="widget">

            <div class="title1"><h6>Admin Data</h6></div>

            <div class="formRow mt30">
                <?php echo $form->labelEx($model,'f_send_to_admin'); ?>
                <div class="formRight">
                    <?php echo $form->checkBox($model,'f_send_to_admin', array('id'=>'ch_admin', 'class'=>'styled')); ?>
                    <?php echo $form->error( $model, 'f_send_to_admin' ); ?>
                    <label for="ch_admin">active</label>
                </div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model,'admin_mail'); ?>
                <div class="formRight">
                    <?php echo $form->textField($model,'admin_mail',array('size'=>50,'maxlength'=>100)); ?>
                    <?php echo $form->error( $model, 'admin_mail' ); ?>
                </div>
                <div class="clear"></div>
            </div>

            <div class="formRow mb20">
                <?php echo $form->labelEx($model,'admin_subject'); ?>
                <div class="formRight">
                    <?php echo $form->textField($model,'admin_subject',array('size'=>50,'maxlength'=>100)); ?>
                    <?php echo $form->error( $model, 'admin_subject' ); ?>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <div class="widget">
            <div class="title"><h6>Admin Html</h6></div>
            <?php echo $form->textArea($model,'admin_html',array('style'=>'width:468px;height:150px;', 'class'=>'textEditor')); ?>
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
        <?php echo CHtml::link( 'Back to List', array('index', 'mod_id'=>$model->mod_id), array('class'=>'backBtn')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>
