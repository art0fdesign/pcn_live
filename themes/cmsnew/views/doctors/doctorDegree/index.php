<div class="titleBlock">
    <span>DOCTOR DEGREES: List of Doctor Degrees</span>
</div>
<div class="wideContent">
	<!-- Table -->
    <div class="widget">
		<div class="title"></div>

		<div class="title">
			<div class="filter">
                <form action="<?php //echo Yii::app()->createUrl($this->route); ?>" method="POST">
                    <div class="select-list">
                        <?php echo CHtml::dropDownList('cat', $selectedCategory, $categories, $htmlOptions = array( 'submit' => '', ));?>
                    </div>
                </form>
			</div>
		</div>

        <table class="display dTable">

        <thead>
    		<tr>       
                <th>ID</th>
                <th>Code</th>
                <th>Description</th>
                <th>Status</th>
        		<th>Actions</th>        
            </tr>
        </thead>
        
        <tbody>
        <?php  foreach($models as $item) : ?>
        	
        <tr class='<?php if($item->f_status==1) echo 'gradeA'; else echo 'gradeC'; ?>'>
        <td><?php echo $item->primaryKey;?></td>
        <td><?php echo $item->code;?></td>
        <td><?php echo $item->description;?></td>
        <td><?php echo $item->getStatusText($item->f_status);?></td>
        <td class='center'>
        <?php echo CHtml::link('', array('view', 'id'=>$item->id), array('title'=>'View Doctor Degree', 'class'=>'action BtnView')); ?>
        <?php echo CHtml::link('', array('update', 'id'=>$item->id), array('title'=>'Edit Doctor Degree', 'class'=>'action BtnEdit')); ?>
        <?php echo CHtml::link('', '', array('submit'=>array('activate', 'id'=>$item->id), 'title'=>'Active/Inactive', 'class'=>'action BtnRead')); ?>
        <?php echo CHtml::link('', '', array('submit'=>array('delete', 'id'=>$item->id), 'confirm' => 'Are you sure?', 'title'=>'Delete Doctor Degree', 'class'=>'action BtnDelete')); ?>
		</td>
        </tr>
        <?php endforeach; ?>
        </tbody>
        
        </table>
        <div class="tfooter">Total number of Doctor Degrees: <?php echo count($models);?></div>
    </div>

</div>
