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
    <fieldset>
        <div class="widget">

            <div class="title1"><h6>Post Data</h6></div>

            <div class="formRow mt30">
                <?php echo $form->labelEx($model, 'id'); ?>
                <div class="formRight"><?php echo $form->textField($model,'id',$disabled); ?></div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model, 'blog_date'); ?>
                <div class="formRight"><?php echo $form->textField($model,'blog_date',$disabled); ?></div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model, 'blog_name'); ?>
                <div class="formRight"><?php echo $form->textField($model,'blog_name',$disabled); ?></div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model, 'blog_author'); ?>
                <div class="formRight"><?php echo $form->textField($model,'blog_author',$disabled); ?></div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model, 'order_by'); ?>
                <div class="formRight"><input type="text" value="<?php echo CHtml::encode($model->order_by); ?>" disabled="disabled"/></div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model, 'lang_id'); ?>
                <div class="formRight"><input type="text" value="<?php echo CHtml::encode($model->getLangText()); ?>" disabled="disabled"/></div>
                <div class="clear"></div>
            </div>

            <div class="formRow mb20">
                <?php echo $form->labelEx($model, 'f_status'); ?>
                <div class="formRight"><?php echo $form->checkBox($model,'f_status',CMap::mergeArray($disabled,array('id'=>'ch3','class'=>'styled'))); ?>
                    <label for="ch3">active</label></div>
                <div class="clear"></div>
            </div>



        </div>
    </fieldset>

    <div class="clear"></div>


    <div class="widget">
        <div class="title"><h6><?php echo $form->labelEx($model, 'blog_content'); ?></h6></div>
        <fieldset>
                <?php echo $form->textArea($model,'blog_content',CMap::mergeArray($disabled,array('style'=>'width:468px;height:150px;'))); ?>

                <?php /*<div align="center"><?php echo $form->textArea($model,'issue_text',CMap::mergeArray($disabled,array('style'=>'height:300px;'))); ?></div> */?>
                <?php //echo CHtml::tag('p', $disabled); echo $model->blog_content; echo CHtml::closeTag('p') ?>
                <div class="clear"></div>
        </fieldset>
    </div>


<?php  if($model->getNumOfComments())
    echo
    '<div class="titleBlock" style="width:485px;margin-left: 0px;">
        <span><h6>Comments</h6></span>
    </div>'; ?>


    <div class="clear"></div>


    <?php  foreach($comments as $comment) : ?>

    <div class="widget">
        <!--<fieldset>-->
            <div class="title1"></div>

            <div class="formRow mt30">
                <?php echo CHtml::label('Username', '', array()); ?>
                <div class="formRight"><?php echo CHtml::textField('', $comment->creator->user_name,$disabled); ?></div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($comment, 'created_dt'); ?>
                <div class="formRight"><?php echo $form->textField($comment,'created_dt',$disabled); ?></div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($comment, 'f_status'); ?>
                <div class="formRight"><?php echo $form->checkBox($comment,'f_status',CMap::mergeArray($disabled,array('id'=>'ch3','class'=>'styled'))); ?></div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($comment, 'comment_content')?>
                <div class="formRight"><?php echo $form->textArea($comment,'comment_content', $disabled); ?></div>
                <div class="clear"></div>
            </div>
            <!--<div style="float:right;margin-right: 10px">
                <?php //echo CHtml::link('Delete',"", array("submit"=>array('deleteComment', 'id'=>$model->id, 'commentId'=>$comment->id), 'confirm' => 'Are you sure?', 'title'=>'Delete Comment', 'class'=>'backBtn')); ?>
                <?php //echo CHtml::link($comment->getRightTextForStatus(),"", array("submit"=>array('activateComment', 'id'=>$comment->id, 'blog'=>$model->id), 'title'=>'Active/Inactive', 'class'=>'backBtn')); ?>
            </div>-->

    </div>
    <?php endforeach; ?>

</div>

<div class="rightContent">

    <div class="rightWidget widget">
        <div class="title"><h6>Blog Image</h6></div>
        <div class="formRow mt30"></div>
        <div align="center" style="width:202px; height:157px; border: 1px solid #CDCDCD; margin:0 auto;">
            <img alt="img1" src="<?php echo $model->loadBlogImage(); ?>">
        </div><br />

        <div align="center"><?php echo $form->labelEx($model, 'blog_image'); ?></div>
        <div align="center"><input type="text" value="<?php echo CHtml::encode($model->blog_image); ?>" disabled="disabled"/></div>
        <div class="clear"></div>
        <!--<div class="formRow mt20"></div>--><br />

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
        <?php //echo CHtml::link('Add Comment',array('createComment', 'id'=>$model->id), array('class'=>'saveBtn')); ?>
    </div>


</div>
<?php $this->endWidget(); ?>

