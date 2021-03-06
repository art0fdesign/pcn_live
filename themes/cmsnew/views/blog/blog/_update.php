<?php
/**
 * Created by Lemmy.
 * Date: 9/8/12
 * Time: 1:37 AM
 */?>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'blog-form',
    'enableAjaxValidation'=>true,
    'htmlOptions'=>array('class'=>'form'),
)); ?>


<div class="middleContent">

    <div class="widget">

        <div class="title1"><h6>Post Data</h6></div>

        <fieldset>

            <div class="formRow mt30">
                <div class="formRight">
                    <?php echo $form->errorSummary($model); ?>
                </div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model,'blog_date'); ?>
                <div class="formRight"><?php echo $form->textField($model,'blog_date',array('title'=>'Type date in format: yyyy-mm-dd')); ?></div>
                <?php echo $form->error($model,'blog_date'); ?>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model,'blog_name'); ?>
                <div class="formRight"><?php echo $form->textField($model,'blog_name',array()); ?></div>
                <?php echo $form->error($model,'blog_name'); ?>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model,'blog_author'); ?>
                <div class="formRight"><?php echo $form->textField($model,'blog_author',array('size'=>60,'maxlength'=>256)); ?></div>
                <?php echo $form->error($model,'blog_author'); ?>
                <div class="clear"></div>
            </div>

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
        <div class="title"><h6>Blog Text</h6></div>
        <fieldset>
            <?php echo $form->textArea($model,'blog_content',array('class'=>'textEditor')); ?>
        </fieldset>
    </div>

        <?php  if($model->getNumOfComments())
        echo
        '<div class="titleBlock" style="width:485px;margin-left: 0px;">
        <span><h6>Comments</h6></span>
    </div>'; ?>


        <div class="clear"></div>


        <?php  foreach($comments as $i=>$comment) : ?>

            <div class="widget">
                <fieldset>
                <div class="title1"></div>


                <div class="formRow mt30">
                    <?php echo CHtml::label('Username', '', array()); ?>
                    <div class="formRight"><?php echo CHtml::textField('', $comment->creator->user_name,array('disabled'=>'disabled')); ?></div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <?php echo $form->labelEx($comment, 'created_dt'); ?>
                    <div class="formRight"><?php echo $form->textField($comment,'created_dt',array('disabled'=>'disabled')); ?></div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <?php echo $form->labelEx($comment, 'f_status'); ?>
                    <div class="formRight"><?php echo $form->checkBox($comment,"[$i]f_status",array('id'=>'ch3','class'=>'styled')); ?>
                    <label for="ch3">active</label></div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <?php echo $form->labelEx($comment, 'comment_content')?>
                    <div class="formRight"><?php echo $form->textArea($comment,'comment_content', array('disabled'=>'disabled')); ?></div>
                    <div class="clear"></div>
                </div>
                <div style="float:right;margin-right: 10px">
                    <?php echo CHtml::link('Delete',"", array("submit"=>array('deleteComment', 'id'=>$model->id, 'commentId'=>$comment->id), 'confirm' => 'Are you sure?', 'title'=>'Delete Comment', 'class'=>'backBtn')); ?>
                    <?php //echo CHtml::link($comment->getRightTextForStatus(),"", array("submit"=>array('activateComment', 'id'=>$model->id, 'commentId'=>$comment->id), 'title'=>'Active/Inactive', 'class'=>'backBtn')); ?>
                </div>


                    <?php  //CHtml::hiddenField('id', $comment->id, array()) ?>
                </fieldset>
            </div>

        <div class="clear"></div>
        <?php endforeach; ?>

</div>

<div class="rightContent">

    <div class="rightWidget widget">

        <div class="title"><h6>Blog Image</h6></div>
        <div class="formRow mt30"></div>
        <div align="center" style="width:202px; height:157px; border: 1px solid #CDCDCD; margin:0 auto;">
            <img alt="img1" src="<?php echo $model->loadBlogImage(); ?>">
        </div><br />
        <fieldset>
        <div align="center"><?php echo $form->labelEx($model, 'blog_image'); ?></div>
        <div align="center"><?php echo $form->textField($model, 'blog_image', array()); ?></div>
        <div class="clear"></div>
        <!--<div class="formRow mt20"></div>--><br />
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