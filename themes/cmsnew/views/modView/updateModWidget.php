<?php
/**
 * Created by Lemmy.
 * Date: 11/14/12
 * Time: 12:44 AM
 */?>
<div class="titleBlock">
    <span><?php echo strtoupper($module->mod_name) ?> MODULE: Update Widget - <?php echo $model->view_name; ?></span>
</div>

<?php echo $this->renderPartial('_formModWidget', array('model'=>$model, 'module'=>$module)); ?>