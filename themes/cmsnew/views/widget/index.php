<?php
$baseUrl = Yii::app()->getRequest()->getBaseUrl();
?>
<div class="titleBlock mb20">
    <span>WIDGETS: List of widgets</span>
</div>

<div class="wrapper">

<div class="wideContent">
	<!-- Table -->
    <div class="widget mt0">
		<div class="title">

			<div class="filter">


                    <form action="<?php echo Yii::app()->createUrl($this->route); ?>" method="POST">
                    <div class="select-list"><?php echo CHtml::dropDownList('filter', $filterSelected, $filterOptions,
                                $htmlOptions = array(
                                    'submit'    => '',
                                ));
                    ?></div>
                    </form>
			</div>

		</div>

        <table class="display dTable">
        <thead>
		<tr>
       
        <th>Name</th>
        <th>Module</th>
		<th class="center">Actions</th>
        
        </tr>
        </thead>
        <tbody>
        <?php  foreach($widgets as $item): ?>
        	
        <tr class="gradeA">
        <td><?php echo $item['name'];?></td>
        <td><?php echo $item['mod_name'];?></td>
        <td class='center'>
        <?php echo empty($item['admin_url'])? '': CHtml::link('', $baseUrl.$item['admin_url'], array('title'=>'Admin', 'class'=>'action BtnAdmin'))."\n"; ?>
        <?php echo CHtml::link('', array('view', 'type'=>$item['type'], 'id'=>$item['id']), array('title'=>'Widget Settings', 'class'=>'action BtnView'))."\n"; ?>
		</td>
        </tr>
        <?php endforeach; ?>


        
        </tbody>
        </table>
        <div class="tfooter">Total number of widgets: <?=count($widgets);?></div>
    </div>

</div>
</div>
