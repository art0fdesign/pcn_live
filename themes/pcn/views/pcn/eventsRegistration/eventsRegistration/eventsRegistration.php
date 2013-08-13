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

<div class="wide wide1 floatL dotedR dotedL">
    <div class="pl20 pr0">
    <?php if($message != null) echo $message; ?>
    <?php echo Frontend::replaceAllTagsInContent(@$settings['text-before-form']['set_value']) ?>

<?php /*
    <h2 class="pt15">Your Details</h2>
        <?php
        // $url = Frontend::getPageDataByWidget(null, 'eWayRapid3');
        // MyFunctions::echoArray($url, $_SERVER);
        if($_SERVER['SERVER_ADDR'] == '127.0.0.1') {
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
        <fieldset class="mt30 pb30 dotedB">
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
            </dl>
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
            </dl>
            <dl class="floatL mb10">
                <dt class="floatL mr10">
                    <?php echo $form->labelEx($model, 'postcode'); ?>
                </dt>
                <dd class="floatR">
                    <?php echo $form->textField($model, 'postcode', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($model, 'postcode'); ?>
                </dd>
            </dl>
            <dl class="floatR mb10 mr10">
                <dt class="floatL mr10">
                    <?php echo $form->labelEx($model, 'country'); ?>
                </dt>
                <dd class="floatR">
                    <?php echo $form->dropDownList($model, 'country', $countries, array('class'=>'styled', 'maxlength'=>70)); ?>
                    <?php //echo $form->textField($model, 'country', array('class'=>'textbox', 'maxlength'=>70)); ?>
                    <?php echo $form->error($model, 'country'); ?>
                </dd>
            </dl>
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
            </dl>
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
            <!--<label class="floatL ml10 mt10 mr40">Dietary requirements (if any)</label>
            <dl class="floatL mb10">
                <dd class="floatL mt10">
                    <input id="" class="styled" type="checkbox" />
                </dd>
                <dt class="floatL ml5"><label>Vegetarian</label></dt>
                <dd class="floatL mt10">
                    <input id="" class="styled" type="checkbox" />
                </dd>
                <dt class="floatL ml5"><label>Gluten free</label></dt>
                <dd class="floatL mt10">
                    <input id="" class="styled" type="checkbox" />
                </dd>
                <dt class="floatL ml5"><label>Other, specify</label></dt>
            </dl>
            <br class="clear" />
            <dl>
                <dd class="floatR">
                    <input class="textbox" type="text" name="" value="" maxlength="70" />
                </dd>
            </dl>-->
        </fieldset>

        <fieldset class="mt30 pb30">
        <h2 class="pt10">Registration Details</h2>
        <em class="blue" style="font-size: 160%;">N.B. Please note that all prices quoted are in AUD and inclusive of GST. </em>
            <br />
            <br class="clear" />

            <?php echo Frontend::replaceAllTagsInContent(@$settings['session-dates']['set_value']) ?>

            <dl class="floatL mb10 mr10">
                <dt class="floatL mb0 pb0" style="width: 100px;">
                    <label>Please note:</label>
                </dt>
            </dl><br />
            <dl class="floatL mb10 mr10">
                <dd class="floatL">
                    <?php echo Frontend::replaceAllTagsInContent(@$settings['note']['set_value']) ?>
                </dd>
            </dl><br />

            <dl class="floatL mt20 mb10 mr10">
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
                            $("#lowprice").hide();
                            $("#id_box").hide();
                            $("#ticketType").html(data);
                            var ticket = $("#ticketType").attr("name");
                            document.getElementById("select"+ticket).childNodes[0].nodeValue = "---select---";
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
                        'data'=>array('ticket'=>'js:this.value','city_name'=>'js:$("#cities").val()'),
                        'dataType'=>'html',
                        'success'=>'function(data){
                            $("#lowprice").hide();
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
                    <label>Choose Date:</label>
                </dt>
                <dd class="floatL mt0">
                    <?php echo $form->dropDownList($session, 'id', $ids, array(
                    'id'=>'sessId',
                    'class'=>'styled',
                    'empty'=>'--select--',
                    'onchange'=>'$(".ajax-loader").show()',
                    'ajax'=>array(
                        'type'=>'POST',
                        'data'=>array('sess_id'=>'js:this.value'),
                        'dataType'=>'json',
                        'success'=>'function(data){
                            $("#lowprice").hide();
                            $("#priceLow").html(data.lowPrice);
                            $("#priceHigh").html(data.highPrice);
                            $("#lowprice").show();
                            $("#highprice").show();
                            $("#hidden_price_high").val(data.highprice);
                            $("#hidden_price_low").val(data.lowprice);
                            $(".ajax-loader").hide();
                        }'
                    ),
                )); ?>
                </dd>
            </dl>
            <br class="clear" />
            <?php if(date('Y-m-d') > '2013-06-30'): ?>
            <input type="hidden" id="hidden_price_high" name="EventsRegistration[price]" value="0"/>
            <dl class="floatL mb40 ml15" id="highprice" style="display: none;">
                <dd class="floatL mt10">
                    <?php echo CHtml::checkbox('price', 'price', array('class'=>'styled', 'checked'=>'checked', 'disabled'=>'disabled')) ?>
                </dd>
                <dt class="floatL ml5" id="priceHigh">
                </dt>
                <dt class="floatL ml5">
                    <label>Registration cost for one location<br />1/7/13-17/3/13</label>
                </dt>
            </dl><br class="clear" />
            <?php else: ?>
            <input type="hidden" id="hidden_price_low" name="EventsRegistration[price]" value="0"/>
            <dl class="floatL mb40 ml15" id="lowprice" style="display: none;">
                <dd class="floatL mt10">
                    <?php echo CHtml::checkbox('price', 'price', array('class'=>'styled', 'checked'=>'checked', 'disabled'=>'disabled')) ?>
                </dd>
                <dt class="floatL ml5" id="priceLow">
                </dt>
                <dt class="floatL ml5">
                    <label>Early bird cost for one location<br />to <?php echo @$settings['reg-date-earlybird']['set_value'] ?></label>
                </dt>
            </dl> 
            <?php endif; ?>
            <br class="clear" /> 
            <dl class="floatL mb20 ml15">
                <dd class="floatL mt10">
                    <?php echo $form->checkBox($model, 'terms', array());  ?>
                    <!--<input name="EventsRegistration[terms]" class="styled" type="checkbox" />-->
                </dd>
                <dt class="floatL ml5">
                    <label>I agree to the registration <a href="#" class="blue" id="popup_popUp">Terms and Conditions</a></label>
                </dt>
            </dl>
            <br class="clear" />
            <dl class="floatL mb20 ml15">
                <dd class="floatL mt10">
                    <?php echo $form->error($model, 'terms') ?>
                </dd>
            </dl>
            <br class="clear" />
            <dl class="floatL mb20 ml15">
                <dd>
                    <?php echo CHtml::submitButton('SUBMIT', array('name'=>'submit', 'class'=>'submit btn_blue', 'style'=>'width: 100px;')) ?>
                </dd>
            </dl>
        </fieldset>
        <?php $this->endWidget(); /**/?>
    </div>
</div>

<?php //echo Frontend::replaceAllTagsInContent(@$settings['terms-and-conditions']['set_value']) ?>

