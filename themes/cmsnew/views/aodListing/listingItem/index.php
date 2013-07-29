<div class="titleBlock">
    <span>LISTING ITEMS: List of Listing Items</span>
    <span class="blockMenu">
        <?php echo $mainModel->f_use_cat? '&nbsp;'.CHtml::link('Categories', array( '/aodListing/listingCategory', 'list'=>$mainModel->listing_id )): ''?>
        <?php echo '&nbsp;'.CHtml::link('Items', array( '/aodListing/listingItem', 'list'=>$mainModel->listing_id ))?>
        <?php echo $mainModel->f_use_widget? '&nbsp;'.CHtml::link('Widget', array( '/aodListing/listingWidget', 'list'=>$mainModel->listing_id )): ''?>
    </span>
</div>
<div class="wideContent">
	<!-- Table -->
    <div class="widget">
		<div class="title"></div>
<!--
		<div class="title">
			<div class="filter">
                <form action="<?php //echo Yii::app()->createUrl($this->route); ?>" method="POST">
                    <div class="select-list">
                        <?php //echo CHtml::dropDownList('filter', $selectedFilterItem, $filterOptions, $htmlOptions = array( 'submit' => '', ));?>
                    </div>
                </form>
			</div>
		</div>
-->
        <table class="display dTable">

        <thead>
    		<tr>       
                <th>ID</th>
                <th>Order</th>
                <th>Title</th>
                <th>Language</th>
                <th>Status</th>
        		<th>Actions</th>        
            </tr>
        </thead>
        
        <tbody>
        <?php  foreach($models as $item) : ?>
        	
        <tr class='<?php if($item->f_status==1) echo 'gradeA'; else echo 'gradeC'; ?>'>
        <td><?php echo $item->primaryKey;?></td>
        <td><?php echo $item->item_order;?></td>
        <td><?php echo $item->item_title;?></td>
        <td><?php echo $item->language->lang_name;?></td>
        <td><?php echo $item->getStatusText($item->f_status);?></td>
        <td class='center'>
        <?php echo CHtml::link('', array('view', 'id'=>$item->id), array('title'=>'View Item', 'class'=>'action BtnView')); ?>
        <?php echo CHtml::link('', array('update', 'id'=>$item->id), array('title'=>'Edit Item', 'class'=>'action BtnEdit')); ?>
        <?php echo CHtml::link('', array('copy', 'id'=>$item->id), array('title'=>'Copy Item', 'class'=>'action BtnEdit')); ?>
        <?php echo CHtml::link('', '', array('submit'=>array('activate', 'id'=>$item->id), 'title'=>'Active/Inactive', 'class'=>'action BtnRead')); ?>
        <?php echo CHtml::link('', '', array('submit'=>array('delete', 'id'=>$item->id), 'confirm' => 'Are you sure?', 'title'=>'Delete Item', 'class'=>'action BtnDelete')); ?>
		</td>
        </tr>
        <?php endforeach; ?>
        </tbody>
        
        </table>
        <div class="tfooter">Total number of Listing Items: <?php echo count($models);?></div>
    </div>

</div>
