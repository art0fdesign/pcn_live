<?php
class ReportPurchaseWidget extends AodWidget {

    public $params;
    public $type;
    public $model;
    public $session;
    public $message = null;
    protected $_page_id = 0;
    protected $module_id = 0;
    protected $view_id = 0;
    protected $_settings = null;

    protected $_validationErrors = array();


    public function init()
    {
        // $condition = 'mod_path = :path AND f_status=1 AND f_deleted=0';
        // $params = array( 'path' => 'pcn.reportPurchase');
        // $this->module_id = ModRegister::model()->findByAttributes( array(), $condition, $params )->id;

        // $this->_settings = ModSetting::getSettingsArray( $this->module_id);

        $this->_page_id = Frontend::getPageId($this->pars[0]);

        $this->registerScripts();
    }

    public function run()
    {
        $model = null;
        if (isset(Yii::app()->params['pcnPurchaseReports']['page_' . $this->_page_id])) {
            $model = Yii::app()->params['pcnPurchaseReports']['page_' . $this->_page_id];
        }
        if (is_null($model)) {
            return;
        }

        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['ReportPurchase'])) {
        // MyFunctions::echoArray($_POST);
                if (empty($_POST['ReportPurchase']['terms'])) {
                    $this->_validationErrors['terms'] = 'Please confirm that you agree to Terms & Conditions';
                }
                if (empty($_POST['ReportPurchase']['items'])) {
                    $this->_validationErrors['items'] = 'Please select at least one report to purchase';
                }
                // MyFunctions::echoArray($this->_validationErrors, $_POST);
                if (empty($this->_validationErrors)) {
                    foreach ($_POST['ReportPurchase']['items'] as $item) {
                        if (empty($model['items'][$item])) {
                            continue;
                        }
                        // Prepare report 'model'
                        $report = $model['items'][$item];

                        // Try to load already added item
                        $cartItem = SimpleCartItem::model()->findByAttributes(array(
                            'cart_id' => SimpleCart::cartID(),
                            'item_id' => $item,
                            'price'   => (int)$report['price'],
                        ));
                        if (empty($cartItem)) {
                            $cartItem = new SimpleCartItem();
                        }

                        $cartItem->item_id      = $item;
                        $cartItem->category     = $report['category'];
                        $cartItem->name         = $report['name'];
                        $cartItem->description  = $report['description'];
                        $cartItem->quantity    += (int)$report['quantity'];
                        $cartItem->price        = (int)$report['price'];
                        // MyFunctions::echoArray($cartItem);
                        SimpleCart::addCartItem($cartItem);
                    }
                }

            }
        }
        // MyFunctions::echoArray($this->_settings);
        $this->html = $this->render('reportPurchase', array(
            'model' => $model,
            'validationErrors' => $this->_validationErrors,
        ),true);
    }

    /** Register scripts */
    private function registerScripts()
    {
        // register script
        if( ($theme=Yii::app()->getTheme())!==null ){
            $assetPath = $this->viewPath . DIRECTORY_SEPARATOR . 'js';
            //$assetPath = Yii::app()->getTheme()->basePath . DIRECTORY_SEPARATOR . 'js' .DIRECTORY_SEPARATOR . 'menu-colapsed' ;
            //$assetPath = Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'popup';
        } else
            $assetPath = Yii::getPathOfAlias('');
        //MyFunctions::echoArray( $assetPath );
        $assetsFolder=Yii::app()->assetManager->publish( $assetPath );
        Yii::app()->clientScript->registerScriptFile($assetsFolder.'/jquery.services.js');
    }

    private function sendConfirmationMail($model)
    {

        $data = $model->attributes;
        $session = EventsRegistrationSession::model()->findByPk($this->model->session_id);
        // prepare $to parameter
        if(isset($this->_settings['email']['set_value']))
            $to = $this->_settings['email']['set_value'];
        else
            $to = 'darkokrmpotic@gmail.com';
        //

        $subject = isset($this->_settings['subject']['set_value'])? $this->_settings['subject']['set_value']: 'New Event Registration';
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
                            Email:  '.$data['email'].' <br /><br /><br />
                            Session/s:  '.$session->sessions.' <br />
                            Date:  '.$this->formatDate($session->date_from).' to '.$this->formatDate($session->date_to).' <br />
                            Price:  $'.$data['price'].' <br />
                            City:  '.$session->city.
                        '</body>
                    </html>';

        $headers = "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=utf-8\n";

        $headers .= "X-Sender: <" . $_SERVER["SERVER_ADMIN"] . ">\n";
        $headers .= "X-Mailer: Updater <http://" . $_SERVER["SERVER_NAME"] . ">\n";
        $headers .= "Return-Path: <  >\n";
        if(isset($this->_settings['from-email']['set_value']))
            $headers .= 'From: '.$this->_settings['from-email']['set_value']. "\r\n";
        else
            $headers .= 'From: Event Registration' . "\r\n";
        // all prepared->continue
        //MyFunctions::echoArray( array( 'to'=>$to, 'subject'=>$subject ), $headers, $message1 );
        if( $_SERVER['SERVER_ADDR'] != '127.0.0.1' ) mail($to, $subject, $message1, $headers);
    }

}