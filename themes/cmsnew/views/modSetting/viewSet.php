<?php
/**
 * Created by Lemmy.
 * Date: 11/14/12
 * Time: 2:52 PM
 */?>
<?php
    if(get_class($widget) !== 'ModView') $name = $widget->mod_name;
    else $name = $widget->view_name;
    $mod = '';
    if(get_class($widget) !== 'ModView'){
        if($widget->f_type == 'M') $mod = 'Module';
        else $mod = 'Widget';
    }
    else $mod = 'Widget';
?>

<div class="titleBlock">
    <span><?php echo strtoupper($name).' '.strtoupper($mod).': View '.$mod. ' Setting - '.$model->set_name; ?></span>
</div>

<?php echo $this->renderPartial('_viewSet', array('model'=>$model, 'widget'=>$widget)); ?>