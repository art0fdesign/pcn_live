<div class="titleBlock">
    <span>ACCOMMODATIONS: View Accommodations - <?php echo $model->name; ?></span>
    <span class="blockMenu">
        <?php echo CHtml::link('Gallery', array('accommodationsImage/index', 'id'=>$model->id)); ?>
    </span>
</div>

<?php echo $this->renderPartial('_view', array('model'=>$model)); ?>
