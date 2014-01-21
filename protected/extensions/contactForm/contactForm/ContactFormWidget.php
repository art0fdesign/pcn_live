<?php
/**
 * Author : Darko Krmpotić
 * Email : darkokrmpotic@gmail.com
 * Date: 4.7.12.
 * Time: 20.22
 * ----------------------------------------------------
 * Updated: Aod Team
 * Email: aod.team@art0fdesign.com
 * Date: 24.3.2013.
 * Time: 9.53
 */
/**
 * Settings:
 * ----------------------------------------------------
 * ---- MAIL SETTINGS ----
 * - success: String Message to inform him that contact form is received
 * - from-email: String Sendername in mail header
 * - email: String Admin e-mail addres for receiving mail confirmation
 * - subject: String Mail Subject
 * ---- FRONTEND ----
 * - text-before-form: String Contact Form intro text
 */

class ContactFormWidget extends AodWidget
{
    public $model = null;
    protected $module_id = 0;
    protected $view_id = 0;
    protected $_settings = null;

    public function init()
    {
        // module_id
        $condition = 'mod_path = :path AND f_status=1 AND f_deleted=0';
        $params = array( 'path' => 'contactForm');
        $this->module_id = ModRegister::model()->findByAttributes( array(), $condition, $params )->id;
        // view_id
        $condition = 'view_action = :action AND f_status=1 AND f_deleted=0';
        $params = array( 'action' => 'contactForm');
        $this->view_id = ModView::model()->findByAttributes( array(), $condition, $params )->id;
    }

    public function run()
    {
        $this->model=new ContactForm();
        $refreshCaptcha = true;

        if(Yii::app()->getRequest()->getIsAjaxRequest()) {
                    echo CActiveForm::validate( array( $this->model));
                    Yii::app()->end();
                }
        // load settings
        $this->_settings = ModSetting::getSettingsArray( $this->module_id, $this->view_id );
        //
        $message = '';
        if(isset($_POST['ContactForm']))
        {
            $this->model->attributes=$_POST['ContactForm'];
            // if email repeat is not scheduled
            if( empty( $_POST['ContactForm']['email_repeat'] ) )
                $this->model->email_repeat = $this->model->email;
            //
            $valid = $this->model->validate();
            //MyFunctions::echoArray( $_POST['ContactForm'], array('valid'=>$valid), $this->model->getErrors() );

            if($this->model->save()){
                // prepare confirmation on-screen message
                if(isset($this->_settings['success']['set_value']))
                    $message = $this->_settings['success']['set_value'];
                // send mail to admin
                $this->sendConfirmationMail();
                // reset model
                $this->model = new ContactForm();        
            } else {
                $this->model->verifyCode = '';
            }

        }



        $this->html = $this->render( 'contactForm', array(
            'model'=>$this->model,
            'message'=>$message,
            'sets'=>$this->_settings,
            'refreshCaptcha' => $refreshCaptcha,
        ), true );

    }

    /**
     * Implements contact form mail sending
     */
    private function sendConfirmationMail()
    {

        $data = $this->model->attributes;
        // prepare $to parameter 
        if(isset($this->_settings['email']['set_value']))
            $to = $this->_settings['email']['set_value'];
        else
            $to = 'darkokrmpotic@gmail.com';
        //
            
        $subject = isset($this->_settings['subject']['set_value'])? $this->_settings['subject']['set_value']: 'New Contact Form';
        $message1 = '<html>
			 			<head>
						<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
						</head><body><h2>New contact data:</h2> <br />
						First Name: '.$data['first_name'].' <br />
						Last Name: '.$data['last_name'].' <br />
						Email: '.$data['email'].' <br />
						Subject: '.$data['subject'].' <br />
						Message: '.$data['message'].'</body></html>';

        $headers = "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=utf-8\n";

        $headers .= "X-Sender: <" . $_SERVER["SERVER_ADMIN"] . ">\n";
        $headers .= "X-Mailer: Updater <http://" . $_SERVER["SERVER_NAME"] . ">\n";
        $headers .= "Return-Path: <  >\n";
        if(isset($this->_settings['from-email']['set_value']))
            $headers .= 'From: '.$this->_settings['from-email']['set_value']. "\r\n";
        else
            $headers .= 'From: Contact Form' . "\r\n";
        // all prepared->continue
        //MyFunctions::echoArray( array( 'to'=>$to, 'subject'=>$subject ), $headers, $message1 );
        if( $_SERVER['SERVER_ADDR'] != '127.0.0.1' && $_SERVER['SERVER_ADDR'] != '::1') mail($to, $subject, $message1, $headers);
    }
}
