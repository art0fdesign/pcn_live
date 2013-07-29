<?php
$this->breadcrumbs=array(
	'Blog Comments',
);

$this->menu=array(
	array('label'=>'Create BlogComment', 'url'=>array('create')),
	array('label'=>'Manage BlogComment', 'url'=>array('admin')),
);
?>

<h1>Blog Comments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
