<?php
/**
 * Created by Lemmy.
 * Date: 11/14/12
 * Time: 12:43 AM
 */?>
<div class="titleBlock">
    <span><?php echo strtoupper($module->mod_name) ?> MODULE: View Widget - <?php echo $model->view_name; ?></span>

        <span class="blockMenu">
    <?php echo CHtml::link('Settings',array('modSetting/indexSet', 'mod_id'=>$model->mod_id, 'view_id'=>$model->id)); ?>&nbsp;&nbsp;&nbsp;
    </span>

</div>

<?php echo $this->renderPartial('_viewModWidget', array('model'=>$model, 'module'=>$module)); ?>