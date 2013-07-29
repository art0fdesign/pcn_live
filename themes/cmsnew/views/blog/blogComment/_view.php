<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('blog_id')); ?>:</b>
	<?php echo CHtml::encode($data->blog_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment_content')); ?>:</b>
	<?php echo CHtml::encode($data->comment_content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lang_id')); ?>:</b>
	<?php echo CHtml::encode($data->lang_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_by')); ?>:</b>
	<?php echo CHtml::encode($data->order_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('f_status')); ?>:</b>
	<?php echo CHtml::encode($data->f_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('f_deleted')); ?>:</b>
	<?php echo CHtml::encode($data->f_deleted); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('created_dt')); ?>:</b>
	<?php echo CHtml::encode($data->created_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_id')); ?>:</b>
	<?php echo CHtml::encode($data->created_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('changed_dt')); ?>:</b>
	<?php echo CHtml::encode($data->changed_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('changed_id')); ?>:</b>
	<?php echo CHtml::encode($data->changed_id); ?>
	<br />

	*/ ?>

</div>