<?php

/**
 * This is the model class for table "mod_listing_main".
 *
 * The followings are the available columns in table 'mod_listing_main':
 * @property string $id
 * @property string $listing_id
 * @property integer $f_use_cat
 * @property integer $f_use_image
 * @property integer $f_use_detail
 * @property integer $f_use_widget
 * @property integer $f_status
 * @property string $created_id
 * @property string $created_dt
 * @property string $changed_id
 * @property string $changed_dt
 * @property integer $f_deleted
 *
 * The followings are the available model relations:
 * @property ListingCategory[] $listingCategories
 * @property ListingItem[] $listingItems
 * @property User $creator
 * @property User $editor
 */
class ListingMain extends CmsActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ListingMain the static model class
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
		return 'mod_listing_main';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('listing_id', 'required'),
			array('listing_id', 'length', 'max'=>20),
			array('f_use_cat, f_use_image, f_use_detail, f_use_widget, f_status, f_deleted, created_id, changed_id, created_dt, changed_dt', 'safe'),
			// The following rule is used by search().            
			// Please remove those attributes that should not be searched.
            // Uncomment if needed
			//array('id, listing_id, f_use_cat, f_status, created_id, created_dt, changed_id, changed_dt, f_deleted', 'safe', 'on'=>'search'),
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
			'listingCategories' => array(self::HAS_MANY, 'ListingCategory', 'listing_id'),
			'listingItems' => array(self::HAS_MANY, 'ListingItem', 'listing_id'),
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
			'listing_id' => 'Listing',
			'f_use_cat' => 'Use Categories',
			'f_use_image' => 'Use Image',
            'f_use_detail' => 'Use Details View',
			'f_use_widget' => 'Use Widget',
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
		$criteria->compare('listing_id',$this->listing_id,true);
		$criteria->compare('f_use_cat',$this->f_use_cat);
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
     *  - $filters can include order, limit, offset parameters
     * @param Bool $showDeleted Show/Hide deleted records
     * @return Array all models that meet params
     */     
    public static function retrieveAll( $orderBy = '', $filters = array(), $showDeleted = false )
    {
        return parent::retrieveAllByModel( __CLASS__, $filters, $orderBy, $showDeleted );
    }
    
}