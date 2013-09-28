<?php $this->layout = '//layouts/wrapper'; ?>

<div class="titleBlock">
    <span><?php echo $model->cat_name ?></span>
</div>

<?php echo $this->renderPartial('_view', array('model'=>$model)); ?>
