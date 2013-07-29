<div class="titleBlock"><span>USERS: List of Users</span></div>

<div class="wideContent">
	<!-- Table -->
    <div class="widget">
		<div class="title"></div>

        <table class="display dTable">
        <thead>
		<tr>
       
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>e-mail</th>
        <th>Role</th>
        <th>Status</th>
		<th class="center">Actions</th>
        
        </tr>
        </thead>
        <tbody>
        <?php  foreach($users as $item) : ?>
        	
        <tr class='<?php if($item->f_status==1) echo "gradeA"; else echo "gradeC"; ?>'>
        <td><?php echo $item->user_name;?></td>
        <td><?php echo $item->first_name;?></td>
        <td><?php echo $item->last_name;?></td>
        <td><?php echo $item->email;?></td>
        <td><?php echo $item->getAdminLabel($item->f_admin);?></td>
        <td><?php echo $item->getStatusText($item->f_status);?></td>
        <td class='center'>
        <?php echo CHtml::link('', array('view', 'id'=>$item->id), array('title'=>'View User', 'class'=>'action BtnView'))."\n"; ?>
        <?php echo CHtml::link('', array('update', 'id'=>$item->id), array('title'=>'Edit User', 'class'=>'action BtnEdit'))."\n"; ?>
        <?php echo CHtml::link('',"", array("submit"=>array('activate', 'id'=>$item->id), 'title'=>'Active/Inactive', 'class'=>'action BtnRead')); ?>
        <?php echo CHtml::link('',"", array("submit"=>array('delete', 'id'=>$item->id), 'confirm' => 'Are you sure?', 'title'=>'Delete User', 'class'=>'action BtnDelete')); ?>
		</td>
        </tr>
        <?php endforeach; ?>


        
        </tbody>
        </table>
        <div class="tfooter">Total number of users: <?=count($users);?></div>
    </div>
</div>
