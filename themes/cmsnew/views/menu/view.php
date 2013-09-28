<?php $this->layout = '//layouts/wrapper'; ?>

    <div class="titleBlock">
        <span><?php echo $model->name ?> Menu Data</span>
    </div>

<?php echo $this->renderPartial('_view', array('model'=>$model)); ?>
<?php echo CHtml::link('Back to list',array('list'), array('class'=>'btn floatR')); ?>

