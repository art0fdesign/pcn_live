<?php

/**
 * This is the model class for table "mod_event_price".
 *
 * The followings are the available columns in table 'mod_event_price':
 * @property integer $id
 * @property string $event_id
 * @property string $parent_id
 * @property string $option_level
 * @property string $option_value
 * @property string $option_text
 * @property string $price_low
 * @property string $price_high
 * @property string $price_extra_json
 * @property integer $order_by
 * @property integer $f_status
 * @property string $created_id
 * @property string $created_dt
 * @property integer $changed_id
 * @property string $changed_dt
 * @property integer $f_deleted
 *
 * The followings are the available model relations:
 * @property User $creator
 * @property User $editor
 */
class EventPrice extends CmsActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return EventPrice the static model class
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
        return 'mod_event_price';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('order_by, event_id, parent_id, option_level', 'numerical', 'integerOnly'=>true),
            array('price_low, price_high', 'numerical', 'integerOnly'=>false),
            array('option_value, option_text', 'length', 'max'=>100),
            array('price_extra_json', 'safe'),
            array('f_status, changed_id, created_id, f_deleted, changed_dt, created_dt', 'safe'),
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
            'event_id' => 'Event',
            'parent_id' => 'Parent',
            'option_level' => 'Option Level',
            'option_value' => 'Option Value',
            'option_text' => 'Option Text',
            'price_low' => 'Price Low',
            'price_high' => 'Price High',
            'price_extra_json' => 'Price Extra Json',
            'order_by' => 'Order By',
            'f_status' => 'Status',
            'created_id' => 'Created By',
            'created_dt' => 'Created Time',
            'changed_id' => 'Changed By',
            'changed_dt' => 'Changed Time',
            'f_deleted' => 'Deleted',
        );
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

}