<?php
/**
 * Created by Lemmy.
 * Date: 6/15/13
 * Time: 8:26 PM
 */
class EventsRegistrationWidget extends AodWidget
{
    public $model;
    public $message = null;
    protected $module_id = 0;
    protected $view_id = 0;
    protected $_settings = null;
    protected $_page_id = 0;

    public function init()
    {
        // $condition = 'mod_path = :path AND f_status=1 AND f_deleted=0';
        // $params = array( 'path' => 'pcn.eventsRegistration');
        // $this->module_id = ModRegister::model()->findByAttributes( array(), $condition, $params )->id;
        // // view_id
        // $condition = 'view_action = :action AND f_status=1 AND f_deleted=0';
        // $params = array( 'action' => 'eventsRegistration');
        // $this->view_id = ModView::model()->findByAttributes( array(), $condition, $params )->id;

        // $this->_settings = ModSetting::getSettingsArray( $this->module_id, $this->view_id );

        $this->_page_id = Frontend::getPageID($this->pars[0]);
        // MyFunctions::echoArray($this->pars, $this->_page_id);

        $this->registerScripts();
    }

    public function run()
    {
        $this->model = new EventsRegistration();

        if(isset($_POST['ajax']) && $_POST['ajax'] === 'events-registration-form'){
            echo CActiveForm::validate(array($this->model));
            Yii::app()->end();
        }

        // What is this for?
        $eventMain = EventMain::model()->findByAttributes(array('page_id'=>$this->_page_id));
        if (!$eventMain || $eventMain->f_status == 0) {
            $this->html = $this->render('notPreparedYet', array(
                'eventMain' => $eventMain,
                'message'=>'ONLINE REGISTRATION OPENING SOON',
            ),true);
            return;
        }

        // AJAX Requests from select controls...
        if (Yii::app()->request->isAjaxRequest && isset($_POST['price_option1'])) {
            if ($eventMain->tickets_schema == 'common') {
                $options = $eventMain->getOptionsListByLevel(2);
                $retAll = CHtml::tag('option', array('value'=>''), '--select--', true);
                foreach ($options as $key => $value) {
                    $retAll .= CHtml::tag('option', array('value'=>$key), $value, true);
                }
            } elseif ($eventMain->tickets_schema == 'with_report') {
                $priceBird = 0; $priceBirdTotal = 0;
                $priceFull = 0; $priceFullTotal = 0;
                $showEarlyBirdPrice = $eventMain->isEarlyBird();
                $price = EventPrice::model()->findByPk(intval($_POST['price_option1']));
                if (!empty($price)) {
                    $priceBird = $price->price_low;
                    $priceBirdTotal = $priceBird;
                    $priceFull = $price->price_high;
                    $priceFullTotal = $priceFull;
                }
                if (!empty($_POST['selected_report_id'])) {
                    $price = EventPrice::model()->findByPk(intval($_POST['selected_report_id']));
                    $priceBirdTotal += $price->price_low;
                    $priceFullTotal += $price->price_high;
                }
                echo CJSON::encode(array(
                    'earlyBirdPrice'=>$priceBird,
                    'earlyBirdTotal'=>$priceBirdTotal,
                    'standardPrice'=>$priceFull,
                    'standardTotal'=>$priceFullTotal,
                    'showEarlyBirdPrice'=>$showEarlyBirdPrice,
                ));
                Yii::app()->end();
            }
            echo $retAll;
            Yii::app()->end();
        }

        if (Yii::app()->request->isAjaxRequest && isset($_POST['price_option2'])) {
            if ($eventMain->tickets_schema == 'common') {
                $options = $eventMain->getOptionsListByParentID(intval($_POST['price_option2']));
                $retAll = CHtml::tag('option', array('value'=>''), '--select--', true);
                foreach ($options as $key => $value) {
                    $retAll .= CHtml::tag('option', array('value'=>$key), $value, true);
                }
            } elseif ($eventMain->tickets_schema == 'with_report') {
                $priceBird = 0; $priceBirdTotal = 0;
                $priceFull = 0; $priceFullTotal = 0;
                $showEarlyBirdPrice = $eventMain->isEarlyBird();
                $price = EventPrice::model()->findByPk(intval($_POST['price_option2']));
                if (!empty($price)) {
                    $priceBird = $price->price_low;
                    $priceBirdTotal = $priceBird;
                    $priceFull = $price->price_high;
                    $priceFullTotal = $priceFull;
                }
                if (!empty($_POST['selected_registration_id'])) {
                    $price = EventPrice::model()->findByPk(intval($_POST['selected_registration_id']));
                    $priceBirdTotal += $price->price_low;
                    $priceFullTotal += $price->price_high;
                }
                echo CJSON::encode(array(
                    'earlyBirdPrice'=>$priceBird,
                    'earlyBirdTotal'=>$priceBirdTotal,
                    'standardPrice'=>$priceFull,
                    'standardTotal'=>$priceFullTotal,
                    'showEarlyBirdPrice'=>$showEarlyBirdPrice,
                ));
                Yii::app()->end();
            }
            echo $retAll;
            Yii::app()->end();
        }


        if (Yii::app()->request->isAjaxRequest && isset($_POST['price_option3'])) {
            $priceBird = 0;
            $priceFull = 0;
            $showEarlyBirdPrice = $eventMain->isEarlyBird();
            $price = EventPrice::model()->findByPk(intval($_POST['price_option3']));
            if (!empty($price)) {
                $priceBird = $price->price_low;
                $priceFull = $price->price_high;
            }
            echo CJSON::encode(array(
                'earlyBirdPrice'=>$priceBird,
                'standardPrice'=>$priceFull,
                'showEarlyBirdPrice'=>$showEarlyBirdPrice,
            ));
            Yii::app()->end();
        }

        if (Yii::app()->request->isPostRequest) {
            $savedRegistrationID = $this->saveRegistrationData($eventMain);
            if ($savedRegistrationID) {
                SimpleCart::setEventRegistrationID($savedRegistrationID);
                $this->controller->redirect('/my-cart');
            }
            // MyFunctions::echoArray($_POST);
        }

        $priceOptions2 = array();
        if ($eventMain->tickets_schema == 'with_report') {
            $priceOptions2 = $eventMain->getOptionsListByLevel(2);
        }
        $priceOptions = array(
            'displaySelect2'    => false,
            'displaySelect3'    => false,
            'select1'           => '',
            'select2'           => '',
            'select3'           => '',
            'options1'          => $eventMain->getOptionsListByLevel(1),
            'options2'          => $priceOptions2,
            'options3'          => array(),
            'price_low'         => '0.00',
            'price_high'        => '0.00',
        );
        // If loaded from session...
        if ( ! is_null(SimpleCart::getEventRegistrationID())) {
            $this->model->attributes = SimpleCart::getEventRegistrationAttributes();
        }
        // SKIP THIS, I DONT LIKE HOW IT WORKS!!!
        if (false && !is_null(SimpleCart::getEventRegistrationID())) {
            $this->model->attributes = SimpleCart::getEventRegistrationAttributes();
            $ticket = CJSON::decode($this->model->ticket, false);
            // MyFunctions::echoArray(array('ticket'=>$ticket));
            if (isset($ticket->option1)) {
                $priceOptions['select1'] = $ticket->option1;
            }
            if (isset($ticket->option2)) {
                $priceOptions['select2'] = $ticket->option2;
                $priceOptions['options2'] = $eventMain->getOptionsListByLevel(2);
                $priceOptions['displaySelect2'] = true;
            }
            if (isset($ticket->option2, $ticket->option3)) {
                $priceOptions['select3'] = $ticket->option3;
                $priceOptions['options3'] = $eventMain->getOptionsListByparentID(intval($ticket->option2));
                $priceOptions['displaySelect3'] = true;
            }
            if (isset($ticket->Tickets)) {
            // MyFunctions::echoArray($ticket->Tickets);
                foreach ($ticket->Tickets as $key=>$ticket) {
                    $eventPrice = EventPrice::model()->findByPk($ticket);
                    if (!empty($eventPrice)) {
                        $priceOptions['price_low']  += $eventPrice->price_low;
                        $priceOptions['price_high'] += $eventPrice->price_high;
                    }
                }
            }
        } // SKIPPED

        $this->model->event_id = $eventMain->id;
        $this->html = $this->render('eventsRegistration', array(
            'eventMain' => $eventMain,
            'model'=>$this->model,
            'priceOptions' => $priceOptions,
            'message'=>$this->message,
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
        $assetsFolder=Yii::app()->assetManager->publish( $assetPath, false, -1, true );
        Yii::app()->clientScript->registerScriptFile($assetsFolder.'/jquery.services.js');
    }

    /**
     * Save event reegistration to DB
     *
     * @return registrationID|false
     */
    private function saveRegistrationData($eventMain = null)
    {
        if ( ! isset($_POST['EventsRegistration'])) {
            return false;
        }

        $earlyBirdPrice = false;
        if (!empty($eventMain)) {
            $earlyBirdPrice = $eventMain->isEarlyBird();
        }

        // MyFunctions::echoArray($_POST);
        $model = new EventsRegistration();
        $model->attributes = $_POST['EventsRegistration'];
        $model->country_title = Country::getCountryName($model->country);
        if (isset($_POST['Dietary'])) {
            $model->dietary_requirements = CJSON::encode($_POST['Dietary']);
        }

        $ticketArray = array();
        if (!empty($_POST['Price'])) {
            $ticketArray = array_merge($ticketArray, $_POST['Price']);
        }
        if (!empty($_POST['Ticket'])) {
            $tickets = array();
                // If event is market as price list, calculate total price
            if (!is_null($eventMain) && $eventMain->f_price_list) {
                $price = 0.00;
                foreach($_POST['Ticket'] as $ticket) {
                    $priceModel = EventPrice::model()->findByPk($ticket);
                    if (!empty($priceModel)) {
                        if ($eventMain->isEarlyBird()) {
                            $currentPrice = $priceModel->price_low;
                        } else {
                            $currentPrice = $priceModel->price_high;
                        }
                        $price += $currentPrice;
                        // Add to tickets list
                        $tickets[$ticket] = $priceModel->attributes;
                        $tickets[$ticket]['purchase_price'] = $currentPrice;
                    }
                }
                $model->price = $price;
            }
            if (empty($tickets)) {
                foreach ($_POST['Ticket'] as $ticket) {
                    $tickets[$ticket] = array();
                }
            }
            // Add this tickets to ticket json
            $ticketArray = array_merge($ticketArray, array('Tickets' => $tickets));
        }


        $model->ticket = CJSON::encode($ticketArray);
        $model->invoice_description = substr($model->invoiceDescription(), 0, 60);
        $model->created_dt=new CDbExpression('NOW()');
        if ( ! isset($_POST['EventsRegistration']['terms_report'])) {
            $model->terms_report = 1;
        }
        // MyFunctions::echoArray($_POST, $model->attributes);
        if ( ! $model->save() ) {
            return false;
        };
        // MyFunctions::echoArray($_POST, $model->attributes);

        // Add items to cart
        if (!empty($_POST['Ticket']) && is_array($_POST['Ticket'])) {
            foreach ($_POST['Ticket'] as $ticket) {
                $eventPriceModel = EventPrice::model()->findByPk((int)$ticket);
                if (!$eventPriceModel) {
                    continue;
                }

                // Try to load already added item
                $cartItem = SimpleCartItem::model()->findByAttributes(array(
                    'cart_id' => SimpleCart::cartID(),
                    'price_id' => (int)$ticket,
                ));
                if (empty($cartItem)) {
                    $cartItem = new SimpleCartItem();
                }

                $cartItem->price_id     = (int)$ticket;
                $cartItem->category     = $eventPriceModel->category;
                $cartItem->name         = $eventPriceModel->option_text;
                $cartItem->description  = '';
                $cartItem->quantity    += 1;
                $cartItem->price        = $earlyBirdPrice ? $eventPriceModel->price_low : $eventPriceModel->price_high;
                $c = SimpleCart::addCartItem($cartItem);
                // MyFunctions::echoArray($c->attributes, $eventPriceModel->attributes, $model->attributes);
            }
        }

        return $model->id;
    }

}

