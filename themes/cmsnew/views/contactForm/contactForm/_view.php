<?php
// array to disable input fields... if there MUST be inputs???
$disabled = array('disabled'=>'disabled');

$form=$this->beginWidget('CActiveForm', array(
    'id'=>'contact-form',
    'htmlOptions'=>array('class'=>'form'),
    'enableAjaxValidation'=>true,
));
?>
<div class="middleContent">
<fieldset>
    <div class="widget">

        <div class="title1"><h6>Contacts Data</h6></div>



        <div class="formRow mt30">
            <?php echo $form->labelEx($model, 'first_name'); ?>
            <div class="formRight"><?php echo $form->textField($model,'first_name',$disabled); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'last_name'); ?>
            <div class="formRight"><?php echo $form->textField($model,'last_name',$disabled); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'email'); ?>
            <div class="formRight"><?php echo $form->textField($model,'email',$disabled); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'subject'); ?>
            <div class="formRight"><?php echo $form->textField($model,'subject',$disabled); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'created_dt'); ?>
            <div class="formRight"><?php echo $form->textField($model,'created_dt',$disabled); ?></div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <?php echo $form->labelEx($model, 'f_status'); ?>
            <div class="formRight"><?php echo $form->checkBox($model,'f_status',CMap::mergeArray($disabled,array('class'=>'styled'))); ?></div>
            <div class="clear"></div>
        </div>


    </div>
</fieldset>
<fieldset>
    <div class="widget">

        <div class="title"><h6>Message</h6></div>




        <div class="formRight"><?php echo $form->textArea($model,'message',CMap::mergeArray($disabled,array('style'=>'width:98%;height:300px;'))); ?></div>




    </div>
</fieldset>

</div>


<?php $this->endWidget(); ?>