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
		$ids = array();
        if(isset($_POST['EventsRegistration']) && isset($_POST['EventsRegistrationSession'])){
            //MyFunctions::echoArray($_POST);
            $this->model->attributes = $_POST['EventsRegistration'];
            $this->session->city = $_POST['EventsRegistrationSession']['city'];
            $this->session->id = $_POST['EventsRegistrationSession']['id'];
            if($this->session->city != '')
            	$ids = $this->getIds($this->session->city);
            
            $this->model->session_id = $_POST['EventsRegistrationSession']['id'];
            //$this->model->created_dt = new CDbExpression('NOW()');
            $this->model->f_status = 1;
            if($this->model->save()){
                if(isset($this->_settings['success']['set_value']))
                    $this->message = $this->_settings['success']['set_value'];
                $this->sendConfirmationMail($this->model);
                $this->model = new EventsRegistration();
            }
        }

		
		
        if(Yii::app()->request->isAjaxRequest && isset($_POST['city'])){
            $city = $_POST['city'];
            $models = $this->session->findAll('f_deleted = 0 AND f_status = 1 AND city = :town', array('town'=>$city));
            //print_r($models);die;
            $sess2 = array();
            $sess1 = array();
            $retAll = CHtml::tag('option', array('value'=>''), '', true);;
            $ret2 = '';
            $ret1 = '';

            foreach($models as $mod){
                if($mod->num_of_sessions == 4){
                    $retAll .= CHtml::tag('option', array('value'=>$mod->id), $mod->name, true);
                }
                elseif($mod->num_of_sessions == 2){
                    $sess2[] = $mod;
                }
                else $sess1[] = $mod;
            }

            $ret2 .= CHtml::tag('optgroup', array('label'=>'One day seminar'), '', false);
            foreach($sess2 as $s2){
                $sess_nums = explode(",", $s2->sessions);
                $ret2 .= CHtml::tag('option', array('value'=>$s2->id), 'Sessions ' . $sess_nums[0]. ' and '. $sess_nums[1], true);
                unset($sess_nums);
            }
            $ret2 .= CHtml::closeTag('optgroup');

            $retAll .= $ret2;

            $ret1 .= CHtml::tag('optgroup', array('label'=>'One session'), '', false);
            foreach($sess1 as $s1){
                $sess_nums = explode(",", $s1->sessions);
                $ret1 .= CHtml::tag('option', array('value'=>$s1->id), 'Session ' . $s1->sessions, true);
                unset($sess_nums);
            }
            $ret1 .= CHtml::closeTag('optgroup');

            $retAll .= $ret1;
            echo CJSON::encode($retAll);
            Yii::app()->end();
        }

        if(Yii::app()->request->isAjaxRequest && isset($_POST['ticket'])){
            $id = (int)$_POST['ticket'];
            Yii::app()->session['session_id'] = $id;
            $session = $this->session->findByPk($id);
            $ret = CHtml::tag('option', array('value'=>''), '', true);
            if($session){
                if($session->date_from){
                    if($session->date_to != null){
                        $ret .= CHtml::tag('option', array('value'=>$session->date_from), $this->formatDate($session->date_from).' - '.$this->formatDate($session->date_to), true);
                    }
                    else
                    $ret .= CHtml::tag('option', array('value'=>$session->date_from), $this->formatDate($session->date_from), true);
                }
            }
            echo CJSON::encode($ret);
            Yii::app()->end();
        }

        if(Yii::app()->request->isAjaxRequest && isset($_POST['date'])){
            $date = $_POST['date'];
            //MyFunctions::echoArray(array('date'=>$date, 'id'=>Yii::app()->session['session_id']));
            $event = $this->session->findByAttributes(array(), 'id = :sessId AND date_from = :date', array(
                'sessId'=>Yii::app()->session['session_id'],
                'date'=>$date,
            ));
            unset(Yii::app()->session['session_id']);
            $priceLow = $event->price_low;
            $priceHigh = $event->price_high;
            echo CJSON::encode(array(
                'lowPrice'=> '<em class="blue" style="font-size: 200%">$' .$priceLow. '</em>',
                'highPrice'=>'<em class="blue" style="font-size: 200%">' .$priceHigh. ' $</em>',
            ));
            Yii::app()->end();
        }


        $this->html = $this->render('eventsRegistration', array(
            'model'=>$this->model,
            'session'=>$this->session,
            'cities'=>$cities,
            'message'=>$this->message,
            'ids'=>$ids,
            'settings'=>$this->_settings,
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
                            Price:  '.$session->getPrice($data['price']).'$ <br />
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
    
    function getIds($city){
    	$models = $this->session->findAll('f_deleted = 0 AND f_status = 1 AND city = :town', array('town'=>$city));
            //print_r($models);die;
            $sess2 = array();
            $sess1 = array();
            $retAll = array(" "=>"--select--");
            $ret2 = '';
            $ret1 = '';

            foreach($models as $mod){
                if($mod->num_of_sessions == 4){
                    $retAll[$mod->id]=  $mod->name;
                }
                elseif($mod->num_of_sessions == 2){
                    $sess2[] = $mod;
                }
                else $sess1[] = $mod;
            }

            $helpss2 = array();
            foreach($sess2 as $s2){
                $sess_nums = explode(",", $s2->sessions);
                $helpss2[$s2->id]='Sessions ' . $sess_nums[0]. ' and '. $sess_nums[1];
                unset($sess_nums);
            }
            $retAll['One day seminar']= $helpss2;
            

            

            $helpss1 = array();
            foreach($sess1 as $s1){
                $sess_nums = explode(",", $s1->sessions);
                $helpss1[$s1->id]='Session ' . $s1->sessions;
               
                unset($sess_nums);
            }
           $retAll['One session']= $helpss1;

            return $retAll;
    }
}
