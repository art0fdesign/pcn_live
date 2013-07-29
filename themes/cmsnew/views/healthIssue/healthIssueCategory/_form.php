<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'issue-form',
    'enableAjaxValidation'=>true,
    'htmlOptions'=>array('class'=>'form'),
)); ?>


<div class="middleContent">

        <div class="widget">

            <div class="title1"><h6>Category Data</h6></div>
            <fieldset>
                <div class="formRow">
                    <div class="formRight">
                        <?php echo $form->errorSummary($model); ?>
                    </div>
                </div>


                <div class="formRow mt30">
                    <?php echo $form->labelEx($model,'cat_name'); ?>
                    <div class="formRight"><?php echo $form->textField($model,'cat_name',array('size'=>50,'maxlength'=>50)); ?></div>
                    <?php echo $form->error($model,'cat_name'); ?>
                    <div class="clear"></div>
                </div>
            </fieldset>
        </div>

</div>

    <div class="rightContent">
        <div class="rightWidget widget">
            <div class="title">
                <h6>System info</h6>
            </div>
            <div class="formRow mt30">
                <b>Created by: </b>
                <span><?= @$model->created_id ?></span>
            </div>
            <div class="formRow">
                <b>Created: </b>
                <span><?= $model->created_dt; ?></span>
            </div>
            <div class="formRow">
                <b>Modified by: </b>
                <span><?= @$model->changed_id ?></span>
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