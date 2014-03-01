<?php

$reportItems = array();
if (isset($model['items'])) {
    $reportItems = $model['items'];
}
// MyFunctions::echoArray($reportItems);

?>
<div class="wide floatL dotedL">
<div class="pl20 pr0">
<h1 class="dotedB contactTitle aboutTitle mb15"><?php echo empty($model['header']) ? 'Select Report(s) to Purchase' : $model['header'] ?></h1>
<div class="flashMessage"<?php if (!isset($displayFlashMessage) || $displayFlashMessage != true): ?> style="display:none"<?php endif; ?>>
    <p>Item added to shopping cart. Continue shopping or checkout by clicking on your cart above.<p>
</div>
<?php
$id = 'report-purchase-form';
if ( isset($model['purchase_form_id']) ) $id = $model['purchase_form_id'];
$form=$this->beginWidget('CActiveForm', array(
  'id'=>$id,
  // 'action' => $url,
  // 'enableClientValidation' => true,
  // 'clientOptions'=> array('validateOnSubmit'=>true),
  // 'htmlOptions'=>array('class'=>'form'),
  // 'enableAjaxValidation'=>true,
));
?>

<fieldset class="mt30 pb30">
<?php
if (isset($model['tmp_file']) && file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . $model['tmp_file'])) {
    include($model['tmp_file']);
} else {
?>
    <em class="grey" style="font-size: 140%;">N.B. Please note that all prices quoted are in AUD and exclusive of GST. </em><br /><br class="clear" />
    <p class="mb0" style="font-size: 100%;">I would like to order:</p>
    <div id ="reportItemsWrapper">
<?php
    foreach ($reportItems as $key => $reportItem) { ?>
        <div class="clear"></div>
        <dl class="floatL mt20 ml15">

            <dd class="floatL mt10">
                <input id="" class="styled" type="checkbox" name="ReportPurchase[items][]" value="<?php echo $key; ?>" />
            </dd>
            <dt class="floatL ml5 checkBoxLabel">
                <em class="blue" style="font-size: 200%;">$ <?php echo number_format($reportItem['price']); ?></em>
            </dt>

            <dt class="floatL ml5 checkBoxLabel">
                <label><?php echo $reportItem['label']?></label>
            </dt>
        </dl>
    </div>
    <div class="clear"></div>

    <div class="errorMessage ml40 blue" id="priceErrorMessage"<?php if (empty($validationErrors['items'])): ?> style="display:none;"<?php endif; ?>><?php echo empty($model['price_error_msg']) ? 'Please select at least one report to purchase' : $model['price_error_msg'] ?></div>
<?php }} ?>

    <br class="clear" />


    <dl class="floatL mb0 ml15">
        <dd class="floatL mt10">
            <input id="ytReportPurchase_terms" type="hidden" value="0" name="ReportPurchase[terms]" />
            <input id="terms" class="styled" type="checkbox" value="1" name="ReportPurchase[terms]" />
        </dd>
        <dt class="floatL ml5 mr5">
            <label for="terms">I agree to the <a href="#" class="blue" id="terms_popup_button">Terms and Conditions</a></label>
        </dt>
    </dl>
    <div class="clear"></div>
    <div class="errorMessage ml40 blue" id="termsErrorMessage"<?php if (empty($validationErrors['terms'])): ?> style="display:none;"<?php endif; ?>><?php echo empty($model['terms_error_msg']) ? 'Please confirm that you agree to Terms & Conditions' : $model['terms_error_msg'] ?></div>

    <dl class="floatL mb20 ml15">
        <dd>
            <input class="submit btn_blue" style="width: 100px;" type="submit" value="SUBMIT" />
        </dd>
    </dl>
</fieldset>
<?php $this->endWidget(); /**/?>
</div>
</div>
<?php
if (!empty($model['terms_popup_file']) && file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . $model['terms_popup_file'])) {
    require_once($model['terms_popup_file']);
} else {
    require_once('_terms_common.php');
}
?>
<script type="text/javascript">
    /*<![CDATA[*/
    jQuery(function($) {
        jQuery("#terms_popup_button").click(function(e){
            e.preventDefault();
            $("#terms_popup").bPopup({modalClose:false});
            return false;
        });

        jQuery("#report-purchase-form").submit(function(){
            jQuery("#termsErrorMessage").hide();
            jQuery("#priceErrorMessage").hide();
            if ( ! jQuery("#terms").is(':checked')) {
                jQuery("#termsErrorMessage").show();
                return false;
            }
            if (jQuery("#reportItemsWrapper input:checked").length == 0) {
                jQuery("#priceErrorMessage").show();
                return false;
            }
        });

        setTimeout(function(){
            jQuery(".flashMessage").fadeOut()
        },10000);
    });
    /*]]>*/
</script>
