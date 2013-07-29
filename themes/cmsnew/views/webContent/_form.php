<?php
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'web-content-form',
    'htmlOptions'=>array('class'=>'form'),
    'enableAjaxValidation'=>true,
));
?>
<div class="middleContent">
<fieldset>
    <div class="widget">

        <div class="title1"><h6>Content Data</h6></div>

        <div class="formRow mt30">
            <div class="formRight">
                <?php echo $form->errorSummary($model); ?>
            </div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'name'); ?>
            <div class="formRight"><?php echo $form->textField($model,'name'); ?>
                <?php echo $form->error($model, 'name') ?></div>
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

        <div class="title"><h6>Content Data</h6></div>

        <?php echo $form->textArea($model,'content',array('class'=>'textEditor')); ?>

    </div>
</fieldset>
</div>
<div class="rightContent">
<?php /*
    <div class="rightWidget widget">
        <div class="title">
            <h6>Replacement Tags</h6>
        </div>
        <dl>
            <dt>Tag1</dt>
            <dd>Neki opis</dd>
            
            <dt>Tag1</dt>
            <dd>Neki opis</dd>
        </dl>
    </div>
/**/?>
    <div class="rightWidget widget">
        <div class="title">
            <h6>System info</h6>
        </div>
        <div class="formRow mt30">
            <b>Created by: </b>
            <span><?if( !$model->isNewRecord ) echo @$model->creator->first_name.' '.@$model->creator->last_name; ?></span>
        </div>
        <div class="formRow">
            <b>Created: </b>
            <span><?if( !$model->isNewRecord ) echo $model->created_dt; ?></span>
        </div>
        <div class="formRow">
            <b>Modified by: </b>
            <span><?if( !$model->isNewRecord ) echo @$model->editor->first_name.' '.@$model->editor->last_name; ?></span>
        </div>
        <div class="formRow mb20">
            <b>Modified: </b>
            <span><?if( !$model->isNewRecord ) echo $model->changed_dt; ?></span>
        </div>
    </div>
    <div class="button-box mt20">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('name'=>'save', 'class'=>'saveBtn')); ?>
        <?php echo CHtml::link('or back to list',array("index"),array('class'=>'backBtn')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>