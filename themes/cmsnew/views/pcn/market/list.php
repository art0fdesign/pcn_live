<div class="titleBlock"><span>MARKET: List of <?php echo $type; ?>s</span></div>

<div class="wideContent">
    <!-- Table -->
    <div class="widget">
        <div class="title"></div>

        <table class="display dTable">
        <thead>
        <tr>

        <th>Title</th>
        <th>Begin time</th>
        <th>Early Bird Time</th>
        <th>End Time</th>
        <th class="center">Actions</th>

        </tr>
        </thead>
        <tbody>
        <?php  foreach($items as $item) : ?>

        <tr class='<?php if($item->f_status==1) echo "gradeA"; else echo "gradeC"; ?>'>
        <td><?php echo $item->title;?></td>
        <td><?php echo $item->start_dt;?></td>
        <td><?php echo $item->earlybird_dt;?></td>
        <td><?php echo $item->end_dt;?></td>
        <td class='center'>
        <?php //echo CHtml::link('', array('view', 'id'=>$item->id), array('title'=>'View User', 'class'=>'action BtnView'))."\n"; ?>
        <?php //echo CHtml::link('', array('update', 'id'=>$item->id), array('title'=>'Edit User', 'class'=>'action BtnEdit'))."\n"; ?>
        <?php //echo CHtml::link('',"", array("submit"=>array('activate', 'id'=>$item->id), 'title'=>'Active/Inactive', 'class'=>'action BtnRead')); ?>
        </td>
        </tr>
        <?php endforeach; ?>

        </tbody>
        </table>
        <div class="tfooter">Total number of events: <?=count($events);?></div>
    </div>
</div>