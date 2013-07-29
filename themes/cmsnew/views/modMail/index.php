
<div class="titleBlock">
    <span>MODULE MAILS: List of <?=$modName?> Mails</span>
</div>
<div class="wideContent">
    <!-- Table -->
    <div class="widget">
        <div class="title"></div>

        <table class="display dTable">

            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Subject</th>
                <th>Admin</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            <?php  foreach($models as $item) : ?>

            <tr class='<?php if($item->f_status==1) echo 'gradeA'; else echo 'gradeC'; ?>'>
                <td><?php echo $item->primaryKey;?></td>
                <td><?php echo $item->mail_ident;?></td>
                <td><?php echo $item->user_subject;?></td>
                <td><?php echo $item->getAdminLabel($item->f_send_to_admin);?></td>
                <td><?php echo $item->getStatusText($item->f_status);?></td>
                <td class='center'>
                    <?php echo CHtml::link('', array('viewAdmin', 'id'=>$item->id), array('title'=>'View', 'class'=>'action BtnView')); ?>
                    <?php echo CHtml::link('', array('updateAdmin', 'id'=>$item->id), array('title'=>'Edit', 'class'=>'action BtnEdit')); ?>
                    <?php echo CHtml::link('', '', array('submit'=>array('activate', 'id'=>$item->id), 'title'=>'Active/Inactive', 'class'=>'action BtnRead')); ?>
                    <?php echo CHtml::link('', '', array('submit'=>array('delete', 'id'=>$item->id), 'confirm' => 'Are you sure?', 'title'=>'Delete', 'class'=>'action BtnDelete')); ?>
                </td>
            </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
        <div class="tfooter">Total number of Mails: <?php echo count($models);?></div>
    </div>

</div>
