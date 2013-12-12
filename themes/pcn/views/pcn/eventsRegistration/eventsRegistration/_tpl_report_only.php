<?php
$reportItems = EventMain::getReportItems($eventMain->id);

// MyFunctions::echoArray($eventMain, $countriesOptions);


?>
<fieldset id="reportItemsWrapper" class="mt30 pb10">
    <em class="grey" style="font-size: 140%;">N.B. Please note that all prices quoted are in AUD and inclusive of GST. </em><br /><br class="clear" />
    <p class="mb0" style="font-size: 100%;">I would like to order:</p>

<?php foreach ($reportItems as $reportItem): ?>
    <div class="clear"></div>
    <dl class="floatL mt20 ml15">

        <dd class="floatL mt10">
            <input id="" class="styled" type="checkbox" name="Ticket[]" value="<?php echo $reportItem->id; ?>" />
        </dd>
        <dt class="floatL ml5">
            <em class="blue" style="font-size: 200%;">$ <?php echo number_format($reportItem->price_high); ?></em>
        </dt>

        <dt class="floatL ml5">
            <label><?php echo $reportItem->option_text; ?></label>
        </dt>
    </dl>
<?php endforeach; ?>
    <div class="clear"></div>
    <div class="errorMessage ml15" id="priceErrorMessage" style="display:none;">Please select report to purchase</div>
    <br class="clear" />

    <dl class="floatL ml15">
        <dd class="floatL">
            <?php $model->terms = false; ?>
            <?php echo $form->checkBox($model, 'terms', array('id'=>'reportTermsCheckBox'));  ?>
            <label class="checkBoxLabel" for="reportTermsCheckBox">I agree to the <a href="#" class="blue" id="report_popup_button">Terms and Conditions</a></label>
            <div class="errorMessage" id="reportTermsErrorMessage" style="display:none;">You must agree to the Terms and Conditions</div>
        </dd>
    </dl>

</fieldset>

<?php // ------- POPUP PROZORI ---------- ?>


<?php // Reports ?>
                    <div id="terms_report_popup" class="popUpDiv newsletter" style="display:none;">
                        <a id="mc_back" class="back b-close"></a>
                        <div class="top">
                            <h1 class="black">Reports Terms &amp; Conditions</h1>
                            <ul class="pt20 pb30">
                                <li>No part of this publication may be reproduced, resold, stored in or introduced into any retrieval system of any nature or transmitted in any form or by any means (electronic, mechanical, photocopying, recording or otherwise) without the prior consent of Payments Consulting Network (PCN).</li>
                                <li>The Subscriber/User is responsible for any breach of copyright committed by accessing the PCN material.</li>
                                <li>This report is sold as a single-user license which permits the following use of the material, without the prior written consent of PCN:<br /> a) Paper copy: allows the Authorised User to circulate the original paper issue within his/her organisation; and<br /> b) Electronic copy: The Registered User only may access the PDF which cannot be published, circulated or redistributed electronically outside the Authorised User&rsquo;s organisation.</li>
                                <li>Notwithstanding the above, the Subscriber/User is not permitted to make the material available to clients, consultants or to any other third parties.</li>
                            </ul>
                       </div>
                    </div>
                    <script type="text/javascript">
                        /*<![CDATA[*/
                        jQuery(function($) {
                            jQuery("#report_popup_button").click(function(e){
                                e.preventDefault();
                                $("#terms_report_popup").bPopup({modalClose:false});
                                return false;
                            });

                            jQuery("#events-registration-form").submit(function(){
                                jQuery("#priceErrorMessage").hide();
                                if (jQuery("#reportItemsWrapper input.styled:checked").length == 0) {
                                    jQuery("#priceErrorMessage").show();
                                    return false;
                                }
                            });
                        });
                        /*]]>*/
                    </script>
<?php // ------- END OF POPUP PROZORI ---------- ?>

