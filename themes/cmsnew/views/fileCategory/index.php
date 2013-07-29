<div class="titleBlock"><span>FILE MANAGER: List of Categories</span>
    <div class="blockMenu">
        <span class="blockIcon"><?php echo CHtml::link('', array('fileCategory/index'), array('title'=>'View Categories')) ?></span>
        <span class="blockIcon2"><?php echo CHtml::link('', array('file/index'), array('title'=>'View Files')) ?></span>
    </div>
</div>
<div class="wideContent">
<div class="wrapper">

    <!-- Table -->
    <div class="widget">
        <div class="title"></div>

        <table class="display dTable">

            <thead>

            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>

            </thead>

            <tbody>

            <?php  foreach($files as $item) : ?>

            <tr class="gradeA">
                <td><?php echo $item->cat_name;?></td>

                <td class='center'>
                    <?php echo CHtml::link('', array('view', 'id'=>$item->id), array('title'=>'View File', 'class'=>'action BtnView'))."\n"; ?>
                    <?php echo CHtml::link('', array('update', 'id'=>$item->id), array('title'=>'Edit File', 'class'=>'action BtnEdit'))."\n"; ?>
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