<?php if($type == 'M')
        $tp = 'V';
    else
        $tp = $type; ?>
<div class="titleBlock"><span><?php echo strtoupper($modelName); ?> WIDGET:  View Settings</span>
<span class="blockMenu">
    <?php echo CHtml::link('Asign',array('webAssign/create', 'type'=>$tp,'con_id'=>$model->id)); ?></span></div>
<div class="middleContent">
<?php if( count( $items ) != 0 ): ?>
<?php
// array to disable input fields... if there MUST be inputs???
    $disabled = array('disabled'=>'disabled');
//
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'widget-view-form',
        'htmlOptions'=>array('class'=>'form'),
        'enableAjaxValidation'=>false,
    ));
    ?>
<!--<div class="middleContent">-->
<fieldset>

    <?php foreach( $items as $key=>$item ){ ?>
    <div class="widget">
        <div class="title"><h6><?php echo CHtml::encode( $item->set_name ); ?></h6></div>
        <?php if($item->set_type == 1 || $item->set_type == 2): ?>
        <?php echo $form->textArea($item, "[$key]set_value", CMap::mergeArray($disabled, array('style'=>'width:468px;height:150px;'))); ?>
        <?php else: ?>
        <div class="formRow mt20">
            <!--<div class="formRight">-->
                <?php // in case we need some other controll then textField edit here
                switch($key){
                    default:
                        switch($item->set_type){
                            case 1: // wysiwyg editor
                            case 2: // common text area
                                //echo $form->textArea($item, "[$key]set_value", $disabled); break;
                            case 3: // widget specific
                            default: // text field
                                echo $form->textField($item, "[$key]set_value", $disabled);
                        } // switch($item->set_type){
                } // switch($key){
                ?>
        </div>
        <div class="formRow mb10"></div>
        <div class="clear"></div>
        <?php endif; ?>
    </div>
    <?php } ?>

</fieldset>
    <div class="clear"></div>

<?php //if( count($items) != 0 ) echo CHtml::link('Edit',array('update', 'type'=>$type, 'id'=>$model->id), array('class'=>'btn floatR')); ?>
    <?php //if( count($items) != 0 ) echo CHtml::link('Back',array('index'), array('class'=>'btn floatR')); ?>
    <div class="button-box mt20" style="float: right;">
        <?php if( count($items) != 0 ) echo CHtml::link( 'Edit', array('update', 'type'=>$type, 'id'=>$model->id), array('class'=>'saveBtn')); ?>
        <?php echo CHtml::link( 'Back to List', array('index'), array('class'=>'backBtn')); ?>
    </div>



<?php $this->endWidget(); ?>
<?php else: // display message that there are no settings defined ?>

<div style="height: 30px;"></div>

<h3>No settings defined!!!</h3>
<?php endif; ?>
<!--</div>-->
</div>