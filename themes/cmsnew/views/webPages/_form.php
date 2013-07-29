<?php
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'web-pages-form',
    'htmlOptions'=>array('class'=>'form'),
    'enableAjaxValidation'=>true,
));
?>
<div class="middleContent">
<fieldset>
    <div class="widget">

        <div class="title1"><h6>Page Data</h6></div>





        <div class="formRow mt40">
            <?php echo $form->labelEx($model, 'name'); ?>
            <div class="formRight"><?php echo $form->textField($model,'name'); ?>
                <?php echo $form->error($model, 'name') ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'parent_id'); ?>
            <div class="formRight"><div class="select-list"><?php echo $form->dropDownList($model,'parent_id',array_merge(array("0"=>"no parent"),$model->getPagesOptions())); ?></div>
                <?php echo $form->error($model, 'parent_id') ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'url'); ?>
            <div class="formRight"><?php echo $form->textField($model,'url'); ?>
                <?php echo $form->error($model, 'url') ?></div>
            <div class="clear"></div>
        </div>



        <div class="formRow">
            <?php echo $form->labelEx($model, 'tpl_id'); ?>
            <div class="formRight"><div class="select-list"><?php echo $form->dropDownList($model,'tpl_id',Template::getTemplatesOptions()); ?></div>
                <?php echo $form->error($model, 'tpl_id') ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'lang_id'); ?>
            <div class="formRight"><div class="select-list"><?php echo $form->dropDownList($model,'lang_id',Language::getLanguagesOptions()); ?></div>
                <?php echo $form->error($model, 'lang_id') ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow mb20">
            <?php echo $form->labelEx($model, 'f_status'); ?>
            <div class="formRight"><?php echo $form->checkBox($model,'f_status', array('id'=>'ch3','class'=>'styled')); ?>
                <label for="ch3">active</label></div>
            <div class="clear"></div>
        </div>


    </div>
</fieldset>
<fieldset>
    <div class="widget longWidget">

        <div class="title1"><h6>SEO & ANALYTICS</h6></div>
        <div class="formRow mt30 mb20">
            <?php echo $form->labelEx($model, 'google_code'); ?>
            <div class="formRight"><?php echo $form->checkBox($model,'google_code', array('id'=>'ch4','class'=>'styled')); ?>
                <label for="ch4">include Google Analytics code</label></div>
            <div class="clear"></div>
        </div>
    </div>
</fieldset>
<fieldset>
    <div class="widget longWidget">
        <div class="formRow mt20">
            <?php echo $form->labelEx($model, 'meta_title'); ?>
            <div class="formRight"><?php echo $form->textField($model,'meta_title'); ?>
                <?php echo $form->error($model, 'meta_title') ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'meta_keywords'); ?>
            <div class="formRight"><?php echo $form->textArea($model,'meta_keywords'); ?>
                <?php echo $form->error($model, 'meta_keywords') ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow mb20">
            <?php echo $form->labelEx($model, 'meta_description'); ?>
            <div class="formRight"><?php echo $form->textArea($model,'meta_description'); ?>
                <?php echo $form->error($model, 'meta_description') ?></div>
            <div class="clear"></div>
        </div>

    </div>
</fieldset>
</div>
<div class="rightContent">
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