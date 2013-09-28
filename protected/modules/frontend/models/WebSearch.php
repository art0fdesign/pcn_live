<?php

/**
 * This is the model class for table "vw_search".
 *
 * The followings are the available columns in table 'vw_search':
 * @property string $id
 * @property string $module
 * @property string $title
 * @property string $title_seo
 * @property string $html
 * @property string $changed_dt
 *
 * The followings are the available model relations:
 * @property User $creator
 * @property User $editor
 */
class WebSearch extends CmsActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return WebSearch the static model class
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
		return 'vw_search';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'length', 'max'=>11),
			array('module', 'length', 'max'=>20),
			array('html, changed_dt', 'safe'),
			// The following rule is used by search().            
			// Please remove those attributes that should not be searched.
            // Uncomment if needed
			//array('id, module, html, changed_dt', 'safe', 'on'=>'search'),
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
			//'creator' => array(self::BELONGS_TO, 'User', 'created_id'),
			//'editor' => array(self::BELONGS_TO, 'User', 'changed_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'module' => 'Module',
			'title' => 'Title',
			'title_seo' => 'Title',
			'html' => 'Html',
			'changed_dt' => 'Changed Time',
		);
	}
    
    /**
     * Override cms function because there is no created->changed fields in table
     */
    // uncomment this line if validation is needed 
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
     * Retrieve searched item's link
     * moved here to relax view file
     * @param $baseUrl String outter formatted base url
     * @return String href tag for anchor in displaying of item
     */
    public function getTitleHRef($baseUrl)
    {
        $ret = $baseUrl;
        switch ($this->module){
            case 'ourteam': $ret .= '#' . $this->title_seo; break; 
            case 'services':
                //MyFunctions::echoArray( $this->id );
                $catSeo =  ListingItem::model()->findByPk( $this->id )->listingCategory->cat_seo;
                $ret .= '/' . $catSeo . '/' . $this->title_seo; break;
            case 'research': break;
            default: $ret .= '/' . $this->title_seo;
        }
        return $ret;
    }
    
    /**
     * Retrieve content to display
     * Function for displaying searched terms in content
     * @param $search Array tags to search for
     * @param $length Integer Max length of returned content
     * @return String Html content
     */
    public function prepareItemContent( $search, $length = 200 )
    {        
        $arr = array();
        //
        $stripped = strip_tags($this->html);        
        $stripped = str_replace( array("\r\n", "\n", "\r"), ' ', $stripped );
        $part = substr( $stripped, 0, $length );
        if( count($search) ){ // if not empty search needle array
            foreach( $search as $needle ){
                //$needle = 'atm';
                $pos = stripos( $stripped, $needle );
                if( $pos !== false ){ // finded
                    if( $pos != 0 ){ // not in a beggining
                        // insert b tag around needle
                        $prepared = substr( $stripped, 0, $pos ) . '<b>';
                        $prepared .= substr( $stripped, $pos, strlen($needle) ) . '</b>';
                        $prepared .= substr( $stripped, $pos + strlen($needle) ); 
                        // find first space before needle
                        $beforeContent = substr( $prepared, 0, $pos-1 ); 
                        $spacePosition = strrpos( $beforeContent, ' ' );
                        // return part from left space to $length length
                        $part = substr( $prepared, $spacePosition+1, $length);
                        
                    } // if( $pos != 0 ) 
                    // add this part to array
                    $arr[] = $part;
                } // if( $pos !== false )
            } // foreach( $needle )
        } else { // there is empty search array... retrieve all
            $arr[] = $part;
        }
        //MyFunctions::echoArray( array('count'=>count($search)), $arr );
        // $arr ia array of $length length of stripped part 
        // implode them with equal parts of needles
        $ret = '';
        $len = $length;
        if( count( $arr ) ) $len = $length/count($arr) - 4; // leave room for '... '
        // do implode
        foreach( $arr as $elem ){
            $subElem = substr( $elem, 0, $len ); 
            $rightSpacePos = strrpos( $subElem, ' ' );
            $ret .= substr( $subElem, 0, $rightSpacePos ) . '... ';
        }
        /*MyFunctions::echoArray( array( 
            'needle'=>$needle, 
            'pos'=>$pos, 
            'space'=>$spacePosition, 
            //'prepared'=>$prepared, 
            'part'=>$part,
            'return' => $ret,
        ), array( 'stripped'=>$stripped, ), $this->html );/**/
        return $ret;
    }
    
}