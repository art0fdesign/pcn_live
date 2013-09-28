<?php

/**
 * This is the model class for table "mod_events_registration_session".
 *
 * The followings are the available columns in table 'mod_registration_session':
 * @property integer $id
 * @property string $city
 * @property int $name
 * @property int $num_of_sessions
 * @property string $sessions
 * @property string $date_from
 * @property string $date_to
 * @property double $price_low
 * @property double $price_high
 * @property string $content
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
class EventsRegistrationSession extends CmsActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RegistrationSession the static model class
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
		return 'mod_events_registration_session';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('city, name, num_of_sessions, sessions, date_from', 'required'),
			array('num_of_sessions, order_by, f_status, f_deleted', 'numerical', 'integerOnly'=>true),
			array('price_low, price_high', 'numerical'),
			array('city, sessions, name', 'length', 'max'=>256),
			array('content', 'length', 'max'=>2048),
			array('date_to', 'safe'),
			// The following rule is used by search().            
			// Please remove those attributes that should not be searched.
            // Uncomment if needed
			//array('id, name, sessions, date_from, date_to, price_low, price_high, content, order_by, f_status, created_id, created_dt, changed_id, changed_dt, f_deleted', 'safe', 'on'=>'search'),
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
            'city'=>'City',
			'name' => 'Name',
            'num_of_sessions'=>'Number Of Sessions',
			'sessions' => 'Sessions',
			'date_from' => 'Date From',
			'date_to' => 'Date To',
			'price_low' => 'Price Low',
			'price_high' => 'Price High',
			'content' => 'Content',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('sessions',$this->sessions);
		$criteria->compare('date_from',$this->date_from,true);
		$criteria->compare('date_to',$this->date_to,true);
		$criteria->compare('price_low',$this->price_low);
		$criteria->compare('price_high',$this->price_high);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('order_by',$this->order_by);
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

    public function getPrice($p)
    {
        if($p == 0) return $this->price_low;
        else return $this->price_high;
    }
    
}