<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'blog-comment-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'blog_id'); ?>
		<?php echo $form->textField($model,'blog_id',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'blog_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment_content'); ?>
		<?php echo $form->textArea($model,'comment_content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comment_content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lang_id'); ?>
		<?php echo $form->textField($model,'lang_id'); ?>
		<?php echo $form->error($model,'lang_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'order_by'); ?>
		<?php echo $form->textField($model,'order_by'); ?>
		<?php echo $form->error($model,'order_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'f_status'); ?>
		<?php echo $form->textField($model,'f_status'); ?>
		<?php echo $form->error($model,'f_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'f_deleted'); ?>
		<?php echo $form->textField($model,'f_deleted'); ?>
		<?php echo $form->error($model,'f_deleted'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_dt'); ?>
		<?php echo $form->textField($model,'created_dt'); ?>
		<?php echo $form->error($model,'created_dt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_id'); ?>
		<?php echo $form->textField($model,'created_id',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'created_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'changed_dt'); ?>
		<?php echo $form->textField($model,'changed_dt'); ?>
		<?php echo $form->error($model,'changed_dt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'changed_id'); ?>
		<?php echo $form->textField($model,'changed_id',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'changed_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->