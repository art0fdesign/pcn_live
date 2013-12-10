<?php

/**
 * This is the model class for table "tmp_countries".
 *
 * The followings are the available columns in table 'tmp_countries':
 * @property integer $id
 * @property string $name
 * @property string $alpha_2
 * @property string $alpha_3
 *
 * The followings are the available model relations:
 * @property User $creator
 * @property User $editor
 */
class Country extends CmsActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Countries the static model class
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
        return 'tmp_countries';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'length', 'max'=>50),
            array('alpha_2', 'length', 'max'=>2),
            array('alpha_3', 'length', 'max'=>3),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            // Uncomment if needed
            //array('id, name, alpha_2, alpha_3', 'safe', 'on'=>'search'),
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
            'name' => 'Name',
            'alpha_2' => 'Alpha 2',
            'alpha_3' => 'Alpha 3',
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
        $criteria->compare('alpha_2',$this->alpha_2,true);
        $criteria->compare('alpha_3',$this->alpha_3,true);

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

    public function getAlpha2OptionsList()
    {
        $ret = array();
        $countries = self::model()->findAll();
        foreach($countries as $country) {
            $ret[$country->alpha_2] = $country->name;
        }
        return $ret;
    }

    public function getCountryName($abbr = null)
    {
        if (is_null($abbr)) {
            return null;
        }

        $criteria = new CDbCriteria();
        $criteria->addCondition('alpha_2 = :abbr or alpha_3 = :abbr');
        $criteria->params = array(':abbr' => $abbr);

        if (!self::model()->exists($criteria)) {
            return null;
        }

        $model = self::model()->find($criteria);
        if (empty($model)) {
            return false;
        }

        return $model->name;

    }

}