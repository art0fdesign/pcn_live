<?php

/**
 * This is the model class for table "mod_listing_category".
 *
 * The followings are the available columns in table 'mod_listing_category':
 * @property string $id
 * @property string $listing_id
 * @property integer $cat_order
 * @property string $cat_title
 * @property string $cat_seo
 * @property string $description
 * @property integer $lang_id
 * @property integer $f_status
 * @property string $created_id
 * @property string $created_dt
 * @property string $changed_id
 * @property string $changed_dt
 * @property integer $f_deleted
 *
 * The followings are the available model relations:
 * @property ListingMain $listing
 * @property User $creator
 * @property User $editor
 */
class ListingCategory extends CmsActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ListingCategory the static model class
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
		return 'mod_listing_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('listing_id, cat_title, cat_seo', 'required'),
			array('cat_order', 'numerical', 'integerOnly'=>true),
			array('cat_title, cat_seo, description', 'length', 'max'=>100),
			array('cat_seo, description, lang_id, f_status, f_deleted, changed_dt, created_dt, created_id, changed_id', 'safe'),
			// The following rule is used by search().            
			// Please remove those attributes that should not be searched.
            // Uncomment if needed
			//array('id, listing_id, cat_order, cat_title, description, lang_id, f_status, created_id, created_dt, changed_id, changed_dt, f_deleted', 'safe', 'on'=>'search'),
		);
	}
    
    /**
     * Ensure preparation of seo link
     */
    protected function beforeValidate()
    {
        $this->cat_seo = MyFunctions::parseForSEO( $this->cat_title );
        //
        return parent::beforeValidate();
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'listingMain' => array(self::BELONGS_TO, 'ListingMain', array('listing_id'=>'listing_id')),
			'parent' => array(self::BELONGS_TO, 'ListingCategory', array('parent_id'=>'id')),
			'language' => array(self::BELONGS_TO, 'Language', 'lang_id'),
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
			'cat_order' => 'Order',
			'cat_title' => 'Title',
			'cat_seo' => 'SEO Link',
			'description' => 'Description',
			'lang_id' => 'Language',
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
		$criteria->compare('cat_order',$this->cat_order);
		$criteria->compare('cat_title',$this->cat_title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('lang_id',$this->lang_id);
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
    
    /**
     * Retrievevs Category select optioins array
     * @param String ListingID
     */
    public static function getCategoryOptions( $listing_id = null )
    {
        /*
        $rows = Yii::app()->db->createCommand()
            ->select( 'id, cat_title' )
            ->from( self::tableName()  )
            ->where( 'listing_id = :list AND f_status = 1 AND f_deleted = 0', array( 'list'=>$listing_id ) )
            ->order( 'cat_order' )
            ->queryAll();/**/
        $rows = array();
        $models = self::retrieveAll( 'cat_order', array('listing_id'=>$listing_id, 'f_status'=>'1') );
        foreach( $models as $model ){
            $rows[$model->id] = $model->cat_title;
        }
        //
        return $rows;
        
    }

    public static function getCategoryId($listing_id, $cat_seo)
    {
        $ret = 0;
        $models = self::retrieveAll( '', array('listing_id'=>$listing_id, 'f_status'=>'1') );
        foreach($models as $model){
            if($model->cat_seo == $cat_seo){
                $ret = $model->id;
                break;
            }
        }
        return $ret;
    }
}