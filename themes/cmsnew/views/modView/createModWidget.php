<?php
/**
 * Created by Lemmy.
 * Date: 11/13/12
 * Time: 11:12 PM
 */?>
<div class="titleBlock">
    <span><?php echo strtoupper($module->mod_name) ?> MODULE: Create New Widget</span>
</div>

<?php echo $this->renderPartial('_formModWidget', array('model'=>$model, 'module'=>$module)); ?>