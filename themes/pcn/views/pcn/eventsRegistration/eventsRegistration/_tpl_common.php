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
            <dl class="floatL mb10 mr10">
                <dt class="floatL mr10" style="width: 120px;"><label>Choose City:</label></dt>
                <dd class="floatL mt0">
                    <?php echo CHtml::dropDownList('Price[option1]', $priceOptions['select1'], $priceOptions['options1'], array(
                    'id'=>'price_option1',
                    'class'=>'styled',
                    'empty'=>'---select---',
                    'onchange'=>'$("#overallPriceWrapper").hide();$(".ajax-loader").show();',
                    'ajax'=>array(
                        'type'=>'POST',
                        'data'=>array('price_option1'=>'js:this.value'),
                        'dataType'=>'html',
                        'empty'=>'--select--',
                        'success'=>'function(data){
                            $("#priceErrorMessage").hide();
                            $("#price_early_bird_wrapper").hide();
                            $("#price_standard_wrapper").hide();
                            $("#registration_price").val(0);
                            $("#price_option2").empty().html(data);
                            var ticket = $("#price_option2").attr("name");
                            // document.getElementById("select"+ticket).childNodes[0].nodeValue = "---select---";
                            $("#option2_box").show();
                            $(".ajax-loader").hide();
                            $("#overallPriceWrapper").show();
                        }'
                    ),
                )); ?>
                </dd>
            </dl>
            <dl class="floatL mb10 mr10" id="option2_box"<?php if(!$priceOptions['displaySelect2']):?>style="display:none;"<?php endif;?>>
                <dt class="floatL mr10" style="width: 120px;">
                    <label>Ticket Type:</label>
                </dt>
                <dd class="floatL mt0">
                    <?php echo CHtml::dropDownList('Price[option2]', $priceOptions['select2'], $priceOptions['options2'], array(
                    'class'=>'styled',
                    'id'=>'price_option2',
                    'empty'=>'--select--',
                    'onchange'=>'$("#overallPriceWrapper").hide();$(".ajax-loader").show();',
                    'ajax'=>array(
                        'type'=>'POST',
                        'data'=>array('price_option2'=>'js:this.value'),
                        'dataType'=>'html',
                        'success'=>'function(data){
                            $("#priceErrorMessage").hide();
                            $("#price_early_bird_wrapper").hide();
                            $("#price_standard_wrapper").hide();
                            $("#registration_price").val(0);
                            var date = $("#price_option3").attr("name");
                            document.getElementById("select" + date).childNodes[0].nodeValue = "---select---";
                            $("#price_option3").empty().html(data);
                            $("#option3_box").show();
                            $(".ajax-loader").hide();
                            $("#overallPriceWrapper").show();
                        }'
                    ),
                )); ?>
                </dd>
            </dl>

            <dl class="floatL mb20 mr10" id="option3_box"<?php if(!$priceOptions['displaySelect3']):?> style="display:none;"<?php endif;?>>
                <dt class="floatL mr10" style="width: 120px;">
                    <label>Choose Session(s):</label>
                </dt>
                <dd class="floatL mt0">
                    <?php echo CHtml::dropDownList('Price[option3]', $priceOptions['select3'], $priceOptions['options3'], array(
                    'id'=>'price_option3',
                    'class'=>'styled',
                    'empty'=>'--select--',
                    'onchange'=>'$("#overallPriceWrapper").hide();$(".ajax-loader").show();',
                    'ajax'=>array(
                        'type'=>'POST',
                        'data'=>array('price_option3'=>'js:this.value'),
                        'dataType'=>'json',
                        'success'=>'function(data){
                            $("#priceErrorMessage").hide();
                            $("#registration_price").val(data.standardPrice);
                            $("#priceStandard em").html("$"+data.standardPrice);
                             if (data.showEarlyBirdPrice) {
                                $("#registration_price").val(data.earlyBirdPrice);
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
            </dl>
            <br class="clear" />


            <input type="hidden" id="registration_price" name="EventsRegistration[price]" value="<?php echo $eventMain->isEarlyBird()? $priceOptions['price_low']: $priceOptions['price_high']; ?>"/>
            <input type="hidden" id="registration_price_type" name="Price[EarlyBird]" value="<?php echo $eventMain->isEarlyBird() ? 'yes' : 'no'; ?>"/>
            <div class="errorMessage ml30" id="priceErrorMessage" style="display:none;">Please ensure that required session is selected</div>
            <?php if ($eventMain->isEarlyBird()): ?>
            <dl class="floatL mb10 ml15" id="price_early_bird_wrapper"<?php if(! ($priceOptions['displaySelect3'] && $eventMain->isEarlyBird())):?> style="display:none;"<?php endif;?>>
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
                    <label>Standard registration date <?php echo date('d/m/y', strtotime($eventMain->date_early_bird.' + 1 day'))?> - <?php echo date('d/m/y', strtotime($eventMain->date_end))?></label>
                </dt>
            </dl><br class="clear" />
        </div>

            <dl class="floatL mb20 ml15">
                <dd class="floatL mt10">
                    <?php $model->terms = false; ?>
                    <?php echo $form->checkBox($model, 'terms', array('id'=>'termsCheckBox'));  ?>
                    <label class="checkBoxLabel">I agree to the registration <a href="#" class="blue" id="popup_popUp">Terms and Conditions</a></label>
                    <div class="errorMessage" id="termsErrorMessage" style="display:none;">You must agree to the registration Terms and Conditions</div>
                </dd>
            </dl><br class="clear" />
