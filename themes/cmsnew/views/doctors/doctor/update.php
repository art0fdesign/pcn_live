<div class="titleBlock">
    <span>DOCTORS: Update Doctor - <?php echo $model->fullName; ?></span>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model,'categories'=>$categories)); ?>