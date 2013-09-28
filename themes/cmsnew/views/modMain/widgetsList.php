<?php
$baseUrl = Yii::app()->getRequest()->getBaseUrl();
?>
<div class="titleBlock mb20">
    <span>List of Widgets</span>
</div>

<div class="wrapper">

<div class="wideContent">
	<!-- Table -->
    <div class="widget mt0">
		<div class="title">

<?php /* ?>
			<div class="filter">

                    <form action="<?php echo Yii::app()->createUrl($this->route); ?>" method="POST">
                    <div class="select-list"><?php echo CHtml::dropDownList('filter', $filterSelected, $filterOptions,
                                $htmlOptions = array(
                                    'submit'    => '',
                                ));
                    ?></div>
                    </form>
			</div>
<?php /**/?>

		</div>

        <table class="display dTable">
        <thead>
		<tr>
       
        <th>Name</th>
		<th class="center">Actions</th>
        
        </tr>
        </thead>
        <tbody>
        <?php  foreach($models as $item): ?>
        	
        <tr class="gradeA">
        <td><?php echo $item->mod_name;?></td>
        <td class='center'>

<?php 
// TODO: change to affect cms_mod_table url preparation shema
    $adminUrl = $baseUrl . $item->url_controller;
?>
        <?php echo $item->f_admin? CHtml::link('', $adminUrl, array('title'=>'Admin', 'class'=>'action BtnAdmin')): '' . "\n"; ?>
        <?php $viewID = $item->id > 100? 0: $item->id; // until all this stuff is moved to cms_mod_main TABLE ?>
        <?php echo CHtml::link('', array('modSetting/indexSet', 'mod_id'=>$item->mod_id, 'view_id'=>$viewID), array('title'=>'Module Settings', 'class'=>'action BtnView'))."\n"; ?>
		</td>
        </tr>
        <?php endforeach; ?>


        
        </tbody>
        </table>
        <div class="tfooter">Total number of modules: <?=count($models);?></div>
    </div>

</div>
</div>
