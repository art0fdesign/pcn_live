<?php
class PastEventsWidget extends AodWidget
{
    public $pageSize = 5;
    protected $_settings = array();
    protected $_categoryID = null;

    /** Do some initializations */
    public function init()
    {
        // module_id
        $condition = 'mod_path = :path AND f_status=1 AND f_deleted=0';
        $params = array( 'path' => 'pcn.events');
        $module_id = ModRegister::model()->findByAttributes( array(), $condition, $params )->id;
        // view_id
        $condition = 'lcase(view_action) = :action AND f_status=1 AND f_deleted=0';
        $params = array( 'action' => 'eventsList');
        $view_id = ModView::model()->findByAttributes( array(), $condition, $params )->id;
        // load settings
        $this->_settings = ModSetting::getSettingsArray( $module_id, $view_id );
         //MyFunctions::echoArray( $this->_settings );
        if( isset( $this->_settings['page-size']['set_value'] ) )
            $this->pageSize = intval($this->_settings['page-size']['set_value']);
        if( isset( $this->_settings['past-category-id']['set_value'] ) )
            $this->_categoryID = intval($this->_settings['past-category-id']['set_value']);
        // register pager css file
        $this->registerScripts();
    }

    public function run()
    {
        $displaySingle = false; // display only this one item
        //
        $criteria = new CDbCriteria();
        $params = array( 'list' => 'events', 'category'=>$this->_categoryID );
            // MyFunctions::echoArray( $params );
        $criteria->addCondition( 'listing_id = :list' );
        $criteria->addCondition( 'cat_id = :category' );
        $criteria->addCondition( 'f_deleted = 0' );
        $criteria->addCondition( 'f_status = 1' );
        $criteria->order = 'item_order DESC, id DESC';
        // if pars[2] is items seo then load that one only
            //MyFunctions::echoArray( $this->pars );
        if( !empty( $this->pars[1] ) && $this->pars[1] != 'page' ){
            $criteria->addCondition( 'item_seo = :seo' );
            $params['seo'] = $this->pars[1];
            $displaySingle = true;
        }
        $criteria->params = $params;
        //
        $count = ListingItem::model()->count($criteria);
        $pages = new CPagination( $count );
        $pages->pageSize = $this->pageSize;
        if( $this->pars[1] == 'page' && intval( $this->pars[2] ) )
            $pages->setCurrentPage( intval( $this->pars[2] )-1 );
        $pages->applyLimit( $criteria );

        // load models
        $models = ListingItem::model()->findAll( $criteria );
        $linkBaseUrl = Yii::app()->request->getBaseUrl() . '/' . $this->pars[0];
        $this->html = $this->render( 'eventsList', array(
            'models'    => $models,
            'pages'     => $pages,
            'displaySingle' => $displaySingle,
            'linkBaseUrl' => $linkBaseUrl,
        ), true );
    }

    /** Register scripts */
    private function registerScripts()
    {
        // register script
        if( ($theme=Yii::app()->getTheme())!==null ){
            $assetPath = $this->viewPath . DIRECTORY_SEPARATOR . 'js';
            $assetPath = Yii::app()->getTheme()->basePath . DIRECTORY_SEPARATOR . 'css';
            //MyFunctions::echoArray( $assetPath );
        } else
            $assetPath = Yii::getPathOfAlias('');
        //MyFunctions::echoArray( $assetPath );
        $assetsFolder=Yii::app()->assetManager->publish( $assetPath,
            false, -1, true
        );
        Yii::app()->clientScript->registerCssFile($assetsFolder.'/pager.css');
    }


}
