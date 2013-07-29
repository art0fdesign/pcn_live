
<div class="titleBlock mb20">
    <span>BLOG: List of Posts</span>
</div>

<div class="wideContent">
    <div class="wrapper">

        <div class="widget">
            <div class="title"></div>

            <table class="display dTable">

                <thead>

                <tr>
                    <th class="center">ID</th>
                    <th>Name</th>
                    <th>Author</th>
                    <th>Created Time</th>
                    <th>Comments</th>
                    <th class="center">Actions</th>
                </tr>

                </thead>

                <tbody>

                <?php  foreach($files as $item) : ?>

                <tr class='<?php if($item->f_status==1) echo 'gradeA'; else echo 'gradeC'; ?>'>
                    <td class="center"><?php echo $item->id;?></td>
                    <td><?php echo $item->blog_name;?></td>
                    <td><?php echo $item->blog_author; ?></td>
                    <td><?php echo $item->created_dt;?></td>
                    <td><?php echo $item->getNumOfComments('index'). ' ' .$item->getRightTextForComments();?></td>

                    <td class='center'>
                        <?php echo CHtml::link('', array('view', 'id'=>$item->id), array('title'=>'View Blog Post', 'class'=>'action BtnView'))."\n"; ?>
                        <?php echo CHtml::link('', array('update', 'id'=>$item->id), array('title'=>'Edit Blog Post', 'class'=>'action BtnEdit'))."\n"; ?>
                        <?php echo CHtml::link('', '', array('submit'=>array('activate', 'id'=>$item->id), 'title'=>'Active/Inactive', 'class'=>'action BtnRead')); ?>
                        <?php echo CHtml::link('',"", array("submit"=>array('delete', 'id'=>$item->id), 'confirm' => 'Are you sure?', 'title'=>'Delete Blog Post', 'class'=>'action BtnDelete')); ?>
                    </td>
                </tr>
                    <?php endforeach; ?>

                </tbody>

            </table>
            <div class="tfooter">Total number of Posts: <?php echo count($files);?></div>
        </div>
    </div>
</div>
