<div class="titleBlock"><span>CATALOG: List of Articles</span></div>

<div class="wideContent">
	<!-- Table -->
    <div class="widget">
		<div class="title">
			<div class="filter">
				<span><a>Filter by:</a></span>
				<div class="select-list">
                    <form action="<?php echo Yii::app()->createUrl($this->route); ?>" method="POST">
                    <?php echo CHtml::dropDownList('cid', $selectedCategory, $categoryOptions, 
                                $htmlOptions = array(
                                    'empty'     => ' ',
                                    'submit'    => '',
                                ));
                    ?>
                    </form>
				</div>
			</div>
        </div>

        <table class="display dTable">
        <thead>
		<tr>
       
        <th>Image</th>
        <th>Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Status</th>
		<th class="center">Controls</th>
        
        </tr>
        </thead>
        <tbody>
        <?php  foreach($data as $item) : ?>
        	
        <tr class='<?php if($item->f_status==1) echo 'gradeA'; else echo 'gradeC'; ?>'>
        <td><?php echo Chtml::image( $item->getThumbSrc('list'), $item->getThumbFileName('list') );?></td>
        <td><?php echo $item->name;?></td>
        <td><?php echo @$item->category->name;?></td>
        <td><?php echo $item->price;?></td>
        <td><?php echo $item->getStatusText($item->f_status);?></td>
        <td class='center'>
        <?php echo CHtml::link('', array('view', 'id'=>$item->id), array('title'=>'View Article', 'class'=>'action BtnView')); ?>
        <?php echo CHtml::link('', array('update', 'id'=>$item->id), array('title'=>'Edit Article', 'class'=>'action BtnEdit')); ?>
        <?php echo CHtml::link('', '', array('submit'=>array('activate', 'id'=>$item->id), 'title'=>'Active/Inactive', 'class'=>'action BtnRead')); ?>
        <?php echo CHtml::link('', '', array('submit'=>array('delete', 'id'=>$item->id, 'cid'=>$selectedCategory), 'confirm' => 'Are you sure?', 'title'=>'Delete Article', 'class'=>'action BtnDelete')); ?>
		</td>
        </tr>
        <?php endforeach; ?>


        
        </tbody>
        </table>
        <div class="tfooter">Total number of articles: <?=count($data);?></div>
    </div>
</div>
