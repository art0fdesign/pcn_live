<div class="titleBlock">
    <span>BLOG: Update Post - <?php echo $model->blog_name ?></span>
</div>

<?php echo $this->renderPartial('_update', array('model'=>$model, 'comments'=>$comments)); ?>