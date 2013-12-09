<?php

/**
 * This is the model class for table "mod_webshop_item".
 *
 * The followings are the available columns in table 'mod_webshop_item':
 * @property string $id
 * @property string $webshop_id
 * @property string $item_type
 * @property string $title
 * @property string $description
 * @property integer $level
 * @property string $parent_id
 * @property string $price_eb
 * @property string $price_eb_vat
 * @property string $price_std
 * @property string $price_std_vat
 * @property string $extra_json
 * @property integer $f_status
 * @property string $created_id
 * @property string $created_dt
 * @property string $changed_id
 * @property string $changed_dt
 * @property integer $f_deleted
 *
 * The followings are the available model relations:
 * @property User $creator
 * @property User $editor
 */
class WebshopItem extends CmsActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return WebshopItem the static model class
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
		return 'mod_webshop_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('level, f_status, f_deleted', 'numerical', 'integerOnly'=>true),
			array('webshop_id, created_id, changed_id', 'length', 'max'=>10),
			array('item_type', 'length', 'max'=>6),
			array('title', 'length', 'max'=>255),
			array('parent_id', 'length', 'max'=>11),
			array('price_eb, price_eb_vat, price_std, price_std_vat', 'length', 'max'=>9),
			array('description, extra_json, created_dt, changed_dt', 'safe'),
			// The following rule is used by search().            
			// Please remove those attributes that should not be searched.
            // Uncomment if needed
			//array('id, webshop_id, item_type, title, description, level, parent_id, price_eb, price_eb_vat, price_std, price_std_vat, extra_json, f_status, created_id, created_dt, changed_id, changed_dt, f_deleted', 'safe', 'on'=>'search'),
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
			'webshop_id' => 'Webshop',
			'item_type' => 'Item Type',
			'title' => 'Title',
			'description' => 'Description',
			'level' => 'Level',
			'parent_id' => 'Parent',
			'price_eb' => 'Price Eb',
			'price_eb_vat' => 'Price Eb Vat',
			'price_std' => 'Price Std',
			'price_std_vat' => 'Price Std Vat',
			'extra_json' => 'Extra Json',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('webshop_id',$this->webshop_id,true);
		$criteria->compare('item_type',$this->item_type,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('level',$this->level);
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('price_eb',$this->price_eb,true);
		$criteria->compare('price_eb_vat',$this->price_eb_vat,true);
		$criteria->compare('price_std',$this->price_std,true);
		$criteria->compare('price_std_vat',$this->price_std_vat,true);
		$criteria->compare('extra_json',$this->extra_json,true);
		$criteria->compare('f_status',$this->f_status);
		$criteria->compare('f_deleted', 0);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}/**/
    
    /**
     * Override cms function because there is no created->changed fields in table
     */
    /*// uncomment this line if validation is needed 
    protected function beforeValidate()
    {
        return true;
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
    
}