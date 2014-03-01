<?php

/**
 * This is the model class for table "mod_simplecart_item".
 *
 * The followings are the available columns in table 'mod_simplecart_item':
 * @property string $id
 * @property string $cart_id
 * @property string $item_id
 * @property string $category
 * @property string $name
 * @property string $description
 * @property string $quantity
 * @property string $price
 * @property string $description
 * @property string $created_dt
 * @property string $changed_dt
 *
 * The followings are the available model relations:
 * @property User $creator
 * @property User $editor
 */
class SimpleCartItem extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return SimpleCartItem the static model class
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
        return 'mod_simplecart_item';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('cart_id', 'required'),
            array('cart_id', 'length', 'max'=>32),
            array('category', 'length', 'max'=>100),
            array('name, item_id', 'length', 'max'=>255),
            array('quantity, price', 'numerical'),
            array('description, details, created_dt, changed_dt', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    // public function relations()
    // {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        // return array(
            // 'creator' => array(self::BELONGS_TO, 'User', 'created_id'),
            // 'editor' => array(self::BELONGS_TO, 'User', 'changed_id'),
        // );
    // }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'cart_id' => 'Cart',
            'item_id' => 'Item Identificator',
            'category' => 'Category',
            'name' => 'Name',
            'description' => 'Description',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'details' => 'Item JSON details',
            'created_dt' => 'Created Time',
            'changed_dt' => 'Changed Time',
        );
    }

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

    public function price($vatMultiplicator = 1.00)
    {
        return $this->price * $vatMultiplicator;
    }

    public function total($vatMultiplicator = 1.00)
    {
        return $this->price * $this->quantity * $vatMultiplicator;
    }

    public function description()
    {
        $description = CJSON::decode($this->description);

        if (empty($description) || ! is_array($description)) {
            return null;
        }

        return $this->formatDescriptionHTML($description);
        $descriptionHTML = $this->formatDescriptionHTML($description);

        MyFunctions::echoArray($description, $descriptionHTML);

        return $this->description;
    }

    /**
     * Recursive function to create description HTML output
     * @param  array  $descriptionArray Array of descriptions
     * @return string
     */
    private function formatDescriptionHTML($descriptionArray = array())
    {
        $return = array('<ul>');
        foreach ($descriptionArray as $key => $descriptionItem) {
            if ($key === 'Location') {
                $return[] = '<li>Location: ' . Chtml::encode($descriptionItem) . '</li>';
                continue;
            }

            if (is_array($descriptionItem)) {
                $recursiveArray = '<li>' . $descriptionItem['name'];
                $recursiveArray .= $this->formatDescriptionHTML($descriptionItem['items']) . '</li>';

                $return[] = $recursiveArray;
                continue;
            }

            $return[] = '<li>' . Chtml::encode($descriptionItem) . '</li>';
        }
        $return[] = '</ul>';

        return implode('', $return);
    }

}