
<div class="titleBlock"><span>FILE MANAGER: List of Files</span>
    <div class="blockMenu">
        <span class="blockIcon"><?php echo CHtml::link('', array('fileCategory/index')) ?></span>
        <span class="blockIcon2"><?php echo CHtml::link('', array('file/index')) ?></span>
    </div>
</div>
<div class="wideContent">
<div class="wrapper">
	


	<!-- Table -->
    <div class="widget">
		<div class="title">
            <div class="filter">
        		<span><a>Filter by:</a></span>
				<div class="select-list">
                <!--<form method="GET" action="<?php /*echo Yii::app()->createUrl($this->route); */?>">-->
                <?php echo CHtml::form('','get'); ?>
                    <?php echo CHtml::dropDownList('category',
                    isset($_GET['category'])?(int)$_GET['category']:0,
                    File::model()->getCategoryOptions(),
                    array('empty'=>'All categories', 'submit'=>Yii::app()->createUrl($this->route))); ?>
                </form></div>
                <div class="select-list">
                <!--<form method="GET" action="<?php /*echo Yii::app()->createUrl($this->route); */?>">-->
                <?php echo CHtml::form('','get'); ?>
                    <?php echo CHtml::dropDownList('type',
                    isset($_GET['type'])?(string)$_GET['type']:0,
                    File::model()->getTypeOptions(),
                    array('empty'=>'All types', 'submit'=>Yii::app()->createUrl($this->route))); ?>
                </form></div>
            </div>
		</div>

        <table class="display dTable">

        <thead>

		<tr>
        <th class="center">ID</th>
        <th>FILE NAME</th>
        <th>CATEGORY</th>
        <th>TYPE</th>
        <th>SIZE</th>
        <th>URL</th>
		<th class="center">Actions</th>
        </tr>

        </thead>

        <tbody>

        <?php  foreach($files as $item) : ?>
        	
        <tr class="gradeA">
            <td><?php echo $item->id;?></td>
        <td class="center"><?php echo $item->file_name;?></td>
        <td><?php echo $item->getCategoryText( $item->cat_id );?></td>
        <td><?php echo $item->file_type;?></td>
        <td><?php echo $item->getReadableFileSize();?></td>
        <td><?php echo $item->getFileMarkup();?></td>

        <td class='center'>
        <?php echo CHtml::link('', array('view', 'id'=>$item->id), array('title'=>'View File', 'class'=>'action BtnView'))."\n"; ?>
        <?php echo CHtml::link('', array('update', 'id'=>$item->id), array('title'=>'Edit File', 'class'=>'action BtnEdit'))."\n"; ?>
        <?php //if(in_array($item->getFileExt(), $item->img)) {echo CHtml::link('', array('cropZoom', 'id'=>$item->id), array('title'=>'Create Thumnail', 'class'=>'action BtnRead'))."\n"; }?>
        <?php echo CHtml::link('',"", array("submit"=>array('delete', 'id'=>$item->id), 'confirm' => 'Are you sure?', 'title'=>'Delete File', 'class'=>'action BtnDelete')); ?>
		</td>
        </tr>
        <?php endforeach; ?>

        </tbody>

        </table>
        <div class="tfooter">Total number of pages: <?=count($files);?></div>
    </div>

</div>
</div>