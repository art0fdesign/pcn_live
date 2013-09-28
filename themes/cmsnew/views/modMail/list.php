
<div class="titleBlock">
    <span>MODULE MAILS: List of Module Mails</span>
</div>
<div class="wideContent">
    <!-- Table -->
    <div class="widget">
        <div class="title"></div>

        <table class="display dTable">

            <thead>
            <tr>
                <th>Module</th>
                <th>From</th>
                <th>Subject</th>
                <th>Admin</th>
                <th>Mail</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            <?php  foreach($models as $item) : ?>

            <tr class='<?php if($item->f_status==1) echo 'gradeA'; else echo 'gradeC'; ?>'>
                <td><?php echo $item->module->mod_name;?></td>
                <td><?php echo $item->from_mail;?></td>
                <td><?php echo $item->user_subject;?></td>
                <td><?php echo $item->getAdminLabel($item->f_send_to_admin);?></td>
                <td><?php echo $item->admin_mail;?></td>
                <td class='center'>
                    <?php echo CHtml::link('', array('view', 'id'=>$item->id), array('title'=>'View', 'class'=>'action BtnView')); ?>
                    <?php echo CHtml::link('', array('update', 'id'=>$item->id), array('title'=>'Edit', 'class'=>'action BtnEdit')); ?>
                </td>
            </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
        <div class="tfooter">Total number of Mails: <?php echo count($models);?></div>
    </div>

</div>
