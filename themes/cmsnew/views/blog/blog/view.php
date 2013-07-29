<div class="titleBlock">
<span>BLOG: View Post - <?php echo $model->blog_name ?></span>
</div>

<?php echo $this->renderPartial('_view', array(
                        'model'=>$model,
                        'comments'=>$comments,
                    )); ?>