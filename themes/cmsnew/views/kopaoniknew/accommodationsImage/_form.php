<?php
$url = $this->createUrl('accommodationsImage/uploadHandler', array('id'=>$model->id));
$this->widget('application.extensions.swfupload.CSwfUpload', array(
        'postParams'=>array(),
        'config'=>array(
            'use_query_string'=>true,
            'upload_url'=>CHtml::normalizeUrl($url),
            'file_size_limit'=>'5 MB',
            'file_types'=>'*.JPG;*.jpg;*.png;*.gif',
            'file_types_description'=>'Image Files',
            'file_upload_limit'=>15,
            'file_queue_error_handler'=>'js:fileQueueError',
            'file_dialog_complete_handler'=>'js:fileDialogComplete',
            'upload_progress_handler'=>'js:uploadProgress',
            'upload_error_handler'=>'js:uploadError',
            'upload_success_handler'=>'js:uploadSuccess',
            'upload_complete_handler'=>'js:uploadComplete',
            'custom_settings'=>array('upload_target'=>'divFileProgressContainer'),
            'button_placeholder_id'=>'swfupload',
            'button_width'=>200,
            'button_height'=>20,
            'button_text'=>'<span class="button">'.Yii::t('messageFile', 'Upload Images').' (Max 5MB per file)</span>',
            'button_text_style'=>'.button { font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif; font-size: 11pt; text-align: center; }',
            'button_text_top_padding'=>0,
            'button_text_left_padding'=>10,
            'button_window_mode'=>'js:SWFUpload.WINDOW_MODE.TRANSPARENT',
            'button_cursor'=>'js:SWFUpload.CURSOR.HAND',
        ),
    )
);
?>
<div class="middleContent">
    <div id="main-content">
        <form>
            <div class="form">
                <div class="row">
                    <div class="swfupload"  style="display: inline; border: solid 1px #7FAAFF; background-color: #C5D9FF; padding: 2px;">
                        <span id="swfupload"></span>
                    </div>
                    <div id="divFileProgressContainer" style="height: 75px;"></div>
                    <div id="thumbnails"></div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="rightContent">
    <div class="button-box mt20">
        <?php //echo CHtml::link( 'Edit', array('update', 'id'=>$model->id), array('class'=>'saveBtn')); ?>
        <?php echo CHtml::link( 'Back to List', array('index', 'id'=>$model->id), array('class'=>'backBtn')); ?>
    </div>
</div>
