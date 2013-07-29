<?php
/**
 * Created by Lemmy.
 * Date: 3/26/13
 * Time: 12:11 AM
 */
class ServicesListWidget extends AodWidget
{
    protected $_settings = array();

    public function init()
    {
        $condition = 'mod_path = :path AND f_status=1 AND f_deleted=0';
        $params = array( 'path' => 'pcn.services');
        $module_id = ModRegister::model()->findByAttributes( array(), $condition, $params )->id;
        // view_id
        $condition = 'lcase(view_action) = :action AND f_status=1 AND f_deleted=0';
        $params = array( 'action' => 'servicesList');
        $view_id = ModView::model()->findByAttributes( array(), $condition, $params )->id;
        // load settings
        $this->_settings = ModSetting::getSettingsArray( $module_id, $view_id );
        // register scripts
        $this->registerScripts();
    }

    public function run()
    {
        $categories = array();
        $models = array();
        // resolve selected category
        $selectedCategory = 0; $title = 'Services';
        $all = ListingCategory::retrieveAll('', array('listing_id'=>'services', 'f_status'=>1));
        foreach($all as $cat){
            $active = false;
            if( $this->pars[1] == '' || $this->pars[1] == $cat->cat_seo ) {
                $active = true;
                $this->pars[1] = $cat->cat_seo;
                $selectedCategory = $cat->id;
                $title = $cat->cat_title;
            }
            array_push($categories,array('id'=> $cat->id,'title'=>$cat->cat_title, 'seo'=>$cat->cat_seo, 'active'=>$active));
        }
        //MyFunctions::echoArray( $categories );
        //
        $criteria = new CDbCriteria();
        $criteria->addCondition('listing_id = :services');
        $params = array('services'=>'services');
        $criteria->addCondition('f_deleted = 0');
        $criteria->addCondition('f_status = 1');
        $criteria->order = 'item_order ASC, id ASC';
        if(!empty($this->pars[1])){
            $criteria->addCondition('cat_id = :catId');
            $params['catId'] = $selectedCategory;// ListingCategory::getCategoryId('services', $this->pars[1]);
        }
        $criteria->params = $params;

        $all = ListingItem::model()->findAll($criteria);
        foreach($all as $model){
            array_push($models, array( 'id'=>$model->id, 'list'=>$model->html_list, 'content'=>$model->html_content, 'seo'=>$model->item_seo));
        }

        $linkBaseUrl = Yii::app()->request->getBaseUrl() . '/' . $this->pars[0];

        $this->html = $this->render('servicesList', array(
            'models'=>$this->prepareArray($models),
            'categories'=>$categories,
            'title'=>$title,
            'linkBaseUrl'=>$linkBaseUrl,
            'selectedItem' => $this->pars[2],
        ),true);
    }

    public function getTitle($par)
    {
        $modelId = ListingCategory::getCategoryId('services', $par);
        $model = ListingCategory::model()->findByPk($modelId);
        return $model->cat_title;


    }

    private static function prepareArray($arr)
    {
        $ret = array();
        $const = 4;
        $count = count($arr);
        //$arrNum = ceil($count/$const);
        $i = 0;
        $k = 0;
        //MyFunctions::echoArray($arrNum);
        while($i < $count){
            for($j=$i; $j<$i+$const; $j++){
                if(empty($arr[$j])) break;
                $tmp[] = $arr[$j];
            }
            $ret[$k] = $tmp;
            unset($tmp);
            $k++;
            $i += $const;
        }
        //MyFunctions::echoArray($ret);
        return $ret;
    }

    /** Register scripts */
    private function registerScripts()
    {
        // register script
        if( ($theme=Yii::app()->getTheme())!==null ){
            $assetPath = $this->viewPath . DIRECTORY_SEPARATOR . 'js';
            //$assetPath = Yii::app()->getTheme()->basePath . DIRECTORY_SEPARATOR . 'js' .DIRECTORY_SEPARATOR . 'menu-colapsed' ;
            //$assetPath = Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'popup';
        } else
            $assetPath = Yii::getPathOfAlias('');
        //MyFunctions::echoArray( $assetPath );
        $assetsFolder=Yii::app()->assetManager->publish( $assetPath );
        Yii::app()->clientScript->registerScriptFile($assetsFolder.'/jquery.services.js');
    }
}
