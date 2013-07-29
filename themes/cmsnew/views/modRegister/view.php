<?php
/**
 * Created by Lemmy.
 * Date: 11/13/12
 * Time: 1:56 PM
 */?>
<?php
    $title = '';
    if($model->f_type == 'M') $title = 'Module';
    else $title = 'Widget';
?>
<div class="titleBlock">
    <span>MODULES & WIDGETS: View <?php echo $title ?> - <?php echo $model->mod_name; ?></span>
    <span class="blockMenu">
    <?php echo CHtml::link('Settings', array('modSetting/indexSet', 'mod_id'=>$model->id, 'view_id'=>0)); ?>
    <?php if($model->f_type == 'M') echo '&nbsp;&nbsp;&nbsp;' . CHtml::link('Widgets',array('modView/indexModWidget', 'mod_id'=>$model->id)); ?>
    <?php if($model->f_type == 'M') echo '&nbsp;&nbsp;&nbsp;' . CHtml::link('Mails',array('modMail/index', 'mod_id'=>$model->id)); ?>
    </span>
</div>

<?php echo $this->renderPartial('_view', array('model'=>$model, 'title'=>$title)); ?>
