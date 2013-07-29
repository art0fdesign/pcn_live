<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'template-form',
    'htmlOptions'=>array('class'=>'form'),
	'enableAjaxValidation'=>true,
)); 
// prepares page/content divs; default: hide both
$displayPageDiv = ' style="display:none;"'; 
$displayContentDiv = ' style="display:none;"';
$displayValueDiv = ' style="display:none;"';
switch($model->li_type){
    case 2: // Link To Page... Unhide Page
        $displayPageDiv = '';
        $displayValueDiv = '';
        break;
    case 3: // Link To Content... Unhide Content
        $displayContentDiv = '';
        $displayValueDiv = '';
        break;
    case 1: // Link to HTML... Leave hidden
        $displayValueDiv = '';
        break;
    default:
}
?>

    <fieldset>
    <div class="widget">
    
        <div class="title"><h6>Menu Item Data</h6></div>
        
        <div class="formRow">
            <div class="formRight">
                <?php echo $form->errorSummary($model); ?>
            </div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'menu_order'); ?>
            <div class="formRight"><?php echo $form->textField($model,'menu_order'); ?>
            <?php echo $form->error($model,'menu_order'); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'parent_id'); ?>
            <div class="formRight"><?php echo $form->dropDownList($model,'parent_id', CMap::mergeArray(array('0'=>'(Select Parent Menu)'), $model->getParentOptions($model->menu_id))); ?>
            <?php echo $form->error($model,'parent_id'); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'name'); ?>
            <div class="formRight"><?php echo $form->textField($model,'name'); ?>
            <?php echo $form->error($model,'name'); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'caption'); ?>
            <div class="formRight"><?php echo $form->textField($model,'caption'); ?>
            <?php echo $form->error($model,'description'); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'description'); ?>
            <div class="formRight"><?php echo $form->textField($model,'description'); ?>
            <?php echo $form->error($model,'description'); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'li_options'); ?>
            <div class="formRight"><?php echo $form->textField($model,'li_options'); ?>
            <?php echo $form->error($model,'li_options'); ?></div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="widget">
    
        <div class="title"><h6>Link Data</h6></div>
        
        <div class="formRow">
            <?php echo $form->labelEx($model, 'li_type'); ?>
            <div class="formRight"><?php echo $form->dropDownList($model,'li_type', $model->getTypeOptions(), array('id'=>'li_type_select')); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow" id="li_page_div"<?php echo $displayPageDiv; ?>>
            <?php echo $form->labelEx($model, 'li_page'); ?>
            <div class="formRight"><?php echo $form->dropDownList($model,'li_page', $model->getPageOptions(), array('id'=>'li_page_select')); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow" id="li_content_div"<?php echo $displayContentDiv; ?>>
            <?php echo $form->labelEx($model, 'li_content'); ?>
            <div class="formRight"><?php echo $form->dropDownList($model,'li_content', $model->getContentOptions(), array('id'=>'li_content_select')); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow" id="li_value_div"<?php echo $displayValueDiv; ?>>
            <?php echo Chtml::label($model->getAttributeLabel('li_value'), ''); ?>
            <div class="formRight"><?php echo $form->textField( $model, 'li_value' ); ?></div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <?php echo $form->labelEx($model, 'f_status'); ?>
            <div class="formRight"><?php echo $form->checkBox($model,'f_status', array('id'=>'ch3')); ?>
            <label for="ch3">active</label></div>
            <div class="clear"></div>
        </div>

    </div>
    </fieldset>

    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('name'=>'save', 'class'=>'btn floatR')); ?>

<script>
    $("#li_type_select").change(function(){
        var typeVal = $(this).val();
        //alert( typeVal ); return false;
        switch( typeVal ){
            case '2':
                $("#li_content_div").hide();
                $("#li_content_select").val(0).prev().html(' ');
                $("#li_page_div").show();
                $("#li_value_div label").html('Page Sector:');
                $("#li_value_div").show();
                break;
            case '3':
                $("#li_page_div").hide();
                $("#li_page_select").val(0).prev().html(' ');
                $("#li_content_div").show();
                $("#li_value_div label").html('Content Sector:');
                $("#li_value_div").show();
                break;                
            case '1':
                $("#li_value_div label").html('URL:');
                $("#li_value_div").show();
                break;
            default: 
                $("#li_page_div").hide();
                $("#li_page_select").val(0).prev().html(' ');
                $("#li_content_div").hide();
                $("#li_content_select").val(0).prev().html(' ');
                $("#li_value_div").hide();
        }
    });
</script>

<?php $this->endWidget(); ?>
