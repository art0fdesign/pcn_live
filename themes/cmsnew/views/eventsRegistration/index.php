<div class="titleBlock"><span>EVENTS: List of Events</span></div>

<div class="wideContent">
    <!-- Table -->
    <div class="widget">
        <div class="title"></div>

        <table class="display dTable">
        <thead>
        <tr>

        <th>Name</th>
        <th>Page</th>
        <th>Early Bird Date</th>
        <th>Date End</th>
        <th>Status</th>
        <th class="center">Actions</th>

        </tr>
        </thead>
        <tbody>
        <?php  foreach($events as $item) : ?>

        <tr class='<?php if($item->f_status==1) echo "gradeA"; else echo "gradeC"; ?>'>
        <td><?php echo $item->name;?></td>
        <td><?php echo $item->page->name;?></td>
        <td><?php echo $item->date_early_bird;?></td>
        <td><?php echo $item->date_end;?></td>
        <td><?php echo $item->getStatusText($item->f_status);?></td>
        <td class='center'>
        <?php echo CHtml::link('', array('view', 'id'=>$item->id), array('title'=>'View User', 'class'=>'action BtnView'))."\n"; ?>
        <?php echo CHtml::link('', array('update', 'id'=>$item->id), array('title'=>'Edit User', 'class'=>'action BtnEdit'))."\n"; ?>
        <?php echo CHtml::link('',"", array("submit"=>array('activate', 'id'=>$item->id), 'title'=>'Active/Inactive', 'class'=>'action BtnRead')); ?>
        </td>
        </tr>
        <?php endforeach; ?>

        </tbody>
        </table>
        <div class="tfooter">Total number of events: <?=count($events);?></div>
    </div>
</div>
