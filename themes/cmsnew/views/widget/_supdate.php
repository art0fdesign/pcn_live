
<div class="titleBlock ">
    <span><?php echo strtoupper($modelName); ?> WIDGET:  Update Settings</span>
</div>

<?php
// array with keys that will display in wysiwyg editor
$wysiwygKeys = array(  );
//
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'widget-update-form',
    'htmlOptions'=>array('class'=>'form'),
    'enableAjaxValidation'=>false,
));
?>
<div class="middleContent">
<fieldset>

<?php foreach( $items as $key=>$item ){ ?>
    <div class="widget">
        <div class="title"><h6><?php echo CHtml::encode( $item->set_name ); ?></h6></div>
        <?php /** WYSIWYG Editor   */ ?>
        <?php if( in_array( $key, $wysiwygKeys ) || $item->set_type == 1 ): ?>
            <?php echo $form->textArea($item, "[$key]set_value", array( 'class'=>'textEditor', 'style'=>'width:97%; height:100%')); ?>
        <?php elseif($item->set_type == 2): ?>
            <?php echo $form->textArea($item, "[$key]set_value", array('style'=>'width:468px;height:150px;')); ?>
        <?php else: /** Controls other then WYSIWYG Editor */ ?>
        <div class="formRow mt20">
            <?php //echo CHtml::encode( $item->set_name ); ?>
            <!--<div class="formRight">-->
                <?php // in case we need some specifyc display set it here referencing on set_key
                switch($key){
                    /** set_key specific settings */
                    case 'text-area-setting-key':
                        echo $form->textField($item, "[$key]set_value", array());
                        break;
                    /** set_type predefined settings */
                    default: // display according to set_type option
                        switch($item->set_type){
                            case 1: // wysiwyg editor is triggered above
                            case 2: // common text area
                                //echo $form->textArea($item, "[$key]set_value", array('style'=>'width:468px;height:150px;')); break;
                            case 3: // widget specific->better define above
                            default: // text field
                                echo $form->textField($item, "[$key]set_value");
                        } // switch($item->set_type){

                }
                ?>
        </div>
        <div class="formRow mb10"></div>
        <div class="clear"></div>
        <!--</div>-->
        <?php endif; ?>
    </div>
<?php } ?>

</fieldset>
    <div class="clear"></div>
<div class="button-box mt20" style="float: right;">
<?php echo CHtml::submitButton('Save', array('name'=>'save', 'class'=>'saveBtn')); ?><br/>
<?php echo CHtml::link('Back to List',array('view', 'type'=>$type, 'id'=>$model->id), array('class'=>'backBtn')); ?>
</div>

<?php //echo CHtml::link('Back',array('view'), array('class'=>'btn floatR')); ?>

<?php $this->endWidget(); ?>
</div>