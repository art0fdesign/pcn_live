<?php
class MailChimpWidget extends CWidget
{
    public $html   = '';
    public $params = array();
    public $type   = '';

    protected $_settings   = array();
    protected $_apikey     = 'ea5794a86d070e040f20efce6f0e4151-us5'; // aod
    protected $_email      = null;
    protected $_merge_vars = array();

    protected $_result     = 99; // subscription result

    public function init()
    {
        $modID = ModRegister::getModuleID('mailChimp');
        $sets = ModSetting::getSettingsArray( $modID );
        $this->_settings = $sets;
        if (!empty($sets['api-key'])) $this->_apikey = $sets['api-key']['value'];
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
     * Prepares MergeVars Array for creating mailChimp request
     * @param  Array $data GET array
     * @return Array|null
     */
    private function prepareMergeVars( $data = null )
    {
        if ( is_null($this->_settings) || is_null($data) )
            return null;

        $vars = array();
        for ( $i = 1; $i <= 4; $i++ ) {
            if ( isset($this->_settings['opt' . $i . '-list-id']) ) {
                $listID    = $this->_settings['opt' . $i . '-list-id']['value'];
                $groupID   = $this->_settings['opt' . $i . '-group-id']['value'];


                if ( empty($groupID) && ! isset($vars[$listID]) ) {
                    $vars[$listID] = array();
                }

                if ( ! empty($groupID) && ! isset($vars[$listID])
                     || ( isset($vars[$listID]) && ! in_array($groupID, $vars[$listID]) )
                ) {
                    $vars[$listID][] = $groupID;
                }
            }
        }

        // Full lists empty merge_vars
        if ( ! empty($vars)) {
            foreach ($vars as $listID => $list) {
                $groupings = array();
                foreach ($list as $groupID) {
                    if ( ! empty($groupID) ) {
                        $groupings[] = array(
                            'id'     => $groupID,
                            'groups' => '',
                        );
                    }
                }
                $this->_merge_vars[$listID] = array(
                    'FNAME'     => $data['first_name'],
                    'LNAME'     => $data['last_name'],
                    'COMPANY'   => $data['company'],
                    'POSITION'  => $data['job_title'],
                    'API_DATE'  => date('m/d/Y'),
                );
                if ( ! empty($groupings) )
                    $this->_merge_vars[$listID]['GROUPINGS'] = $groupings;
            }
        }

        $vars = array();
        for ( $i = 1; $i <= 4; $i++ ) {
            if ( isset($data['opt' . $i . '']) ) {
                $listID    = $this->_settings['opt' . $i . '-list-id']['value'];
                $groupID   = $this->_settings['opt' . $i . '-group-id']['value'];
                $groupName = $this->_settings['opt' . $i . '-group-name']['value'];

                $vars[$listID][$groupID][] = $groupName;
            }
        }

        // If groupings ARE selected
        if ( ! empty($vars)) {
            foreach ($vars as $listID => $list) {
                foreach ($list as $groupID => $group) {
                    $groupNames = array();
                    foreach ($group as $groupName) {
                        $groupNames[] = $groupName;
                    }
                    $groups = implode( ',', $groupNames );

                    // Update GROUPINGS groups value
                    foreach ($this->_merge_vars[$listID]['GROUPINGS'] as $index => $grouping) {
                        if ( $grouping['id'] == $groupID ) {
                            $this->_merge_vars[$listID]['GROUPINGS'][$index]['groups'] = $groups;
                            break;
                        }
                    }
                }
            }
        }

        return $this->_merge_vars;
    }

    /**
     * Subscribe user and return result/message pair
     */
    private function subscribe( $data )
    {
        $msg = ''; // common error

        $merge_vars = $this->prepareMergeVars($data);
        // MyFunctions::echoArray($merge_vars);
        // only if there are data AND they are valid
        if( $data !== null && $this->validateData( $data ) && ! is_null($merge_vars) ){
            $this->_email = $data['email'];
            foreach ($this->_merge_vars as $listID => $merge_vars) {
                // check is user already subscribed
                $memberStatus = $this->getMemberInfo( $listID, $this->_email );
            //MyFunctions::echoArray( array( 'valid'=>$this->validateData( $data ), 'status'=>$memberStatus ), $data );
                // if returned in error
                if( !empty( $memberStatus['apiErrorCode'] ) ){
                    $msg = $memberStatus['apiErrorMsg'];
                    $this->_result = $memberStatus['apiErrorCode'];
                } else { // succeeded
                    if( !$memberStatus['success'] ){ // not yet subscribed
                        // do subscribe
                        $msg = $this->doMemberSubscription( $listID, $data );
                        if( $msg == '' ) $this->_result = 0;
                    } else { // already subscribed
                        switch( $memberStatus['status'] ){
                            case 'pending': // do nothing
                                $this->_result = 1001; break;
                            case 'unsubscribed': // subscribe
                                $this->_result = 1002;
                                $msg = $this->doMemberSubscription( $listID, $data );
                                break;
                            case 'subscribed': // do update member
                                $this->_result = 1003;
                                $msg = $this->doMemberUpdate( $listID, $data );
                                break;
                        }// switch( $memberStatus['status'] )
                    } // if( $memberStatus['succeeded'] )
                } // if( !empty( $memberStatus['apiErrorCode'] ) )
            }
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
    private function getMemberInfo( $listID = null, $email = null )
    {
        $data = array(
            'apiErrorCode' => '0',
            'apiErrorMsg'  =>  '',
        );
        if( !empty($email) ){
            $api = new MCAPI($this->_apikey);
            //
            $retval = $api->listMemberInfo( $listID, array($email) );
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
    private function doMemberSubscription( $listID = null, $data = array() )
    {
        $result = null;
        if( !empty($this->_email) && ! empty($this->_merge_vars[$listID]) ){
            // By default this sends a confirmation email - you will not see new members
            // until the link contained in it is clicked!
            $api = new MCAPI($this->_apikey);

            // MyFunctions::echoArray($merge_vars);
            // echo CJSON::encode( $merge_vars );
            // Yii::app()->end();
            //
            $retval = $api->listSubscribe( $listID, $this->_email, $this->_merge_vars[$listID] );

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
    private function doMemberUpdate( $listID = null, $data = array() )
    {
        $result = '';
        if( !empty($this->_email) && ! empty($this->_merge_vars[$listID]) ){
            // By default this sends a confirmation email - you will not see new members
            // until the link contained in it is clicked!
            $api = new MCAPI($this->_apikey);

            $retval = $api->listUpdateMember( $listID, $this->_email, $this->_merge_vars[$listID], 'html', true );

            if ($api->errorCode){
                $this->_result = $api->errorCode;
                $result = $api->errorMessage . '; listID: ' . $listID . ', ' . json_encode($this->_merge_vars[$listID]);
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