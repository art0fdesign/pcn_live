<?php

class WebcropController extends Controller
{


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
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        // $this->controls = true;
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        if(Yii::app()->getRequest()->getIsAjaxRequest()) {
            echo CActiveForm::validate( array( $model));
            Yii::app()->end();
        }
        if(isset($_POST['EventMain']))
        {
            $model->attributes=$_POST['EventMain'];
            if($model->save())
                $this->redirect(array('eventsRegistration/view','id'=>$model->id));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        echo '<h1>FUCK YOU WEBSHOP!!!</h1>';
        die();
        // $this->controls = true;
        $condition = 'f_deleted = 0';
        $params = array();
        $events = EventMain::model()->findAllByAttributes(array(),
            $condition, $params );
        $this->render('index',array(
            'events'=>$events,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model=EventMain::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
}
