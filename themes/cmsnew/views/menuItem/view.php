<?php $this->layout = '//layouts/wrapper'; ?>
	
    <div class="titleBlock">
        <span><?php echo $model->name ?> Menu Item Data</span>
    </div>

<?php echo $this->renderPartial('_view', array('model'=>$model)); ?>
<?php echo CHtml::link('Back to list',array('list', 'mid'=>$model->menu_id), array('class'=>'btn floatR')); ?>

