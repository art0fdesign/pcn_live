<?php
/**
 * Created by Lemmy.
 * Date: 11/14/12
 * Time: 2:17 PM
 */?>
<?php
    $name = '';
    if(get_class($widget) !== 'ModView') $name = $widget->mod_name;
    else $name = $widget->view_name;

    $mod = '';
    /*
    if(get_class($widget) !== 'ModView'){
        if($widget->f_type == 'M') $mod = ' Module';
        else $mod = ' Widget';
    }
    else $mod = ' Widget';*/?>

<div class="titleBlock">
    <span><?php echo strtoupper($name).strtoupper($mod).': List of '.$mod. ' Settings' ?></span>
    <span class="blockMenu">
    <?php
        if( Yii::app()->user->isAdmin ){ 
            if(get_class($widget) === 'ModView')
                echo CHtml::link('Widget',array('modView/viewModWidget', 'id'=>$widget->id));
            else
                echo CHtml::link($mod, array('modRegister/view', 'id'=>$widget->id)); 
        }?>&nbsp;&nbsp;&nbsp;
<?php
    /*$modID = '';
    $viewID = '';
    if(get_class($widget) === 'ModView'){
        $modID = $widget->mod_id;
        $viewID = $widget->id;
    }else{
        $modID = $widget->id;
        $viewID = 0;
    }?>

    <?php echo CHtml::link('Add new Setting',array('createSet', 'mod_id'=>$modID, 'view_id'=>$viewID));*/ ?>
    </span>
</div>
<div class="wideContent">
    <!-- Table -->
    <div class="widget">
        <div class="title"></div>
        <!--
		<div class="title">
			<div class="filter">
                <form action="<?php //echo Yii::app()->createUrl($this->route); ?>" method="POST">
                    <div class="select-list">
                        <?php //echo CHtml::dropDownList('filter', $selectedFilterItem, $filterOptions, $htmlOptions = array( 'submit' => '', ));?>
                    </div>
                </form>
			</div>
		</div>
-->
        <table class="display dTable">

            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Key</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            <?php  foreach($models as $item) : ?>

            <tr class='<?php if($item->f_status==1) echo 'gradeA'; else echo 'gradeC'; ?>'>
                <td><?php echo $item->primaryKey;?></td>
                <td><?php echo $item->set_name;?></td>
                <td><?php echo $item->set_key;?></td>
                <td><?php echo $item->getStatusText($item->f_status);?></td>
                <td class='center'>
                    <?php echo CHtml::link('', array('viewSet', 'id'=>$item->id), array('title'=>'View Setting', 'class'=>'action BtnView')); ?>
                    <?php echo CHtml::link('', array('updateS', 'id'=>$item->id), array('title'=>'Edit Setting', 'class'=>'action BtnEdit')); ?>
                    <?php echo CHtml::link('', '', array('submit'=>array('activateSet', 'id'=>$item->id), 'title'=>'Active/Inactive', 'class'=>'action BtnRead')); ?>
                    <?php echo CHtml::link('', '', array('submit'=>array('deleteSet', 'id'=>$item->id), 'confirm' => 'Are you sure?', 'title'=>'Delete Setting', 'class'=>'action BtnDelete')); ?>
                </td>
            </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
        <div class="tfooter">Total number of Widget Settings: <?php echo count($models);?></div>
    </div>

</div>
