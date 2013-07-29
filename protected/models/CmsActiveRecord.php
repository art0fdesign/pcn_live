<?php

abstract class CmsActiveRecord extends CActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    /**
     * Prepares created_dt, created_id, updated_dt and updated_id attributes before performing validation.
     */
    protected function beforeValidate()
    {
        if($this->isNewRecord){
            // set properly values for creation of user
            $this->created_dt=$this->changed_dt=new CDbExpression('NOW()');
            $this->created_id=$this->changed_id=Yii::app()->user->id;
        } else {
            // not new record, set only update fields
            $this->changed_dt=new CDbExpression('NOW()');
            $this->changed_id=Yii::app()->user->id;
        }
        
        return parent::beforeValidate();
    }

    /**
     * Overrides model's delete action
     * Not really deletes model but set some fields to mark deletion
     * @return success of marking as deleted
     */
    public function delete($force_delete=true)
    {
        if ($force_delete) {
            return parent::delete();
        }
        elseif( !$this->isNewRecord ){
            $this->f_deleted = 1;
            $this->changed_id = Yii::app()->user->id;
            $this->changed_dt = new CDbExpression('NOW()');
            return $this->save(false);
        } else 
            return false;
    }
    
    /**
     * Simulates model's update action
     * Perform update of specified columns in current model
     * Sometimes it is usefull to update some columns
     * @attributes: array of type 'field'=>'new value'; must be at least one pair
     */
    public function updatePartial( $attributes = null )
    {
        if( ! empty($attributes) && is_array( $attributes ) ){
            // generates sql query and params array
            $params = array();
            $table = $this->tableName();
            $sql = "UPDATE {$table} SET ";
            foreach( $attributes as $key=>$value ){
                if( count($params) != 0 ) $sql .= ', ';// add comma separator between fields
                if( strtolower($value) != 'now()' ){
                    $sql .= "$key = :$key";
                    $params[$key] = $value;
                } else {
                    // now value must be prepared on some other way
                    // this is probably not best solution... but for now works
                    $sql .= "$key = now()";
                } 
            }
            $sql .= " WHERE id = :id";
            $params['id'] = $this->id;
            //MyFunctions::echoArray(array('sql'=>$sql, 'params'=>$params));
            // Execute prepared statement and parameters 
            return Yii::app()->db->createCommand($sql)->execute($params);
            
        } else {
            return false;
        }
    }

    /**
     * Retrieves a list of models 
     * Simulates model()->findAll function w/o parameters
     * --------------------------------------------------------------------
     * Like functionality can be implemented using filter value in format 'like fs'
     * - fs can be any sql prepared string: %filter% etc.
     * --------------------------------------------------------------------
     * @param String $modelName Name of model
     * @param Array $filters Attributes to filter by 
     * @param Mixed $parameters order, limit, offset Attributes 
     * @param Bool $showDeleted Show/Hide deleted records
     * @return Array all models that meet params
     */     
    public static function retrieveAllByModel( $modelName = null, $filters = array(), $parameters = null, $showDeleted = false )
    {        
        $ret = array();
        // check is class exists
        if( class_exists( $modelName, false) ){
            $find = array();  
            $attribNames = @$modelName::model()->attributeNames();          
            // prepare field filters
            // params can also be given in filters            
            $condition = ''; $params = array(); 
            // !!! BE CAREFUL: given $params parameters is cleared in prev statement  
            // if marked for nondeleted and is f_deleted in attributes array set condition
            if( !$showDeleted && in_array( 'f_deleted', $attribNames ) ) 
                $condition = 'f_deleted = 0';
            // prepare filters
            foreach( $filters as $key => $value ){
                if( isset( $key ) && isset( $value ) ){
                    switch( $key ){
                        case 'order': $find[$key] = $value; break;
                        case 'limit':
                        case 'offset': $find[$key] = (int)$value; break;
                        default:
                            // check is attribute
                            if( !in_array( $key, $attribNames ) ) continue;
                            // update condition and params                 
                            if( !empty( $condition ) ) $condition .= ' and ';
                            /* separate 'like' filterings */
                            if( substr( $value, 0, 4 ) == 'like' ){
                                $condition .= $key . ' like :' . $key;
                                $params[$key] = substr($value, 5);
                            } else { // general 
                                $condition .= $key . ' = :' . $key;
                                $params[$key] = $value;
                            }
                            /* like function for string is not eligible; we need more specific conditioning
                            // if one needs 'like' functionality then he needs to program that here ;-)
                            if( is_numeric( $value ) ){ // numeric
                                $condition .= $key . ' = :' . $key;
                                $params[$key] = $value;
                            } else { // string
                                $condition .= $key . ' like :' . $key;
                                $params[$key] = '%' . $value . '%';
                            } // isnumeric ||isstring
                            /**/
                    }
                } // if(isset (key & value))
            } // foreach ( $filters )
            // merge condition & params
            $find['condition'] = $condition;
            $find['params'] = $params;
            // prepare dbcommand parameters
            if( !empty($parameters) ){
                // $filters can be array with params or string when retrieves order param
                if( is_array($parameters) ){
                    // for safety check given params
                    foreach( $parameters as $key=>$value ){
                        if( isset( $key ) && isset( $value ) && in_array( $key, array( 'order', 'limit', 'offset' ) ) ){
                            $find[$key] = $value;
                        }
                    }
                } else $find['order'] = $parameters;
            }
            // prevent from sending empty string in order parameter
            if( empty($find['order']) ) $find['order'] = $modelName::model()->tableSchema->primaryKey;
            //
            $ret = $modelName::model()->findAll( $find );
        } // if( $model = is_object($className, false))
        //
        return $ret;
    }
    
    /**
     * Retrieves status options array
     */
    public static function getStatusOptions()
    {
        return array(
            self::STATUS_INACTIVE => 'Inactive',
            self::STATUS_ACTIVE => 'Active',
        );
    }
    public static function getStatusText($statusValue=0)
    {
        if( $statusValue == 0 ) return 'Inactive';
        else return 'Active';
    }
    
    /**
     * Retrieve Yes/No text
     */
    public function getYesNoText( $value )
    {
        if( $value ) return 'Yes';
        else return 'No';
    }
    
    /** **********************************************************************************************
     *  SESSION MANIPULATION
     ************************************************************************************************/
    public static function getSessionKey( $param )
    {
        $ret = '';
        switch( $param ){
            default: // return param as key 
                $ret = $param;
        }
        return Yii::app()->session->sessionID . '__' . $ret;
    }
    public static function getSessionValue( $param )
    {
        $key = self::getSessionKey( $param );
        return !empty(Yii::app()->session[$key])? Yii::app()->session[$key]: null;
    }
    public static function setSessionValue( $param, $value )
    {
        $key = self::getSessionKey( $param );
        Yii::app()->session[$key] = $value;
        return $value;
    }
    public static function unsetSessionValue( $param )
    {
        $key = self::getSessionKey( $param );
        $value = self::getSessionValue( $param );
        unset(Yii::app()->session[$key]);
        return $value;
    }
    
    /** **********************************************************************************************
     *  ZipCodes/Countries/States MANIPULATION
     ************************************************************************************************/
    /**
     * Retrieves us states options
     * @return array us states array 'abbr'=>'name'
     */
    public static function getUSStates()
    {
        $states = array();
        $rows = Yii::app()->db->createCommand()
            ->select()
            ->from('mod_states_us')
            ->order('name')
            ->queryAll();
        foreach( $rows as $item ){
            $states[ $item['abbrev'] ] = $item['name'];
        }
        return $states;
    }
    /** Retrieve name for selected state */
    public static function getUSStateName( $stateCode = '' )
    {
        $result = '';
        if( !empty( $stateCode ) ){
            $result = Yii::app()->db->createCommand()
                ->select('name')
                ->from('mod_states_us')
                ->where( 'abbrev = :abbrev', array('abbrev'=>$stateCode) )
                ->queryScalar();
        }
        return $result;
    }
    /** Retrieve city name from zip_code */
    public static function getCityNameByZip( $zip = null, $prependZIP = false )
    {
        $result = '';
        $returnSQL = "concat(city, ', ', state)";
        if( $prependZIP ) $returnSQL = "concat(zip, ' ', city, ', ', state)";
        //
        if( $zip !== null ){
            $result = Yii::app()->db->createCommand()
                ->select($returnSQL)
                ->from('zip_codes')
                ->where( 'zip = :zip', array('zip'=>$zip) )
                ->queryScalar();
        }
        return $result;
    }
}