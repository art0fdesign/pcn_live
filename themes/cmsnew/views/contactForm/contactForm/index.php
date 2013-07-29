<div class="titleBlock"><span>CONTACT FORM: List of Contacts</span></div>

<div class="wideContent">
    <!-- Table -->
    <div class="widget">
        <div class="title"> </div>

        <table class="display dTable">
            <thead>
            <tr>

                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Received</th>

                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?  foreach ($forms as $n) : ?>

            <tr class='<?php if($n->f_status==1) echo "gradeA"; else echo "gradeC"; ?>'>
                <td><?=$n->first_name;?></td>
                <td><?=$n->last_name;?></td>
                <td><?=$n->email;?></td>
                <td><?=$n->created_dt;?></td>

                <td class='center' >
                    <?php echo CHtml::link('', array('view', 'id'=>$n->id), array('title'=>'View Forms', 'class'=>'action BtnView'))."\n"; ?>
                    <?php echo CHtml::link('',"", array("submit"=>array('activate', 'id'=>$n->id), 'title'=>'Active/Inactive', 'class'=>'action BtnRead')); ?>
                    <?php echo CHtml::link('',"", array("submit"=>array('delete', 'id'=>$n->id), 'confirm' => 'Are you sure?', 'title'=>'Delete Forms', 'class'=>'action BtnDelete')); ?>
                </td>
            </tr>
                <? endforeach; ?>



            </tbody>
        </table>
    </div>

</div>
