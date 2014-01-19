            <?php if (!empty($eventMain->tickets_note)): ?>
            <dl class="floatL mb10 mr10">
                <dt class="floatL mb0 pb0" style="width: 100px;">
                    <label>Please note:</label>
                </dt>
            </dl><br />
            <dl class="floatL mb10 mr10">
                <dd class="floatL">
                    <?php echo $eventMain->tickets_note; ?>
                </dd>
            </dl><br class="clear" />
            <?php endif; ?>
            <div class="ajax-loader"></div>

        <div id="overallPriceWrapper">

            <dl class="floatL mb20 mr10" id="option1_box">
                <dt class="floatL mr10" style="width: 120px;">
                    <label>Choose Ticket:</label>
                </dt>
                <dd class="floatL mt0">
                    <input type="hidden" id="selected_registration_id" name="Ticket[selected_registration_id]" value="<?php echo $priceOptions['select1']; ?>"/>
                    <?php echo CHtml::dropDownList('Price[option1]', $priceOptions['select1'], $priceOptions['options1'], array(
                    'id'=>'price_option1',
                    'class'=>'styled',
                    'empty'=>'--select--',
                    'onchange'=>'$("#overallPriceWrapper").hide();$(".ajax-loader").show();$("#selected_registration_id").val($(this).children("option:selected").val());',
                    'ajax'=>array(
                        'type'=>'POST',
                        'data'=>array('price_option1'=>'js:this.value', 'selected_report_id'=>'js:document.getElementById("selected_report_id").value'),
                        'dataType'=>'json',
                        'success'=>'function(data){
                            $("#priceErrorMessage").hide();
                            $("#registration_price").val(data.standardTotal);
                            $("#registration_priceStandard em").html("$"+data.standardPrice);
                            if (data.showEarlyBirdPrice) {
                                $("#registration_price").val(data.earlyBirdTotal);
                                $("#registration_priceEarlyBird em").html("$"+data.earlyBirdPrice);
                                $("#registration_price_early_bird_wrapper").show();
                            }
                            $("#registration_price_standard_wrapper").show();
                            $(".ajax-loader").hide();
                            $("#overallPriceWrapper").show();
                        }'
                    ),
                )); ?>
                </dd>
                <dd class="floatL mt20">
                    <?php $model->terms = false; ?>
                    <?php echo $form->checkBox($model, 'terms', array('id'=>'registrationTermsCheckBox'));  ?>
                    <label class="checkBoxLabel" for="registrationTermsCheckBox">I agree to the registration <a href="#" class="blue" id="registration_popup_button">Terms and Conditions</a></label>
                    <div class="errorMessage" id="registrationTermsErrorMessage" style="display:none;">You must agree to the registration Terms and Conditions</div>
                </dd>

            </dl>
            <br class="clear" />

        <div id="registrationPriceWrapper">
            <?php if ($eventMain->isEarlyBird()): ?>
            <dl class="floatL mb10 ml15" id="registration_price_early_bird_wrapper" style="display:none;">
                <dd class="floatL mt10">
                    <?php echo CHtml::checkbox('price', 'price', array('class'=>'styled', 'checked'=>'checked', 'disabled'=>'disabled')) ?>
                </dd>
                <dt class="floatL ml5" id="registration_priceEarlyBird">
                    <em class="blue" style="font-size: 200%"><?php echo $priceOptions['price_low']; ?></em>
                </dt>
                <dt class="floatL ml5">
                    <label>Early bird price until <?php echo date('d/m/y', strtotime($eventMain->date_early_bird))?></label>
                </dt>
            </dl><br class="clear" />
            <?php endif; ?>

            <dl class="floatL mb10 ml15" id="registration_price_standard_wrapper"<?php if(!$priceOptions['displaySelect3']):?> style="display:none;"<?php endif;?>>
                <dd class="floatL mt10">
                    <?php if (!$eventMain->isEarlyBird()): ?>
                    <?php echo CHtml::checkbox('price', 'price', array('class'=>'styled', 'checked'=>'checked', 'disabled'=>'disabled')); ?>
                    <?php else: ?>
                    <span style="display:block; width:19px;">&nbsp;</span>
                    <?php endif; ?>
                </dd>
                <dt class="floatL ml5" id="registration_priceStandard">
                    <em class="blue<?php echo $eventMain->isEarlyBird()? ' disabled': ''; ?>" style="font-size: 200%"><?php echo $priceOptions['price_high']; ?></em>
                </dt>
                <dt class="floatL ml5">
                    <label>Standard registration date - from <?php echo date('d/m/y', strtotime($eventMain->date_early_bird.' + 1 day'))?></label>
                </dt>
            </dl>
        </div>
            <br class="clear" />


            <dl class="floatL mb20 mr10" id="option1_box">
                <dt class="floatL mr10" style="width: 120px;">
                    <label>Choose Report:</label>
                </dt>
                <dd class="floatL mt0">
                    <input type="hidden" id="selected_report_id" name="Ticket[selected_report_id]" value="<?php echo $priceOptions['select2']; ?>"/>
                    <?php echo CHtml::dropDownList('Price[option2]', $priceOptions['select2'], $priceOptions['options2'], array(
                    'id'=>'price_option2',
                    'class'=>'styled',
                    'empty'=>'-- without report --',
                    'onchange'=>'$("#overallPriceWrapper").hide();$(".ajax-loader").show();$("#selected_report_id").val($(this).children("option:selected").val());',
                    'ajax'=>array(
                        'type'=>'POST',
                        // 'data'=>array('price_option2'=>'js:this.value', 'selected_registration_id'=>'js:document.getElementById("selected_registration_id").value'),
                        'data'=>array('price_option2'=>'js:this.value', 'selected_registration_id'=>'0'),
                        'dataType'=>'json',
                        'success'=>'function(data){
                            $("#priceErrorMessage").hide();
                            $("#registration_price").val(data.standardTotal);
                            $("#priceStandard em").html("$"+data.standardPrice);
                            if (data.showEarlyBirdPrice) {
                                $("#registration_price").val(data.earlyBirdTotal);
                                $("#priceEarlyBird em").html("$"+data.earlyBirdPrice);
                                $("#price_early_bird_wrapper").show();
                            }
                            $("#price_standard_wrapper").show();
                            $(".ajax-loader").hide();
                            $("#overallPriceWrapper").show();
                        }'
                    ),
                )); ?>
                </dd>
                <dd class="floatL mt20">
                    <?php $model->terms_report = false; ?>
                    <?php echo $form->checkBox($model, 'terms_report', array('id'=>'reportTermsCheckBox'));  ?>
                    <label class="checkBoxLabel" for="reportTermsCheckBox">I agree to the report <a href="#" class="blue" id="report_popup_button">Terms and Conditions</a></label>
                    <div class="errorMessage" id="reportTermsErrorMessage" style="display:none;">You must agree to the report Terms and Conditions</div>
                </dd>
            </dl>
            <br class="clear" />


        <div id="reportPriceWrapper">
            <?php if ($eventMain->isEarlyBird()): ?>
            <dl class="floatL mb10 ml15" id="price_early_bird_wrapper" style="display:none;">
                <dd class="floatL mt10">
                    <?php echo CHtml::checkbox('price', 'price', array('class'=>'styled', 'checked'=>'checked', 'disabled'=>'disabled')) ?>
                </dd>
                <dt class="floatL ml5" id="priceEarlyBird">
                    <em class="blue" style="font-size: 200%"><?php echo $priceOptions['price_low']; ?></em>
                </dt>
                <dt class="floatL ml5">
                    <label>Early bird price until <?php echo date('d/m/y', strtotime($eventMain->date_early_bird))?></label>
                </dt>
            </dl><br class="clear" />
            <?php endif; ?>

            <dl class="floatL mb10 ml15" id="price_standard_wrapper"<?php if(!$priceOptions['displaySelect3']):?> style="display:none;"<?php endif;?>>
                <dd class="floatL mt10">
                    <?php if (!$eventMain->isEarlyBird()): ?>
                    <?php echo CHtml::checkbox('price', 'price', array('class'=>'styled', 'checked'=>'checked', 'disabled'=>'disabled')); ?>
                    <?php else: ?>
                    <span style="display:block; width:19px;">&nbsp;</span>
                    <?php endif; ?>
                </dd>
                <dt class="floatL ml5" id="priceStandard">
                    <em class="blue<?php echo $eventMain->isEarlyBird()? ' disabled': ''; ?>" style="font-size: 200%"><?php echo $priceOptions['price_high']; ?></em>
                </dt>
                <dt class="floatL ml5">
                    <label>Standard report purchase - from <?php echo date('d/m/y', strtotime($eventMain->date_early_bird.' + 1 day'))?></label>
                </dt>
            </dl>
        </div>
            <br class="clear" />

            <input type="hidden" id="registration_price" name="EventsRegistration[price]" value="<?php echo $eventMain->isEarlyBird()? $priceOptions['price_low']: $priceOptions['price_high']; ?>"/>
            <input type="hidden" id="registration_price_type" name="Price[EarlyBird]" value="<?php echo $eventMain->isEarlyBird() ? 'yes' : 'no'; ?>"/>
            <div class="errorMessage ml30" id="priceErrorMessage" style="display:none;">Please ensure that required session is selected</div>
        </div>

<?php // ------- POPUP PROZORI ---------- ?>
<?php // Registration ?>
                    <div id="terms_registration_popup" class="popUpDiv newsletter" style="display:none; height:auto !important;">
                        <a id="mc_back" class="back b-close"></a>
                        <div class="top">
                           <h1 class="black">Registration Terms and Conditions</h1>
                       </div>
                    <ul class="pt20 pb30">
                        <li><h3 class="black">Program:</h3>
                        Payments Consulting Network reserves the right to change the program at any time. Every effort will be made to ensure a program of equivalent standard is offered</li><br />
                        <li><h3 class="black">Event cancellation or postponement:</h3>
                        In the unlikely event that we have to cancel or postpone the event a full refund will be offered or registration at a subsequent event of equal value</li><br />
                        <li><h3 class="black">Cancellation policy:</h3>
                        Cancellations must be received in writing. AUD$100 administration fee will apply for all cancellations made before the registration closing date. No refunds given after the registration closing date (i.e. 11 November 2013).</li><br />
                        <li><h3 class="black">Substitutions:</h3>
                        Should a registrant be unable to attend, they may send a substitute in their place. Payments Consulting Network must be notified of all substitutions by 11 November 2013 or a AUD$100 administration fee may apply.</li><br />
                        <li><h3 class="black">Liability:</h3>
                        In the event of industrial disruptions or natural disasters, Payments Consulting Network accepts no responsibility for losses incurred by delegates or attendees.</li><br />
                        <li><h3 class="black">Privacy policy:</h3>
                        Payments Consulting Network is concerned with the protection of your privacy. View our full Privacy Policy <a href="http://paymentsconsulting.com/privacy-policy" target="_blank" class="blue"><strong>here</stong></a></li><br />
                    </ul>
                    </div>
                    <script type="text/javascript">
                        /*<![CDATA[*/
                        jQuery(function($) {
                            jQuery("#registration_popup_button").click(function(e){
                                e.preventDefault();
                                $("#terms_registration_popup").bPopup({modalClose:false});
                                return false;
                            });
                        });
                        /*]]>*/
                    </script>

<?php // Reports ?>
                    <div id="terms_report_popup" class="popUpDiv newsletter" style="display:none; height:auto !important;">
                        <a id="mc_back" class="back b-close"></a>
                        <div class="top">
                           <h1 class="black">Reports Terms &amp; Conditions</h1>
                       </div>
                       <ul class="pt20 pb30" style="color:grey;">
                        <li><strong class="blue pr5"> 1.) </strong> No part of this publication may be reproduced, resold, stored in or introduced into any retrieval system of any nature or transmitted in any form or by any means (electronic, mechanical, photocopying, recording or otherwise) without the prior consent of Payments Consulting Network (PCN).</li><br />
                        <li><strong class="blue pr5"> 2.) </strong> The Subscriber/User is responsible for any breach of copyright committed by accessing the PCN material.</li><br />
                        <li><strong class="blue pr5"> 3.) </strong> This report is sold as a single-user license which permits the following use of the material, without the prior written consent of PCN:<br /><br />
                            <ul class="pl20 pt5 pb5">
                                <li><strong class="blue pr5">a)</strong> Paper copy: allows the Authorised User to circulate the original paper issue within his/her organisation; and</li><br />
                                <li><strong class="blue pr5">b)</strong> Electronic copy: The Registered User only may access the PDF which cannot be published, circulated or redistributed electronically outside the Authorised User’s organisation.</li>
                            </ul>
                        </li><br />
                        <li><strong class="blue pr5"> 4.) </strong> Notwithstanding the above, the Subscriber/User is not permitted to make the material available to clients, consultants or to any other third parties.</li><br />
                       </ul>
                    </div>
                    <script type="text/javascript">
                        /*<![CDATA[*/
                        jQuery(function($) {
                            jQuery("#report_popup_button").click(function(e){
                                e.preventDefault();
                                $("#terms_report_popup").bPopup({modalClose:false});
                                return false;
                            });
                        });
                        /*]]>*/
                    </script>
<?php // ------- END OF POPUP PROZORI ---------- ?>

