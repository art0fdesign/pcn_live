<?php

/**
 * This is the model class for table "mod_webshop_main".
 *
 * The followings are the available columns in table 'mod_webshop_main':
 * @property string $id
 * @property integer $type
 * @property string $title
 * @property integer $f_active
 * @property string $description
 * @property string $intro_html
 * @property string $comming_soon_html
 * @property integer $f_reg_form
 * @property string $reg_form_header
 * @property string $reg_form_intro_html
 * @property integer $f_reg_form_dietary
 * @property string $reg_form_extra_json
 * @property string $f_items
 * @property string $f_reports
 * @property string $items_header
 * @property string $items_intro_html
 * @property string $items_extra_json
 * @property string $reports_extra_json
 * @property string $items_tc_html
 * @property string $reports_tc_html
 * @property string $start_dt
 * @property integer $f_earlybird
 * @property string $earlybird_dt
 * @property string $invoice_prefix
 * @property string $end_dt
 * @property string $ended_html
 * @property string $purchase_error_msg_html
 * @property string $purchase_success_msg_html
 * @property integer $f_status
 * @property integer $created_id
 * @property string $created_dt
 * @property integer $changed_id
 * @property string $changed_dt
 * @property integer $f_deleted
 *
 * The followings are the available model relations:
 * @property User $creator
 * @property User $editor
 */
class WebshopMain extends CmsActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return WebshopMain the static model class
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
        return 'mod_webshop_main';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('f_active, f_reg_form, f_reg_form_dietary, f_earlybird, f_status, created_id, changed_id, f_deleted', 'numerical', 'integerOnly'=>true),
            array('type', 'length', 'max'=>10),
            array('title, reg_form_header, f_items, f_reports, items_header, invoice_prefix', 'length', 'max'=>255),
            array('description, intro_html, comming_soon_html, reg_form_intro_html, reg_form_extra_json, items_intro_html, items_extra_json, reports_extra_json, items_tc_html, reports_tc_html, start_dt, earlybird_dt, end_dt, ended_html, purchase_error_msg_html, purchase_success_msg_html, created_dt, changed_dt', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            // Uncomment if needed
            //array('id, type, title, f_active, description, intro_html, comming_soon_html, reg_form_header, reg_form_intro_html, f_reg_form_dietary, reg_form_extra_json, f_items, f_reports, items_header, items_intro_html, items_extra_json, reports_extra_json, items_tc_html, reports_tc_html, start_dt, f_earlybird, earlybird_dt, invoice_prefix, end_dt, ended_html, purchase_error_msg_html, purchase_success_msg_html, f_status, created_id, created_dt, changed_id, changed_dt, f_deleted', 'safe', 'on'=>'search'),
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
            'type' => 'Type',
            'title' => 'Title',
            'f_active' => 'Active',
            'description' => 'Description',
            'intro_html' => 'Intro Html',
            'comming_soon_html' => 'Comming Soon Html',
            'f_reg_form' => 'Display Registration Form',
            'reg_form_header' => 'Registration Form Header',
            'reg_form_intro_html' => 'Registration Form Intro Html',
            'f_reg_form_dietary' => 'Registration Form Dietary',
            'reg_form_extra_json' => 'Registration Form Extra Data',
            'f_items' => 'Display Items',
            'f_reports' => 'Display  Reports',
            'items_header' => 'Items Header',
            'items_intro_html' => 'Items Intro Html',
            'items_extra_json' => 'Items Extra Data',
            'reports_extra_json' => 'Reports Extra Data',
            'items_tc_html' => 'Items T&C Html',
            'reports_tc_html' => 'Reports T&C Html',
            'start_dt' => 'Start Time',
            'f_earlybird' => 'Display Earlybird',
            'earlybird_dt' => 'Earlybird Time',
            'invoice_prefix' => 'Invoice Prefix',
            'end_dt' => 'End Time',
            'ended_html' => 'Ended Html',
            'purchase_error_msg_html' => 'Purchase Error Mesage',
            'purchase_success_msg_html' => 'Purchase Success Message',
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
        $criteria->compare('type',$this->type,true);
        $criteria->compare('title',$this->title,true);
        $criteria->compare('f_active',$this->f_active);
        $criteria->compare('description',$this->description,true);
        $criteria->compare('intro_html',$this->intro_html,true);
        $criteria->compare('comming_soon_html',$this->comming_soon_html,true);
        $criteria->compare('reg_form_header',$this->reg_form_header,true);
        $criteria->compare('reg_form_intro_html',$this->reg_form_intro_html,true);
        $criteria->compare('f_reg_form_dietary',$this->f_reg_form_dietary);
        $criteria->compare('reg_form_extra_json',$this->reg_form_extra_json,true);
        $criteria->compare('f_items',$this->f_items,true);
        $criteria->compare('f_reports',$this->f_reports,true);
        $criteria->compare('items_header',$this->items_header,true);
        $criteria->compare('items_intro_html',$this->items_intro_html,true);
        $criteria->compare('items_extra_json',$this->items_extra_json,true);
        $criteria->compare('reports_extra_json',$this->reports_extra_json,true);
        $criteria->compare('items_tc_html',$this->items_tc_html,true);
        $criteria->compare('reports_tc_html',$this->reports_tc_html,true);
        $criteria->compare('start_dt',$this->start_dt,true);
        $criteria->compare('f_earlybird',$this->f_earlybird);
        $criteria->compare('earlybird_dt',$this->earlybird_dt,true);
        $criteria->compare('invoice_prefix',$this->invoice_prefix,true);
        $criteria->compare('end_dt',$this->end_dt,true);
        $criteria->compare('ended_html',$this->ended_html,true);
        $criteria->compare('purchase_error_msg_html',$this->purchase_error_msg_html,true);
        $criteria->compare('purchase_success_msg_html',$this->purchase_success_msg_html,true);
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

    /**
     * WebAssign Controller function to load list of contents
     * @param  string $contentType Type of contents to retrieve
     * @return array ['id'=>'', 'value'=>'']
     */
    public function getContentsOptions($contentType = 'E')
    {
        $return = array();
        $criteria = new CDbCriteria();
        $criteria->addCondition('f_deleted = 0');
        $criteria->addCondition('f_type = :type');
        $criteria->order = 'title';
        if ($contentType == 'E') {
            $criteria->params = array(':type' => 'event');
        } else {
            $criteria->params = array(':type' => 'report');
        }

        $items = WebshopMain::model()->findAll($criteria);
        foreach($items as $item) {
            $return[$item->id] = $item->title;
        }
// Myfunctions::echoArray($items, $return);

        return $return;
    }

}