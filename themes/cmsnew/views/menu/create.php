<?php $this->layout = '//layouts/wrapper'; ?>

    <div class="titleBlock">
        <span>Add Menu</span>
    </div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php //echo CHtml::link('Back to list',array('list'), array('class'=>'btn floatR')); ?>

