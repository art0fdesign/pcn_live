<?php $this->layout = '//layouts/wrapper'; ?>

<div class="titleBlock">
    <span>Update <?php echo $model->cat_name ?></span>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>