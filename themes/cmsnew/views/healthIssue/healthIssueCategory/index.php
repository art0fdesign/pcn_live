<?php //$this->layout = '//layouts/wrapper'; ?>

<div class="titleBlock mb20">
    <span>List of Health Issues Categories</span>

</div>


<div class="wideContent">
    <div class="wrapper">
            <div class="widget">
                <div class="title">
                    <!--<div class="filter">
                        <span><a>Filter by:</a></span>
                    </div>-->
                </div>

                <table class="display dTable">

                    <thead>

                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>

                    </thead>

                    <tbody>

                    <?php  foreach($files as $item) : ?>

                    <tr class="gradeA">
                        <td><div align="center"><?php echo $item->id;?></div></td>
                        <td><?php echo $item->cat_name;?></td>

                        <td class='center'>
                            <?php echo CHtml::link('', array('view', 'id'=>$item->id), array('title'=>'View Category ', 'class'=>'action BtnView'))."\n"; ?>
                            <?php echo CHtml::link('', array('update', 'id'=>$item->id), array('title'=>'Edit Category', 'class'=>'action BtnEdit'))."\n"; ?>
                            <?php echo CHtml::link('',"", array("submit"=>array('delete', 'id'=>$item->id), 'confirm' => 'Are you sure?', 'title'=>'Delete Category', 'class'=>'action BtnDelete')); ?>
                        </td>
                    </tr>
                        <?php endforeach; ?>

                    </tbody>

                </table>
            </div>
    </div>
</div>
