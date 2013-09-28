<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'blog_id'); ?>
		<?php echo $form->textField($model,'blog_id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comment_content'); ?>
		<?php echo $form->textArea($model,'comment_content',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lang_id'); ?>
		<?php echo $form->textField($model,'lang_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'order_by'); ?>
		<?php echo $form->textField($model,'order_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'f_status'); ?>
		<?php echo $form->textField($model,'f_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'f_deleted'); ?>
		<?php echo $form->textField($model,'f_deleted'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_dt'); ?>
		<?php echo $form->textField($model,'created_dt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_id'); ?>
		<?php echo $form->textField($model,'created_id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'changed_dt'); ?>
		<?php echo $form->textField($model,'changed_dt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'changed_id'); ?>
		<?php echo $form->textField($model,'changed_id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->