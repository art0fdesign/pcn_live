<div class="titleBlock mb20"><span>WIDGETS: List of Menus</span></div>

<div class="wideContent">
    <!-- Table -->
    <div class="widget mt0">
        <div class="title"></div>

        <table class="display dTable">
            <thead>
            <tr>

                <th>Name</th>
                <th>Language</th>
                <th>HTML Options</th>
                <th>Status</th>
                <th class="center">Actions</th>

            </tr>
            </thead>
            <tbody>
            <?php  foreach($menus as $item) : ?>

            <tr class='<?php if($item->f_status==1) echo "gradeA"; else echo "gradeC"; ?>'>
                <td><?php echo $item->name;?></td>
                <td><?php echo $item->language->lang_name;?></td>
                <td><?php echo $item->ul_options;?></td>
                <td><?php echo $item->getStatusText($item->f_status);?></td>
                <td class='center'>
                    <?php echo CHtml::link('', array('view', 'id'=>$item->id), array('title'=>'View Menu', 'class'=>'action BtnView'))."\n"; ?>
                    <?php echo CHtml::link('', array('menuItem/list', 'mid'=>$item->id), array('title'=>'View Menu Items', 'class'=>'action BtnView'))."\n"; ?>
                    <?php echo CHtml::link('', array('update', 'id'=>$item->id), array('title'=>'Edit Menu', 'class'=>'action BtnEdit'))."\n"; ?>
                    <?php echo CHtml::link('',"", array("submit"=>array('activate', 'id'=>$item->id), 'title'=>'Active/Inactive', 'class'=>'action BtnRead')); ?>
                    <?php echo CHtml::link('',"", array("submit"=>array('delete', 'id'=>$item->id), 'confirm' => 'Are you sure?', 'title'=>'Delete Menu', 'class'=>'action BtnDelete')); ?>
                </td>
            </tr>
                <?php endforeach; ?>



            </tbody>
        </table>
        <div class="tfooter">Total number of menus: <?=count($menus);?></div>

    </div>
</div>