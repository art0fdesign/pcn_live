<?php
// array to disable input fields... if there MUST be inputs???
$disabled = array('disabled'=>'disabled');
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'template-form',
    'htmlOptions'=>array('class'=>'form'),
    'enableAjaxValidation'=>false,
));
?>


<div class="middleContent">

    <div class="widget">


            <div class="title1"><h6>Health Issue Data</h6></div>

        <fieldset>

            <div class="formRow mt30">
                <?php echo $form->labelEx($model, 'id'); ?>
                <div class="formRight"><?php echo $form->textField($model,'id',$disabled); ?></div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model, 'issue_name'); ?>
                <div class="formRight"><?php echo $form->textField($model,'issue_name',$disabled); ?></div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model, 'cat_id'); ?>
                <div class="formRight"><input type="text" value="<?php echo CHtml::encode($model->getCategoryText()); ?>" disabled="disabled"/></div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model, 'order_by'); ?>
                <div class="formRight"><input type="text" value="<?php echo CHtml::encode($model->order_by); ?>" disabled="disabled"/></div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model, 'f_status'); ?>
                <div class="formRight"><?php echo $form->checkBox($model,'f_status',CMap::mergeArray($disabled,array('id'=>'ch3', 'class'=>'styled'))); ?></div>
                <div class="clear"></div>
            </div>

        </fieldset>

    <!--</div>-->

    </div>

    <div class="clear"></div>
    <fieldset>
        <div class="widget longWidget">
            <div class="title1"><h6><?php echo $form->labelEx($model, 'issue_text'); ?></h6></div>
            <div class="formRow mt30">
                <?php /*<div align="center"><?php echo $form->textArea($model,'issue_text',CMap::mergeArray($disabled,array('style'=>'height:300px;'))); ?></div> */?>
                <?php echo CHtml::tag('p', $disabled); echo $model->issue_text; echo CHtml::closeTag('p') ?>
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
        <?php echo CHtml::link('Edit',array('update', 'id'=>$model->id), array('class'=>'saveBtn')); ?>
        <?php echo CHtml::link('Back to List',array('index'), array('class'=>'backBtn')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>
