<?php
/**
 * Created by Lemmy.
 * Date: 11/2/12
 * Time: 12:53 AM
 */?>
<?php
/**
 * Created by Lemmy.
 * Date: 11/1/12
 * Time: 11:42 PM
 */?>
<div class="titleBlock">
    <span>Cheerful: List of Cheerful Widgets</span>

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
                <th class="center">ID</th>
                <th>Name</th>
                <th class="center">Actions</th>
            </tr>
            </thead>

            <tbody>
            <?php  foreach($widgets as $item) : ?>

            <tr class='<?php if($item->f_status==1) echo 'gradeA'; else echo 'gradeC'; ?>'>
                <td class="center"><?php echo $item->primaryKey;?></td>
                <td><?php echo $item->view_name;?></td>
                <td class='center'>
                    <?php /*echo CHtml::link('', array('view', 'id'=>$item->id), array('title'=>'View Testimonials', 'class'=>'action BtnView')); ?>
                    <?php echo CHtml::link('', array('update', 'id'=>$item->id), array('title'=>'Edit Testimonials', 'class'=>'action BtnEdit')); ?>
                    <?php echo CHtml::link('', '', array('submit'=>array('activate', 'id'=>$item->id), 'title'=>'Active/Inactive', 'class'=>'action BtnRead')); ?>
                    <?php echo CHtml::link('', '', array('submit'=>array('delete', 'id'=>$item->id), 'confirm' => 'Are you sure?', 'title'=>'Delete Testimonials', 'class'=>'action BtnDelete')); */?>
                </td>
            </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
        <div class="tfooter">Total number of Cheerfull Widgets: <?php echo count($widgets);?></div>
    </div>

</div>