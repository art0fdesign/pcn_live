<?php

/**
 * This is the model class for table "contact_form".
 *
 * The followings are the available columns in table 'contact_form':
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $subject
 * @property string $message
 * @property string $created_dt
 * @property integer $f_status
 * @property integer $f_deleted
 */
class ContactForm extends CActiveRecord
{
    public $verifyCode;
    public $email_repeat;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ContactForm the static model class
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
        return 'mod_contact_form';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('first_name, last_name, email, subject, message', 'required'),
            array('first_name, last_name, email, phone, subject', 'length', 'max'=>100),
            array('email', 'required'),
            //array('email', 'unique'),
            array('email_repeat', 'required', 'on'=>'insert'),
            array('email, email_repeat', 'email'),
            array('email_repeat', 'compare', 'compareAttribute'=>'email', 'message'=>'E-mail must be repeated exactly.'),
            //
            array('email_repeat', 'safe'),
            // captcha
            //array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
            array('verifyCode', 'safe'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'email_repeat' => 'Confirm Email',
            'subject' => 'Subject',
            'message' => 'Message',
            'created_dt' => 'Created',
            'f_deleted' => 'deleted',
            'f_status' =>'Read/Unread',
        );
    }
}