<?php
class MarketWidget extends AodWidget {

    public $marketID    = null;

    private $market     = null;
    private $request    = null;

    private $token_id   = 'neka.kobasica.za.sakrivanje.id.a';

    public function init()
    {
        // Load template model
        if (WebshopMain::model()->exists($this->marketID)) {
            $this->market = WebshopMain::model()->findByPk($this->marketID);
        };

        // Load request model
        if (!is_null($this->market)) {
            if (!isset(Yii::app()->session[$this->token_id])) {
                Yii::app()->session[$this->token_id] = $this->uuid();
            }
            $criteria = new CDbCriteria();
            $criteria->addCondition('token = :token');
            $criteria->params = array(
                ':token' => Yii::app()->session[$this->token_id],
            );
            if (WebshopRequest::model()->exists($criteria)) {
                $this->request = WebshopRequest::model()->find($criteria);
                // If request is completed `clone` it, else continue with that one
                if ($this->request->completed) {
                    // `Clone` request and clean up some attrinutes
                    $copyAttributes = array('first_name', 'last_name', 'title_position', 'company', 'division_department', 'street_address', 'suburb', 'state', 'postcode', 'country', 'telephone', 'mobile', 'email', 'dietary_requirements', 'dietary_other');
                    $attributes = array();
                    foreach ($copyAttributes as $attrib) {
                        $attributes[$attrib] = $this->request->$attrib;
                    }
                    // MyFunctions::echoArray($attributes, $this->request->attributes);
                    // Create fresh one
                    $this->request = new WebshopRequest();
                    $this->request->attributes = $attributes;
                    // Create new token
                    Yii::app()->session[$this->token_id] = $this->uuid();
                    // Apply all updates of new one...
                    $this->request->webshop_id = $this->marketID;
                    $this->request->token = Yii::app()->session[$this->token_id];
                    $this->request->save();
                }
            }
            if (empty($this->request)) {
                $this->request = new WebshopRequest;
                $this->request->webshop_id = $this->marketID;
                $this->request->token = Yii::app()->session[$this->token_id];
                $this->request->save();
            }
        }
        // MyFunctions::echoArray(array(
        //     'marketID' => $this->marketID,
        //     'market_exists' => WebshopMain::model()->exists($this->marketID),
        //     'token' => Yii::app()->session[$this->token_id],
        //     'request' => $this->request,
        // ));

        // $this->registerScripts();
    }

    public function run()
    {
        if(Yii::app()->getRequest()->getIsAjaxRequest()) {
            // MyFunctions::echoArray($_POST);
            // echo '<h2>Bollocks</h2>';
            $this->request->steps_completed++;
            echo $this->render('_items_step1_edit', array(
                'market'    => $this->market,
                'request'   => $this->request,
            ));
            Yii::app()->end();
        }

        // Process Registration form POST request
        if (Yii::app()->getRequest()->getIsPostRequest() && !is_null(Yii::app()->request->getParam('submit_reg_form'))) {
            $this->request->scenario = 'reg_form';
            $this->request->attributes = $_POST['WebshopRequest'];
            $this->saveRegistrationForm();
        }
        // if(isset($_POST['EventMain']))
        // {
        //     $model->attributes=$_POST['EventMain'];
        //     if($model->save())
        //         $this->redirect(array('eventsRegistration/view','id'=>$model->id));
        // }
        // If market not loaded... move out
        if (is_null($this->market)) {
            $this->html = $this->render('error', array(),true);
            return;
        }
        // Sorry, not ready yet
        if ($this->market->start_dt > date('Y-m-d H:i:s')) {
            $this->html = $this->render('comming_soon', array('market' => $this->market),true);
            return;
        }
        // MyFunctions::echoArray($this->_settings);
        $this->html = $this->render('index', array(
            'market'    => $this->market,
            'request'   => $this->request,
        ), true);
        // MyFunctions::echoArray($this->_settings);
        // MyFunctions::echoArray(array(
        //     'marketID' => $this->marketID,
        //     'html' => $this->html,
        // ));
    }

    private function saveRegistrationForm()
    {
        if (!$this->request->validate()) {
            return false;
        }
        // Registration form is validated... do some extra preparations
        $this->request->steps_completed = 1;
        //
        return $this->request->save();
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

    private function uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

            // 16 bits for "time_mid"
            mt_rand( 0, 0xffff ),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand( 0, 0x0fff ) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand( 0, 0x3fff ) | 0x8000,

            // 48 bits for "node"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }

}