<?php
/**
 * Created by Lemmy.
 * Date: 8/8/12
 * Time: 1:56 AM
 */ ?>


<div class="titleBlock mb20">
    <span><?= @$author->creator->first_name.' '.@$author->creator->last_name; ?> - List of Blog Entries</span>
</div>

<div class="wideContent">
    <div class="wrapper">

        <div class="widget">
            <div class="title"></div>

            <table class="display dTable">

                <thead>

                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created Time</th>
                    <th>Number Of Comments</th>
                    <th>Actions</th>
                </tr>

                </thead>

                <tbody>

                <?php  foreach($files as $item) : ?>

                <tr class="gradeA">
                    <td><?php echo $item->id;?></td>
                    <td><?php echo $item->blog_name;?></td>
                    <td><?php echo $item->created_dt;?></td>
                    <td><?php echo $item->getNumOfComments();?></td>

                    <td class='center'>
                        <?php echo CHtml::link('', array('view', 'id'=>$item->id), array('title'=>'View Blog Entry', 'class'=>'action BtnView'))."\n"; ?>
                        <?php echo CHtml::link('', array('update', 'id'=>$item->id), array('title'=>'Edit Blog Entry', 'class'=>'action BtnEdit'))."\n"; ?>
                        <?php echo CHtml::link('',"", array("submit"=>array('delete', 'id'=>$item->id), 'confirm' => 'Are you sure?', 'title'=>'Delete Blog Entry', 'class'=>'action BtnDelete')); ?>
                    </td>
                </tr>
                    <?php endforeach; ?>

                </tbody>

            </table>
        </div>
    </div>
</div>
