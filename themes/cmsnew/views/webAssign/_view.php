<?php
// array to disable input fields... if there MUST be inputs???
$disabled = array('disabled'=>'disabled');

$form=$this->beginWidget('CActiveForm', array(
    'id'=>'web-assign-form',
    'htmlOptions'=>array('class'=>'form'),
    'enableAjaxValidation'=>true,
));
?>
<div class="middleContent">
    <fieldset>
        <div class="widget">

            <div class="title1"><h6>Assignment Data</h6></div>

            <?php
                if($model->assign_type == 'P')
                    $item = 'Page';
                else
                    $item = 'Template';
            ?>

            <div class="formRow mt30">
                <?php echo $form->labelEx($model, 'assign_type'); ?>
                <div class="formRight"><?php echo CHtml::textField('page_id',$item,$disabled); ?></div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model, 'page_temp_id'); ?>
                <div class="formRight"><?php echo CHtml::textField('page_temp_id',WebAssign::model()->getPageTempName($model->assign_type,$model->page_temp_id),$disabled); ?></div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model, 'sector_id'); ?>
                <div class="formRight"><?php echo CHtml::textField('sector_id',$model->sector->name,$disabled); ?></div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model, 'content_type'); ?>
                <div class="formRight"><?php echo CHtml::textField('content_type',WebAssign::model()->getTypeText($model->content_type),$disabled); ?></div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model, 'content_id'); ?>
                <div class="formRight"><?php echo CHtml::textField('content_id',WebAssign::model()->getContentName($model->content_type,$model->content_id),$disabled); ?></div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model, 'content_order'); ?>
                <div class="formRight"><?php echo $form->textField($model,'content_order',$disabled); ?></div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model, 'f_status'); ?>
                <div class="formRight"><?php echo $form->checkBox($model,'f_status',CMap::mergeArray($disabled,array('class'=>'styled'))); ?></div>
                <div class="clear"></div>
            </div>


        </div>
    </fieldset>
</div>
<div class="rightContent">
    <div class="rightWidget widget">
        <div class="title">
            <h6>Page Sectors</h6>
        </div>

        <div style="margin: 40px 0 0 17px;">
            <?php echo CHtml::image( $model->getSectorsImageSrc(), '', array('class'=>'pic') ); ?>
        </div>
        
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
        <?php echo CHtml::link('Edit',array('update', 'id'=>$model->id), array('class'=>'saveBtn')); ?>
        <?php echo CHtml::link('Back to List',array('index'), array('class'=>'backBtn')); ?>
    </div>
</div>


<?php $this->endWidget(); ?>