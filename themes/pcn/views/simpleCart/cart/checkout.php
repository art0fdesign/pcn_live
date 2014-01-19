<?php

$countries = Country::getAlpha2OptionsList();
if (empty($model->country)) {
    $model->country = 'au';
}

if(!$this->controller->isLive()) {
  $url = Yii::app()->request->getHostInfo('http');
} else {
  $url = Yii::app()->request->getHostInfo('https');
}
$url .= '/' . Frontend::getPageDataByWidget(null, 'eWayRapid3');

?>
<div class="wide floatL dotedL">
<div class="pl20 pr0">
<h1 class="dotedB contactTitle aboutTitle mb15">ONLINE PAYMENTS FORM</h1>
<span class="black">How to purchase:</span><br />
<ul class="links mt5 mb10">
<li>Credit card: Purchase online by completing the ONLINE PAYMENTS FORM below and pay with your credit card (Visa and Mastercard accepted)</li>
</ul>
<a class="pl20" href="http://www.credit-card-logos.com"><img title="" src="http://www.credit-card-logos.com/images/visa_credit-card-logos/visa_mastercard_2.gif" alt="" width="116" height="35" border="0" /></a>
<ul class="links mt5 mb10">
<li>Eft/Bank transfer or Cheque: Purchase by emailing your request to <a class="blue" href="mailto:cassandra.hargreaves@paymentsconsulting.com.au">Cassandra Hargreaves</a> to receive a tax invoice</li>
</ul>
<h2 class="pt20">Your Details</h2>
<?php
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'simple-cart-checkout-form',
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
    </dl><br class="clear" />
    <dl class="floatL mb10">
        <dt class="floatL mr10 mb0 mt0">
            <label>Title/<br />Position*</label>
        </dt>
        <dd class="floatR">
            <?php echo $form->textField($model, 'title_position', array('class'=>'textbox', 'maxlength'=>70)); ?>
            <?php echo $form->error($model, 'title_position'); ?>
        </dd>
    </dl><br class="clear" />
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
    </dl><br class="clear" />
    <dl class="floatL mb10">
        <dt class="floatL mr10 mb0 mt0">
            <label>Street<br />Address*</label>
        </dt>
        <dd class="floatR">
            <?php echo $form->textField($model, 'street_address', array('class'=>'textbox', 'maxlength'=>70)); ?>
            <?php echo $form->error($model, 'street_address'); ?>
        </dd>
    </dl><br class="clear" />
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
    </dl><br class="clear" />
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
</fieldset>

<fieldset class="mt30 pb30">
    <dl class="floatL mb20 ml15">
        <dd>
            <input class="submit btn_blue" style="width: 100px;" type="submit" value="SUBMIT" />
        </dd>
    </dl>
</fieldset>
<?php echo $form->hiddenField($model, 'price', array('value'=>$total)); ?>
<?php $this->endWidget(); /**/?>
</div>
</div>

<?php //echo Frontend::replaceAllTagsInContent(@$settings['terms-and-conditions']['set_value']) ?>

