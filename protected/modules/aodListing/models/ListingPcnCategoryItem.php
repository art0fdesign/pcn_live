<?php

/**
 * This is the model class for table "mod_listing_pcn_cat_item".
 *
 * The followings are the available columns in table 'mod_listing_pcn_cat_item':
 * @property string $id
 * @property string $cat_id
 * @property string $item_id
 * @property string $order_by
 *
 * The followings are the available model relations:
 * @property User $creator
 * @property User $editor
 */
class ListingPcnCategoryItem extends CmsActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ListingPcnCategoryItem the static model class
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
		return 'mod_listing_pcn_cat_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cat_id, item_id', 'required'),
			array('cat_id, item_id, order_by', 'length', 'max'=>10),
			// The following rule is used by search().            
			// Please remove those attributes that should not be searched.
            // Uncomment if needed
			//array('id, cat_id, item_id, order_by', 'safe', 'on'=>'search'),
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
			'category' => array(self::BELONGS_TO, 'ListingPcnCategory', array('cat_id'=>'id')),
			'item' => array(self::BELONGS_TO, 'ListingItem', array('item_id'=>'id')),
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
			'cat_id' => 'Category',
			'item_id' => 'Item',
			'order_by' => 'Order',
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
		$criteria->compare('cat_id',$this->cat_id,true);
		$criteria->compare('item_id',$this->item_id,true);
		$criteria->compare('order_by',$this->order_by,true);

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

    public function getCategoryOptions() {
    	$ret = array();
    	$func_group = ListingPcnCategory::retrieveAll('', array('listing_id'=>'ourteam', 'expertize'=>'1', 'level'=>'2'));
    	foreach ($func_group as $group) {
    		$fullName = $group->fullName;
    		$ret[$fullName] = array();
    		$func_items = ListingPcnCategory::retrieveAll('', array('listing_id'=>'ourteam', 'parent_id'=>$group->id));
    		foreach($func_items as $item) {
    			$ret[$fullName][$item->id] = $item->cat_title;
    		}
    	}
    	$ind_group = ListingPcnCategory::retrieveAll('', array('listing_id'=>'ourteam', 'expertize'=>'2', 'level'=>'1'));
    	foreach ($ind_group as $group) {
    		$fullName = $group->cat_title;
    		$ret[$fullName] = array();
    		$func_items = ListingPcnCategory::retrieveAll('', array('listing_id'=>'ourteam', 'parent_id'=>$group->id));
    		foreach($func_items as $item) {
    			$ret[$fullName][$item->id] = $item->cat_title;
    		}
    	}
    	// MyFunctions::echoArray($ret);
    	return $ret;
    }
    public function getMemberOptions() {
    	$ret = array();
    	$models = ListingItem::retrieveAll('', array('listing_id'=>'ourteam'), false);
    	foreach ($models as $model) {
    		$ret[$model->id] = $model->item_title;
    	}
    	// MyFunctions::echoArray($ret);
    	return $ret;
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
        $condition = ''; $params = array(); // if( !$showDeleted ) $condition = 'f_deleted = 0';
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