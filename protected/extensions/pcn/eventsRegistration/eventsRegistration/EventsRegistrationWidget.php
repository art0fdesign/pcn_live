<?php
/**
 * Created by Lemmy.
 * Date: 6/15/13
 * Time: 8:26 PM
 */
class EventsRegistrationWidget extends AodWidget
{
    public $model;
    public $session;
    public $message = null;
    protected $module_id = 0;
    protected $view_id = 0;
    protected $_settings = null;

    protected $_prices = array(
        'allday' => array('price_bird'=>1188, 'price_full'=>1320),
        'halfday' => array('price_bird'=>675, 'price_full'=>750),
        'session' => array('price_bird'=>400, 'price_full'=>440),
    );
    protected $_earlyBirdDate = '2013-10-15';

    public function init()
    {
        $condition = 'mod_path = :path AND f_status=1 AND f_deleted=0';
        $params = array( 'path' => 'pcn.eventsRegistration');
        $this->module_id = ModRegister::model()->findByAttributes( array(), $condition, $params )->id;
        // view_id
        $condition = 'view_action = :action AND f_status=1 AND f_deleted=0';
        $params = array( 'action' => 'eventsRegistration');
        $this->view_id = ModView::model()->findByAttributes( array(), $condition, $params )->id;

        $this->_settings = ModSetting::getSettingsArray( $this->module_id, $this->view_id );

        $this->registerScripts();
    }

    public function run()
    {
        $message = null;
        $this->model = new EventsRegistration();
        if(isset($_POST['ajax']) && $_POST['ajax'] === 'events-registration-form'){
            echo CActiveForm::validate(array($this->model));
            Yii::app()->end();
        }

        $this->session = new EventsRegistrationSession();
        $sessionsCity = $this->session->findAll('f_deleted = 0 AND f_status = 1');
        $cities = array();
        foreach($sessionsCity as $sessCity){
            $cities[$sessCity->city] = $sessCity->city;
        }
        $tickets = array();
        $ids = array();
        if(isset($_POST['EventsRegistration']) && isset($_POST['EventsRegistrationSession'])){
            $this->model->attributes = $_POST['EventsRegistration'];

            $this->session->city = $_POST['EventsRegistrationSession']['city'];
            $this->session->id = $_POST['EventsRegistrationSession']['id'];
            $this->session->ticket_type = $_POST['EventsRegistrationSession']['ticket_type'];



            $this->model->session_id = $_POST['EventsRegistrationSession']['id'];

            // TODO: Resolve dietary reqirements

            $this->model->f_status = 1;
            MyFunctions::echoArray($this->model->attributes, $_POST);
            if($this->model->save()){
                if(isset($this->_settings['success']['set_value']))
                    $this->message = $this->_settings['success']['set_value'];
                $this->sendConfirmationMail($this->model);
                $this->model = new EventsRegistration();
                $this->session->city = '';
                $this->session->id = '';
                $this->session->ticket_type = '';
            }
        }

        if(isset($this->session->city) && $this->session->city != '')
            $tickets = $this->getTicketsType($this->session->city);

        if(isset($this->session->city) && $this->session->city != '' && isset($this->session->ticket_type) && $this->session->ticket_type != ''){
                //print $this->session->city;
                //print $this->session->ticket_type;die;
                $ids = $this->getIds($this->session->city, $this->session->ticket_type);
        }
        /*if(isset($this->model->session_id) && $this->model->session_id != ''){
            $prices = $this->getPrices;
        }*/




        if(Yii::app()->request->isAjaxRequest && isset($_POST['city'])){
            $city = $_POST['city'];
            $models = $this->session->findAll(array("group"=>"name","condition"=>'f_deleted = 0 AND f_status = 1 AND city = :town', "params"=>array('town'=>$city)));
            //print_r($models);die;

            $retAll = CHtml::tag('option', array('value'=>''), '--select--', true);

            $retAll .= CHtml::tag('option', array('value'=>'allday'), 'All Day', true);
            $retAll .= CHtml::tag('option', array('value'=>'halfday'), 'Half Day', true);
            $retAll .= CHtml::tag('option', array('value'=>'session'), 'Single Session', true);



            echo $retAll;
            Yii::app()->end();
        }

        if(Yii::app()->request->isAjaxRequest && isset($_POST['ticket_type'])){
            $ticket = $_POST['ticket_type'];
            $city = $_POST['city_name'];

            //Yii::app()->session['session_id'] = $id;
            // $session = $this->session->findAll(array("condition"=>'f_deleted = 0 AND f_status = 1 AND city = :town AND type=:type AND seo_name=:seo_name' , "params"=>array('town'=>$city,"type"=>$ticket[0],"seo_name"=>$ticket[1])));
            //print count($session);die;
            $ret = CHtml::tag('option', array('value'=>''), '--select--', true);

            switch ($ticket) {
                case 'allday':
                    $ret .= CHtml::tag('option', array('value'=>'all_sessions'), 'All sessions', true);
                    break;
                case 'halfday':
                    $ret .= CHtml::tag('option', array('value'=>'sessions_1_2'), 'Sessions 1 &amp; 2', true);
                    $ret .= CHtml::tag('option', array('value'=>'sessions_1_3'), 'Sessions 1 &amp; 3', true);
                    $ret .= CHtml::tag('option', array('value'=>'sessions_1_4'), 'Sessions 1 &amp; 4', true);
                    $ret .= CHtml::tag('option', array('value'=>'sessions_2_3'), 'Sessions 2 &amp; 3', true);
                    $ret .= CHtml::tag('option', array('value'=>'sessions_2_4'), 'Sessions 2 &amp; 4', true);
                    $ret .= CHtml::tag('option', array('value'=>'sessions_3_4'), 'Sessions 3 &amp; 4', true);
                    break;
                case 'session':
                    $ret .= CHtml::tag('option', array('value'=>'session_1'), 'Session 1', true);
                    $ret .= CHtml::tag('option', array('value'=>'session_2'), 'Session 2', true);
                    $ret .= CHtml::tag('option', array('value'=>'session_3'), 'Session 3', true);
                    $ret .= CHtml::tag('option', array('value'=>'session_4'), 'Session 4', true);
                    break;
            }

            echo $ret;
            Yii::app()->end();
        }

        if(Yii::app()->request->isAjaxRequest && isset($_POST['sess_id'])){
            $id = $_POST['sess_id'];
            $ticket_type = $_POST['ticket_type_value'];
            //MyFunctions::echoArray(array('date'=>$date, 'id'=>Yii::app()->session['session_id']));
            // $event = $this->session->findByPk($id);
            //unset(Yii::app()->session['session_id']);

            $priceBird = $this->_prices[$ticket_type]['price_bird'];
            $priceFull = $this->_prices[$ticket_type]['price_full'];
            $showEarlyBirdPrice = date('Y-m-d') <= $this->_earlyBirdDate;
            echo CJSON::encode(array(
                'lowPrice'=> '<em class="blue" style="font-size: 200%">$' .$priceBird. '</em>',
                'highPrice'=>'<em class="blue" style="font-size: 200%">$' .$priceFull. '</em>',
                'earlyBirdPrice'=>$priceBird,
                'standardPrice'=>$priceFull,
                'showEarlyBirdPrice' => $showEarlyBirdPrice,
            ));
            Yii::app()->end();
        }

        if (isset(Yii::app()->session['events.registration.id']['EventsRegistration'])) {
            $this->model->attributes = Yii::app()->session['events.registration.id']['EventsRegistration'];
            //MyFunctions::echoArray($this->model->attributes);
        }
        $this->html = $this->render('eventsRegistration', array(
            'model'=>$this->model,
            'session'=>$this->session,
            'cities'=>$cities,
            'message'=>$this->message,
            'ids'=>$ids,
            'tickets'=>$tickets,
            'settings'=>$this->_settings,
            'showEarlyBirdDate'=>date('Y-m-d')<=$this->_earlyBirdDate,
        ),true);
    }

    private function formatDate($dt)
    {
        if($dt != null){
            $date = date_create($dt);
            $formatDate = date_format($date, 'jS M Y');
            return $formatDate;
        }else return false;
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
        if( $_SERVER['HTTP_HOST'] != 'localhost' ) mail($to, $subject, $message1, $headers);
    }

    function getTicketsType($city){
        $models = $this->session->findAll(array("group"=>"name","condition"=>'f_deleted = 0 AND f_status = 1 AND city = :town', "params"=>array('town'=>$city)));
            //print_r($models);die;

            $retAll = array(""=>'--select--');
            $retAll = array();
            $oneDay = array();
            $oneSession = array();
            foreach($models as $mod){
                if($mod->type == 'all'){
                    $retAll[$mod->type.'_'.$mod->seo_name] =  $mod->name;
                }
                elseif($mod->type == 'day'){
                    $oneDay[$mod->type.'_'.$mod->seo_name]= $mod->name;
                }
                else $oneSession[$mod->type.'_'.$mod->seo_name]= $mod->name;
            }
            if(!empty($oneDay)){
                $retAll['One day seminar']= $oneDay;
            }

            if(!empty($oneSession)){
                $retAll['One Session'] = $oneSession;

            }
            return $retAll;
    }

    function getIds($city, $type){
            //Yii::app()->session['session_id'] = $id;

            $ticket = explode("_", $type);
            $session = $this->session->findAll(array("condition"=>'f_deleted = 0 AND f_status = 1 AND city = :town AND type=:type AND seo_name=:seo_name' , "params"=>array('town'=>$city,"type"=>$ticket[0],"seo_name"=>$ticket[1])));
            //print count($session);die;
            $ret = array();

            foreach ($session as $sess){
                //print 'aaa';
                if($sess->date_from != '0000-00-00 00:00:00'){
                    //print 'bbb';
                    if($sess->date_to != '0000-00-00 00:00:00'){
                        $ret[$sess->id] = $this->formatDate($sess->date_from).' - '.$this->formatDate($sess->date_to);
                    }
                    else
                        $ret[$sess->id] =  $this->formatDate($sess->date_from);
                }
            }
            //die;
            return $ret;
    }
}

