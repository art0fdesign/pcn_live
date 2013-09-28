<div class="titleBlock">
    <span>LISTING ITEMS: Update Item - <?php echo $model->item_title; ?></span>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'categories'=>$categories)); ?>