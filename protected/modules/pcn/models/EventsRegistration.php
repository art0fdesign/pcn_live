<?php

/**
 * This is the model class for table "mod_registration".
 *
 * The followings are the available columns in table 'mod_registration':
 * @property integer $id
 * @property integer $session_id
 * @property integer $price  if this field is 0 it means high price, else if 1, it's low price
 * @property string $first_name
 * @property string $surname
 * @property string $title_position
 * @property string $company
 * @property string $division_department
 * @property string $street_address
 * @property string $suburb
 * @property string $state
 * @property integer $postcode
 * @property string $country
 * @property string $telephone
 * @property string $mobile
 * @property string $email
 * @property string $dietary_requirements
 * @property string $dietary_other
 * @property string $ticket
 * @property integer $terms
 * @property string $created_dt
 * @property integer $f_status
 * @property integer $f_deleted
 */
class EventsRegistration extends CActiveRecord
{
    protected function beforeValidate()
    {
        if($this->isNewRecord){
            // set properly values for creation of user
            $this->created_dt=new CDbExpression('NOW()');
        }
        return parent::beforeValidate();
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Registration the static model class
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
        return 'mod_events_registration';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //array('postcode, first_name, surname, title_position, company, street_address, suburb, state, country, telephone, mobile, email', 'required'),
            array('postcode, first_name, surname, title_position, company, street_address, suburb, state, country, telephone, mobile, email', 'required'),
            array('session_id, price,  postcode,  f_status, f_deleted', 'numerical', 'integerOnly'=>true),
            array('first_name, surname, title_position, company, division_department, street_address, suburb, state, country, telephone, mobile, email, dietary_other', 'length', 'max'=>100),
            array('email', 'email'),
            //array('terms', 'required', 'requiredValue' => 1, 'message' => 'You must agree the Terms and Conditions'),
            // array('terms', 'boolean', 'falseValue'=>'false', 'message' => 'You must agree to the registration Terms and Conditions'),
            array('terms', 'in', 'range'=>array(1), 'message' => 'You must agree to the registration Terms and Conditions'),
            array('dietary_requirements, dietary_other, ticket', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            // Uncomment if needed
            //array('id, session_id, first_name, surname, title_position, company, division_department, street_address, suburb, state, postcode, country, telephone, mobile, email, dietary_requirements, created_dt, f_status, f_deleted', 'safe', 'on'=>'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'session_id' => 'Session',
            'price'=>'Price',
            'first_name' => 'First Name',
            'surname' => 'Surname',
            'title_position' => 'Title Position',
            'company' => 'Company',
            'division_department' => 'Division Department',
            'street_address' => 'Street Address',
            'suburb' => 'Suburb',
            'state' => 'State',
            'postcode' => 'Postcode',
            'country' => 'Country',
            'telephone' => 'Telephone',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'dietary_requirements' => 'Dietary Requirements',
            'dietary_other' => 'Dietary Requirements Other',
            'ticket' => 'Ticket',
            'terms'=>'Terms',
            'created_dt' => 'Created Time',
            'f_status' => 'Status',
            'f_deleted' => 'Deleted',
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
        $criteria->compare('session_id',$this->session_id);
        $criteria->compare('first_name',$this->first_name,true);
        $criteria->compare('surname',$this->surname,true);
        $criteria->compare('title_position',$this->title_position,true);
        $criteria->compare('company',$this->company,true);
        $criteria->compare('division_department',$this->division_department,true);
        $criteria->compare('street_address',$this->street_address,true);
        $criteria->compare('suburb',$this->suburb,true);
        $criteria->compare('state',$this->state,true);
        $criteria->compare('postcode',$this->postcode);
        $criteria->compare('country',$this->country,true);
        $criteria->compare('telephone',$this->telephone,true);
        $criteria->compare('mobile',$this->mobile,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('dietary_requirements',$this->dietary_requirements,true);
        $criteria->compare('f_status',$this->f_status);
        $criteria->compare('f_deleted', 0);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }/**/

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