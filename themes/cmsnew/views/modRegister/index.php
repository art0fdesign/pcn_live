<?php
/**
 * Created by Lemmy.
 * Date: 11/13/12
 * Time: 1:32 PM
 */?>
<div class="titleBlock">
    <span>MODULES & WIDGETS: List of Modules and Widgets</span>
</div>
<div class="wideContent">
    <!-- Table -->
    <div class="widget">
        <div class="title">

		<!--<div class="title">-->
			<div class="filter">
                <form action="<?php echo Yii::app()->createUrl($this->route); ?>" method="POST">
                    <div class="select-list">
                        <?php echo CHtml::dropDownList('type', $typeSelected, ModRegister::getTypeOptions(),
                        $htmlOptions = array(
                            'empty'     => '(Select Type)',
                            'submit'    => '',
                        ));
                        ?>
                    </div>
                </form>
			</div>
        </div>

        <table class="display dTable">

            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Path</th>
                <th>Type</th>
                <th>Comment</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            <?php  foreach($models as $item) : ?>

            <tr class='<?php if($item->f_status==1) echo 'gradeA'; else echo 'gradeC'; ?>'>
                <td><?php echo $item->primaryKey;?></td>
                <td><?php echo $item->mod_name;?></td>
                <td><?php echo $item->mod_path;?></td>
                <td><?php echo $item->getTypeLabel($item->f_type);?></td>
                <td><?php echo $item->comment;?></td>
                <td><?php echo $item->getStatusText($item->f_status);?></td>
                <td class='center'>
                    <?php echo CHtml::link('', array('view', 'id'=>$item->id), array('title'=>'View', 'class'=>'action BtnView')); ?>
                    <?php echo CHtml::link('', array('modView/indexModWidget', 'mod_id'=>$item->id), array('title'=>'Widgets', 'class'=>'action BtnView')); ?>
                    <?php echo CHtml::link('', array('modMail/index', 'mod_id'=>$item->id), array('title'=>'Mails', 'class'=>'action BtnView')); ?>
                    <?php echo CHtml::link('', array('update', 'id'=>$item->id), array('title'=>'Edit', 'class'=>'action BtnEdit')); ?>
                    <?php echo CHtml::link('', '', array('submit'=>array('activate', 'id'=>$item->id), 'title'=>'Active/Inactive', 'class'=>'action BtnRead')); ?>
                    <?php echo CHtml::link('', '', array('submit'=>array('delete', 'id'=>$item->id), 'confirm' => 'Are you sure?', 'title'=>'Delete', 'class'=>'action BtnDelete')); ?>
                </td>
            </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
        <div class="tfooter">Total number of Mod Registers: <?php echo count($models);?></div>
    </div>

</div>
