<?php

class WebAssignController extends Controller
{
    public $menu = array(array('link'=>'WebAssign/create','text'=>'Add new Assign'));
    public $controls = false;
    /**
     * @return array action filters
     */
    public function beforeAction($action)
    {
        Yii::app()->theme = 'cmsnew';
        return true;
    }
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'allowPostOnly + activate delete', // allow only POST requests
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',  // allow all logged users to perform 'index' and 'view' actions
                'actions'=>array('index', 'view', 'create', 'update', 'delete', 'activate','getPageTempList','getSectorByPageTemp','getContentByType'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->controls = true;
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new WebAssign;

        if(Yii::app()->getRequest()->getIsAjaxRequest()) {
            echo CActiveForm::validate( array( $model));
            Yii::app()->end();
        }

        if(isset($_POST['WebAssign']))
        {
            $model->attributes=$_POST['WebAssign'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $type = Yii::app()->request->getParam('type','C');
        $con_id = Yii::app()->request->getParam('con_id','0');
        $model->content_type = $type;
        $model->content_id = $con_id;
        $model->content_order = 1;
        $model->f_status = 1;
        $this->render('create',array(
            'model'=>$model,
            'con_id'=>$con_id,
            'type'=>$type
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $this->controls = true;
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['WebAssign']))
        {
            $model->attributes=$_POST['WebAssign'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $this->controls = true;
        $assign = WebAssign::model()->findAllByAttributes(array('f_deleted'=>'0'));
        $this->render('index',array(
            'assign'=>$assign,

        ));
    }



    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model=WebAssign::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='web-assign-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionActivate($id)
    {
        $model=$this->loadModel($id);
        if( $model->f_status == 1 ) $model->f_status = 0;
        else $model->f_status = 1;
        //
        if( $model->save() ) $this->redirect(array('index'));
        else throw new CHttpException(400,'Model status not updated. Please do not repeat this request again.');

    }

    public function actionGetPageTempList(){
        $type = $_POST['WebAssign']['assign_type'];
        if($type == 'P'){
             $data = WebPages::model()->getPagesOptions();
             $msg = 'page';
        }elseif($type == 'T'){
            $msg= 'template';
             $data = Template::model()->getTemplatesOptions();
        }
        $pageTemp = array();
        if($data){
            $pageTemp.= CHtml::tag('option', array('value' =>'' ), "--select $msg--", true);
            foreach($data as $key=>$val){
                $pageTemp .= CHtml::tag('option', array('value' => $key), $val, true);
            }
        }else{
            $pageTemp .= CHtml::tag('option', array('value' =>'' ), "--select $msg--", true);
        }

        echo CJSON::encode(array(
            'pageTemp'=>$pageTemp,
            'sector'=>  CHtml::tag('option', array('value' =>'' ), '--select sector--', true)
        ));

    }

    public function actionGetSectorByPageTemp()
    {
        $type = $_POST['WebAssign']['assign_type'];
        $id = $_POST['WebAssign']['page_temp_id'];
        $options = array();
        if($type == 'P'){
            $sectors = Yii::app()->db->createCommand()
                ->select('ts.id,ts.name,p.tpl_id')
                ->from('web_template_sector as ts')
                ->join('web_pages as p','ts.tpl_id=p.tpl_id')
                ->where('ts.f_status="1" and ts.sector_type="P" and p.id=:page',array('page'=>$id))
                ->queryAll();
            // set $id to be template id
            $id = WebPages::model()->findByPk( $id )->tpl_id;

        }elseif($type == "T"){
            $sectors = Yii::app()->db->createCommand()
                ->select('ts.id,ts.name')
                ->from('web_template_sector as ts')
                ->where('ts.f_status="1" and ts.sector_type="T" and ts.tpl_id=:template',array('template'=>$id))
                ->queryAll();

        }
        if($sectors){
            foreach($sectors as $sector){
                $options .= CHtml::tag('option', array('value' => $sector['id']), $sector['name'], true);
            }
        }else{
            $options = CHtml::tag('option', array('value' =>'' ), '--select sector--', true);
        }
        $src = Template::model()->findByPk($id)->getSectorsImageSrc();
        $result = array( 'options'=>$options, 'img_source'=>$src );
        echo CJSON::encode( array(
            'options' => $options,
            'image' => CHtml::image( $src, 'alt' ),
        ) );


    }
    public function actionGetContentByType()
    {
        $content_type = $_POST['WebAssign']['content_type'];
        switch($content_type){
            case "W":
                $widget = Widget::getWidgetOptions();
                foreach($widget as $id=>$value){
                    echo CHtml::tag('option', array('value' => $id), $value, true);
                }
                break;
            case "V":

                $widget = Widget::getModuleWidgetOptions();
                foreach($widget as $group=>$opt){
                    echo CHtml::tag('optgroup', array('label' => $group),  true);
                    foreach($opt as $id=>$value)
                        echo CHtml::tag('option', array('value' => $id), $value, true);
                }
                break;

            case "M":
                $menus = Menu::getMenusOptions();
                foreach($menus as $id=>$value){
                    echo CHtml::tag('option', array('value' => $id), $value, true);
                }

                break;

            case "C":
                $contents = WebContent::getContentsOptions();
                foreach($contents as $id=>$value){
                    echo CHtml::tag('option', array('value' => $id), $value, true);
                }

                break;

            case "E":
            case "R":
                $contents = WebshopMain::getContentsOptions($content_type);
                foreach($contents as $id=>$value){
                    echo CHtml::tag('option', array('value' => $id), $value, true);
                }

                break;
        }
    }


}
