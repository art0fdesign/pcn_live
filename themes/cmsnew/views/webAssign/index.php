<div class="titleBlock"><span>ASSIGNMENTS: List of Assignments</span></div>

<div class="wideContent">

    <!-- Table -->
    <div class="widget">
        <div class="title"> </div>

        <table class="display dTable">
            <thead>
            <tr>
                <th class="center">Type</th>
                <th>Page/Template</th>
                <th>Sector</th>
                <th>Content Type</th>
                <th>Content Name</th>

                <th class="center" style="width:80px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?  foreach ($assign as $a) : ?>

            <tr class='<?php if($a->f_status==1) echo "gradeA"; else echo "gradeC"; ?>'>
                <td class="center"><?=$a->assign_type; ?></td>
                <td><?=WebAssign::model()->getPageTempName($a->assign_type,$a->page_temp_id);?></td>
                <td><?=@$a->sector->name;?></td>
                <td><?=WebAssign::model()->getTypeText($a->content_type);?></td>
                <td><?=@WebAssign::model()->getContentName($a->content_type,$a->content_id)?></td>

                <td class='center' >
                    <?php echo CHtml::link('', array('view', 'id'=>$a->id), array('title'=>'View', 'class'=>'action BtnView'))."\n"; ?>
                    <?php echo CHtml::link('', array('update', 'id'=>$a->id), array('title'=>'Edit', 'class'=>'action BtnEdit'))."\n"; ?>
                    <?php echo CHtml::link('',"", array("submit"=>array('activate', 'id'=>$a->id), 'title'=>'Active/Inactive', 'class'=>'action BtnRead')); ?>
                    <?php echo CHtml::link('',"", array("submit"=>array('delete', 'id'=>$a->id), 'confirm' => 'Are you sure?', 'title'=>'Delete Page content', 'class'=>'action BtnDelete')); ?>
                </td>
            </tr>
                <? endforeach; ?>



            </tbody>
        </table>
        <div class="tfooter">Total number of page contents: <?=count($assign);?></div>
    </div>
</div>

