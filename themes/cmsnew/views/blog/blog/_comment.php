<?php
/**
 * Created by Lemmy.
 * Date: 8/8/12
 * Time: 9:25 PM
 */?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'health-issue-form',
    'enableAjaxValidation'=>true,
    'htmlOptions'=>array('class'=>'form'),
)); ?>


<div class="middleContent">

 <div class="widget">

        <div class="title1"><h6>create comment</h6></div>
 </div>






    <div class="widget longWidget">

        <fieldset>
            <?php /*<div class="title1"><h6><?php echo $form->labelEx($model,'description'); ?></h6></div>
                <div class="formRow mt30"></div>*/ ?>
            <div class="formRight"><?php echo $form->textArea($model,'comment_content',array('class'=>'textEditor')); ?></div>
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
            <span><?= $model->created_id ?></span>
        </div>
        <div class="formRow">
            <b>Created: </b>
            <span><?= $model->created_dt; ?></span>
        </div>
        <div class="formRow">
            <b>Modified by: </b>
            <span><?= $model->changed_id ?></span>
        </div>
        <div class="formRow mb20">
            <b>Modified: </b>
            <span><?= $model->changed_dt; ?></span>
        </div>
    </div>
    <div class="button-box mt20">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('name'=>'save', 'class'=>'saveBtn')); ?>
        <?php echo CHtml::link('or back to blog entry',array('view', 'id'=>$model->blog_id), array('class'=>'backBtn')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>