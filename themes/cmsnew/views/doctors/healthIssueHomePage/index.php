<?php
/**
 * Created by Lemmy.
 * Date: 10/3/12
 * Time: 6:09 PM
 */?>
<div class="titleBlock">
    <span>HEALTH ISSUES: List of Health Issues showed on Home Page</span>
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
                <th>Category</th>
                <th>Order</th>
                <th class="center">Actions</th>
            </tr>
            </thead>

            <tbody>
            <?php  foreach($models as $item) : ?>

            <tr class='<?php if($item->f_status==1) echo 'gradeA'; else echo 'gradeC'; ?>'>
                <td class="center"><?php echo $item->primaryKey;?></td>
                <td><?php echo $item->issue_name;?></td>
                <td><?php echo $item->getCategoryText();?></td>
                <td><?php echo $item->order_hp;?></td>
                <td class='center'>
                    <?php echo CHtml::link('', array('update', 'id'=>$item->id), array('title'=>'Edit Order', 'class'=>'action BtnEdit')); ?>
                    <?php echo CHtml::link('', '', array('submit'=>array('remove', 'id'=>$item->id), 'title'=>'Remove From List', 'class'=>'action BtnDelete')); ?>
                </td>
            </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
        <div class="tfooter">Total number of Added Healt Issues: <?php echo count($models);?></div>
    </div>

</div>
