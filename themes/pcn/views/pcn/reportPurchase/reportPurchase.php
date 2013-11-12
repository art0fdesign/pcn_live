<?php

$countries = array(
    'au' => 'Australia',
);

?>
<div class="wide floatL dotedL">
<div class="pl20 pr0">
<h1 class="dotedB contactTitle aboutTitle mb15">Purchase Report</h1>
<span class="black">How to purchase:</span><br />
<ul class="links mt5 mb10">
<li>Credit card: Purchase online by completing the ONLINE PAYMENTS FORM below and pay with your credit card (Visa and Mastercard accepted)</li>
</ul>
<a class="pl20" href="http://www.credit-card-logos.com"><img title="" src="http://www.credit-card-logos.com/images/visa_credit-card-logos/visa_mastercard_2.gif" alt="" width="116" height="35" border="0" /></a>
<ul class="links mt5 mb10">
<li>Eft/Bank transfer or Cheque: Purchase by emailing your request to <a class="blue" href="mailto:cassandra.hargreaves@paymentsconsulting.com.au">Cassandra Hargreaves</a> to receive a tax invoice</li>
</ul>
<h1 class="pt20">ONLINE PAYMENTS FORM</h1>
<h2 class="pt20">Your Details</h2>
<?php
// $url = Frontend::getPageDataByWidget(null, 'eWayRapid3');
// MyFunctions::echoArray($url, $_SERVER);
if($_SERVER['SERVER_ADDR'] == '127.0.0.1' || $_SERVER['SERVER_ADDR'] == '::1') {
  $url = Yii::app()->request->getHostInfo('http');
} else {
  $url = Yii::app()->request->getHostInfo('https');
}
$url .= '/' . Frontend::getPageDataByWidget(null, 'eWayRapid3').'/report-purchase';

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
			<label>First Name:</label>
		</dt>
		<dd class="floatR">
			<input class="textbox" type="text" name="EventsRegistration[first_name]" value="" maxlength="70" />
		</dd>
	</dl>

	<dl class="floatR mb10 mr10">
		<dt class="floatL mr10">
			<label>Surname:</label>
		</dt>
		<dd class="floatR">
			<input class="textbox" type="text" name="EventsRegistration[surname]" value="" maxlength="70" />
		</dd>
	</dl>

	<dl class="floatL mb10">
		<dt class="floatL mr10 mb0 mt0">
			<label>Title/<br />Position:</label>
		</dt>
		<dd class="floatR">
			<input class="textbox" type="text" name="EventsRegistration[title_position]" value="" maxlength="70" />
		</dd>
	</dl><br class="clear" />

	<dl class="floatL mb10 mr10">
		<dt class="floatL mr10">
			<label>Company:</label>
		</dt>
		<dd class="floatR">
			<input class="textbox" type="text" name="EventsRegistration[company]" value="" maxlength="70" />
		</dd>
	</dl>

	<dl class="floatR mb10 mr10">
		<dt class="floatL mr10 mb0 mt0">
			<label>Division/<br />Department:</label>
		</dt>
		<dd class="floatR">
			<input class="textbox" type="text" name="EventsRegistration[division_department]" value="" maxlength="70" />
		</dd>
	</dl><br class="clear" />
	
	<dl class="floatL mb10">
		<dt class="floatL mr10 mb0 mt0">
			<label>Street<br />Address:</label>
		</dt>
		<dd class="floatR">
			<input class="textbox" type="text" name="EventsRegistration[street_address]" value="" maxlength="70" />
		</dd>
	</dl><br class="clear" />

	<dl class="floatL mb10 mr10">
		<dt class="floatL mr10">
			<label>Suburb:</label>
		</dt>
		<dd class="floatR">
			<input class="textbox" type="text" name="EventsRegistration[suburb]" value="" maxlength="70" />
		</dd>
	</dl>

	<dl class="floatR mb10 mr10">
		<dt class="floatL mr10">
			<label>State:</label>
		</dt>
		<dd class="floatR">
			<input class="textbox" type="text" name="EventsRegistration[state]" value="" maxlength="70" />
		</dd>
	</dl>

	<dl class="floatL mb10">
		<dt class="floatL mr10">
			<label>Postcode:</label>
		</dt>
		<dd class="floatR">
			<input class="textbox" type="text" name="EventsRegistration[postcode]" value="" maxlength="70" />
		</dd>
	</dl>

	<dl class="floatR mb10 mr10">
		<dt class="floatL mr10">
			<label>Country:</label>
		</dt>
		<dd class="floatR">
			<?php echo CHtml::dropDownList('EventsRegistration[country]', 'au', $countries, array('class'=>'styled')); ?>
		</dd>
	</dl>

	<dl class="floatL mb10">
		<dt class="floatL mr10">
			<label>Telephone:</label>
		</dt>
		<dd class="floatR">
			<input class="textbox" type="text" name="EventsRegistration[telephone]" value="" maxlength="70" />
		</dd>
	</dl>

	<dl class="floatR mb10 mr10">
		<dt class="floatL mr10">
			<label>Mobile:</label>
		</dt>
		<dd class="floatR">
			<input class="textbox" type="text" name="EventsRegistration[mobile]" value="" maxlength="70" />
		</dd>
	</dl>

	<dl class="floatL mb10">
		<dt class="floatL mr10">
			<label>Email:</label>
		</dt>
		<dd class="floatR">
			<input class="textbox" type="text" name="EventsRegistration[email]" value="" maxlength="70" />
		</dd>
	</dl>
</fieldset>

<fieldset class="mt30 pb30">
	<h2 class="pt10">Payment Details</h2>
	<em class="grey" style="font-size: 140%;">N.B. Please note that all prices quoted are in AUD and inclusive of GST. </em><br /><br class="clear" />
	<p class="mb0" style="font-size: 100%;">I would like to order:</p>
	<br class="clar" />
	<dl class="floatL mb20 ml15">
		<dd class="floatL mt10">
			<input id="" class="styled" type="checkbox" name="EventsRegistration[price]" value="4400" />
		</dd>
		<dt class="floatL ml5">
			<em class="blue" style="font-size: 200%;">$ 4400</em>
		</dt>

		<dt class="floatL ml5">
			<label>1 electronic (PDF) version of the market study report<br />(licenced for one organisation)</label>
		</dt>
	</dl>

	<dl class="floatL mb40 ml15">
		<dd class="floatL mt10">
			<input id="" class="styled" type="checkbox" name="EventsRegistration[price]" value="2200" />
		</dd>
		<dt class="floatL ml5">
			<em class="blue" style="font-size: 200%;">$ 2200</em>
		</dt>
		<dt class="floatL ml5">
			<label>1 hard copy of the market study report sent by courier</label>
		</dt>
	</dl><br class="clear" />
	<dl class="floatL mb0 ml15">
		<dd class="floatL mt10">
			<input id="ytEventsRegistration_terms" type="hidden" value="0" name="EventsRegistration[terms]" />
			<input id="" class="styled" type="checkbox" value="1" name="EventsRegistration[terms]" />
		</dd>
		<dt class="floatL ml5 mr5">
			<label>I agree to the </label>
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

