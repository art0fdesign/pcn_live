<div class="titleBlock">
    <span>LISTINGS: List of Listings</span>
</div>
<div class="wideContent">
	<!-- Table -->
    <div class="widget">
		<div class="title"></div>

        <table class="display dTable">

        <thead>
    		<tr>       
                <th>ID</th>
                <th>Mark</th>
                <th>Use Categories</th>
                <th>Use Widget</th>
                <th>Status</th>
        		<th>Actions</th>        
            </tr>
        </thead>
        
        <tbody>
        <?php  foreach($models as $item) : ?>
        	
        <tr class='<?php if($item->f_status==1) echo 'gradeA'; else echo 'gradeC'; ?>'>
        <td><?php echo $item->primaryKey;?></td>
        <td><?php echo $item->listing_id;?></td>
        <td><?php echo $item->getYesNoText($item->f_use_cat);?></td>
        <td><?php echo $item->getYesNoText($item->f_use_widget);?></td>
        <td><?php echo $item->getStatusText($item->f_status);?></td>
        <td class='center'>
        <?php echo CHtml::link('', array('view', 'id'=>$item->id), array('title'=>'View Listing Settings', 'class'=>'action BtnView')); ?>
        <?php echo CHtml::link('', array('/aodListing/ListingItem', 'list'=>$item->listing_id), array('title'=>'View Listing Items', 'class'=>'action BtnView')); ?>
        <?php echo $item->f_use_cat? CHtml::link('', array('/aodListing/ListingCategory', 'list'=>$item->listing_id), array('title'=>'View Listing Categories', 'class'=>'action BtnView')): ''; ?>
        <?php echo $item->f_use_widget? CHtml::link('', array('/aodListing/ListingWidget', 'list'=>$item->listing_id), array('title'=>'View Listing Widget Items', 'class'=>'action BtnView')): ''; ?>
        <?php echo CHtml::link('', array('update', 'id'=>$item->id), array('title'=>'Edit Listing', 'class'=>'action BtnEdit')); ?>
        <?php echo CHtml::link('', '', array('submit'=>array('activate', 'id'=>$item->id), 'title'=>'Active/Inactive', 'class'=>'action BtnRead')); ?>
        <?php echo CHtml::link('', '', array('submit'=>array('delete', 'id'=>$item->id), 'confirm' => 'Are you sure?', 'title'=>'Delete Listing Main', 'class'=>'action BtnDelete')); ?>
		</td>
        </tr>
        <?php endforeach; ?>
        </tbody>
        
        </table>
        <div class="tfooter">Total number of Listings: <?php echo count($models);?></div>
    </div>

</div>
