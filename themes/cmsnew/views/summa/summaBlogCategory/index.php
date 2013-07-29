<div class="titleBlock">
    <span>SUMMA BLOG CATEGORIES: List of Summa Blog Categories</span>
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
                <th>Name</th>
                <th>Status</th>
        		<th>Actions</th>        
            </tr>
        </thead>
        
        <tbody>
        <?php  foreach($models as $item) : ?>
        	
        <tr class='<?php if($item->f_status==1) echo 'gradeA'; else echo 'gradeC'; ?>'>
        <td><?php echo $item->primaryKey;?></td>
        <td><?php echo $item->cat_name;?></td>
        <td><?php echo $item->getStatusText($item->f_status);?></td>
        <td class='center'>
        <?php echo CHtml::link('', array('view', 'id'=>$item->id), array('title'=>'View Summa Blog Category', 'class'=>'action BtnView')); ?>
        <?php echo CHtml::link('', array('update', 'id'=>$item->id), array('title'=>'Edit Summa Blog Category', 'class'=>'action BtnEdit')); ?>
        <?php echo CHtml::link('', '', array('submit'=>array('activate', 'id'=>$item->id), 'title'=>'Active/Inactive', 'class'=>'action BtnRead')); ?>
        <?php echo CHtml::link('', '', array('submit'=>array('delete', 'id'=>$item->id), 'confirm' => 'Are you sure?', 'title'=>'Delete Summa Blog Category', 'class'=>'action BtnDelete')); ?>
		</td>
        </tr>
        <?php endforeach; ?>
        </tbody>
        
        </table>
        <div class="tfooter">Total number of Summa Blog Categorys: <?php echo count($models);?></div>
    </div>

</div>
