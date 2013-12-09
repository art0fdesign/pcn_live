<?php

/**
 * This is the model class for table "mod_webshop_request".
 *
 * The followings are the available columns in table 'mod_webshop_request':
 * @property integer $id
 * @property string $token
 * @property string $webshop_id
 * @property string $first_name
 * @property string $last_name
 * @property string $title_position
 * @property string $company
 * @property string $division_department
 * @property string $street_address
 * @property string $suburb
 * @property string $state
 * @property string $postcode
 * @property string $abbr
 * @property string $country
 * @property string $telephone
 * @property string $mobile
 * @property string $email
 * @property string $dietary_requirements
 * @property string $dietary_other
 * @property integer $f_earlybird
 * @property string $items_json
 * @property string $reports_json
 * @property integer $steps_completed
 * @property string $invoice_date
 * @property integer $invoice_number
 * @property string $invoice_reference
 * @property string $invoice_description
 * @property string $invoice_comment
 * @property string $purchase_dt
 * @property string $purchase_response
 * @property integer $completed
 * @property string $created_dt
 * @property string $changed_dt
 *
 * The followings are the available model relations:
 * @property User $creator
 * @property User $editor
 */
class WebshopRequest extends CmsActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return WebshopRequest the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mod_webshop_request';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('webshop_id, token', 'required'),
            // Registration Form required Parameters
            array('first_name, last_name, title_position, company, division_department, street_address, suburb', 'required', 'on' => 'reg_form'),
            array('postcode, abbr, telephone, mobile, email', 'required', 'on' => 'reg_form'),
            //
            array('f_earlybird, steps_completed, invoice_number, completed', 'numerical', 'integerOnly'=>true),
            array('token', 'length', 'max'=>36),
            array('first_name, last_name, title_position, company, division_department, street_address, suburb, state, country, telephone, mobile, email, dietary_requirements', 'length', 'max'=>100),
            array('postcode, abbr, dietary_other, invoice_reference', 'safe'),
            array('items_json, reports_json, invoice_date, invoice_description, invoice_comment', 'safe'),
            array('purchase_dt, purchase_response, created_dt, changed_dt', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            // Uncomment if needed
            //array('id, token, webshop_id, first_name, last_name, title_position, company, division_department, street_address, suburb, state, postcode, abbr, country, telephone, mobile, email, dietary_requirements, dietary_other, f_earlybird, items_json, reports_json, steps_completed, invoice_date, invoice_number, invoice_reference, invoice_description, invoice_comment, purchase_dt, purchase_response, completed, created_dt, changed_dt', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'creator' => array(self::BELONGS_TO, 'User', 'created_id'),
            'editor' => array(self::BELONGS_TO, 'User', 'changed_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'token' => 'Token',
            'webshop_id' => 'Webshop',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'title_position' => 'Title Position',
            'company' => 'Company',
            'division_department' => 'Division Department',
            'street_address' => 'Street Address',
            'suburb' => 'Suburb',
            'state' => 'State',
            'postcode' => 'Postcode',
            'abbr' => 'Abbr',
            'country' => 'Country',
            'telephone' => 'Telephone',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'dietary_requirements' => 'Dietary Requirements',
            'dietary_other' => 'Dietary Other',
            'f_earlybird' => 'F Earlybird',
            'items_json' => 'Items Json',
            'reports_json' => 'Reports Json',
            'steps_completed' => 'Steps Completed',
            'invoice_date' => 'Invoice Date',
            'invoice_number' => 'Invoice Number',
            'invoice_reference' => 'Invoice Reference',
            'invoice_description' => 'Invoice Description',
            'invoice_comment' => 'Invoice Comment',
            'purchase_dt' => 'Purchase Dt',
            'purchase_response' => 'Purchase Response',
            'completed' => 'Completed',
            'created_dt' => 'Created Time',
            'changed_dt' => 'Changed Time',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    /*// uncomment this line if search is needed
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('token',$this->token,true);
        $criteria->compare('webshop_id',$this->webshop_id,true);
        $criteria->compare('first_name',$this->first_name,true);
        $criteria->compare('last_name',$this->last_name,true);
        $criteria->compare('title_position',$this->title_position,true);
        $criteria->compare('company',$this->company,true);
        $criteria->compare('division_department',$this->division_department,true);
        $criteria->compare('street_address',$this->street_address,true);
        $criteria->compare('suburb',$this->suburb,true);
        $criteria->compare('state',$this->state,true);
        $criteria->compare('postcode',$this->postcode,true);
        $criteria->compare('abbr',$this->abbr,true);
        $criteria->compare('country',$this->country,true);
        $criteria->compare('telephone',$this->telephone,true);
        $criteria->compare('mobile',$this->mobile,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('dietary_requirements',$this->dietary_requirements,true);
        $criteria->compare('dietary_other',$this->dietary_other,true);
        $criteria->compare('f_earlybird',$this->f_earlybird);
        $criteria->compare('items_json',$this->items_json,true);
        $criteria->compare('reports_json',$this->reports_json,true);
        $criteria->compare('steps_completed',$this->steps_completed);
        $criteria->compare('invoice_date',$this->invoice_date,true);
        $criteria->compare('invoice_number',$this->invoice_number);
        $criteria->compare('invoice_reference',$this->invoice_reference,true);
        $criteria->compare('invoice_description',$this->invoice_description,true);
        $criteria->compare('invoice_comment',$this->invoice_comment,true);
        $criteria->compare('purchase_dt',$this->purchase_dt,true);
        $criteria->compare('purchase_response',$this->purchase_response,true);
        $criteria->compare('completed',$this->completed);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }/**/

    /**
     * Override cms function because there is no created->changed fields in table
     */
    // uncomment this line if validation is needed
    protected function beforeValidate()
    {
        return true;
    }

    /**
     * Retrieves a list of models
     * Simulates model()->findAll function w/o parameters
     * @param String $orderBY Attribute name to sort by
     * @param Array $filters Attributes to filter by
     * @param Bool $showDeleted Show/Hide deleted records
     * @return Array all models that meet params
     */
    public static function retrieveAll( $orderBy = '', $filters = array(), $showDeleted = false )
    {
        // prepare dbcommand parameters
        if( empty( $orderBy ) ) $orderBy = self::model()->tableSchema->primaryKey;
        if( empty( $orderBy ) ) $orderBy = array_shift( self::model()->attributeNames() );
        $condition = ''; $params = array(); if( !$showDeleted ) $condition = 'f_deleted = 0';
        // prepare filters
        foreach( $filters as $key => $value ){
            if( isset( $key ) && isset( $value ) ){
                // check is attribute
                if( !in_array( $key, self::model()->attributeNames() ) ) continue;
                // update condition and params
                if( !empty( $condition ) ) $condition .= ' and ';
                if( is_numeric( $value ) ){ // numeric
                    $condition .= $key . ' = :' . $key;
                    $params[$key] = $value;
                } else { // string
                    $condition .= $key . ' like :' . $key;
                    $params[$key] = '%' . $value . '%';
                } // isnumeric ||isstring
            } // if(isset (key & value))
        } // foreach ( $filters )
        //
        return self::model()->findAll( array( 'order'=>$orderBy, 'condition'=>$condition, 'params'=>$params ) );
    }

    public function dietaryRequirements()
    {
        return CJSON::decode($this->dietary_requirements,false);
    }

    public function dietaryRequirementsText()
    {
        if (empty($this->dietary_requirements)) {
            return false;
        }
        $return = '';
        $arr = json_decode($this->dietary_requirements, true);
        foreach ($arr as $key => $value) {
            if (!empty($return)) {
                $return .= ', ';
            }
            switch ($value) {
                case 'vegetarian': $return .= 'Vegetarian'; break;
                case 'gluten_free': $return .= 'Gluten free'; break;
                case 'other': $return .= 'Other: '.$this->dietary_other; break;
                default: $return .= $key;
            }
        }
        return $return;
        // Myfunctions::echoArray($arr, $return);
        // die($this->dietary_requirements);
    }

}