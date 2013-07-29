<?php $this->layout = '//layouts/wrapper'; ?>

<div class="titleBlock mb20">
    <span>WIDGETS: List of Menu Items</span>
</div>

<div class="wideContent">
	<!-- Table -->
    <div class="widget">
		<div class="title">
			<div class="filter">
				<span><a>Filter by:</a></span>
				<div class="select"></div>
                    <form action="<?php echo Yii::app()->createUrl($this->route, array('mid'=>$this->_menu->id)); ?>" method="POST">
                    <?php echo CHtml::dropDownList('parent_id', $selectedParent, $parentOptions, 
                                $htmlOptions = array(
                                    //'empty'     => '(Select Type)',
                                    'submit'    => '',
                                ));
                    ?>
                    </form>
			</div>
		</div>

        <table class="display dTable">
        <thead>
		<tr>
       
        <th>Order</th>
        <!--<th>Name</th>-->
        <th>Caption</th>
        <th>Parent</th>
        <th>URL</th>
        <th>Status</th>
		<th>Actions</th>
        
        </tr>
        </thead>
        <tbody>
        <?php  foreach($menuItems as $item) : ?>
        	
        <tr class='<?php if($item->f_status==1) echo "gradeA"; else echo "gradeC"; ?>'>
        <td><?php echo $item->getOrder(); ?></td>
        <!--<td><?php echo $item->name;?></td>-->
        <td><?php echo $item->getNameIndent();?></td>
        <td><?php echo @$item->parent->name;?></td>
        <td><?php echo $item->getUrl( $item->id );?></td>
        <td><?php echo $item->getStatusText($item->f_status);?></td>
        <td class='center'>
        <?php echo CHtml::link('', array('view', 'id'=>$item->id), array('title'=>'View Menu Item', 'class'=>'action BtnView'))."\n"; ?>
        <?php echo CHtml::link('', array('update', 'id'=>$item->id), array('title'=>'Edit Menu Item', 'class'=>'action BtnEdit'))."\n"; ?>
        <?php echo CHtml::link('',"", array("submit"=>array('activate', 'id'=>$item->id), 'title'=>'Active/Inactive', 'class'=>'action BtnRead')); ?>
        <?php echo CHtml::link('',"", array("submit"=>array('delete', 'id'=>$item->id), 'confirm' => 'Are you sure?', 'title'=>'Delete Menu Item', 'class'=>'action BtnDelete')); ?>
		</td>
        </tr>
        <?php endforeach; ?>


        
        </tbody>
        </table>
    </div>
</div>
