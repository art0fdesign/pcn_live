<div class="titleBlock"><span>CONTENS: View Content - <?php echo $model->name; ?></span>
<span class="blockMenu">
    <?php echo CHtml::link('Asign',array('webAssign/create', 'type'=>'C','con_id'=>$model->id)); ?></span></div>

<?php echo $this->renderPartial('_view', array('model'=>$model,'assignment'=>$assignment)); ?>