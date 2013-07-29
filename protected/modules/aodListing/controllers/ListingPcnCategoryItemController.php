<?php

class ListingPcnCategoryItemController extends Controller
{
    public $menu = array( array( 'link' => 'listingPcnCategoryItem/create','text'=>'Add new ListingPcnCategoryItem' ));
    public $controls = false;
    
    /**
     * Entry Point to Class. Define Theme to use
     * @return bool Allow action
     */
    public function beforeAction( $action )
    {
        Yii::app()->theme = 'cmsnew';
        return true;
    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView( $id )
	{
        $this->controls = true;
        $this->render( 'view', array(
			'model' => $this->loadModel( $id ),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ListingPcnCategoryItem;
		/*// Uncomment this line if AJAX validation is needed        
        if(Yii::app()->getRequest()->getIsAjaxRequest()) {        
            echo CActiveForm::validate( array( $model ));         
            Yii::app()->end();         
        }/**/

		if(isset($_POST['ListingPcnCategoryItem']))
		{
			$model->attributes = $_POST['ListingPcnCategoryItem'];

			if( $model->save() ) {
				$model->order_by = $model->id;
				$model->save(false);
				$this->redirect( array( 'view', 'id' => $model->id ) );
			}
		}

		$this->render( 'create', array(
			'model' => $model,            
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate( $id )
	{
    // Widget::getModuleWidgetOptions(1);
    $this->controls = true;
		$model = $this->loadModel( $id );

		/*// Uncomment this line if AJAX validation is needed		
        if(Yii::app()->getRequest()->getIsAjaxRequest()) {        
            echo CActiveForm::validate( array( $model ));         
            Yii::app()->end();         
        }/**/

		if(isset($_POST['ListingPcnCategoryItem']))
		{
			$model->attributes=$_POST['ListingPcnCategoryItem'];
			if( $model->save() ) {
				$model->order_by = $model->id;
				$model->save(false);
				$this->redirect( array( 'view', 'id' => $model->id ) );
			}
		}
		$this->render( 'update', array(
			'model' => $model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete( $id )
	{
        // POST request check is moved to filters 
		//if(Yii::app()->request->isPostRequest)
		//{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete(true);
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		//}
		//else
		//	throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $models = ListingPcnCategoryItem::retrieveAll( null, array() );
        $this->menu = array( array( 'link' => array('listingPcnCategoryItem/create'),'text'=>'Add new Membership' ));
        $this->controls = true;
        $this->render( 'index', array(
            'models' => $models,
		));
	}

    // This is actually index action defined in Controller
    // Uncomment to override
    /*
    public function actionList()
    {
        $this->actionIndex();
    }/**/


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel( $id )
	{
		$model=ListingPcnCategoryItem::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404,'The requested model does not exist.');
		return $model;
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
            'accessControl',  // perform access control for CRUD operations
            //'allowPostOnly + activate delete', // allow only POST requests
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
    
	public function accessRules()
	{
		return array(
			array('allow',  // allow admins only
				'actions' => array('index', 'view', 'create', 'update', 'delete', 'activate'),
                'roles'   => array( 'admin', 'admineditor'),
			),
			array('deny',  // deny all users
				'users'   => array('*'),
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}