<?php if (isset($items) && is_array($items)): ?>
	<ul>
	<?php foreach ($items as $item): ?>
		<?php if (empty($item['description'])): ?>
		<li><?php echo (int)$item['quantity'] . ' x ' . $item['name'] . ' (' . $item['price'] . ')'; ?></li>
		<?php else: ?>
		<li class="invoiceDetails">
			<?php echo (int)$item['quantity'] . ' x ' . $item['name'] . ' (' . $item['price'] . ')'; ?>
			<?php
				if ( ! empty($item['description'])) {
					$model = SimpleCartItem::model()->findByPk((int)$item['id']);
					if ($model) {
						echo $model->description();
						// MyFunctions::echoArray($item, $model, $model->description());
					}
				}
			?>
		</li>
		<?php endif; ?>
	<?php endforeach; ?>
	</ul>
<?php endif; ?>