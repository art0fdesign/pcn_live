<?php $this->layout = '//layouts/wrapper'; ?>

    <div class="titleBlock">
        <span>Edit Menu: <?php echo $model->name; ?></span>
    </div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php //echo CHtml::link('Back to list',array('list'), array('class'=>'btn floatR')); ?>

