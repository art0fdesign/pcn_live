<?php
/**
 * Created by Lemmy.
 * Date: 3/24/13
 * Time: 5:25 PM
 */
class OurTeamWidget extends AodWidget
{
    public $_models;
    protected $_settings = array();

    public function init()
    {
        $condition = 'mod_path = :path AND f_status=1 AND f_deleted=0';
        $params = array( 'path' => 'pcn.ourteam');
        $module_id = ModRegister::model()->findByAttributes( array(), $condition, $params )->id;
        // view_id
        $condition = 'lcase(view_action) = :action AND f_status=1 AND f_deleted=0';
        $params = array( 'action' => 'ourTeam');
        $view_id = ModView::model()->findByAttributes( array(), $condition, $params )->id;
        // load settings
        $this->_settings = ModSetting::getSettingsArray( $module_id, $view_id );

        $this->registerScripts();
    }

    public function run()
    {
        // $models = ListingPcnCategory::model()->findAll();
        // foreach ($models as $model) {
        //     $model->cat_seo = MyFunctions::parseForSeo($model->cat_title);
        //     $model->save(false);
        // }
        // die("Counted: ".$models->count);
        $location = false; $filter = '';
        if(in_array(ucfirst($this->pars[1]), Yii::app()->params['pcnOurTeamLocations'])) {
            $location = array_search(ucfirst($this->pars[1]), Yii::app()->params['pcnOurTeamLocations']);
            $filter = ucfirst($this->pars[1]);
        }
        // MyFunctions::echoArray($this->pars);
        $sql = ''; 
        if ($this->pars[2] != '') {
            $condition = 'cat_seo = :seo';
            $params = array('seo'=>$this->pars[2]);
            $model = ListingPcnCategory::model()->find($condition, $params);
            if ($model) {
                $cat = $model->id;
                $filter = $model->cat_title;
                $sql = 'SELECT item_id from mod_listing_pcn_cat_item where cat_id = '.$cat;
            }
        } elseif ($this->pars[1] != '' && $location === false) {
            $condition = 'cat_seo = :seo';
            $params = array('seo'=>$this->pars[1]);
            $model = ListingPcnCategory::model()->find($condition, $params);
            if ($model) {
                $expertize = $model->id;
                $filter = $model->cat_title;
                $sql = "SELECT DISTINCTROW ci.item_id ";
                $sql .= "from mod_listing_pcn_cat_item as ci ";
                $sql .= "INNER JOIN mod_listing_pcn_category as cc ";
                $sql .= "ON ci.cat_id=cc.id ";
                $sql .= "WHERE cc.expertize = ".$expertize;
            }
        }

        $criteria = new CDbCriteria();
        $criteria->addCondition('listing_id = :ourteam');
        $params = array('ourteam'=>'ourteam');
        if ($sql != '') {
            $criteria->addCondition('id IN ('.$sql.')');
        }
        if ($location !== false) {
            $criteria->addCondition('cat_id = '.$location);
        }
        $criteria->addCondition('f_deleted = 0');
        $criteria->addCondition('f_status = 1');
        $criteria->order = 'item_order ASC, id ASC';
        $criteria->params = $params;

        $this->_models = ListingItem::model()->findAll($criteria);

        // MyFunctions::echoArray($this->_models);

        $this->html = $this->render('ourTeam', array(
            'models'=>$this->_models,
            'filter' => $filter,
        ), true);
    }

    /** Register scripts */
    private function registerScripts()
    {
        // publish folder to assets & retrieve path
        $assetsFolder = parent::retrieveAssetsFolder('webroot.js.menu-colapsed');
        //register required scripts
        Yii::app()->clientScript->registerScriptFile($assetsFolder.'/jquery.content-colapsed.js');
    }
}
