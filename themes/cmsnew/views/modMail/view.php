<div class="titleBlock">
    <span>MODULE MAILS: View <?php echo $model->user_subject; ?></span>
    <span class="blockMenu">
    <?php //echo CHtml::link('Settings', array('modSetting/indexSet', 'mod_id'=>$model->id, 'view_id'=>0)); ?>&nbsp;&nbsp;&nbsp;
    <?php //if($model->f_type == 'M')echo CHtml::link('Widgets',array('modView/indexModWidget', 'mod_id'=>$model->id)); ?>
    </span>
</div>

<?php echo $this->renderPartial('_view', array('model'=>$model, 'tags'=>$tags)); ?>
