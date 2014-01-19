<?php
class MailChimpWidget extends CWidget
{
    public $html    = '';
    public $params = array();
    public $type = '';

    protected $_settings = array();

    protected $apikey = 'ea5794a86d070e040f20efce6f0e4151-us5'; // aod
    protected $listID = '7fbd5f1541'; // aod - lista1
    //protected $apiUrl = 'http://api.mailchimp.com/1.3/';
    // groupings
    protected $listGroupingID   = '12945';
    protected $group1Name       = 'Quarterly';
    protected $group2Name       = 'Daily';
    protected $group3Name       = '';
    protected $group4Name       = '';
    protected $eventsGroupingID = '12949';
    protected $eventsName1      = 'Events';
    protected $newsGroupingID   = '12953';
    protected $newsName1        = 'News';

    protected $_result = 99; // subscription result

    public function init()
    {
        $modID = ModRegister::getModuleID('mailChimp');
        $sets = ModSetting::getSettingsArray( $modID );
        $this->_settings = $sets;
        if (!empty($sets['api-key']))           $this->apikey           = $sets['api-key']['value'];
        if (!empty($sets['list-id']))           $this->listID           = $sets['list-id']['value'];
        if (!empty($sets['grouping-id']))       $this->listGroupingID   = $sets['grouping-id']['value'];
        if (!empty($sets['group1-name']))       $this->group1Name       = $sets['group1-name']['value'];
        if (!empty($sets['group2-name']))       $this->group2Name       = $sets['group2-name']['value'];
        if (!empty($sets['group3-name']))       $this->group3Name       = $sets['group3-name']['value'];
        if (!empty($sets['group4-name']))       $this->group4Name       = $sets['group4-name']['value'];
        if (!empty($sets['events-group-id']))   $this->eventsGroupingID = $sets['events-group-id']['value'];
        if (!empty($sets['events-name-1']))     $this->eventsName1      = $sets['events-name-1']['value'];
        if (!empty($sets['news-group-id']))     $this->newsGroupingID   = $sets['news-group-id']['value'];
        if (!empty($sets['news-name-1']))       $this->newsName1        = $sets['news-name-1']['value'];
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
            // Prepare groupings part of merge_vars array
            $groupsArray = array();
            if( !empty($data['group1']) ) $groupsArray[] = $this->group1Name;
            if( !empty($data['group2']) ) $groupsArray[] = $this->group2Name;
            // if( !empty($data['group3']) && !empty($this->group3Name) ) $groupsArray[] = $this->group3Name;
            // if( !empty($data['group4']) && !empty($this->group4Name) ) $groupsArray[] = $this->group4Name;
            $groups = '';
            if (!empty($groupsArray)) $groups = implode(',', $groupsArray);
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
            if( isset($data['group3']) ) { $merge_vars['GROUPINGS'][] = array( 'id'=>$this->eventsGroupingID, 'groups'=>$this->eventsName1 ); }
            else  { $merge_vars['GROUPINGS'][] = array( 'id'=>$this->eventsGroupingID, 'groups'=>'' ); }
            if( isset($data['group4']) ) { $merge_vars['GROUPINGS'][] = array( 'id'=>$this->newsGroupingID, 'groups'=>$this->newsName1 );}
            else  { $merge_vars['GROUPINGS'][] = array( 'id'=>$this->newsGroupingID, 'groups'=>'' );}
            // MyFunctions::echoArray($merge_vars);
                // echo CJSON::encode( $merge_vars );
                // Yii::app()->end();

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
            // Prepare groupings part of merge_vars array
            $groupsArray = array();
            if( !empty($data['group1']) ) $groupsArray[] = $this->group1Name;
            if( !empty($data['group2']) ) $groupsArray[] = $this->group2Name;
            // if( !empty($data['group3']) && !empty($this->group3Name) ) $groupsArray[] = $this->group3Name;
            // if( !empty($data['group4']) && !empty($this->group4Name) ) $groupsArray[] = $this->group4Name;
            $groups = '';
            if (!empty($groupsArray)) $groups = implode(',', $groupsArray);
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

            if( isset($data['group3']) ) { $merge_vars['GROUPINGS'][] = array( 'id'=>$this->eventsGroupingID, 'groups'=>$this->eventsName1 ); }
            else  { $merge_vars['GROUPINGS'][] = array( 'id'=>$this->eventsGroupingID, 'groups'=>'' ); }
            if( isset($data['group4']) ) { $merge_vars['GROUPINGS'][] = array( 'id'=>$this->newsGroupingID, 'groups'=>$this->newsName1 );}
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