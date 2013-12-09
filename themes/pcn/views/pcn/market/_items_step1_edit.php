<?php
$stepsTemplate = array(
    '1' => array(
        'label' => 'Choose city:',
    ),
    '2' => array(
        'label' => 'Ticket Type:',
    ),
    '3' => array(
        'label' => 'Choose Session(s):',
    ),
);
$activeStep = $request->steps_completed;
$selectedOption = '02';
$selectOptions = array('01' => 'Item 1', '02' => 'Item 2', '03' => 'Item 3');
?>
        <div id="overallPriceWrapper">

            <?php foreach ($stepsTemplate as $step => $item): ?>
            <dl class="floatL mb10 mr10<?php if ((int)$step != $activeStep): ?> hidden<?php endif; ?>">
                <dt class="floatL mr10" style="width: 120px;"><label><?php echo $item['label']; ?></label></dt>
                <dd class="floatL mt0">
                    <?php
                        if (intval($step) == $activeStep) {
                            echo CHtml::dropDownList(
                                'Price[option' . $step . ']',
                                $selectedOption,
                                $selectOptions,
                                array(
                                    'id'        => 'price_option' . $step . '',
                                    'class'     => 'styled',
                                    'empty'     => '---select---',
                                    'onchange'  => '$("#stepswrapper").hide();$(".ajax-loader").show();',
                                    'ajax'      => array(
                                        'type'      => 'POST',
                                        'data'      => array('price_option1'=>'js:this.value'),
                                        'dataType'  => 'html',
                                        'empty'     => '--select--',
                                        'success'   => 'function(response){
                                            // alert(response); return false;
                                            $(".ajax-loader").hide();
                                            $("#stepswrapper").empty().html(response).show();
                                        }'
                                    )
                                ));
                        } else {
                            echo CHtml::dropDownList('Price[option' . $step . ']', $null, array(),
                                array(
                                    'id'        => 'price_option' . $step . '',
                                    'class'     => 'styled',
                                    'empty'     => '---select---',
                                )
                            );

                        }
                    ?>
                </dd>
            </dl>
            <?php endforeach; ?>
            <br class="clear" />

            <div class="errorMessage ml30 hidden" id="priceErrorMessage">Please ensure that required session is selected</div>

<?php /*
            <?php //if ($request->f_earlybird): ?>
            <dl class="floatL mb10 ml15" id="price_early_bird_wrapper">
                <dd class="floatL mt10">
                    <?php echo CHtml::checkbox('price', 'price', array('class'=>'styled', 'checked'=>'checked', 'disabled'=>'disabled')) ?>
                </dd>
                <dt class="floatL ml5" id="priceEarlyBird">
                    <em class="blue" style="font-size: 200%"><?php //echo $priceOptions['price_low']; ?></em>
                </dt>
                <dt class="floatL ml5">
                    <label>Early bird price until <?php echo date('d/m/y', strtotime($market->earlybird_dt))?></label>
                </dt>
            </dl><br class="clear" />
            <?php //endif; ?>

            <dl class="floatL mb10 ml15" id="price_standard_wrapper">
                <dd class="floatL mt10">
                    <?php if (!$request->f_earlybird): ?>
                    <?php echo CHtml::checkbox('price', 'price', array('class'=>'styled', 'checked'=>'checked', 'disabled'=>'disabled')); ?>
                    <?php else: ?>
                    <span style="display:block; width:19px;">&nbsp;</span>
                    <?php endif; ?>
                </dd>
                <dt class="floatL ml5" id="priceStandard">
                    <em class="blue<?php echo $request->f_earlybird ? ' disabled': ''; ?>" style="font-size: 200%"><?php //echo $priceOptions['price_high']; ?></em>
                </dt>
                <dt class="floatL ml5">
                    <label>Standard registration date <?php echo date('d/m/y', strtotime($market->earlybird_dt.' + 1 day'))?> - <?php echo date('d/m/y', strtotime($market->end_dt))?></label>
                </dt>
            </dl><br class="clear" />
*/ ?>
        </div>

        <dl class="floatL mb20 ml15<?php if ($activeStep != count($stepsTemplate)): ?> hidden<?php endif; ?>">
            <dd class="floatL mt10">
                <?php echo CHtml::checkBox($model, 'terms', array('id'=>'termsCheckBox'));  ?>
                <label for="termsCheckBox" class="checkBoxLabel">I agree to the registration <a href="#" class="blue" id="popup_popUp">Terms and Conditions</a></label>
                <div class="errorMessage hidden" id="termsErrorMessage">You must agree to the registration Terms and Conditions</div>
            </dd>
        </dl><br class="clear" />
