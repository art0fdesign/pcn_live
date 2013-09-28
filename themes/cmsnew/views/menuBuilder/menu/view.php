

    <div class="titleBlock">
        <span><?php echo $model->name ?> Menu Data</span>
        <span class="blockMenu">
    <?php echo CHtml::link('Asign',array('/webAssign/create', 'type'=>'M','con_id'=>$model->id)); ?></span>
    </div>

<?php echo $this->renderPartial('_view', array('model'=>$model)); ?>

