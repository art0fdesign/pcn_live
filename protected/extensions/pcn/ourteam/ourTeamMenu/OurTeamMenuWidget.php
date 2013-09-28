<?php
class OurTeamMenuWidget extends AodWidget {

    private $listing_id = 'ourteam';
    public $items = array();
    protected $_settings = array();

    public function init()
    {
        $condition = 'mod_path = :path AND f_status=1 AND f_deleted=0';
        $params = array( 'path' => 'pcn.ourteam');
        $module_id = ModRegister::model()->findByAttributes( array(), $condition, $params )->id;
        // view_id
        $condition = 'lcase(view_action) = :action AND f_status=1 AND f_deleted=0';
        $params = array( 'action' => 'ourTeamMenu');
        $view_id = ModView::model()->findByAttributes( array(), $condition, $params )->id;
        // load settings
        $this->_settings = ModSetting::getSettingsArray( $module_id, $view_id );
        //MyFunctions::echoArray( array('mod'=>$module_id, 'view'=>$view_id), $this->_settings );
        // register menu-colapsed script
        // $this->registerScripts();
    }
    public function run()
    {
        $linkBaseUrl = Yii::app()->request->baseUrl;
        $models = ListingPcnCategory::retrieveAll('order_by ASC', array('level'=>1));
        $linkBaseUrl = Yii::app()->request->getBaseUrl(true);
        $linkBaseUrl .= '/' . Frontend::getPageDataByWidget('ourTeamMenu');
        // MyFunctions::echoArray(array('baseUrl'=>$linkBaseUrl), $models);
        $this->html = $this->render('widget', array(
            'settings'=>$this->_settings,
            'models'=>$models,
            'pars'=>$this->pars,
            'linkBaseUrl'=>$linkBaseUrl
        ), true);
    }

    private function registerScripts()
    {
        // publish folder to assets & retrieve path
        $assetsFolder = parent::retrieveAssetsFolder('webroot.js.menu-colapsed');
        //register required scripts
        Yii::app()->clientScript->registerScriptFile($assetsFolder.'/jquery.menu-colapsed.js');
    }

	
}