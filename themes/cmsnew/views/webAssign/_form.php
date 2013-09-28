<?php
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'web-assign-form',
    'htmlOptions'=>array('class'=>'form'),
    'enableAjaxValidation'=>true,
));
?>
<div class="middleContent">
    <fieldset>
        <div class="widget">

            <div class="title1"><h6>Assignment Data</h6></div>



            <?php
            $items = array("P"=>"Page","T"=>"Template")?>

            <div class="formRow mt30">
                <?php echo $form->labelEx($model, 'assign_type'); ?>
                <div class="formRight">
                    <div class="select-list"><?php echo $form->dropDownList($model,'assign_type', $items,array('empty'=>'--select type--','ajax'=>array(
                        'type' => 'POST',
                        'url' =>CController::createUrl('webAssign/getPageTempList'),
                        'dataType'=>'json',
                        //'data'=>array('color'=>'js: $(this).val()'),
                        //'update' => '#page_temp_id'
                        'success'=>'function(data) {
                            $("#page_temp_id").html(data.pageTemp);
                            $("#sector_id").html(data.sector);
                            $("#tplSectorImage").empty();
                         }',
                    )) ); ?></div>
                    <?php echo $form->error($model,'sector_id'); ?></div>
                <div class="clear"></div>
            </div>

            <?
            $items = array();
            if($model->page_temp_id == '0')
            $items = array('empty'=>'--select page or template-');
            else{
                if($model->assign_type == 'P'){
                    $items = WebPages::model()->getPagesOptions();
                    //$items = array($row->id => $row->name);

                }elseif($model->assign_type == 'T'){
                    $items = Template::model()->getTemplatesOptions();
                    //$items = array($row->id => $row->name);
                }

            }
            ?>

            <div class="formRow">
                <?php echo $form->labelEx($model, 'page_temp_id'); ?>
                <div class="select-list"><div class="formRight"><?php echo $form->dropDownList($model,'page_temp_id',$items, array('id'=>'page_temp_id','ajax' => array(
                        'type' => 'POST',
                        'url' => CController::createUrl('webAssign/getSectorByPageTemp'),
                        'dataType'=>'json',
                        //'update' => '#sector_id'
                        'success'=>' function(data) {
                            $("#sector_id").empty().html(data.options);
                            $("#tplSectorImage").empty().html(data.image);
                        }',
                    )
                    )
                );
                    ?></div>
                    <?php echo $form->error($model,'page_temp_id'); ?></div>
                <div class="clear"></div>
            </div>

            <?
                $items = array();
                if($model->sector_id == '0')
                    $items = array('empty'=>'--select sector--');
                else{
                    $row = TemplateSector::model()->findAll();

                    foreach ($row as $r){
                         if($model->assign_type == $r->sector_type)
                            $items[$r->id] = $r->name;
                }

            }
            ?>
            <div class="formRow">
                <?php echo $form->labelEx($model, 'sector_id'); ?>
                <div class="formRight">
                    <div class="select-list"><?php echo $form->dropDownList($model,'sector_id', $items,array('id'=>'sector_id') ); ?></div>
                    <?php echo $form->error($model,'sector_id'); ?></div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model, 'content_type'); ?>
                <div class="formRight"><div class="select-list"><?php echo $form->dropDownList($model,'content_type', WebAssign::getTypeOptions(),  array('empty' => '--select type--','ajax' => array(
                        'type' => 'POST',
                        'url' => CController::createUrl('webAssign/getContentByType'),
                        'update' => '#content_id'
                    )
                    )
                );
                    ?> </div>
                    <?php echo $form->error($model,'content_type'); ?></div>
                <div class="clear"></div>
            </div>
            <?
            $items = array();
            switch($model->content_type){
                case "C":
                    $items = WebContent::getContentsOptions();
                    break;
                case "W":
                    $items = Widget::getWidgetOptions();
                    break;
                case "V":
                    $items = Widget::getModuleWidgetOptions();
                    break;
                case "M":
                    $items = Menu::getMenusOptions();
                    break;

            }
            ?>
            <div class="formRow">
                <?php echo $form->labelEx($model, 'content_id'); ?>
                <div class="formRight"><div class="select-list"><?php echo $form->dropDownList($model,'content_id', $items,array('id'=>'content_id') ); ?></div>
                    <?php echo $form->error($model,'content_id'); ?></div>
                <div class="clear"></div>
            </div>





            <div class="formRow">
                <?php echo $form->labelEx($model, 'content_order'); ?>
                <div class="formRight"><?php echo $form->textField($model,'content_order'); ?>
                    <?php echo $form->error($model,'content_order'); ?></div>
                <div class="clear"></div>
            </div>

            <div class="formRow">
                <?php echo $form->labelEx($model, 'f_status'); ?>
                <div class="formRight"><?php echo $form->checkBox($model,'f_status', array('class'=>'styled')); ?>
                    <label for="ch3">active</label></div>
                <div class="clear"></div>
            </div>
        </div>

    </fieldset>
</div>
<div class="rightContent">
    <div class="rightWidget widget">
        <div class="title">
            <h6>Page Sectors</h6>
        </div>

        <div id="tplSectorImage" style="margin: 40px 0 0 17px;">
            <?php if( !$model->isNewRecord ) echo CHtml::image( $model->getSectorsImageSrc(), '' ); ?>
        </div>
        
    </div>

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
