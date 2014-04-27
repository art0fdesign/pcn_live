<?php

class CartWidget extends AodWidget
{

    /** Do some initializations */
    public function init()
    {

        // $this->registerScripts();
    }

    /**
     * render widget
     * do not directly render, just set html in a public html parameter
     */
    public function run()
    {
        // Functionality that manage checkout part of cart journey
        if (!empty($this->pars[1]) && $this->pars[1] == 'checkout') {
            $this->checkout();
            return;
        }

        if (!empty($this->pars[1]) && !empty($this->pars[2])) {
            switch ($this->pars[1]) {
                case 'update': $result = $this->updateCart(); break;
                case 'delete': $result = $this->deleteItemFromCart(); break;
                default: $result = false;
            }
            if (Yii::app()->getRequest()->getIsAjaxRequest() && $result) {
                echo 'OK';
            } else {
                $this->controller->redirect('/my-cart');
            }
            Yii::app()->end();
        }



        $models     = SimpleCart::fullCartItemsList();
        $total = array(
            'NoTax' => SimpleCart::total(),
            'Tax'   => SimpleCart::total(0.1),
            'Full'  => SimpleCart::total(1.1),
        );
        // MyFunctions::echoArray(array('total'=>$total), $models);

        $this->html = $this->render('cart', array(
            'cartID'    => SimpleCart::cartID(),
            'models'    => $models,
            'total'     => $total,
        ), true);
    }

    private function checkout()
    {
        $model = new EventsRegistration();
        if(isset($_POST['ajax']) && $_POST['ajax'] === 'simple-cart-checkout-form'){
            echo CActiveForm::validate(array($model));
            Yii::app()->end();
        }

        $model->attributes = SimpleCart::getEventRegistrationAttributes();

        $this->html = $this->render('checkout', array(
            'model' => $model,
            'total' => SimpleCart::total(),

        ), true);
    }

    private function registerScripts()
    {
        //Yii::app()->assetManager->forceCopy = true;
        // publish folder to assets & retrieve path
        // general accordion script
        // $assetsFolder = parent::retrieveAssetsFolder('webroot.js.accordion');
        // Yii::app()->clientScript->registerScriptFile($assetsFolder.'/jquery.aod.accordion.js');
        // specific rating script
        // $assetsFolder = parent::retrieveAssetsFolder();
        // Yii::app()->clientScript->registerScriptFile($assetsFolder.'/jquery.rating.js');
        /**/
        // star rating
        // $assetsFolder = parent::retrieveAssetsFolder('webroot.js.starrating');
        // Yii::app()->clientScript->registerCssFile($assetsFolder.'/jquery.rating.css');
        // Yii::app()->clientScript->registerScriptFile($assetsFolder.'/jquery.rating.js');
    }

    private function updateCart()
    {
        if (empty($this->pars[2]) || is_null(Yii::app()->getRequest()->getParam('quantity'))) {
            return false;
        }

        $itemID = (int)$this->pars[2];
        $newQuantity = Yii::app()->getRequest()->getParam('quantity');

        return SimpleCart::updateCart($itemID, $newQuantity);
    }

    private function deleteItemFromCart()
    {
        if (empty($this->pars[2])) {
            return false;
        }

        $itemID = (int)$this->pars[2];

        return SimpleCart::deleteCartItem($itemID);
    }
}