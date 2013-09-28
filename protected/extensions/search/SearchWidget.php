<?php
class SearchWidget extends CWidget
{
    public $html    = '';
    public $params = array();
    public $type = '';
    
    public $pageSize = 10;
    
    protected $_settings = array();
    protected $_links = array();
    
    public function init()
    {
        $baseUrl = Yii::app()->request->baseUrl;
        $this->_links['news'] = $baseUrl . '/news';
        $this->_links['ourteam'] = $baseUrl . '/our-team';
        $this->_links['events'] = $baseUrl . '/events';
        $this->_links['services'] = $baseUrl . '/services';
        $this->_links['research'] = $baseUrl . '/research';
        /*
        $modID = ModRegister::getModuleID('mailChimp');
        $sets = ModSetting::getSettingsArray( $modID );
        $this->_settings = $sets;
        $this->apikey = $sets['api-key']['value'];
        $this->listID = $sets['list-id']['value'];
        $this->listGroupingID = $sets['grouping-id']['value'];
        $this->group1Name = $sets['group1-name']['value'];
        $this->group2Name = $sets['group2-name']['value'];
        //MyFunctions::echoArray( $sets );        
        $this->registerScripts();        
        Yii::import('ext.mailChimp.mailChimp.MCAPI');
        */
    } 
    
    public function run()
    {
        $paginationParams = '';
        $search = array();
        if( isset( $_GET['term'] ) && $_GET['term'] != 'Search...' ){
            $term = Yii::app()->request->getParam( 'term' );
            $term = str_replace('  ', ' ', $term);
            // save to cookie
            Yii::app()->request->cookies['search_term']  = new CHttpCookie('search_term', $term);
        }
        // if no $_GET is defined, try to read it from cookie
        if( empty( $term ) )
            $term = isset(Yii::app()->request->cookies['search_term']) ? Yii::app()->request->cookies['search_term']->value : '';
        // process term
        if( !empty($term) ){
            $trimmed = trim( $term );
            if( !empty( $trimmed ) ) $search = explode( ' ', $term );
            // remove emty elements
            foreach( $search as $key=>$value ){
                $trimmed = trim( $value );
                if( empty($trimmed) ) unset( $search[$key] );
            }
            //$paginationParams = substr(strstr($_SERVER['REQUEST_URI'], '?' ), 1);
            //MyFunctions::echoArray( array( 'term'=>$term, 'count'=>count($search) ), $search, $_GET );            
        }
        $criteria = new CDbCriteria();
        foreach( $search as $item ){
            $trimmed = trim($item);
            if( !empty( $trimmed ) ){
                $criteria->addSearchCondition( 'html', $trimmed, true, 'OR' );
            }
        }
        $criteria->order = 'changed_dt DESC';
        //
        $count = WebSearch::model()->count( $criteria );
        //MyFunctions::echoArray( array('count'=>$count) );
        //
        $pages = new CPagination( $count );
        $pages->pageSize = $this->pageSize;
        if( $this->controller->pars[1] == 'page' && intval( $this->controller->pars[2] ) )
            $pages->setCurrentPage( intval( $this->controller->pars[2] )-1 );
        $pages->applyLimit( $criteria );
        
        // load models
        $models = WebSearch::model()->findAll( $criteria );
        $paginationBaseUrl = Yii::app()->request->getBaseUrl() . '/' . $this->controller->pars[0]; 
        $this->html = $this->render( 'search', array(
            'models'    => $models,
            'pages'     => $pages,
            'links' => $this->_links,
            'term' => $term,
            'paginationBaseUrl' => $paginationBaseUrl,
            //'paginationParams' => $paginationParams,
            'search' => $search,
        ), true );        
    }

    /**
     * Overrides default widget function to implement AoD theming
     * widget view file's path is:
     * theme/views/moduleName/widgetName
     */
    public function getViewPath(){
        if( ($theme=Yii::app()->getTheme())!==null ){
            // create dir as: /moduleName/widgetPath
            $dir = str_replace( Yii::getPathOfAlias('ext'), '', dirname(__FILE__) );
            return Yii::app()->getTheme()->viewPath . $dir;
        } else {
            return parent::getViewPath(false);
        }        
    }
    
}