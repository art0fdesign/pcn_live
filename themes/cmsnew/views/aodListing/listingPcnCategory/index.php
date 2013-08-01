<div class="titleBlock">
    <span>LISTING CATEGORIES: List of <?php echo $subtitle;?></span>
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
        		<th>Actions</th>        
            </tr>
        </thead>
        
        <tbody>
        <?php  foreach($models as $item) : ?>
        	
        <tr class='gradeA'>
        <td><?php echo $item->primaryKey;?></td>
        <td><?php echo $item->order_by;?></td>
        <td><?php echo $item->cat_title;?></td>
        <td class='center'>
        <?php if ($item->parent_id == '1') echo CHtml::link('', array('index', 'parent_id'=>$item->id), array('title'=>'View Subcategories', 'class'=>'action BtnRead')); ?>
        <?php echo CHtml::link('', array('view', 'id'=>$item->id), array('title'=>'View Category', 'class'=>'action BtnView')); ?>
        <?php echo CHtml::link('', array('update', 'id'=>$item->id), array('title'=>'Edit Category', 'class'=>'action BtnEdit')); ?>
        <?php echo CHtml::link('', '', array('submit'=>array('delete', 'id'=>$item->id), 'confirm' => 'Are you sure?', 'title'=>'Delete Category', 'class'=>'action BtnDelete')); ?>
		</td>
        </tr>
        <?php endforeach; ?>
        </tbody>
        
        </table>
        <div class="tfooter">Total number of Categories: <?php echo count($models);?></div>
    </div>

</div>
