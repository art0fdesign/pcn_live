<?php

class MarketController extends Controller
{

    public $controls = false;
    // /**
    //  * @return array action filters
    //  */
    public function beforeAction($action)
    {
        Yii::app()->theme = 'cmsnew';
        return true;
    }

    public function actionIndex()
    {
        $this->redirect(array('ListEvents'));
    }


    public function actionListEvents()
    {
        $this->displayList('event');
    }

    public function actionListReports()
    {
        $this->displayList('report');
    }

    private function displayList($displayType = 'event')
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('f_deleted = 0');
        $criteria->addCondition('f_type = :type');
        $criteria->params = array(':type' => $displayType);

        $items = WebshopMain::model()->findAll($criteria);

        // MyFunctions::echoArray($items);

     // echo '<h1>FUCK IT WEBSHOP! MARKET IS COMMING!!!</h1>';
     // echo 'App theme: ' . Yii::app()->theme->name . '<br />';
     // var_dump(Yii::app()->theme);
// die("<h2>Display $displayType</h2>");

        $this->render('list', array(
            'type'  => $displayType,
            'items' => $items,
        ));
    }

}