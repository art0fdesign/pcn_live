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
                <th>Show</th>
                <th>Order</th>
                <th>Title</th>
        		<th>Actions</th>        
            </tr>
        </thead>
        
        <tbody>
        <?php  foreach($models as $item) : ?>
        	
        <tr class='<?php if($item->f_widget==1) echo 'gradeA'; else echo 'gradeC'; ?>'>
        <td><?php echo $item->primaryKey;?></td>
        <td><?php echo $item->getYesNoText($item->f_widget);?></td>
        <td><?php echo $item->widget_order;?></td>
        <td><?php echo $item->item_title;?></td>
        <td class='center'>
        <?php echo CHtml::link('', array('view', 'id'=>$item->id), array('title'=>'View Widget Item', 'class'=>'action BtnView')); ?>
        <?php echo CHtml::link('', array('update', 'id'=>$item->id), array('title'=>'Edit Widget Item', 'class'=>'action BtnEdit')); ?>
        <?php echo CHtml::link('', '', array('submit'=>array('activate', 'id'=>$item->id), 'title'=>'Active/Inactive', 'class'=>'action BtnRead')); ?>
		</td>
        </tr>
        <?php endforeach; ?>
        </tbody>
        
        </table>
        <div class="tfooter">Total number of Listing Items: <?php echo count($models);?></div>
    </div>

</div>
