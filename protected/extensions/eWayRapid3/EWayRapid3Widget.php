<?php
class EWayRapid3Widget extends AodWidget
{
    public $params = array();
    public $type = '';
    private $service;
    private $errorHTML = '';
    private $message = '';
    private $systemMessage = '';
    private $response;
    private $TotalAmount = 0;
    private $InvoiceNumber = '';
    private $InvoiceReference = '';
    private $InvoiceDescription = '';
    private $dietaryRequirements = '';

    /** Do some initializations */
    public function init()
    {
        // initialize class and config file paths
        $rapidClassFile = Yii::getPathOfAlias('webroot.vendors.rapid3.Rapid3') . '.php';
        $configFile = Yii::getPathOfAlias('webroot.vendors.rapid3.config') . '.ini';
        require_once( $rapidClassFile );
        // establish connection with Rapid class
        try{
            $this->service = new RapidAPI();
        }
        catch( Exception $e ){
            // Some bad happens; display error and rip
            $ret = $this->render( 'conn_error', array( 'e'=>$e ), $return=true );
            //
            $this->html = $ret;
            return false;
        }
    }

    /**
     * render widget
     * do not directly render, just set html in a public html parameter
     */
    public function run()
    {

         if(isset($_POST['ajax']) && $_POST['ajax'] === 'events-registration-form'){
           $model = new EventsRegistration();

            echo CActiveForm::validate(array($model));
            Yii::app()->end();
        }


        $viewfile = 'payment';
        $params = array();
        if (Yii::app()->request->isPostRequest ) {
            if (isset($_POST['EventsRegistration'])) {
                // MyFunctions::echoArray($_POST);
                $_POST['EventsRegistration']['country'] = 'au';
                $model = new EventsRegistration();
                $model->attributes = $_POST['EventsRegistration'];
                if (isset($_POST['Dietary'])) {
                    $model->dietary_requirements = CJSON::encode($_POST['Dietary']);
                }
                $model->ticket = CJSON::encode($_POST['Price']);
                $model->invoice_description = $model->invoiceDescription();
                $model->created_dt=new CDbExpression('NOW()');
                if ($model->save()) {
                    $this->InvoiceDescription = $model->invoice_description;
                    $this->dietaryRequirements = $model->dietaryRequirementsText();

                    Yii::app()->session['events.registration.model'] = $model->attributes;

                    if ($this->getAccessCode()) {
                        $params['Response'] = $this->response;
                        $params['TotalAmount'] = $this->TotalAmount;
                        $params['InvoiceNumber'] = $this->InvoiceNumber;
                        $params['InvoiceReference'] = $this->InvoiceReference;
                        $params['DietaryRequirements'] = $this->dietaryRequirements;
                        $params['ShowDebugInfo'] = $this->service->APIConfig['ShowDebugInfo'];
                        // MyFunctions::echoArray($params);
                    } else {
                        $viewfile = 'payment_error';
                    }
                };
            }
        } elseif (isset($_GET['AccessCode'])) {
            $success = $this->prepareShowResult();
            $viewfile = 'result';

            $condition = 'mod_path = :path AND f_status=1 AND f_deleted=0';
            $params = array( 'path' => 'eWayRapid3');
            $module_id = ModRegister::model()->findByAttributes( array(), $condition, $params )->id;
            $settings = ModSetting::getSettingsArray( $module_id );
            //MyFunctions::echoArray($settings);
            if ($success) {

                $this->sendConfirmationMail($settings);

                if (substr($this->InvoiceReference, 0, 3) == 'rpt') { // report purchase
                    $this->message = $settings['report.purchase.api.aprooved']['value'];
                } else {
                    $this->message = $settings['api.aprooved']['value'];
                }
            } else {
                $this->message = $settings['api.not.aprooved']['value'];
            }

            $params['message'] = $this->message;
            $params['result'] = $this->response;// object
            $params['systemMessage'] = $this->systemMessage;
        } else {
            $url = Yii::app()->request->getBaseUrl(true);
            $this->controller->redirect($url);
        }
        $params['error'] = $this->errorHTML;
        //MyFunctions::echoArray($params);
        $ret = $this->render($viewfile, $params, true);
        //
        $this->html = $ret;
    }

    private function getAccessCode()
    {
            $ref = '';
            if (isset($_SERVER['HTTP_REFERER'])) {
                $ref = $_SERVER['HTTP_REFERER'];
                $ref = str_replace(Yii::app()->getBaseUrl(true).'/', '', $ref);
            }
            if ($ref == 'research-purchase-report') {
                $ref = 'rpt-'.time();
            } else {
                $ref = 'event-'.time();
            }
                // MyFunctions::echoArray($ref, $_POST, $_SERVER);

            $this->InvoiceNumber = $ref;
            $this->InvoiceReference = $ref;

            $this->TotalAmount = $_POST['EventsRegistration']['price'];

            //Create AccessCode Request Object
            $request = new CreateAccessCodeRequest();

            //Populate values for Customer Object
            //Note: TokenCustomerID is Required Field When Update an exsiting TokenCustomer
            if(!empty($_POST['txtTokenCustomerID']))
                $request->Customer->TokenCustomerID = $_POST['txtTokenCustomerID'];

            $request->Customer->Reference = $this->InvoiceNumber;
            //Note: FirstName is Required Field When Create/Update a TokenCustomer
            $request->Customer->FirstName = $_POST['EventsRegistration']['first_name'];
            //Note: LastName is Required Field When Create/Update a TokenCustomer
            $request->Customer->LastName = $_POST['EventsRegistration']['surname'];
            $request->Customer->CompanyName = $_POST['EventsRegistration']['company'];
            $request->Customer->JobDescription = $_POST['EventsRegistration']['title_position'];
            $request->Customer->Street1 = $_POST['EventsRegistration']['street_address'];
            $request->Customer->City = $_POST['EventsRegistration']['suburb'];
            $request->Customer->State = $_POST['EventsRegistration']['state'];
            $request->Customer->PostalCode = $_POST['EventsRegistration']['postcode'];
            //Note: Country is Required Field When Create/Update a TokenCustomer
            $request->Customer->Country = 'AU';// $_POST['EventsRegistration']['country'];
            $request->Customer->Email = $_POST['EventsRegistration']['email'];
            $request->Customer->Phone = $_POST['EventsRegistration']['telephone'];
            $request->Customer->Mobile = $_POST['EventsRegistration']['mobile'];
            $request->Customer->Comments = '';
            $request->Customer->Fax = '';
            $request->Customer->Url = Yii::app()->getBaseUrl(true);

            //Populate values for ShippingAddress Object.
            /*//This values can be taken from a Form POST as well. Now is just some dummy data.
            $request->ShippingAddress->FirstName = $_POST['EventsRegistration']['first_name'];
            $request->ShippingAddress->LastName = $_POST['EventsRegistration']['surname'];
            $request->ShippingAddress->Street1 = $_POST['EventsRegistration']['street_address'];
            $request->ShippingAddress->Street2 = "";
            $request->ShippingAddress->City = $_POST['EventsRegistration']['suburb'];
            $request->ShippingAddress->State = $_POST['EventsRegistration']['state'];
            $request->ShippingAddress->Country = $_POST['EventsRegistration']['country'];
            $request->ShippingAddress->PostalCode = $_POST['EventsRegistration']['postcode'];
            $request->ShippingAddress->Email = $_POST['EventsRegistration']['email'];
            $request->ShippingAddress->Phone = $_POST['EventsRegistration']['telephone'];
            //ShippingMethod, e.g. "LowCost", "International", "Military". Check the spec for available values.
            $request->ShippingAddress->ShippingMethod = "LowCost";
        */
            //Populate values for LineItems
            $item1 = new LineItem();
            $item1->SKU = "SKU1";
            $item1->Description = "Description1";
            //$item2 = new LineItem();
            //$item2->SKU = "SKU2";
            //$item2->Description = "Description2";
            $request->Items->LineItem[0] = $item1;
            //$request->Items->LineItem[1] = $item2;

            //Populate values for Options
            $opt1 = new Option();
            $opt1->Value = '';

            $request->Options->Option[0]= $opt1;

            //Populate values for Payment Object
            //Note: TotalAmount is a Required Field When Process a Payment, TotalAmount should set to "0" or leave EMPTY when Create/Update A TokenCustomer
            //$request->Payment->TotalAmount = $_POST['EventsRegistration']['price'];
            $request->Payment->TotalAmount = $this->TotalAmount * 100;
            $request->Payment->InvoiceNumber = $this->InvoiceNumber;
            $request->Payment->InvoiceDescription = $this->InvoiceDescription;
            $request->Payment->InvoiceReference = $this->InvoiceReference;
            $request->Payment->CurrencyCode = 'AUD';

            //Url to the page for getting the result with an AccessCode
            //Note: RedirectUrl is a Required Field For all cases
            $request->RedirectUrl = Yii::app()->request->getBaseUrl(true) . '/' . Frontend::getPageDataByWidget(null, 'eWayRapid3');

            //Method for this request. e.g. ProcessPayment, Create TokenCustomer, Update TokenCustomer & TokenPayment
            $request->Method = 'ProcessPayment';

            //Call RapidAPI
            $result = $this->service->CreateAccessCode($request);

            //Save result into Session. payment.php and results.php will retrieve this result from Session
            // $Response = $result;
            // $TotalAmount = $this->TotalAmount;
            // $InvoiceReference = $this->InvoiceReference;
            //$_SESSION['TotalAmount'] = (int) $_POST['EventsRegistration']['price'];
            //$_SESSION['InvoiceReference'] = date('Ymd').'-'.time();
            //$_SESSION['Response'] = $result;

            //Check if any error returns
            if(isset($result->Errors))
            {
                //Get Error Messages from Error Code. Error Code Mappings are in the Config.ini file
                $ErrorArray = explode(",", $result->Errors);

                $lblError = "";
                foreach ( $ErrorArray as $error )
                {
                    if(isset($this->service->APIConfig[$error]))
                        $lblError .= $error." ".$this->service->APIConfig[$error]."<br>";
                    else
                        $lblError .= $error.'<br />';
                }

                $this->errorHTML = $lblError;
                //MyFunctions::echoArray($this->errorHTML);
                return false;
            }
            $this->response = $result;
            return true;

    }

    private function prepareShowResult(){
        //Build request for getting the result with the access code.
        $request = new GetAccessCodeResultRequest();



        $request->AccessCode = $_GET['AccessCode'];

        //Call RapidAPI to get the result
        $result = $this->service->GetAccessCodeResult($request);
        //Check if any error returns
        if(isset($result->Errors))
        {
            //Get Error Messages from Error Code. Error Code Mappings are in the Config.ini file
            $ErrorArray = explode(",", $result->Errors);

            //var_dump($ErrorArray);

            $lblError = "";

            foreach ( $ErrorArray as $error )
            {
                $lblError .= $this->service->APIConfig[$error]."<br>";
            }

            $this->errorHTML = $lblError;

            return false;
        }
        $this->response = $result;

        // Prepare message
        $this->systemMessage = $this->service->APIConfig[$result->ResponseMessage];
        $this->InvoiceReference = $result->InvoiceReference;
        // MyFunctions::echoArray($result, $result->ResponseMessage, $this->systemMessage);

        return $result->TransactionStatus;

    }

    private function sendConfirmationMail($settings)
    {
        if (!isset(Yii::app()->session['events.registration.model'])) {
            return false;
            //MyFunctions::echoArray($this->model->attributes);
        }
        $model = new EventsRegistration();
        $model->attributes = Yii::app()->session['events.registration.model'];
        $data = $model->attributes;

        // prepare $to parameter
        if(isset($settings['email']['set_value']))
            $to = $settings['email']['set_value'];
        else
            $to = 'art0fdesign.test@gmail.com';
        //

        $subject = isset($settings['subject']['set_value'])? $settings['subject']['set_value']: 'New Event Registration';
        $message1 = '<html>
                        <head>
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                        </head>
                        <body>
                            <h2>Event registration data:</h2> <br />
                            First Name: '.$data['first_name'].' <br />
                            Surname:  '.$data['surname'].' <br />
                            Title/Position:  '.$data['title_position'].' <br />
                            Company:  '.$data['company'].' <br />
                            Address:  '.$data['street_address'].' <br />
                            Suburb:  '.$data['suburb'].' <br />
                            State:  '.$data['state'].' <br />
                            Postcode:  '.$data['postcode'].' <br />
                            Country:  '.$data['country'].' <br />
                            Telephone:  '.$data['telephone'].' <br />
                            Mobile:  '.$data['mobile'].' <br />
                            Email:  '.$data['email'].' <br />
                            Dietary Requirements:  '.$model->dietaryRequirementsText().' <br /><br /><br />
                            Session/s:  '.$model->invoiceDescription().' <br />
                            Price:  $'.$data['price'].
                        '</body>
                    </html>';

        $headers = "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=utf-8\n";

        $headers .= "X-Sender: <" . $_SERVER["SERVER_ADMIN"] . ">\n";
        $headers .= "X-Mailer: Updater <http://" . $_SERVER["SERVER_NAME"] . ">\n";
        $headers .= "Return-Path: <  >\n";
        if(isset($settings['from-email']['set_value']))
            $headers .= 'From: '.$settings['from-email']['set_value']. "\r\n";
        else
            $headers .= 'From: Event Registration' . "\r\n";
        // all prepared->continue
        MyFunctions::echoArray( array( 'to'=>$to, 'subject'=>$subject ), $headers, $message1 );
        if( !$this->controller->isLive() ) mail($to, $subject, $message1, $headers);
    }

 }
