<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'article-form',
    'htmlOptions'=>array('class'=>'form', 'enctype'=>'multipart/form-data'),
	'enableAjaxValidation'=>true,
)); ?>
<div class="middleContent">
    <fieldset>
    <div class="widget">
    
        <div class="title1"><h6>Article Data</h6></div>
        

        <div class="formRow mt30">
    		<?php echo $form->labelEx($model,'cat_id'); ?>
            <div class="formRight"><div class="select-list">
        		<?php echo $form->dropDownList($model,'cat_id', CMap::mergeArray( array('--select catagory--'), ArticleCategory::getCategoryOptions())); ?></div>
        		<?php echo $form->error($model,'cat_id'); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'name'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
        		<?php echo $form->error($model,'name'); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'int_code'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'int_code',array('size'=>60,'maxlength'=>100)); ?>
        		<?php echo $form->error($model,'int_code'); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'price'); ?>
            <div class="formRight">
        		<?php echo $form->textField($model,'price',array('size'=>9,'maxlength'=>9)); ?>
        		<?php echo $form->error($model,'price'); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'image'); ?>
            <div class="formRight">
                <?php echo $form->fileField($model,'image'); ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
    		<?php echo $form->labelEx($model,'img_cart'); ?>
            <div class="formRight">
                <?php echo $form->fileField($model,'img_cart'); ?>
            </div>
            <div class="clear"></div>
        </div>




        <div class="formRow mb20">
            <?php echo $form->labelEx($model, 'f_status'); ?>
            <div class="formRight"><?php echo $form->checkBox($model,'f_status', array('id'=>'ch3','class'=>'styled')); ?>
                <label for="ch3">active</label></div>
            <div class="clear"></div>
        </div>




    </div>
    </fieldset>
    <fieldset>
        <div class="widget">

            <div class="title"><h6>Specifications</h6></div>

            <?php echo $form->textArea($model,'desc_gen_info',array('class'=>'textEditor')); ?>

        </div>
    </fieldset>
    <fieldset>
        <div class="widget">

            <div class="title"><h6>Description</h6></div>

            <?php echo $form->textArea($model,'description',array('class'=>'textEditor')); ?>

        </div>
    </fieldset>
</div>
<div class="rightContent">
    <div class="rightWidget widget">
        <div class="title">
            <h6>System info</h6>
        </div>
        <div class="formRow mt30">
            <b>Created by: </b>
            <span><?if( !$model->isNewRecord ) echo @$model->creator->first_name.' '.@$model->creator->last_name; ?></span>
        </div>
        <div class="formRow">
            <b>Created: </b>
            <span><?if( !$model->isNewRecord ) echo $model->created_dt; ?></span>
        </div>
        <div class="formRow">
            <b>Modified by: </b>
            <span><?if( !$model->isNewRecord ) echo @$model->editor->first_name.' '.@$model->editor->last_name; ?></span>
        </div>
        <div class="formRow mb20">
            <b>Modified: </b>
            <span><?if( !$model->isNewRecord ) echo $model->changed_dt; ?></span>
        </div>
    </div>
    <div class="button-box mt20">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('name'=>'save', 'class'=>'saveBtn')); ?>
        <?php echo CHtml::link('or back to list',array("index"),array('class'=>'backBtn')); ?>
    </div>
</div>


<?php $this->endWidget(); ?>
