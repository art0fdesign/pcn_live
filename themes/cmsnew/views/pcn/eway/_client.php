<ul>
	<li><?php echo CHtml::encode($item->first_name . ' ' . $item->surname); ?></li>
	<li><?php echo CHtml::encode($item->postcode . ' ' . $item->street_address); ?></li>
	<?php if (!empty($item->state)): ?>
	<li><?php echo CHtml::encode($item->suburb . ', ' . $item->state); ?></li>
	<?php else: ?>
	<li><?php echo CHtml::encode($item->suburb); ?></li>
	<?php endif; ?>
	<li><?php echo CHtml::encode($item->email); ?></li>
	<?php if (!empty($item->telephone)): ?>
	<li><?php echo CHtml::encode('phone: ' . $item->telephone); ?></li>
	<?php endif; ?>
	<?php if (!empty($item->mobile)): ?>
	<li><?php echo CHtml::encode('mobile: ' . $item->mobile); ?></li>
	<?php endif; ?>
</ul>