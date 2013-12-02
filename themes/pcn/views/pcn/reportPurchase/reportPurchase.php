<?php

$reportItems = array();
if ( ! empty(Yii::app()->params['pcnPurchaseReports'])) {
    $reportItems = Yii::app()->params['pcnPurchaseReports'];
}
// MyFunctions::echoArray($reportItems);

?>
<div class="wide floatL dotedL">
<div class="pl20 pr0">
<h1 class="dotedB contactTitle aboutTitle mb15">Select Report(s) to Purchase</h1>
<?php

$form=$this->beginWidget('CActiveForm', array(
  'id'=>'report-purchase-form',
  // 'action' => $url,
  // 'enableClientValidation' => true,
  // 'clientOptions'=> array('validateOnSubmit'=>true),
  // 'htmlOptions'=>array('class'=>'form'),
  // 'enableAjaxValidation'=>true,
));
?>

<fieldset class="mt30 pb30">
    <em class="grey" style="font-size: 140%;">N.B. Please note that all prices quoted are in AUD and inclusive of GST. </em><br /><br class="clear" />
    <p class="mb0" style="font-size: 100%;">I would like to order:</p>
    <br class="clear" />
<?php foreach ($reportItems as $key => $reportItem): ?>
    <dl class="floatL mb20 ml15">

        <dd class="floatL mt10">
            <input id="" class="styled" type="checkbox" name="ReportPurchase[items][]" value="<?php echo $key; ?>" />
        </dd>
        <dt class="floatL ml5">
            <em class="blue" style="font-size: 200%;">$ <?php echo number_format($reportItem['price']); ?></em>
        </dt>

        <dt class="floatL ml5">
            <label><?php echo $reportItem['label']?></label>
        </dt>
    </dl><br class="clear" />
<?php endforeach; ?>
<?php if ( ! empty($validationErrors['items'])): ?>
    <dl class="floatL mb0 ml15">
        <dd class="floatL">
            <div class="errorMessage"><?php echo $validationErrors['items']; ?></div>
        </dd>
    </dl><br class="clear" />
<?php endif; ?>


    <dl class="floatL mb0 ml15">
        <dd class="floatL mt10">
            <input id="ytReportPurchase_terms" type="hidden" value="0" name="ReportPurchase[terms]" />
            <input id="" class="styled" type="checkbox" value="1" name="ReportPurchase[terms]" />
        </dd>
        <dt class="floatL ml5 mr5">
            <label for="ytReportPurchase_terms">I agree to the </label>
        </dt>
    </dl>
    <p class="accordionButton pt10"><a href="#" class="blue" id="popup_popUp">Terms and Conditions</a></p>
    <!--<div class="accordionContent mt30 mb20">
        <ul class="links">
            <li>No part of this publication may be reproduced, resold, stored in or introduced into any retrieval system of any nature or transmitted in any form or by any means (electronic, mechanical, photocopying, recording or otherwise) without the prior consent of Payments Consulting Network (PCN).</li>
            <li>The Subscriber/User is responsible for any breach of copyright committed by accessing the PCN material.</li>
            <li>This report is sold as a single-user license which permits the following use of the material, without the prior written consent of PCN:<br /> a) Paper copy: allows the Authorised User to circulate the original paper issue within his/her organisation; and<br /> b) Electronic copy: The Registered User only may access the PDF which cannot be published, circulated or redistributed electronically outside the Authorised User&rsquo;s organisation.</li>
            <li>Notwithstanding the above, the Subscriber/User is not permitted to make the material available to clients, consultants or to any other third parties.</li>
        </ul>
    </div>--><br class="clear" />
<?php if ( ! empty($validationErrors['terms'])): ?>
    <dl class="floatL mb0 ml15">
        <dd class="floatL">
            <div class="errorMessage"><?php echo $validationErrors['terms']; ?></div>
        </dd>
    </dl><br class="clear" />
<?php endif; ?>


    <dl class="floatL mb20 ml15">
        <dd>
            <input class="submit btn_blue" style="width: 100px;" type="submit" value="SUBMIT" />
        </dd>
    </dl>
</fieldset>
<?php $this->endWidget(); /**/?>
</div>
</div>

<?php echo Frontend::replaceAllTagsInContent(@$settings['terms-and-conditions']['set_value']) ?>

