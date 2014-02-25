<?php if (isset($items) && is_array($items)): ?>
	<ul>
		<?php foreach ($items as $item): ?>
		<li><?php echo (int)$item['quantity'] . ' x ' . $item['name'] . ' (' . $item['price'] . ')'; ?></li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>