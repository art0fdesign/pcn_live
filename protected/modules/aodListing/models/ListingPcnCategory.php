<?php

/**
 * This is the model class for table "mod_listing_pcn_category".
 *
 * The followings are the available columns in table 'mod_listing_pcn_category':
 * @property string $id
 * @property integer $expertize
 * @property string $parent_id
 * @property string $order_by
 * @property string $cat_title
 *
 * The followings are the available model relations:
 * @property User $creator
 * @property User $editor
 */
class ListingPcnCategory extends CmsActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ModListingPcnCategory the static model class
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
		return 'mod_listing_pcn_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('expertize, level', 'numerical', 'integerOnly'=>true),
			array('parent_id', 'length', 'max'=>10),
			array('order_by', 'length', 'max'=>11),
			array('cat_title', 'length', 'max'=>100),
			// The following rule is used by search().            
			// Please remove those attributes that should not be searched.
            // Uncomment if needed
			//array('id, expertize, parent_id, order_by, cat_title', 'safe', 'on'=>'search'),
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
			'parent' => array(self::BELONGS_TO, 'ListingPcnCategory', array('parent_id'=>'id')),
		// 	'creator' => array(self::BELONGS_TO, 'User', 'created_id'),
		// 	'editor' => array(self::BELONGS_TO, 'User', 'changed_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'expertize' => 'Expertize',
			'parent_id' => 'Parent',
			'level' => 'Level',
			'order_by' => 'Order By',
			'cat_title' => 'Cat Title',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('expertize',$this->expertize);
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('order_by',$this->order_by,true);
		$criteria->compare('cat_title',$this->cat_title,true);

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
    }/**/

    public function getFullName() {
    	$return = $this->cat_title;
    	if ($this->parent_id) {
    		$return = $this->parent->fullName . '/' . $return;
    	}
    	return $return;
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
        $condition = ''; $params = array(); //if( !$showDeleted ) $condition = 'f_deleted = 0';
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