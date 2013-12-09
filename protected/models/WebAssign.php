<?php

/**
 * This is the model class for table "web_assign".
 *
 * The followings are the available columns in table 'web_assign':
 * @property string $id
 * @property string $assign_type
 * @property string $page_temp_id
 * @property string $content_type
 * @property string $content_id
 * @property string $sector_id
 * @property string $content_order
 * @property string $params
 * @property integer $f_status
 * @property integer $f_deleted
 * @property string $created_dt
 * @property string $created_id
 * @property string $changed_dt
 * @property string $changed_id
 */
class WebAssign extends CmsActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return WebAssign the static model class
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
        return 'web_assign';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('assign_type,page_temp_id, sector_id,content_id, content_type', 'required'),
            array('f_status, f_deleted', 'numerical', 'integerOnly'=>true),
            array('assign_type, content_type', 'length', 'max'=>1),
            array('page_temp_id, sector_id, content_order, created_id, changed_id', 'length', 'max'=>11),
            array('content_id', 'length', 'max'=>50),
            array('params', 'length', 'max'=>2000),
            array('changed_dt', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, assign_type, page_temp_id, content_type, content_id, sector_id, content_order, params, f_status, f_deleted, created_dt, created_id, changed_dt, changed_id', 'safe', 'on'=>'search'),
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
            'sector' => array(self::BELONGS_TO, 'TemplateSector', 'sector_id'),
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
            'assign_type' => 'Assign Type',
            'page_temp_id' => 'Page Temp',
            'content_type' => 'Content Type',
            'content_id' => 'Content',
            'sector_id' => 'Sector',
            'content_order' => 'Content Order',
            'params' => 'Params',
            'f_status' => 'Status',
            'f_deleted' => 'F Deleted',
            'created_dt' => 'Created Dt',
            'created_id' => 'Created',
            'changed_dt' => 'Changed Dt',
            'changed_id' => 'Changed',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id,true);
        $criteria->compare('assign_type',$this->assign_type,true);
        $criteria->compare('page_temp_id',$this->page_temp_id,true);
        $criteria->compare('content_type',$this->content_type,true);
        $criteria->compare('content_id',$this->content_id,true);
        $criteria->compare('sector_id',$this->sector_id,true);
        $criteria->compare('content_order',$this->content_order,true);
        $criteria->compare('params',$this->params,true);
        $criteria->compare('f_status',$this->f_status);
        $criteria->compare('f_deleted',$this->f_deleted);
        $criteria->compare('created_dt',$this->created_dt,true);
        $criteria->compare('created_id',$this->created_id,true);
        $criteria->compare('changed_dt',$this->changed_dt,true);
        $criteria->compare('changed_id',$this->changed_id,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public function getPageTempName($type, $id){
        if($type == 'T'){
            $data = Template::model()->findByPk($id);
        }else{
             $data = WebPages::model()->findByPk($id);

        }
        return $data->name;
    }

    public static function getTypeOptions()
    {
        return array(
            'C'=>'Content',
            'W'=>'Widget',
            'V'=>'Modul',
            'M'=>'Menu',
            'E'=>'Event Registration',
            'R'=>'Report Purchase'
        );
    }
    public static function getTypeText($typeId=null)
    {
        $types = self::getTypeOptions();
        return isset($types[$typeId])? $types[$typeId]: 'Not Set';
    }

    public function getContentName($typeId=null,$contId=null)
    {
        switch($typeId)
        {
            case 'C':
                $data = WebContent::model()->findByPk($contId);
                $dat = $data->name;
                break;
            case 'W':
                $data = ModRegister::model()->findByPk($contId);
                $dat = $data->mod_name;
                break;
            case 'V':
                $data = ModView::model()->findByPk($contId);
                $dat = $data->view_name;
                break;
            case 'M':
                $data = Menu::model()->findByPk($contId);
                $dat = $data->name;
                break;
            case 'E':
            case 'R':
                $data = WebshopMain::model()->findByPk($contId);
                $dat = $data->title;
                break;
        }
        return $dat;
    }

    public function getSectors($type){
        $all = TemplateSector::model()->findAll();
        return $all;

    }

    public function getPageTempByContent($id){
        $pageTemp = Yii::app()->db->createCommand()
            ->select('*')
            ->from('web_assign')
            ->where('f_deleted="0" and content_id=:content',array('content'=>$id))
            ->order('page_temp_id')
            ->queryAll();
        return $pageTemp;
    }

    public function getSectorsImageSrc()
    {
        $tempID = $this->page_temp_id;
        if( $this->assign_type == 'P' ){
            $tempID = @WebPages::model()->findByPk($this->page_temp_id)->tpl_id;
        }
        //MyFunctions::echoArray( array( 'tempID'=>$tempID ), $this->attributes );
        $src = @Template::model()->findByPk($tempID)->getSectorsImageSrc();
        //MyFunctions::echoArray( array( 'tempID'=>$tempID, 'src'=>$src ), $this->attributes );
        //
        return $src;
        //return Template::model()->findByPk( $templateId )->getSectorsImageSrc();

    }

}