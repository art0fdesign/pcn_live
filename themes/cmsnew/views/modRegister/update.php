<?php
/**
 * Created by Lemmy.
 * Date: 11/13/12
 * Time: 2:17 PM
 */?>
<?php
$title = '';
if($model->f_type == 'M') $title = 'Module';
else $title = 'Widget';
?>
<div class="titleBlock">
    <span>MODULES & WIDGETS : Update <?php echo $title; ?> - <?php echo $model->mod_name; ?></span>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>