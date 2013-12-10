<?php

/**
 * This is the model class for table "mod_event_main".
 *
 * The followings are the available columns in table 'mod_event_main':
 * @property string $id
 * @property string $name
 * @property string $page_id
 * @property string $date_start
 * @property string $f_early_bird
 * @property string $date_early_bird
 * @property string $date_end
 * @property string $description
 * @property string $content_above
 * @property string $tickets_note
 * @property string $tickets_schema
 * @property string $template
 * @property string $comming_soon
 * @property integer $f_dietary
 * @property integer $f_price_list
 * @property integer $f_status
 * @property string $created_dt
 * @property string $created_id
 * @property string $changed_dt
 * @property string $changed_id
 * @property integer $f_deleted
 *
 * The followings are the available model relations:
 * @property User $creator
 * @property User $editor
 */
class EventMain extends CmsActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return EventMain the static model class
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
        return 'mod_event_main';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'length', 'max'=>255),
            array('page_id, f_early_bird, f_price_list', 'numerical', 'integerOnly'=>true),
            array('template', 'length', 'max'=>40),
            array('date_start, date_early_bird, date_end', 'safe'),
            array('content_above, tickets_note, tickets_schema, f_status, f_deleted', 'safe'),
            array('date_start, date_early_bird, date_end, description, comming_soon', 'safe'),
            array('f_dietary, created_id, changed_id, changed_dt, created_dt', 'safe'),
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
            'page' => array(self::BELONGS_TO, 'WebPages', 'page_id'),

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
            'name' => 'Event Name',
            'page_id' => 'Page Reference',
            'date_start' => 'Start Date',
            'f_early_bird' => 'Use Early Bird Date',
            'date_early_bird' => 'Date Early Bird Date',
            'date_end' => 'End Date',
            'description' => 'Description',
            'content_above' => 'Content Above',
            'tickets_note' => 'Note Above Tickets',
            'tickets_schema' => 'Tickets Schema',
            'template' => 'Template',
            'comming_soon' => 'Comming Soon',
            'f_dietary' => 'Dietary',
            'f_price_list' => 'Price List',
            'f_status' => 'Status',
            'created_dt' => 'Created Time',
            'created_id' => 'Created By',
            'changed_dt' => 'Changed Time',
            'changed_id' => 'Changed By',
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

    /**
    * Retrieve boolean flag is active price is early bird or not
    * @return boolean
    */
    public function isEarlyBird()
    {
        if ($this->f_early_bird == 0) {
            return false;
        }

        if (empty($this->date_early_bird)) {
            return false;
        }

        return (date('Y-m-d') <= $this->date_early_bird);
    }

    public function templateName()
    {
        $return = 'common';
        if (!empty($this->template)) {
            $return = $this->template;
        }
        return $return;
    }

    /**
    * Retrieve options array for populating select lists by level
    */
    public function getOptionsListByLevel($optionsLevel = 1)
    {
        $return = array();
        $condition = 'event_id = :event and option_level = :level and f_status = 1 and f_deleted = 0';
        $params = array('event' => $this->id, 'level' => $optionsLevel);
        $options = EventPrice::model()->findAll( array( 'order'=>'order_by', 'condition'=>$condition, 'params'=>$params ) );
        foreach ($options as $option) {
            $return[$option->id] = $option->option_text;
        }
        return $return;
    }

    /**
    * Retrieve options array for populating select lists by parent id
    */
    public function getOptionsListByParentID($parentID = 0)
    {
        $return = array();
        $condition = 'event_id = :event and parent_id = :parent and f_status = 1 and f_deleted = 0';
        $params = array('event' => $this->id, 'parent' => $parentID);
        $options = EventPrice::model()->findAll( array( 'order'=>'order_by', 'condition'=>$condition, 'params'=>$params ) );
        foreach ($options as $option) {
            $return[$option->id] = $option->option_text;
        }
        return $return;
    }

    /**
    * Retrieve collection of report items
    */
    public function getReportItems($eventID = null)
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'event_id = :event and f_status = 1 and f_deleted = 0';
        $criteria->order = 'order_by';
        $criteria->params = array(':event' => $eventID);

        $models = EventPrice::model()->findAll($criteria);
        if (empty($models)) {
            return array();
        }
        return $models;
    }

}