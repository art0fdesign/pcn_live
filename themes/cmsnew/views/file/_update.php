<div class="middleContent">
    <div class="widgets">

        <div class="twoOne">
            <div class="widget">
                <?php
                // array to disable input fields... if there MUST be inputs???
                $disabled = array('readonly'=>'readonly');
                $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'file-form',
                    'htmlOptions'=>array('class'=>'form', 'enctype' => 'multipart/form-data'),
                    'enableAjaxValidation'=>true,
                ));
                ?>
                <fieldset>
                    <div class="title1"><h6>File Details</h6></div>

                    <div class="formRow mt30">
                        <?php echo $form->labelEx($model, 'file'); ?>
                        <div class="formRight"> <?php echo $form->fileField($model,'file'); ?></div>
                        <div class="clear"></div>
                    </div>

                    <div class="formRow">
                        <?php echo $form->labelEx($model, 'file_name'); ?>
                        <div class="formRight"><?php echo $form->textField($model,'file_name'); ?></div>
                        <div class="clear"></div>
                    </div>

                    <div class="formRow">
                        <?php echo $form->labelEx($model, 'cat_id'); ?>
                        <div class="formRight"><div class="select-list"><?php echo $form->dropDownList($model,'cat_id',CMap::mergeArray(array("0"=>"no category"),$model->getCategoryOptions())); ?></div></div>
                        <div class="clear"></div>
                    </div>
<!--
                    <div class="formRow">
                        <?php echo $form->labelEx($model, 'file_type'); ?>
                        <div class="formRight"><?php echo $form->textField($model,'file_type',$disabled); ?></div>
                        <div class="clear"></div>
                    </div>

                    <div class="formRow">
                        <?php echo $form->labelEx($model, 'file_size'); ?>
                        <div class="formRight"><?php echo $form->textField($model,'file_size',CMap::mergeArray(array('value'=>$model->getReadableFileSize()),$disabled)); ?></div>
                        <div class="clear"></div>
                    </div>

                    <div class="formRow">
                        <?php echo $form->labelEx($model, 'url'); ?>
                        <div class="formRight"><?php echo $form->textField($model,'url', CMap::mergeArray(array('class'=>'longText','value'=>$model->getFileUrl()),$disabled)); ?></div>
                        <div class="clear"></div>
                    </div>
-->
                    <div class="formRow">
                        <?php echo $form->labelEx($model, 'file_alt'); ?>
                        <div class="formRight"><?php echo $form->textField($model,'file_alt',array('class'=>'longText')); ?></div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="formRow">
                        <?php echo $form->labelEx($model, 'file_title'); ?>
                        <div class="formRight"><?php echo $form->textField($model,'file_title',array('class'=>'longText')); ?></div>
                        <div class="clear"></div>
                    </div>

                    <div class="formRow">
                        <?php echo $form->labelEx($model, 'file_comment'); ?>
                        <div class="formRight"><?php echo $form->textarea($model,'file_comment'); ?></div>
                        <div class="clear"></div>
                    </div>

                    <div class="formRow">
                        <?php echo $form->labelEx($model, 'status'); ?>
                        <div class="formRight"><?php echo $form->checkBox($model,'f_status',array('id'=>'ch3','class'=>'styled')); ?></div>
                        <div class="clear"></div>
                    </div>


                </fieldset>
            </div>
        </div>

<?php /*
        <div class="twoOne">
            <div class="widget">
                <div class="title1"><h6>Thumbnails</h6></div>
                <table class="display sTable tableThumb">
                    <tbody>
                    <?php foreach ($model->listThumbs() as $thumb): ?>
                    <tr class="gradeA thumbRow">
                        <td valign="center"><a href="<?php echo $model->getThumbBaseUrl().$thumb; ?>" rel="lightbox" ><?php echo CHtml::image($model->getThumbBaseUrl().$thumb, '', $model->resizerForThumList($thumb)); ?></a></td>
                        <td><p><strong>Name:</strong><?php echo "\t". $thumb; ?><br />
                            <strong>Resolution:</strong><?php echo "\t". $model->getThumbResolution($thumb); ?><br />
                            <strong>URL:</strong><?php echo "\t". $model->getThumbBaseUrl() . $thumb; ?></p>
                        </td>
                        <td class='center'>
                            <?php echo CHtml::link('',"", array("submit"=>array('deleteThumb', 'id'=>$model->id, 'thumb'=>$model->getThumbPath() . $thumb), 'confirm' => 'Are you sure?', 'title'=>'Delete Thumb', 'class'=>'action BtnDelete')); ?>
                        </td>
                    </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>
*/?>
    </div>
</div>


<div class="rightContent">

<?php if( $model->file_type == 'image' ):?>
    <div class="oneThree" style="margin-left: 0; float: right;">
        <div class="rightWidget widget">
            <div class="title"><h6>File Preview</h6></div>
                <div style="margin: 40px 0 15px 17px;">
                <?php echo CHtml::image($model->getFileThumbUrl( true, 'preview' ) . '?uptime=' . time(), $model->file_alt, array()); ?>
            </div>
        </div>
    </div>
<?php endif;?>

    <div class="clear"></div>
    <div class="widgets">

        <div class="oneThree" style="margin-left: 0; float: right;">
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
                <?php echo CHtml::submitButton('Save', array('name'=>'save', 'class'=>'saveBtn')); ?>
                <?php echo CHtml::link('Back to List',array('index'), array('class'=>'backBtn')); ?>
            </div>

            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>

