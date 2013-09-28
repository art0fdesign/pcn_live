<div class="titleBlock">
    <span>LOCATIONS: Update Location - <?php echo $model->facility; ?></span>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'states'=>$states)); ?>