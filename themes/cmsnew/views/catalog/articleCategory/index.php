<div class="titleBlock"><span>CATALOG: List of Categories</span></div>

<div class="wideContent">
	


	<!-- Table -->
    <div class="widget">
		<div class="title"><?php //echo $fType; ?></div>

        <table class="display dTable">
        <thead>
		<tr>
       
        <th>Order</th>
        <th>Name</th>
        <th>Parent</th>
        <th>Status</th>
		<th class="center">Controls</th>
        
        </tr>
        </thead>
        <tbody>
        <?php  foreach($data as $item) : ?>
        	
        <tr class='<?php if($item->f_status==1) echo 'gradeA'; else echo 'gradeC'; ?>'>
        <td><?php echo $item->order_by;?></td>
        <td><?php echo $item->name;?></td>
        <td><?php echo @$item->parent->name;?></td>
        <td><?php echo $item->getStatusText($item->f_status);?></td>
        <td class='center'>
        <?php echo CHtml::link('', array('view', 'id'=>$item->id), array('title'=>'View Article Category', 'class'=>'action BtnView')); ?>
        <?php echo CHtml::link('', array('update', 'id'=>$item->id), array('title'=>'Edit Article Category', 'class'=>'action BtnEdit')); ?>
        <?php echo CHtml::link('', '', array('submit'=>array('activate', 'id'=>$item->id), 'title'=>'Active/Inactive', 'class'=>'action BtnRead')); ?>
        <?php echo CHtml::link('', '', array('submit'=>array('delete', 'id'=>$item->id), 'confirm' => 'Are you sure?', 'title'=>'Delete Article Category', 'class'=>'action BtnDelete')); ?>
		</td>
        </tr>
        <?php endforeach; ?>


        
        </tbody>
        </table>
        <div class="tfooter">Total number of categories: <?=count($data);?></div>
    </div>
    </div>

