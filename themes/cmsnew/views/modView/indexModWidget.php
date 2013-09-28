<?php
/**
 * Created by Lemmy.
 * Date: 11/13/12
 * Time: 3:08 PM
 */?>

<div class="titleBlock">
    <span><?php echo strtoupper($module->mod_name); ?> MODULE: List of Module Widgets</span>

    <span class="blockMenu">
    <?php echo CHtml::link('Module',array('modRegister/view', 'id'=>$module->id)); ?>&nbsp;&nbsp;&nbsp;
    <?php //echo CHtml::link('Add new Widget',array('createModWidget', 'id'=>$module->id)); ?>
    </span>

</div>
<div class="wideContent">
    <!-- Table -->
    <div class="widget">
        <div class="title">
        </div>

        <table class="display dTable">

            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>View Action</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            <?php  foreach($models as $item) : ?>

            <tr class='<?php if($item->f_status==1) echo 'gradeA'; else echo 'gradeC'; ?>'>
                <td><?php echo $item->primaryKey;?></td>
                <td><?php echo $item->view_name;?></td>
                <td><?php echo $item->view_action;?></td>
                <td><?php echo $item->getStatusText($item->f_status);?></td>
                <td class='center'>
                    <?php echo CHtml::link('', array('viewModWidget', 'id'=>$item->id), array('title'=>'View', 'class'=>'action BtnView')); ?>
                    <?php echo CHtml::link('', array('modSetting/indexSet', 'mod_id'=>$item->mod_id, 'view_id'=>$item->id), array('title'=>'Widget Settings', 'class'=>'action BtnView')); ?>
                    <?php echo CHtml::link('', array('updateModWidget', 'id'=>$item->id), array('title'=>'Edit', 'class'=>'action BtnEdit')); ?>
                    <?php echo CHtml::link('', '', array('submit'=>array('activateModWidget', 'id'=>$item->id), 'title'=>'Active/Inactive', 'class'=>'action BtnRead')); ?>
                    <?php echo CHtml::link('', '', array('submit'=>array('deleteModWidget', 'id'=>$item->id), 'confirm' => 'Are you sure?', 'title'=>'Delete', 'class'=>'action BtnDelete')); ?>
                </td>
            </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
        <div class="tfooter">Total number of Module Widgets: <?php echo count($models);?></div>
    </div>

</div>
