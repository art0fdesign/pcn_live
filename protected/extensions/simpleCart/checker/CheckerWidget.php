<?php

class CheckerWidget extends AodWidget
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
        if (!empty($this->pars)
            && ($this->pars[0] == 'add-to-basket'
                || $this->pars[0] == 'add-to-cart'
            )
        ) {
            $isAdded = $this->addCartItemFromLink();
            if (isset($_SERVER['HTTP_REFERER'])) {
                $this->controller->redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->controller->redirect($_SERVER['HTTP_HOST']);
            }
            if (Yii::app()->getRequest()->getIsAjaxRequest() && $isAdded) {
                echo 'OK';
            }
            Yii::app()->end();
        }

        $itemsCount = SimpleCart::itemsCount();
        $this->html = $this->render('checker', array(
            'itemsCount' => $itemsCount,
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

    /**
     *  Private function for adding cart item through link
     *  Link format must be:
     *  0: simple-cart
     *  1: add-to-cart
     *
     *  Required params are NAME, QUANTITY, PRICE
     */
    protected function addCartItemFromLink()
    {
        // // Check existence of required parameters
        if (is_null(Yii::app()->request->getParam('name'))
            // || is_null(Yii::app()->request->getParam('quantity'))
            || is_null(Yii::app()->request->getParam('price'))
        ) {
            return false;
        }

        $model = new SimpleCartItem();
        $model->category    = is_null(Yii::app()->request->getParam('category')) ? '' : Yii::app()->request->getParam('category');
        $model->name        = Yii::app()->request->getParam('name');
        $model->quantity    = (float)is_null(Yii::app()->request->getParam('quantity')) ? '1' : Yii::app()->request->getParam('quantity');
        $model->price       = (float)Yii::app()->request->getParam('price');
        $model->description = is_null(Yii::app()->request->getParam('description')) ? '' : Yii::app()->request->getParam('description');

        if (! SimpleCart::addCartItem($model)) {
            return false;
        }

        return true;

    }

}