<?php

class EwayController extends Controller
{
    public $menu = array();
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

    public function actionIndex()
    {
        $models = EventsRegistration::model()->findAll(array(
            'order'=>'id DESC',
            'condition' => 'invoice_no > 0',
        ));
        $this->render('invoicesList', array(
            'models'    => $models,
        ));
    }
}