<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'health-issue-form',
    'enableAjaxValidation'=>true,
    'htmlOptions'=>array('class'=>'form'),
)); ?>


<div class="middleContent">

        <div class="widget">

            <div class="title1"><h6>Insurance Data</h6></div>

            <fieldset>

                <div class="formRow mt30">
                    <div class="formRight">
                        <?php echo $form->errorSummary($model); ?>
                    </div>
                </div>

                <div class="formRow">
                    <?php echo $form->labelEx($model,'name'); ?>
                    <div class="formRight"><?php echo $form->textField($model,'name',array()); ?></div>
                    <?php echo $form->error($model,'name'); ?>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <?php echo $form->labelEx($model,'address'); ?>
                    <div class="formRight"><?php echo $form->textfield($model,'address',array()); ?></div>
                    <?php echo $form->error($model,'address'); ?>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <?php echo $form->labelEx($model,'url'); ?>
                    <div class="formRight"><?php echo $form->textField($model,'url',array()); ?></div>
                    <?php echo $form->error($model,'url'); ?>
                    <div class="clear"></div>
                </div>

                <?php /*<div class="formRow">
                    <?php echo $form->labelEx($model,'thumb_url'); ?>
                    <div class="formRight"><?php echo $form->textField($model,'thumb_url',array()); ?></div>
                    <?php echo $form->error($model,'thumb_url'); ?>
                    <div class="clear"></div>
                </div> */?>

                <div class="formRow">
                    <?php echo $form->labelEx($model,'order_by'); ?>
                    <div class="formRight"><?php echo $form->textField($model,'order_by',array('size'=>60,'maxlength'=>255)); ?></div>
                    <?php echo $form->error($model,'order_by'); ?>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <?php echo $form->labelEx($model,'lang_id'); ?>
                    <div class="formRight"><div class="select-list"><?php echo $form->dropDownList($model,'lang_id', $model->getLangOptions(),array()); ?></div></div>
                    <?php echo $form->error($model,'lang_id'); ?>
                    <div class="clear"></div>
                </div>

                <div class="formRow mb20">
                    <?php echo $form->labelEx($model, 'f_status'); ?>
                    <div class="formRight"><?php echo $form->checkBox($model,'f_status', array('id'=>'ch3','class'=>'styled')); ?>
                        <label for="ch3">active</label></div>
                    <div class="clear"></div>
                </div>

            </fieldset>

        </div>




        <div class="widget">

            <fieldset>
                <?php /*<div class="title1"><h6><?php echo $form->labelEx($model,'description'); ?></h6></div>
                <div class="formRow mt30"></div>*/ ?>
                <div class="formRight"><?php echo $form->textArea($model,'description',array('class'=>'textEditor')); ?></div>
            </fieldset>
        </div>

</div>

<div class="rightContent">

    <div class="rightWidget widget">
        <fieldset>
        <div class="title"><h6>Logo</h6></div>
        <div class="formRow mt30"></div>
        <?php // echo CHtml::image($model->loadLogo(), '', array('align=center')); ?>
        <div align="center" style="width:136px; height:72px; border: 1px solid #CDCDCD; margin:0 auto;">
            <img alt="img1" src="<?php echo $model->loadLogo(); ?>">
        </div><br />

        <!--<div class="formRow">-->
        <div align="center"><?php echo $form->labelEx($model, 'thumb_url'); ?></div>
        <div align="center"><?php echo $form->textField($model,'thumb_url',array('empty'=>'URL')); ?></div>
        <div class="clear"></div>
        <!--<div class="formRow mt20"></div>--><br />
        <!--</div>-->
        </fieldset>
    </div>


    <div class="rightWidget widget">
        <div class="title">
            <h6>System info</h6>
        </div>
        <div class="formRow mt30">
            <b>Created by: </b>
            <span><?= @$model->creator->first_name.' '.@$model->creator->last_name; ?></span>
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