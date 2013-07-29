	<div class="titleBlock">
		<span>MODULES: List of Modules</span>
	</div>
<div class="wideContent">
	<!-- Table -->
    <div class="widget">
		<div class="title">
			<div class="filter"></div>
		</div>

        <table class="display dTable">
        <thead>
		<tr>
       
        <th>Name</th>
        <th>Path</th>
        <th>Type</th>
        <th>Comment</th>
		<th class="center" style="width:80px">Actions</th>
        
        </tr>
        </thead>
        <tbody>
        <?php  foreach($modules as $item) : ?>
       	<?php $url = '/' . $item->mod_path . '/default/view'; ?>
        <tr class='<?php if($item->f_status==1) echo "gradeA"; else echo "gradeC"; ?>'>
        <td><?php echo $item->mod_name;?></td>
        <td><?php echo $item->mod_path;?></td>
        <td><?php echo $item->getTypeLabel($item->f_type);?></td>
        <td><?php echo $item->comment;?></td>
        <td class='center'>
        <?php echo CHtml::link('', array('view', 'id'=>$item->id), array('title'=>'Module Settings', 'class'=>'action BtnView'))."\n"; ?>
		</td>
        </tr>
        <?php endforeach; ?>


        
        </tbody>
        </table>
        <div class="tfooter">Total number of modules: <?=count($modules);?></div>
    </div>
</div>
