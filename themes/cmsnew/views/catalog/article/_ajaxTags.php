<table>
    <thead>
        <tr>
            <th>Tag</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach( $model->getTagsListArray() as $item ){ ?>
        <tr>
            <td><?php echo $item['cat_name']; ?>::<?php echo $item['tag_name']; ?></td>
            <td><?php echo CHtml::link('', '', array('class'=>'action BtnDelete', 'id'=>'tag_' . $item['tag_id']) ); ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>