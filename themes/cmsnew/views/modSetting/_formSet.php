<?php
/**
 * Created by Lemmy.
 * Date: 11/14/12
 * Time: 4:28 PM
 */?>
<?php
if($this->getAction()->getId() === 'updateS') $disabled = array('readonly'=>'readonly');
else $disabled = array();
// Sys Info Panel date format
$dtFormat = $this->getCMSSetting( 'sysinfo_dt_format', 'Y-m-d H:i' );
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'mod-setting-form',
    'htmlOptions'=>array('class'=>'form'),
    'enableAjaxValidation'=>true,
)); ?>
<div class="middleContent">
    <fieldset>
        <div class="widget">

            <div class="title1"><h6>Setting Data</h6></div>

            <div class="formRow mt30">
                <div class="formRight">
                    <?php echo $form->errorSummary($model); ?>
                </div>
                <div class="clear"></div>
            </div>

            <?php
            if(get_class($widget) === 'ModView')
                $widgetId = $widget->mod_id;
            else
                $widgetId = $widget->id;
            ?>

            <div class="formRow">
                <?php echo $form->labelEx($model,'mod_id'); ?>
                <div class="formRight">
                    <?php echo CHtml::textField('mod_id', $model->getModIdOptions($widgetId), array('readonly'=>'readonly')); ?>
                    <?php echo $form->error( $model, 'mod_id' ); ?>
                </div>
                <div class="clear"></div>
            </div>

            <?php if(get_class($widget) === 'ModView'):?>
            <div class="formRow">
                <?php echo $form->labelEx($model,'view_id'); ?>
                <div class="formRight">
                    <?php echo CHtml::textField('view_id',$model->getWidgetName($widget->id), array('readonly'=>'readonly')); ?>
                    <?php echo $form->error( $model, 'view_id' ); ?>
                </div>
                <div class="clear"></div>
            </div>
            <?php endif; ?>

            <div class="formRow">
                <?php echo $form->labelEx($model,'set_key'); ?>
                <div class="formRight">
                    <?php echo $form->textField($model,'set_key',$disabled); ?>
                    <?php echo $form->error( $model, 'set_key' ); ?>
                </div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model,'set_name'); ?>
                <div class="formRight">
                    <?php echo $form->textField($model,'set_name',array('size'=>50,'maxlength'=>50)); ?>
                    <?php echo $form->error( $model, 'set_name' ); ?>
                </div>
                <div class="clear"></div>
            </div>

            <? /*<div class="formRow">
                <?php echo $form->labelEx($model,'set_value'); ?>
                <div class="formRight">
                    <?php echo $form->textArea($model,'set_value',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error( $model, 'set_value' ); ?>
                </div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model,'set_default'); ?>
                <div class="formRight">
                    <?php echo $form->textArea($model,'set_default',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error( $model, 'set_default' ); ?>
                </div>
                <div class="clear"></div>
            </div> */?>

            <div class="formRow">
                <?php echo $form->labelEx($model,'set_type'); ?>
                <div class="select-list"><div class="formRight">
                    <?php echo $form->dropDownList($model,'set_type', $model->getTypeOptions()); ?>
                    <?php echo $form->error( $model, 'set_type' ); ?>
                </div></div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model,'comment'); ?>
                <div class="formRight">
                    <?php echo $form->textArea($model,'comment',array()); ?>
                    <?php echo $form->error( $model, 'comment' ); ?>
                </div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model,'f_status'); ?>
                <div class="formRight">
                    <?php echo $form->checkBox($model,'f_status', array('id'=>'ch3', 'class'=>'styled')); ?>
                    <?php echo $form->error( $model, 'f_status' ); ?>
                    <label for="ch3">active</label>
                </div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model,'f_editable'); ?>
                <div class="formRight">
                    <?php echo $form->checkBox($model,'f_editable', array('id'=>'ch4', 'class'=>'styled'));; ?>
                    <?php echo $form->error( $model, 'f_editable' ); ?>
                    <label for="ch4">editable</label>
                </div>
                <div class="clear"></div>
            </div>

        </div>
    </fieldset>

    <fieldset>
        <div class="widget">
            <div class="title"><h6>Value</h6></div>
            <?php echo $form->textArea($model,'set_value',array('style'=>'width:468px;height:150px;', 'class'=>'textEditor')); ?>
        </div>
    </fieldset>

    <fieldset>
        <div class="widget">
            <div class="title"><h6>Default Value</h6></div>
            <?php echo $form->textArea($model,'set_default',array('style'=>'width:468px;height:150px;', 'class'=>'textEditor')); ?>
        </div>
    </fieldset>

</div>

<!-- INFO PANEL -->
<div class="rightContent">
    <div class="rightWidget widget">
        <div class="title"><h6>System Info</h6></div>

        <div class="formRow mt30">
            <b>Created by: </b>
            <span><?php echo @$model->creator->first_name.' '.@$model->creator->last_name; ?></span>
        </div>

        <div class="formRow">
            <b>Created: </b>
            <span><?php echo $model->isNewRecord ? '': date( $dtFormat, strtotime( @$model->created_dt ) ); ?></span>
        </div>

        <div class="formRow">
            <b>Modified by: </b>
            <span><?php echo @$model->editor->first_name.' '.@$model->editor->last_name; ?></span>
        </div>

        <div class="formRow mb20">
            <b>Modified: </b>
            <span><?php echo $model->isNewRecord ? '': date( $dtFormat, strtotime( @$model->changed_dt ) ); ?></span>
        </div>
    </div>

    <div class="button-box mt20">
        <?php echo CHtml::submitButton( $model->isNewRecord ? 'Create' : 'Save', array('name'=>'save', 'class'=>'saveBtn')); ?>
        <?php
        $modID = '';
        $viewID = '';
        if(get_class($widget) === 'ModView'){
            $modID = $widget->mod_id;
            $viewID = $widget->id;
        }else{
            $modID = $widget->id;
            $viewID = 0;
        }
        ?>
        <?php echo CHtml::link( 'Back to List', array('indexSet', 'mod_id'=>$modID, 'view_id'=>$viewID), array('class'=>'backBtn')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>
