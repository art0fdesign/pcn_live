<?php
// array to disable input fields... if there MUST be inputs???
$disabled = array('disabled'=>'disabled');

$form=$this->beginWidget('CActiveForm', array(
    'id'=>'web-content-form',
    'htmlOptions'=>array('class'=>'form'),
    'enableAjaxValidation'=>true,
));
?>
<div class="middleContent">
<fieldset>
    <div class="widget">

        <div class="title1"><h6>Content Data</h6></div>


        <div class="formRow mt40">
            <?php echo $form->labelEx($model, 'name'); ?>
            <div class="formRight"><?php echo $form->textField($model,'name',$disabled); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'lang_id'); ?>
            <div class="formRight"><div class="select-list"><?php echo $form->dropDownList($model,'lang_id',Language::getLanguagesOptions(),$disabled); ?></div>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow mb10">
            <?php echo $form->labelEx($model, 'f_status'); ?>
            <div class="formRight"><?php echo $form->checkBox($model,'f_status', CMap::mergeArray($disabled,array('class'=>'styled'))); ?>
                <label for="ch3">active</label></div>
            <div class="clear"></div>
        </div>

    </div>
</fieldset>
<fieldset>
    <div class="widget">

        <div class="title"><h6>Content Data</h6></div>

        <?php echo $form->textArea($model,'content',CMap::mergeArray($disabled,array('style'=>'width:468px;height:150px;'))); ?>

    </div>
</fieldset>
</div>
<div class="rightContent">
    <div class="rightWidget widget">
        <div class="title">
            <h6>Assigned To</h6></div>
        <div class="formRow mt30"></div>
            <?php $i = 1; foreach($assignment as $assign): ?>
                <div class="formRow" style="font-size: 11px;line-height: 15px;padding: 5px 30px 5px 10px;position:relative;<? if($i%2!=0) echo 'background-color:#f5f5f5';?>">
                    <b style="width: 60px;"><?php echo $assign['assign_type']=='P'? 'Page' : 'Template'; ?>:</b>
                    <span><?php echo WebAssign::model()->getPageTempName($assign['assign_type'],$assign['page_temp_id']);?></span>  <br />
                    <b style="width: 60px;">sector:</b>
                    <span><?php echo WebAssign::model()->getContentName($assign['content_type'],$assign['content_id']);?></span>
                    <? $url = Yii::app()->theme->baseUrl."/img/ico_edit.png"; echo CHtml::link('<img src="'.$url.'" />',array('webAssign/update','id'=>$assign['id']),array('style'=>'position:absolute;right:10px;top:10px;'));?>
                </div>
            <?php $i++; endforeach; ?>
        <div class="formRow mb25">
           <?php echo CHtml::link("new content assignment",array('webAssign/create','type'=>"C",'con_id'=>$model->id),array('style'=>"color:#419FEC;float:right;text-decoration:underline;font-style:italic;padding-right:10px;"));?>
        </div>


    </div>

    <div class="rightWidget widget">
        <div class="title">
            <h6>System info</h6>
        </div>
        <div class="formRow mt30">
            <b>Created by: </b>
            <span><?= @$model->creator->first_name.' '.@$model->creator->last_name; ?></span>
        </div>
        <div class="formRow">
            <b>Created: </b>
            <span><?= $model->created_dt; ?></span>
        </div>
        <div class="formRow">
            <b>Modified by: </b>
            <span><?= @$model->editor->first_name.' '.@$model->editor->last_name; ?></span>
        </div>
        <div class="formRow mb20">
            <b>Modified: </b>
            <span><?= $model->changed_dt; ?></span>
        </div>
    </div>
    <div class="button-box mt20">
        <?php echo CHtml::link('Edit',array('update', 'id'=>$model->id), array('class'=>'saveBtn')); ?>
        <?php echo CHtml::link('or back to list',array('index'), array('class'=>'backBtn')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>