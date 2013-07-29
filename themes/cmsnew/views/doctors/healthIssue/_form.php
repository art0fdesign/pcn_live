<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'health-issue-form',
    'enableAjaxValidation'=>true,
    'htmlOptions'=>array('class'=>'form'),
)); ?>


    <div class="middleContent">
        <div class="widget">

            <div class="title1"><h6>Health Issue Data</h6></div>
            <fieldset>

            <div class="formRow">
                <?php echo $form->errorSummary($model); ?>
            </div>


            <div class="formRow mt30">
                <?php echo $form->labelEx($model,'issue_name'); ?>
                <div class="formRight"><?php echo $form->textField($model,'issue_name',array('size'=>50,'maxlength'=>50)); ?></div>
                <?php echo $form->error($model,'issue_name'); ?>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model,'cat_id'); ?>
                <div class="formRight"><div class="select-list"><?php echo $form->dropDownList($model,'cat_id', $model->getCategoryOptions(), array('empty'=>'No Category Selected')); ?></div></div>
                <?php echo $form->error($model,'cat_id'); ?>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model,'order_by'); ?>
                <div class="formRight"><?php echo $form->textField($model,'order_by',array('size'=>60,'maxlength'=>255)); ?></div>
                <?php echo $form->error($model,'order_by'); ?>
                <div class="clear"></div>
            </div>

            <div class="formRow mb20">
                <?php echo $form->labelEx($model, 'f_status'); ?>
                <div class="formRight"><?php echo $form->checkBox($model,'f_status', array('id'=>'ch3', 'class'=>'styled')); ?>
                    <label for="ch3">active</label></div>
                <div class="clear"></div>
            </div>

            </fieldset>
        </div>



            <fieldset>
                <div class="widget">
                    <div class="formRight"><?php echo $form->textArea($model,'issue_text',array('class'=>'textEditor')); ?></div>
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
                <span><?=@$model->creator->first_name.' '.@$model->creator->last_name; ?></span>
            </div>
            <div class="formRow">
                <b>Created: </b>
                <span><?= $model->created_dt; ?></span>
            </div>
            <div class="formRow">
                <b>Modified by: </b>
                <span><?= @$model->editor->first_name.' '.@$model->editor->last_name; ?></span>
            </div>
            <div class="formRow mb20">
                <b>Modified: </b>
                <span><?= $model->changed_dt; ?></span>
            </div>
        </div>
        <div class="button-box mt20">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('name'=>'save', 'class'=>'saveBtn')); ?>
            <?php echo CHtml::link('or back to list',array('index'), array('class'=>'backBtn')); ?>
        </div>
    </div>


<?php $this->endWidget(); ?>