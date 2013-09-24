<?php
if ($ShowDebugInfo) {
    echo "CreateAccessCode Response Object From Current Session";
    echo '<pre>';
    print_r($Response);
    echo '</pre><hr />';
    // var_dump($Response);
}
?>
<div class="wide floatL" style="margin-left:100px;">

<h1 class="pt20 pb10 mb20 dotedB">Submit Payment</h1>
<?php /*    <form action="<?php echo $Response->FormActionURL.'&method=report-purchase' ?>" method='post'> */ ?>
    <form action="<?php echo $Response->FormActionURL ?>" method='post'>
        <div id="outer">
            <div id="main">
<?php
    if (isset($error)) {
?>
    <div id="error">
        <label style="color:red"><?php echo $error ?></label>
    </div>
<?php } ?>
                <div id="maincontent">

                    <div class="transactioncustomer floatL" style="width:50%">
                        <div class="first">
                            <h3 class="blue mb10 pl40">Customer Address</h3>
                        </div>

                        <dl class="floatL">
                            <dt class="floatL mr20"><label for="lblStreet">Street</label></dt>
                            <dd class="floatR mb10 mt10"><label id="lblStreet"><?php echo $Response->Customer->Street1 ?></label></dd>
                        </dl><br class="clear" />
                        <dl class="floatL">
                            <dt class="floatL mr20"><label for="lblCity">City</label></dt>
                            <dd class="floatR mb10 mt10"><label id="lblStreet"><?php echo $Response->Customer->City ?></label></dd>
                        </dl><br class="clear" />
                        <dl class="floatL">
                            <dt class="floatL mr20"><label for="lblState">State</label></dt>
                            <dd class="floatR mb10 mt10"><label id="lblState"><?php echo $Response->Customer->State ?></label></dd>
                        </dl><br class="clear" />
                        <dl class="floatL">
                            <dt class="floatL mr20"><label for="lblPostcode">Post Code</label></dt>
                            <dd class="floatR mb10 mt10"><label id="lblPostcode"><?php echo $Response->Customer->PostalCode ?></label></dd>
                        </dl><br class="clear" />
                        <dl class="floatL">
                            <dt class="floatL mr20"><label for="lblCountry">Country</label></dt>
                            <dd class="floatR mb10 mt10"><label id="lblCountry"><?php echo $Response->Customer->Country ?></label></dd>
                        </dl><br class="clear" />
                        <dl class="floatL">
                            <dt class="floatL mr20"><label for="lblEmail">Email</label></dt>
                            <dd class="floatR mb10 mt10"><label id="lblEmail"><?php echo $Response->Customer->Email; ?></label></dd>
                        </dl><br class="clear" />
                        <dl class="floatL">
                            <dt class="floatL mr20"><label for="lblPhone">Phone</label></dt>
                            <dd class="floatR mb10 mt10"><label id="lblPhone"><?php echo $Response->Customer->Phone ?></label></dd>
                        </dl><br class="clear" />
                        <dl class="floatL">
                            <dt class="floatL mr20"><label for="lblMobile">Mobile</label></dt>
                            <dd class="floatR mb10 mt10"><label id="lblMobile"><?php echo $Response->Customer->Mobile ?></label></dd>
                        </dl><br class="clear" />

                        <div class="mt30">
                            <h3 class="blue mb10 pl40">Payment Details</h3>
                        </div>
                        <dl class="floatL">
                            <dt class="floatL mr20"><label for="lblAmount">Total Amount</label></dt>
                            <dd class="floatR mb10 mt10"><label id="lblAmount">$<?php echo $TotalAmount ?></label></dd>
                        </dl><br class="clear" />
                        <dl class="floatL">
                            <dt class="floatL mr20"><label for="lblInvoiceReference">Invoice Reference</label></dt>
                            <dd class="floatR mb10 mt10"><label id="lblInvoiceReference"><?php echo $InvoiceNumber ?></label></dd>
                        </dl><br class="clear" />
                    </div>

                    <div class="transactioncard floatL" style="width:48%; padding-left:2%;">
                        <div class="first">
                            <h3 class="blue mb10 pl40">Customer Details</h3>
                        </div>
                       <?php /* <dl class="floatL">
                            <dt class="floatL mr20"><label for="lblTitle">Title</label></dt>
                             <dd class="floatR mb10 mt10"><label id="lblTitle"><?php echo $Response->Customer->Title ?></label></dd>
                        </dl><br class="clear" /> */ ?>
                        <dl class="floatL">
                            <dt class="floatL mr20"><label for="lblFirstName">First Name</label></dt>
                             <dd class="floatR mb10 mt10"><label id="lblFirstName"><?php echo $Response->Customer->FirstName ?></label></dd>
                        </dl><br class="clear" />
                        <dl class="floatL">
                            <dt class="floatL mr20"><label for="lblLastName">Last Name</label></dt>
                             <dd class="floatR mb10 mt10"><label id="lblLastName"><?php echo $Response->Customer->LastName ?></label></dd>
                        </dl><br class="clear" />
                        <dl class="floatL">
                            <dt class="floatL mr20"><label for="lblCompanyName">Company Name</label></dt>
                             <dd class="floatR mb10 mt10"><label id="lblCompanyName"><?php echo $Response->Customer->CompanyName ?></label></dd>
                        </dl><br class="clear" />
                        <dl class="floatL">
                            <dt class="floatL mr20"><label for="lblJobDescription">Job Description</label></dt>
                             <dd class="floatR mb10 mt10"><label id="lblJobDescription"><?php echo $Response->Customer->JobDescription ?></label></dd>
                        </dl><br class="clear" />
                        <?php if (!empty($DietaryRequirements)): ?>
                        <dl class="floatL">
                            <dt class="floatL mr20"><label for="lblDietaryRequirements">Dietary<br />Requirements</label></dt>
                             <dd class="floatR mb10 mt10"><label id="lblDietaryRequirements"><?php echo $DietaryRequirements ?></label></dd>
                        </dl><br class="clear" />
                        <?php endif; ?>
                        <div class="mt30">
                            <h3 class="blue mb10 pl40">Card Details</h3>
                        </div>
                        <!-- The following fields are the ones that eWAY looks for in the POSTed data when the form is submitted. -->

                        <!-- This field should contain the access code received from eWAY -->
                        <input type='hidden' name='EWAY_ACCESSCODE' value="<?php echo $Response->AccessCode ?>" />
                        <dl class="floatL">
                            <dt class="floatL mr20"><label for="EWAY_CARDNAME">Card Holder</label></dt>
                            <dd class="floatR mb10 mt10"><input class='textbox' type='text' name='EWAY_CARDNAME' id='EWAY_CARDNAME' value="<?php echo (isset($Response->Customer->CardName) && !empty($Response->Customer->CardName) ? $Response->Customer->CardName:"") ?>" /></dd>
                        </dl>
                        <dl class="floatL">
                            <dt class="floatL mr20"><label for="EWAY_CARDNUMBER">Card Number</label></dt>
                            <dd class="floatR mb10 mt10"><input class='textbox' type='text' name='EWAY_CARDNUMBER' id='EWAY_CARDNUMBER' value="<?php echo (isset($Response->Customer->CardNumber) && !empty($Response->Customer->CardNumber)  ? $Response->Customer->CardNumber:"") ?>" /></dd>
                        </dl>
                        <dl class="floatL" style="position:relative">
                            <dt class="floatL mr20"><label for="EWAY_CARDEXPIRYMONTH">Expiry Date</label></dt>
                            <dd class="floatR mb10 mt10">
                            <div class="floatL mr10" style="margin-top:-10px;">
                            <select class="styled" ID="EWAY_CARDEXPIRYMONTH" name="EWAY_CARDEXPIRYMONTH">
                                <?php
                                   if (isset($Response->Customer->CardExpiryMonth)&& !empty($Response->Customer->CardExpiryMonth)) {
                                        $expiry_month = $Response->Customer->CardExpiryMonth;
                                    } else {
                                        $expiry_month = date('m');
                                    }
                                    for($i = 1; $i <= 12; $i++) {
                                        $s = sprintf('%02d', $i);
                                        echo "<option value='$s'";
                                        if ( $expiry_month == $i ) {
                                            echo " selected='selected'";
                                        }
                                        echo ">$s</option>\n";
                                    }
                                ?>
                            </select>
                            </div>
                            <span class="floatL mr10">/</span>
                           <div class="floatL mr10" style="margin-top:-10px;">
                            <select class="styled" ID="EWAY_CARDEXPIRYYEAR" name="EWAY_CARDEXPIRYYEAR">
                                <?php
                                    $i = date("y");
                                    $j = $i+11;
                                    for ($i; $i <= $j; $i++) {
                                        echo "<option value='$i'";
                                        if ( $Response->Customer->CardExpiryYear == $i ) {
                                            echo " selected='selected'";
                                        }
                                        echo ">$i</option>\n";
                                    }
                                ?>
                            </select>
                            </div></dd>
                        </dl><br class="clear" />
                        <?php /*<dl class="floatL" style="position:relative">
                            <dt class="floatL mr20"><label for="EWAY_CARDSTARTMONTH">Valid From Date</label></dt>
                            <dd class="floatR mb10 mt10">
                            <div class="floatL" style="margin:20px 0 0 -10px;">
                            <select class="styled" ID="EWAY_CARDSTARTMONTH" name="EWAY_CARDSTARTMONTH">
                                <?php
                                    if (isset($Response->Customer->CardStartMonth)&& !empty($Response->Customer->CardStartMonth )) {
                                        $expiry_month = $Response->Customer->CardExpiryMonth;
                                    } else {
                                        $expiry_month = "";//date('m');
                                    }
                                    echo  "<option></option>";

                                    for($i = 1; $i <= 12; $i++) {
                                        $s = sprintf('%02d', $i);
                                        echo "<option value='$s'";
                                        if ( $expiry_month == $i ) {
                                            echo " selected='selected'";
                                        }
                                        echo ">$s</option>\n";
                                    }
                                ?>
                            </select>
                            </div>
                            <span class="floatL mr10">/</span>
                            <div class="floatL" style="margin:20px 0 0 -10px;">
                            <select class="styled" ID="EWAY_CARDSTARTYEAR" name="EWAY_CARDSTARTYEAR">
                                <?php
                                    $i = date("y");
                                    $j = $i-11;
                                    echo  "<option></option>";
                                    for ($i; $i >= $j; $i--) {
                                        $year = sprintf('%02d', $i);
                                        echo "<option value='$year'";
                                        if (isset($Response->Customer->CardStartYear)) {
                                            if ( $Response->Customer->CardStartYear == $year ) {
                                                echo " selected='selected'";
                                            }
                                        }
                                        echo ">$year</option>\n";
                                    }
                                ?>
                            </select>
                            </div>
                            </dd>
                        </dl>
                        <dl class="floatL">
                            <dt class="floatL mr20"><label for="EWAY_CARDISSUENUMBER">Issue Number</label></dt>
                            <dd class="floatR mb10 mt10"><input type='text' class='textbox' name='EWAY_CARDISSUENUMBER' id='EWAY_CARDISSUENUMBER' value="<?php echo (isset($Response->Customer->CardIssueNumber) && !empty($Response->Customer->CardIssueNumber) ? $Response->Customer->CardIssueNumber:"") ?>" maxlength="2" style="width:40px;"/></dd> <!-- This field is optional but highly recommended -->
                        </dl> */ ?>
                        <dl class="floatL">
                            <dt class="floatL mr20"><label for="EWAY_CARDCVN">CVV</label></dt>
                            <dd class="floatR mb10 mt10"><input type='text' class='textbox' name='EWAY_CARDCVN' id='EWAY_CARDCVN' value="" maxlength="4" style="width:40px;"/></dd> <!-- This field is optional but highly recommended -->
                        </dl>
                    </div>
                    <div class="paymentbutton floatR mr40">
                        <br />
                        <br />
                        <input type='submit' name='btnSubmitPayment' value="Submit" class="btn_blue floatR"/>
                        <br class="clear" />
                        <br />
                        <a href="http://www.credit-card-logos.com">
                            <img alt="" title="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/eway_logo.jpg" width="116" height="35" border="0" />
                            <img alt="" title="" src="http://www.credit-card-logos.com/images/visa_credit-card-logos/visa_mastercard_2.gif" width="116" height="35" border="0" />
                        </a>
                    </div>
                </div>
                <div id="maincontentbottom">
                </div>
            </div>
        </div>
    </form>

</div>
