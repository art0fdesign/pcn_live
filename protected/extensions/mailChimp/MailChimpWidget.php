<?php
class MailChimpWidget extends CWidget
{
    public $html    = '';
    public $params = array();
    public $type = '';
    
    protected $_settings = array();
    
    protected $apikey = 'ea5794a86d070e040f20efce6f0e4151-us5'; // aod
    protected $listID = '7fbd5f1541'; // aod - lista1
    //protected $newsListID = '37e3bcde57';
    //protected $eventsListID = '6d508d8636';
    //protected $apiUrl = 'http://api.mailchimp.com/1.3/';
    // groupings
    protected $listGroupingID = '11749';
    protected $group1Name = 'Quarterly';
    protected $group2Name = 'Daily'; 
    protected $eventsGroupingID = '12593';
    protected $newsGroupingID = '12597';
    
    protected $_result = 99; // subscription result
    
    public function init()
    {
        $modID = ModRegister::getModuleID('mailChimp');
        $sets = ModSetting::getSettingsArray( $modID );
        $this->_settings = $sets;
        $this->apikey = $sets['api-key']['value'];
        $this->listID = $sets['list-id']['value'];
        $this->listGroupingID = $sets['grouping-id']['value'];
        $this->group1Name = $sets['group1-name']['value'];
        $this->group2Name = $sets['group2-name']['value'];
        //MyFunctions::echoArray( $sets );        
        $this->registerScripts();
        Yii::import('ext.mailChimp.mailChimp.MCAPI');        
    } 
    
    public function run()
    {
        if( Yii::app()->getRequest()->getIsAjaxRequest() ){
            if( isset( $_GET['Newsletter'] ) ){ 
                $response = $this->subscribe( $_GET['Newsletter'] );
                echo CJSON::encode( $response );
                Yii::app()->end();
            }
        }
        //
        $this->html = $this->render('mailChimp', array('settings'=>$this->_settings), true);
        //MyFunctions::echoArray( array('path'=>$this->getViewPath(), 'file'=>$this->getViewFile('mailChimp')), $this->html );
    }
    
    /**
     * Subscribe user and return result/message pair
     */
    private function subscribe( $data )
    {
        $msg = ''; // common error
        // only if there are data AND they are valid 
        if( $data !== null && $this->validateData( $data ) ){
            $email = $data['email'];
            // check is user already subscribed
            $memberStatus = $this->getMemberInfo( $email );
        //MyFunctions::echoArray( array( 'valid'=>$this->validateData( $data ), 'status'=>$memberStatus ), $data );       
            // if returned in error
            if( !empty( $memberStatus['apiErrorCode'] ) ){
                $msg = $memberStatus['apiErrorMsg'];
                $this->_result = $memberStatus['apiErrorCode'];
            } else { // succeeded
                if( !$memberStatus['success'] ){ // not yet subscribed
                    // do subscribe
                    $msg = $this->doMemberSubscription( $data );
                    if( $msg == '' ) $this->_result = 0;
                } else { // already subscribed
                    switch( $memberStatus['status'] ){
                        case 'pending': // do nothing
                            $this->_result = 1001; break;                            
                        case 'unsubscribed': // subscribe
                            $this->_result = 1002; 
                            $msg = $this->doMemberSubscription( $data );
                            break;
                        case 'subscribed': // do update member
                            $this->_result = 1003; 
                            $msg = $this->doMemberUpdate( $data );
                            break;
                    }// switch( $memberStatus['status'] )
                } // if( $memberStatus['succeeded'] )
            } // if( !empty( $memberStatus['apiErrorCode'] ) )
        }
        switch( $this->_result ){
            case 0: $msg = 'Subscribed - look for the confirmation email!'; break;
            case 1: $msg = 'First Name must be entered'; break;
            case 2: $msg = 'Last Name must be entered'; break;
            case 3: $msg = 'E-mail must be valid'; break;
            case 999: $msg = 'Common Error!'; break;
            case 1001: $msg = "Your status is 'pending' - check inbox to finish subscription"; break;
            case 1002: $msg = "Your status is 'unsubscribed' - check inbox to finish re-subscription"; break;
            case 1003: $msg = "Your profile is updated"; break;
            default:                 
        }
        $return = array( 'result'=>$this->_result, 'message'=>$msg );
        //
        return $return;
    }
    
    private function validateData( $data )
    {
        $bValid = true;
        //
        if( empty( $data['first_name'] ) ){
            $bValid = false;
            $this->_result = 1;
        } else if( empty( $data['last_name'] ) ){
            $bValid = false;
            $this->_result = 2;
        }
        // 
        if( $bValid ){
            $validator = new CEmailValidator;
            if( ! $validator->validateValue( $data['email'] ) ){
                $this->_result = 3;
                $bValid = false;
            } // validate email
        } // if name is valid
        //
        return $bValid;
    }
    
    /** 
     * Retrieve member info
     * 
     */
    private function getMemberInfo( $email = null )
    {
        $data = array(
            'apiErrorCode' => '0',
            'apiErrorMsg'  =>  '',
        );
        if( !empty($email) ){
            $api = new MCAPI($this->apikey);
            //
            $retval = $api->listMemberInfo( $this->listID, array($email) );
            //
            if ($api->errorCode){
                $data['apiErrorCode'] = $api->errorCode;
                $data['apiErrorMsg'] = $api->errorMessage;
            } else {
                //MyFunctions::echoArray( $retval );
                $data['success'] = $retval['success'];
                $data['errors'] = $retval['errors'];
                if( $data['success'] ){
                    $data['status'] = $retval['data'][0]['status'];
                    $data['email'] = $retval['data'][0]['email'];
                } else {
                    $data['errorMail'] = $retval['data'][0]['email_address'];
                    $data['errorMsg'] = $retval['data'][0]['error'];
                }
                // retrieve full array
                $data['data'] = $retval ;
            }
        }
        return $data;
    }
    
    /**
     * Do subscription 
     */
    private function doMemberSubscription( $data = array() )
    {
        $result = '';
        $email = @$data['email'];
        if( !empty( $email )){
            // repare groupings part of merge_vars array
            $groups = '';
            if( isset($data['group1']) ) $groups = $this->group1Name;
            if( isset($data['group2']) ){
                if( $groups != '' ) $groups .= ',';
                $groups .= $this->group2Name;
            }
            // prepare merge_vars
            /** TODO: Switch betweeen merge_vars variations */
            $merge_vars = array(
                'FNAME'=>$data['first_name'],  
                'LNAME'=>$data['last_name'],  
                'COMPANY'=>$data['company'],  
                'POSITION'=>$data['job_title'],
                //'API_DATE'=>date('Y-m-d'),  
                'API_DATE'=>date('m/d/Y'),  
                'GROUPINGS'=>array( 
                    array( 'id'=>$this->listGroupingID, 'groups'=>$groups ), 
                    //array('id'=>'11749', 'groups'=>'Quarterly'),
                )
            );
            if( isset($data['group3']) ) { $merge_vars['GROUPINGS'][] = array( 'id'=>$this->eventsGroupingID, 'groups'=>'Events' ); }
            else  { $merge_vars['GROUPINGS'][] = array( 'id'=>$this->eventsGroupingID, 'groups'=>'' ); }
            if( isset($data['group4']) ) { $merge_vars['GROUPINGS'][] = array( 'id'=>$this->newsGroupingID, 'groups'=>'News' );}
            else  { $merge_vars['GROUPINGS'][] = array( 'id'=>$this->newsGroupingID, 'groups'=>'' );}
            //MyFunctions::echoArray($merge_vars);

            // By default this sends a confirmation email - you will not see new members
            // until the link contained in it is clicked!
            $api = new MCAPI($this->apikey);
            //
            $retval = $api->listSubscribe( $this->listID, $email, $merge_vars );
            
            if ($api->errorCode){
                $this->_result = $api->errorCode;
                $result = $api->errorMessage;
            }
            
        }
        return $result;
    }
    
    /**
     * Do Member Update 
     */
    private function doMemberUpdate( $data = array() )
    {
        $result = '';
        $email = @$data['email'];
        if( !empty( $email )){
            // repare groupings part of merge_vars array
            $groups = '';
            if( isset($data['group1']) ) $groups = $this->group1Name;
            if( isset($data['group2']) ){
                if( $groups != '' ) $groups .= ',';
                $groups .= $this->group2Name;
            }
            // prepare merge_vars
            $merge_vars = array(
                'FNAME'=>$data['first_name'],  
                'LNAME'=>$data['last_name'],  
                'COMPANY'=>$data['company'],  
                'POSITION'=>$data['job_title'],
                //'API_DATE'=>date('Y-m-d'),  
                'API_DATE'=>date('m/d/Y'),  
                'GROUPINGS'=>array( 
                    array( 'id'=>$this->listGroupingID, 'groups'=>$groups ), 
                    //array('id'=>'11749', 'groups'=>'Quarterly'),
                )
            );
            if( isset($data['group3']) ) { $merge_vars['GROUPINGS'][] = array( 'id'=>$this->eventsGroupingID, 'groups'=>'Events' ); }
            else  { $merge_vars['GROUPINGS'][] = array( 'id'=>$this->eventsGroupingID, 'groups'=>'' ); }
            if( isset($data['group4']) ) { $merge_vars['GROUPINGS'][] = array( 'id'=>$this->newsGroupingID, 'groups'=>'News' );}
            else  { $merge_vars['GROUPINGS'][] = array( 'id'=>$this->newsGroupingID, 'groups'=>'' );}

            // By default this sends a confirmation email - you will not see new members
            // until the link contained in it is clicked!
            $api = new MCAPI($this->apikey);
            //
            $retval = $api->listUpdateMember( $this->listID, $email, $merge_vars, 'html', true );
            
            if ($api->errorCode){
                $this->_result = $api->errorCode;
                $result = $api->errorMessage;
            }
            
        }
        return $result;
    }
    
    
    /** Register scripts */
    private function registerScripts()
    {
        // register script
        if( ($theme=Yii::app()->getTheme())!==null )
            $assetPath = $this->viewPath . DIRECTORY_SEPARATOR . 'js';
        else
            $assetPath = Yii::getPathOfAlias('');
        //MyFunctions::echoArray( $assetPath );
        $assetsFolder=Yii::app()->assetManager->publish( $assetPath,
            false, -1, true
        );
        Yii::app()->clientScript->registerScriptFile( $assetsFolder . '/jquery.newsletter.js' );
        //Yii::app()->clientScript->registerCoreScript('jquery');
    }

    /**
     * Overrides default widget function to implement AoD theming
     * widget view file's path is:
     * theme/views/moduleName/widgetName
     */
    public function getViewPath(){
        if( ($theme=Yii::app()->getTheme())!==null ){
            // create dir as: /moduleName/widgetPath
            $dir = str_replace( Yii::getPathOfAlias('ext'), '', dirname(__FILE__) );
            return Yii::app()->getTheme()->viewPath . $dir;
        } else {
            return parent::getViewPath(false);
        }        
    }
    
}