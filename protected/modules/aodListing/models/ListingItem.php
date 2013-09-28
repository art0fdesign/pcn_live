<?php

/**
 * This is the model class for table "mod_listing_item".
 *
 * The followings are the available columns in table 'mod_listing_item':
 * @property string $id
 * @property string $listing_id
 * @property string $cat_id
 * @property string $item_title
 * @property string $item_seo
 * @property string $image_url
 * @property integer $link_id  //id of the page where "read more" should be point at
 * @property string $html_list
 * @property string $html_content
 * @property string $html_widget
 * @property integer $item_order
 * @property integer $lang_id
 * @property integer $f_status
 * @property integer $f_widget
 * @property integer $widget_order
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
class ListingItem extends CmsActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ListingItem the static model class
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
		return 'mod_listing_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('listing_id, item_title, item_seo', 'required'),
			array('link_id, item_order, widget_order, lang_id', 'numerical', 'integerOnly'=>true),
			array('item_title, item_seo', 'length', 'max'=>60),
			array('cat_id, item_seo, image_url, html_list, html_content, html_widget, f_status, f_widget, widget_order, f_deleted, created_id, changed_id, changed_dt', 'safe'),
			// The following rule is used by search().            
			// Please remove those attributes that should not be searched.
            // Uncomment if needed
			//array('id, listing_id, cat_id, item_title, html_list, html_content, item_order, lang_id, f_status, created_id, created_dt, changed_id, changed_dt, f_deleted', 'safe', 'on'=>'search'),
		);
	}
    
    /**
     * Ensure preparation of seo link
     */
    protected function beforeValidate()
    {
        $this->item_seo = MyFunctions::parseForSEO( $this->item_title );
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
			'listingCategory' => array(self::BELONGS_TO, 'ListingCategory', 'cat_id'),
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
			'cat_id' => 'Category',
			'item_title' => 'Title',
			'item_seo' => 'SEO Link',
			'image_url' => 'Image URL',
            'link_id'=>'Link To Page',
			'html_list' => 'List Content',
			'html_content' => 'Main Content',
			'html_widget' => 'Top List Content',
			'item_order' => 'Item Order',
			'lang_id' => 'Language',
			'f_widget' => 'Top List',
			'widget_order' => 'Top List Order',
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
		$criteria->compare('cat_id',$this->cat_id,true);
		$criteria->compare('item_title',$this->item_title,true);
		$criteria->compare('html_list',$this->html_list,true);
		$criteria->compare('html_content',$this->html_content,true);
		$criteria->compare('item_order',$this->item_order);
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
     * Retrieve next order number only by listing_id
     */
    public function getNextOrderNo( $retrieveWidgetOrder = false )
    {
        $field = $retrieveWidgetOrder? 'widget_order': 'item_order';
        try {
            $ret = Yii::app()->db->createCommand()
                ->select( $field )
                ->from( self::tableName() )
                ->where( 'listing_id=:list AND f_deleted=0', array( 'list'=>$this->listing_id ) )
                ->order( $field . ' DESC' )
                ->limit( 1 )
                ->queryScalar();
        } catch(Exception $e){
            $ret = 0;
        }
        if( empty($ret) ) $ret = 1;
        else $ret = $ret + 1;
        //
        return $ret;
    }

    /**
     * Retrieve file thumbnail's URL
     * @param Bool Show or not Host name in URL
     * @param String Thumbnail Key to return
     * @return String URL to display image
     */
    public function getImagePreviewSrc()
    {
        $url = '';
        $file = File::getFileModelBySeo( $this->image_url );
        if( !empty( $file ) ){
            $url = $file->getFileThumbUrl( false, 'preview' );
            $url .= '?uptime=' . time();
            //MyFunctions::echoArray( array( 'image_url'=>$this->image_url, 'url'=>$url ));
        }
        //
        return $url;
    }

    public function getLinkPageOptions()
    {
        $models = WebPages::model()->findAll('f_deleted = 0 AND f_status = 1');
        return CHtml::listData($models, 'id', 'name');
    }

    public function getLinkPageName()
    {
        $page = WebPages::model()->findByPk($this->link_id);
        return @$page->name;
    }

    public function getLinkPageUrl()
    {
        $page = WebPages::model()->findByPk($this->link_id);
        return $page->url;
    }
}