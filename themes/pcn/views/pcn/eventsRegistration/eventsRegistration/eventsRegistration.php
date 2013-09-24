<?php
/**
 * Created by Lemmy.
 * Date: 6/15/13
 * Time: 8:32 PM
 */

$countries = array(
    'au' => 'Australia',
);

?>

<div class="wide wide1 floatL dotedR dotedL registration_wrapper">
    <div class="pl20 pr0">
    <?php if($message != null) echo $message; ?>
    <?php echo Frontend::replaceAllTagsInContent(@$settings['text-before-form']['set_value']) ?>

    <h2 class="pt15">Your Details</h2>
        <?php
        // $url = Frontend::getPageDataByWidget(null, 'eWayRapid3');
        // MyFunctions::echoArray($url, $_SERVER);
        if($_SERVER['SERVER_ADDR'] == '127.0.0.1' || $_SERVER['SERVER_ADDR'] == '::1') {
            $url = Yii::app()->request->getHostInfo('http') . '/' . Frontend::getPageDataByWidget(null, 'eWayRapid3');
        } else {
            $url = Yii::app()->request->getHostInfo('https') . '/' . Frontend::getPageDataByWidget(null, 'eWayRapid3');
        }
        //$url = Yii::app()->request->getBaseUrl(true) . '/' . Frontend::getPageDataByWidget(null, 'eWayRapid3');
        $form=$this->beginWidget('CActiveForm', array(
            'id'=>'events-registration-form',
            'action' => $url,
            'enableClientValidation' => true,
            'clientOptions'=> array('validateOnSubmit'=>true),
            // 'htmlOptions'=>array('class'=>'form'),
            // 'enableAjaxValidation'=>true,
        ));
        ?>
        <fieldset class="pb30 dotedB">
        <dl class="floatL mb10">
            <dt class="floatL mr10">
                <?php echo $form->labelEx($model, 'first_name'); ?>
            </dt>
            <dd class="floatR">
                <?php echo $form->textField($model, 'first_name', array('class'=>'textbox', 'maxlength'=>70)); ?>
                <?php echo $form->error($model, 'first_name'); ?>
            </dd>
        </dl>
            <dl class="floatR mb10 mr10">
                <dt class="floatL mr10">
                    <?php echo $form->labelEx($model, 'surname'); ?>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($model, 'surname', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($model, 'surname'); ?>
                </dd>
            </dl><br class="clear" />
            <dl class="floatL mb10">
                <dt class="floatL mr10 mb0 mt0">
                    <label>Title/<br />Position*</label>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($model, 'title_position', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($model, 'title_position'); ?>
                </dd>
            </dl>
            <br class="clear" />
            <dl class="floatL mb10 mr10">
                <dt class="floatL mr10">
                    <?php echo $form->labelEx($model, 'company'); ?>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($model, 'company', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($model, 'company'); ?>
                </dd>
            </dl>
            <dl class="floatR mb10 mr10">
                <dt class="floatL mr10 mb0 mt0">
                    <label>Division/<br />Department:</label>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($model, 'division_department', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($model, 'division_department'); ?>
                </dd>
            </dl>
            <br class="clear" />
            <dl class="floatL mb10">
                <dt class="floatL mr10 mb0 mt0">
                    <label>Street<br />Address*</label>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($model, 'street_address', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($model, 'street_address'); ?>
                </dd>
            </dl>
            <br class="clear" />
            <dl class="floatL mb10 mr10">
                <dt class="floatL mr10">
                    <?php echo $form->labelEx($model, 'suburb'); ?>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($model, 'suburb', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($model, 'suburb'); ?>
                </dd>
            </dl>
            <dl class="floatR mb10 mr10">
                <dt class="floatL mr10">
                    <?php echo $form->labelEx($model, 'state'); ?>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($model, 'state', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($model, 'state'); ?>
                </dd>
            </dl><br class="clear" />
            <dl class="floatL mb10">
                <dt class="floatL mr10">
                    <?php echo $form->labelEx($model, 'postcode'); ?>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($model, 'postcode', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($model, 'postcode'); ?>
                </dd>
            </dl><br class="clear" />
<!--
            <dl class="floatR mb10 mr10">
                <dt class="floatL mr10">
                    <?php echo $form->labelEx($model, 'country'); ?>
                </dt>
                <dd class="floatR">
                    <?php echo $form->dropDownList($model, 'country', $countries, array('class'=>'styled', 'maxlength'=>70)); ?>
                    <?php //echo $form->textField($model, 'country', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($model, 'country'); ?>
                </dd>
            </dl><br class="clear" />
 -->
            <dl class="floatL mb10">
                <dt class="floatL mr10">
                    <?php echo $form->labelEx($model, 'telephone'); ?>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($model, 'telephone', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($model, 'telephone'); ?>
                </dd>
            </dl>
            <dl class="floatR mb10 mr10">
                <dt class="floatL mr10">
                    <?php echo $form->labelEx($model, 'mobile'); ?>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($model, 'mobile', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($model, 'mobile'); ?>
                </dd>
            </dl><br class="clear" />
            <dl class="floatL mb10">
                <dt class="floatL mr10">
                    <?php echo $form->labelEx($model, 'email'); ?>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($model, 'email', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($model, 'email'); ?>
                </dd>
            </dl>
            <br class="clear" />
            <label class="floatL ml10 mt10 mr40">Dietary requirements (if any)</label>
            <dl class="floatL mb10">
                <dd class="floatL mt10">
                    <input id="dietary_vegetarian" class="styled" type="checkbox" name="Dietary[Vegetarian]" value="vegetarian" />
                </dd>
                <dt class="floatL ml5"><label for="dietary_vegetarian">Vegetarian</label></dt>

                <dd class="floatL mt10">
                    <input id="dietary_gluten_free" class="styled" type="checkbox" name="Dietary[GlutenFree]" value="gluten_free" />
                </dd>
                <dt class="floatL ml5"><label for="dietary_gluten_free">Gluten free</label></dt>
                <dd class="floatL mt10">
                    <input id="dietary_other" class="styled" type="checkbox" name="Dietary[Other]" value="other" />
                </dd>
                <dt class="floatL ml5"><label for="dietary_other">Other, specify</label></dt>
            </dl><br class="clear /">
            <dl>
                <dd class="floatR mr10">
                    <?php echo $form->textField($model, 'dietary_other', array('class'=>'textbox', 'style'=>'width:290px;', 'maxlength'=>70)); ?>
                </dd>
            </dl>
        </fieldset>

        <fieldset class="mt30 pb30">
        <h2 class="pt10">Registration Details</h2>

            <?php $note = Frontend::replaceAllTagsInContent(@$settings['note']['set_value']); ?>
            <?php if (!empty($note)): ?>
            <dl class="floatL mb10 mr10">
                <dt class="floatL mb0 pb0" style="width: 100px;">
                    <label>Please note:</label>
                </dt>
            </dl><br />
            <dl class="floatL mb10 mr10">
                <dd class="floatL">
                    <?php echo $note; ?>
                </dd>
            </dl><br class="clear" />
            <?php endif; ?>

            <dl class="floatL mb10 mr10">
                <dt class="floatL mr10" style="width: 100px;"><label>Choose City:</label></dt>
                <dd class="floatL mt0">
                    <?php echo $form->dropDownList($session, 'city', $cities, array(
                    'id'=>'cities',
                    'class'=>'styled',
                    'empty'=>'---select---',
                    'onchange'=>'$(".ajax-loader").show()',
                    'ajax'=>array(
                        'type'=>'POST',
                        'data'=>array('city'=>'js:this.value'),
                        'dataType'=>'html',
                        'empty'=>'--select--',
                        'success'=>'function(data){
                            $("#price_early_bird_wrapper").hide();
                            $("#price_standard_wrapper").hide();
                            $("#registration_price").val(0);
                            $("#ticketType").html(data);
                            var ticket = $("#ticketType").attr("name");
                            // document.getElementById("select"+ticket).childNodes[0].nodeValue = "---select---";
                            $("#ticket_box").show()
                            $(".ajax-loader").hide();
                        }'
                    ),
                )); ?>
                </dd>
            </dl>
            <dl class="floatL mb10 mr10" id="ticket_box" <?php if(empty($tickets)):?>style="display:none;"<?php endif;?>>
                <dt class="floatL mr10" style="width: 100px;">
                    <label>Ticket Type:</label>
                </dt>
                <dd class="floatL mt0">
                    <?php echo $form->dropDownList($session, 'ticket_type', $tickets, array(
                    'class'=>'styled',
                    'id'=>'ticketType',
                    'empty'=>'--select--',
                    'onchange'=>'$(".ajax-loader").show()',
                    'ajax'=>array(
                        'type'=>'POST',
                        'data'=>array('ticket_type'=>'js:this.value','city_name'=>'js:$("#cities").val()'),
                        'dataType'=>'html',
                        'success'=>'function(data){
                            $("#price_early_bird_wrapper").hide();
                            $("#price_standard_wrapper").hide();
                            $("#registration_price").val(0);
                            var date = $("#sessId").attr("name");
                            document.getElementById("select" + date).childNodes[0].nodeValue = "---select---";
                            $("#sessId").html(data);
                            $("#id_box").show();
                            $(".ajax-loader").hide();
                        }'
                    ),
                )); ?>
                </dd>
            </dl>
            <div class="ajax-loader"></div>

            <dl class="floatL mb20 mr10" id="id_box" <?php if(empty($ids)):?>style="display:none;"<?php endif;?>>
                <dt class="floatL mr10" style="width: 100px;">
                    <label>Choose Session(s):</label>
                </dt>
                <dd class="floatL mt0">
                    <?php echo $form->dropDownList($session, 'id', $ids, array(
                    'id'=>'sessId',
                    'class'=>'styled',
                    'empty'=>'--select--',
                    'onchange'=>'$(".ajax-loader").show()',
                    'ajax'=>array(
                        'type'=>'POST',
                        'data'=>array('sess_id'=>'js:this.value', 'ticket_type_value'=>'js:$("#ticketType").val()'),
                        'dataType'=>'json',
                        'success'=>'function(data){
                            $("#registration_price").val(data.standardPrice);
                            $("#priceStandard em").html("$"+data.standardPrice);
                            if (data.showEarlyBirdPrice) {
                                $("#registration_price").val(data.earlyBirdPrice);
                                $("#priceEarlyBird em").html("$"+data.earlyBirdPrice);
                                $("#price_early_bird_wrapper").show();
                            }
                            $("#price_standard_wrapper").show();
                            $(".ajax-loader").hide();
                        }'
                    ),
                )); ?>
                </dd>
            </dl>
            <br class="clear" />


            <!-- <input type="hidden" id="hidden_price_high" name="EventsRegistration[price]" value="0"/> -->
            <?php echo $form->hiddenField($model, 'price', array('id'=>'registration_price')); ?>
            <?php if ($showEarlyBirdDate): ?>
            <dl class="floatL mb10 ml15" id="price_early_bird_wrapper" style="display: none;">
                <dd class="floatL mt10">
                    <?php echo CHtml::checkbox('price', 'price', array('class'=>'styled', 'checked'=>'checked', 'disabled'=>'disabled')) ?>
                </dd>
                <dt class="floatL ml5" id="priceEarlyBird">
                    <em class="blue" style="font-size: 200%"></em>
                </dt>
                <dt class="floatL ml5">
                    <label>Early bird price until 15/10/13</label>
                </dt>
            </dl><br class="clear" />
            <?php endif; ?>

            <dl class="floatL mb10 ml15" id="price_standard_wrapper" style="display: none;">
                <dd class="floatL mt10">
                    <?php if (!$showEarlyBirdDate): ?>
                    <?php echo CHtml::checkbox('price', 'price', array('class'=>'styled', 'checked'=>'checked', 'disabled'=>'disabled')); ?>
                    <?php else: ?>
                    <span style="display:block; width:19px;">&nbsp;</span>
                    <?php endif; ?>
                </dd>
                <dt class="floatL ml5" id="priceStandard">
                    <em class="blue<?php echo $showEarlyBirdDate? ' disabled': ''; ?>" style="font-size: 200%"></em>
                </dt>
                <dt class="floatL ml5">
                    <label>Standard registration date 16/10/13-18/11/13</label>
                </dt>
            </dl><br class="clear" />


            <dl class="floatL mb20 ml15">
                <dd class="floatL mt10">
                    <?php echo $form->checkBox($model, 'terms', array());  ?>
                    <?php //echo $form->error($model, 'terms') ?>
                </dd>
                <dt class="floatL ml5">
                    <label>I agree to the registration <a href="#" class="blue" id="popup_popUp" onclick="$('#popUp').bPopup(); return false;">Terms and Conditions</a></label>
                </dt>
            </dl>
            <br class="clear" />
            <dl class="floatL mb20 ml15">
                <dd>
                    <?php echo CHtml::submitButton('SUBMIT', array('name'=>'submit', 'class'=>'submit btn_blue', 'style'=>'width: 100px;')) ?>
                </dd>
            </dl>
            <dl class="floatL mt10 ml30">
                <a href="http://www.credit-card-logos.com">
                    <img alt="" title="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/eway_logo.jpg" width="116" height="35" border="0" />
                    <img alt="" title="" src="http://www.credit-card-logos.com/images/visa_credit-card-logos/visa_mastercard_2.gif" width="116" height="35" border="0" />
                </a>
            </dl>
        </fieldset>
        <?php $this->endWidget(); /**/?>
    </div>
</div>

<?php echo Frontend::replaceAllTagsInContent(@$settings['terms-and-conditions']['set_value']) ?>

