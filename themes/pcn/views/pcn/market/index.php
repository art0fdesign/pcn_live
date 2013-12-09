<div class="wide wide1 floatL dotedR dotedL registration_wrapper">
    <div class="pl20 pt20">
<?php /* Market wrapper */?>


<?php /* Market intro html */?>
<?php if (!empty($market->intro_html)): ?>
<?php echo $market->intro_html; ?>
<?php endif; ?>

<?php if ($market->f_reg_form): ?>

    <?php /* Registration form header */?>
    <h2 class="pt15">
        <?php echo empty($market->reg_form_header) ? 'Your Details' : $market->reg_form_header; ?>
        <?php if ($request->steps_completed) {

        // <a href="#">Edit</a>
        } ?>
    </h2>

    <?php /* Registration form intro html */?>
    <?php if (!empty($market->reg_form_intro_html)): ?>
    <?php echo Frontend::replaceAllTagsInContent($market->reg_form_intro_html); ?>
    <?php endif; ?>

    <?php /* Registration form */
        $form = $this->beginWidget('CActiveForm', array(
            'id'            =>'registration-form',
            // 'action'        => $url,
            'clientOptions' => array('validateOnSubmit'=>true),
            'enableClientValidation' => true,
            // 'htmlOptions'=>array('class'=>'form'),
            // 'enableAjaxValidation'=>true,
        ));

        if ($request->steps_completed == 0) {
            $request->scenario = 'reg_form';
            require_once('_reg_form_edit.php');
            // $this->controller->renderPartial('_reg_form_edit', array('market'=>$market, 'request'=>$request));
        }
        if ($request->steps_completed) {
            require_once('_reg_form_view.php');
            // $this->controller->renderPartial('_reg_form_view', array('market'=>$market, 'request'=>$request));
        }
    ?>

        <fieldset class="mt30">

            <?php require_once('_items_intro.php'); ?>

            <div class="ajax-loader"></div>

            <div id ="stepswrapper">
            <?php
            if ($market->f_items != 'none') {
                require_once('_items_step1_edit.php');
            }

            if ($market->f_items != 'none') {


            }
            ?></div>
            <dl class="floatL mb20 ml15">
                <dd>
                    <?php echo CHtml::submitButton('SUBMIT', array('id'=>'registrationSubmitButton', 'name'=>'submit_market_request', 'class'=>'submit btn_blue', 'style'=>'width: 100px;')) ?>
                </dd>
            </dl><br class="clear" />
            <dl class="floatR mt10 mr10">
                <a href="http://www.credit-card-logos.com">
                    <img alt="" title="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/eway_logo.jpg" width="116" height="35" border="0" />
                    <img alt="" title="" src="http://www.credit-card-logos.com/images/visa_credit-card-logos/visa_mastercard_2.gif" width="116" height="35" border="0" />
                </a>
            </dl>
        </fieldset>



        <?php $this->endWidget(); ?>

<?php endif; // if ($market->f_reg_form): ?>

<?php /*
<h1 class="dotedB contactTitle aboutTitle mb15">Registration and Market Study Report Purchase</h1>
<h2 class="blue pt15"><img style="vertical-align: baseline; border: 1px dotted #C5C5C5;" title="2013 Payments Industry Training and Masterclass" src="{file:2013-atm-and-branch-598x75}" alt="2013 PITAM 598x75" width="518" height="65" /></h2>
<div>
<h2 class="arialN pb20 pt20">Seminar registration</h2>
<p>Registrations for the Seminar are now closed. For further information contact Cassandra Hargreaves, Associate, Events &amp; Marketing Director</p>
<ul class="links">
<li>E: <a class="blue" href="mailto:events@paymentsconsulting.com">events@paymentsconsulting.com</a></li>
<li>M: +61 403 226 669</li>
<li>T: +61 2 8249 8336</li>
<li>F: +61 2 8079 2998</li>
<li>A: Level 12, 95 Pitt Street,<br />&nbsp;&nbsp;&nbsp; Sydney NSW 2000</li>
</ul>
<h2 class="arialN pb20 pt20">How to purchase the Market Study Report</h2>
<p>The 2013 ATM and Branch Automation Market Study Report will be released in December 2013. It is available for purchase now by:</p>
<ul class="links">
<li>Becoming a Payments Consulting Network ATM and Branch Automation Subscriber. <a href="mailto:events@paymentsconsulting.com.au" target="_blank">Contact us</a> to find out more</li>
<li>Purchasing online with Visa or MasterCard by completing the Online Report Purchase details below</li>
<li>Pay via EFT, Visa or MasterCard by completing the Purchase Form and sending back to us to receive a Tax Invoice</li>
</ul>
<a class="btn_blue mt30 mb30 mr10 floatR" href="../../upload/files/atm-market-study-purchase-order-form.pdf">Download Report Purchase Form</a></div>
<br class="arialN pb20 pt20" />
<h2 class="arialN pb20 pt20"><br /><br /><br />2013 ATM and Branch Automation Market Study Report prices</h2>
<p><strong>N.B. All prices quoted are in Australian dollars and include GST</strong></p>
<p>&nbsp;</p>
<table border="0">
<tbody>
<tr>
<td><strong>Report type<br /></strong></td>
<td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Cost</strong></td>
</tr>
<tr>
<td>1 hard and PDF copy<br />1 hard copy&nbsp;<br />1 additional hard copy - Subscriber Tier 2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />1 additional hard copy - Subscriber Tier 1 &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $ 13,200<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $ &nbsp; 8,800<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $ &nbsp; 2,200<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $ &nbsp; &nbsp; 550</td>
</tr>
</tbody>
</table>
<h2 class="arialN pb20 pt20">&nbsp;</h2>
<h2 class="arialN pb20 pt20">ONLINE REPORT PURCHASE</h2>
<p>&bull; Please complete the below Form. You will be taken to the payments section on the next page. <br />&bull; For further information and all other payment methods please <a href="mailto:cassandra.hargreaves@paymentsconsulting.com" target="_blank">contact us </a><br /><br /></p>
*/ ?>

<?php /* End of market wrapper */?>

    </div>
</div>
