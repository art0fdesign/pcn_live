<div class="titleBlock">
    <span>SUBSPECIALITIES: Update Subspeciality - <?php echo $model->subspec_name; ?></span>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'specialities'=>$specialities)); ?>