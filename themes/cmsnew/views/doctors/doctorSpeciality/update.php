<div class="titleBlock">
    <span>SPECIALITIES: Update Speciality - <?php echo $model->spec_name; ?></span>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'categories'=>$categories)); ?>