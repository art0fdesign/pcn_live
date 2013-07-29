<div class="titleBlock mb20">
    <span>INSURANCE: List Of Insurances</span>

</div>

<div class="wideContent">

        <div class="widget">
            <div class="title"></div>

            <table class="display dTable">

                <thead>

                <tr>
                    <th class="center">ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Order</th>
                    <th class="center">Actions</th>
                </tr>

                </thead>

                <tbody>

                <?php  foreach($files as $item) : ?>

                <tr class='<?php if($item->f_status==1) echo 'gradeA'; else echo 'gradeC'; ?>'>
                    <td class="center"><?php echo $item->id;?></td>
                    <td><?php echo $item->name;?></td>
                    <td><?php echo $item->address;?></td>
                    <td><?php echo $item->order_by;?></td>

                    <td class="center">
                            <?php echo CHtml::link('', array('view', 'id'=>$item->id), array('title'=>'View Insurance', 'class'=>'action BtnView'))."\n"; ?>
                            <?php echo CHtml::link('', array('update', 'id'=>$item->id), array('title'=>'Edit Insurance', 'class'=>'action BtnEdit'))."\n"; ?>
                            <?php echo CHtml::link('', '', array('submit'=>array('activate', 'id'=>$item->id), 'title'=>'Active/Inactive', 'class'=>'action BtnRead')); ?>
                            <?php echo CHtml::link('',"", array("submit"=>array('delete', 'id'=>$item->id), 'confirm' => 'Are you sure?', 'title'=>'Delete Insurance', 'class'=>'action BtnDelete')); ?>
                    </td>
                </tr>
                    <?php endforeach; ?>

                </tbody>

            </table>
            <div class="tfooter">Total number of Insurances: <?php echo count($files);?></div>
        </div>
</div>
