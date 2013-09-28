<?php

abstract class Frontend 
{
    /**
     * --- Content HTML tags in functions ---
     * {pageUrl_id}:    replacePageUrlInContent
     * {menu_id}:       replaceMenuTagInContent
     * {file:seo-name}  replaceFileTagInContent
     */
     
    /**
     * --- Content HTML tags ---
     * @baseUrl: Path to home folder ( Yii::app()->request->baseUrl )
     * @imgUrl: Path to template images folder ( '/frontend/img/' )
     * @uploadUrl: Path to upload folder ( '/upload/' ) -> doc directory
     * @thumbUrl: Path to images thumb folder ( '/upload/thumb/' )
     * @catalogUrl: Path to catalogs thumb folder ( '/upload/catalog/thumb/' )
     */
     
    /**
     * Retrieves CMS Setting value
     * @param string settingKey: name of set_key to search
     * @param string exceptionValue: value to return if some error occurs
     * @return string setting value or exception
     */
    public function getCMSSetting($settingKey = null, $exceptionValue = '')
    {
        $row = Yii::app()->db->createCommand()            
            ->from('cms_settings')
            ->where(array('and', 'set_key=:sk', 'f_deleted=0'), array('sk'=>$settingKey))
            ->order('id DESC')
            ->queryRow();
        /** *************************************/
        try{
            return $row['set_value'];
        } 
        catch(Exception $e){
            return $exceptionValue;
        }
    }
    
    /**
     * Retrieves Home page ID
     * @langCode: language code for specify page's language 
     */
    public function getHomePageID($langCode = 'en')
    {
        $pageID = self::getCMSSetting('home_page_' . $langCode);
        if( $pageID == 0) $pageID = self::getCMSSetting('home_page');

        return intval($pageID);
    }
    public function getLangIdByCode($lang){
         $retVal = Yii::app()->db->createCommand()
             ->select('id')
             ->from('cms_languages')
             ->where('lang_code=:lang',array('lang'=>$lang))
             ->queryScalar();
        return $retVal;

    }

    /**
     * Retrieves pageID For Specified URL and language
     * @url: page's url
     * @langID: specified language
     */
    public function getPageID( $url = null, $langCode = 'en')
    {
        $retVal = 0;
        if(!empty($url)){
            $retVal = Yii::app()->db->createCommand()
                ->select('p.id')
                ->from('web_pages as p')
                ->join('cms_languages as l', 'p.lang_id=l.id')
                ->where(array('and', 'p.url=:url', 'l.lang_code=:lang'), array('url'=>$url, 'lang'=>$langCode))
                ->queryScalar();
        }
        // if no page found, return home page
        if($retVal == 0){
            $retVal = self::getHomePageID($langCode);
        }
        return $retVal;
    }
    
    /**
     * Retrieves pageID By containing Specific Widget
     * @widgetPath: widget's path
     * @moduleWidgetAction: module widget's action
     */
    public static function getPageIDByWidget( $moduleWidgetAction = null, $widgetPath = null, $lang = 'en' )
    {
        $retVal = 0; $id = 0; $ctype = 'W';
        if( !empty( $widgetPath ) ){
            // search by widget path
            // get widget id
            $id = Yii::app()->db->createCommand()
                ->select('id')
                ->from('cms_mod_register')
                ->where('mod_path=:path', array('path'=>$widgetPath))
                ->queryScalar();
        } else if( !empty( $moduleWidgetAction ) ){
            // search by module widget action
            // get widget id
            $id = Yii::app()->db->createCommand()
                ->select('id')
                ->from('cms_mod_view')
                ->where('view_action=:action', array('action'=>$moduleWidgetAction))
                ->queryScalar();           
            $ctype = 'V'; 
        }
        
        if( $id ){

           $lang_id=self::getLangIdByCode($lang);
                // search in web_template_content
                $retVal = Yii::app()->db->createCommand()
                    ->select('p.id')
                    ->from('web_assign as t')
                    //->join('web_pages as p', 'p.tpl_id=t.page_temp_id')
                    ->join('web_pages as p', 'p.id=t.page_temp_id')
                    ->where(
                    array('and', 't.content_type=:ctype', 't.content_id=:id', 't.f_status=1', 't.f_deleted=0','p.lang_id=:lang', 'p.f_status=1', 'p.f_deleted=0'),
                    array('ctype'=>$ctype, 'id'=>$id, 'lang'=>$lang_id)
                )
                    ->order('p.id DESC')
                    ->queryScalar();

        }
        //
        return intval($retVal);
    }
    
    /**
     * Retrieves Page's Data
     * @pageID: 
     * @fieldName:
     */
    public function getPageData($pageID, $fieldName = 'url')
    {
        $result = Yii::app()->db->createCommand()
            ->select($fieldName)
            ->from('web_pages')
            ->where('id=:page_id', array('page_id'=>$pageID))
            ->queryScalar();
        /** *************************************/
        return $result;
    }
    
    /**
     * Retrieves pageID By containing Specific Widget
     * @widgetPath: widget's path
     * @moduleWidgetAction: module widget's action
     */
    public static function getPageDataByWidget( $moduleWidgetAction = null, $widgetPath = null, $lang = 'en', $fieldName = 'url' )
    {
        $retVal = 0; $id = 0; $ctype = 'W';
        if( !empty( $widgetPath ) ){
            // search by widget path
            // get widget id
            $id = Yii::app()->db->createCommand()
                ->select('id')
                ->from('cms_mod_register')
                ->where('mod_path=:path', array('path'=>$widgetPath))
                ->queryScalar();
        } else if( !empty( $moduleWidgetAction ) ){
            // search by module widget action
            // get widget id
            $id = Yii::app()->db->createCommand()
                ->select('id')
                ->from('cms_mod_view')
                ->where('view_action=:action', array('action'=>$moduleWidgetAction))
                ->queryScalar();           
            $ctype = 'V'; 
        }
        
        if( $id ){

           $lang_id=self::getLangIdByCode($lang);
                // search in web_template_content
                try {                    
                    $retVal = Yii::app()->db->createCommand()
                        ->select( 'p.' . $fieldName )
                        ->from('web_assign as t')
                        //->join('web_pages as p', 'p.tpl_id=t.page_temp_id')
                        ->join('web_pages as p', 'p.id=t.page_temp_id')
                        ->where(
                            array('and', 't.content_type=:ctype', 't.content_id=:id', 't.f_status=1', 't.f_deleted=0','p.lang_id=:lang', 'p.f_status=1', 'p.f_deleted=0'),
                            array('ctype'=>$ctype, 'id'=>$id, 'lang'=>$lang_id)
                        )
                        ->order('p.id DESC')
                        ->queryScalar();
                } 
                catch(Exception $e){
                    throw new CHttpException( 0, "Field '$fieldName' does not existst in page table!" );
                }

        }
        //
        return $retVal;
    }
    
    /**
     * Retrieves Page's Layout ID
     * @pageID: 
     */
    public function getPageLayoutID($pageID)
    {
        $result = Yii::app()->db->createCommand()
            ->select('tpl_id')
            ->from('web_pages')
            ->where('id=:page_id', array('page_id'=>$pageID))
            ->queryScalar();
        /** *************************************/
        return $result;
    }
    
    /**
     * Retrieves Array of Contents specific to template
     * @pageID: 
     */
    protected function getPageTemplateContents( $pageID, $lang )
    {
        $retRow = array();
        //
        $tplID = self::getPageLayoutID( $pageID );
        if(!empty($tplID)){

            $rows = Yii::app()->db->createCommand()
                ->select('ts.php_name as sector_name, tc.*')
                ->from('web_assign as tc')
                ->join('web_template_sector as ts', 'tc.sector_id=ts.id')
                ->where(
                $condition = array(
                    'and',
                    'ts.tpl_id=:tpl',
                    'tc.assign_type="T"',
                    'ts.f_status=1', 'ts.f_deleted=0',
                    'tc.f_status=1', 'tc.f_deleted=0'
                ),
                $params = array('tpl'=>$tplID)
            )

                ->order('tc.sector_id, tc.content_order')
                ->queryAll();
        
        //MyFunctions::echoArray( $rows ); 
           // print "<pre>"; print_r($rows);die;
            foreach($rows as $item){
                // retrieve html code
                $html = '';
                switch($item['content_type']){
                    case 'C': // content
                        $html = self::getContentHtml(intval($item['content_id']), $pageID, $lang); break;
                    case 'W': // widget
                        $html = self::getWidgetHtml( intval($item['content_id']) ); break;
                    case 'V': // modul view
                        $html = self::getModuleWidgetHtml( intval($item['content_id']) ); break;
                    case 'M': // menu
                        $html = self::getMenuHtml( $item['content_id'], array('page_id' => $pageID),$lang); break;
                }
                // add it to array
                if($html !=''){
                    if(!array_key_exists($item['sector_name'], $retRow)){
                        $retRow[$item['sector_name']] = $html;
                    } else {
                        $retRow[$item['sector_name']] .= $html;
                    }
                }
            }// foreach($rows as $item)
        }// if(!empty($tplID))
        //        
        return $retRow;
    }
    
    /**
     * Retrieves Page Specific Contents 
     * @pageID:
     */
    protected function getPageSpecificContents( $pageID, $lang )
    {
        $retRow = array();

        $rows = Yii::app()->db->createCommand()
            ->select('s.php_name as sector_name, p.*')
            //->from('web_content as c')
            //->join('web_assign as p', 'c.id=p.content_id')
            ->from('web_assign as p')
            ->join('web_template_sector as s', 'p.sector_id=s.id')
            ->where(array('and', 'p.page_temp_id=:pid', 'p.assign_type=:type',
                'p.f_status=1', 'p.f_deleted=0', 's.f_status=1', 's.f_deleted=0'),
                array('pid'=>$pageID, 'type'=>'P'))
            ->order('p.sector_id, p.content_order')
            ->queryAll();
            //->text;

        foreach($rows as $item){
            // retrieve html code
            $html = '';
            switch($item['content_type']){
                case 'C': // content
                    $html = self::getContentHtml(intval($item['content_id']), $pageID, $lang); break;
                    //MyFunctions::echoArray( $html );
                case 'W': // widget
                    $html = self::getWidgetHtml( intval($item['content_id']) ); break;                    
                case 'V': // modul view
                    $html = self::getModuleWidgetHtml( intval($item['content_id']) ); break;
                case 'M': // menu
                    $html = self::getMenuHtml( $item['content_id'], array('page_id' => $pageID), $lang); break;
            }
            // add it to array
            if(!array_key_exists($item['sector_name'], $retRow)){
                $retRow[$item['sector_name']] = $html;                    
            } else {
                $retRow[$item['sector_name']] .= $html;
            }
        }            
        //        
        return $retRow;
    }
    
    /**
     * Content Generator
     * Generates Html Output for Content
     * @contentID: content ID to generate
     * @params: I don't know what is this for
     */
    protected function getContentHtml( $contentID=0, $pageID, $lang )
    {
        $retRow = array();        
        //
        if($contentID != 0){
            $row = Yii::app()->db->createCommand()
                ->from('web_content')
                ->where('id=:id and lang_id=:lang', array('id'=>$contentID,'lang'=>$lang))
                ->queryRow();
            //     
            if(!empty($row)){
                /** display content */
                $retRow[] = self::getContentHtml_Html($row, $pageID, $lang) . "\n";
            }
        }// if($contentID != 0)
        //
        return implode("\n", $retRow);
    }
    
    /**
     * Retrieves Content's Html Code if type of content is 'html'
     * @return array contentRow: Content Row Array
     * -------------------------------------------------------------
     * publicPath is defined in /frontend/controller/DefaultController.php
     */
    protected function getContentHtml_Html($contentRow = null, $pageID, $lang)
    {
        $retRow = array();
        if($contentRow !== null){
            $t = self::replaceAllTagsInContent( $contentRow['content'], $pageID, $lang );
            $retRow[] = $t; // CHtml::encode($t);            
        }// if($contentRow !== null)
        //
        return implode("\n", $retRow);
    }
/*
    protected function getContentHtml_Html($contentRow = null, $pageID, $lang)
    {
        $retRow = array();
        if( (Yii::app()->getTheme())!==null ) $baseUrl = Yii::app()->theme->baseUrl;
        else $baseUrl = Yii::app()->request->baseUrl;
        //
        if($contentRow !== null){
            $t = str_ireplace('{baseUrl}', $baseUrl, $contentRow['content']);
            //$imgUrl =$baseUrl . "/{$this->publicPath}/img/";
            $imgUrl = $baseUrl . '/img/';
            $t = str_ireplace('{imgUrl}', $imgUrl, $t);
            //
            // Upload dir is ALWAYS upload
            //$uploadUrl = $baseUrl . '/upload/';
            $uploadUrl = Yii::app()->request->baseUrl . '/upload/';
            $t = str_ireplace('{uploadUrl}', $uploadUrl, $t);
            //$thumbUrl = $uploadUrl . 'thumb/';
            $thumbUrl = self::getUploadedImagesThumbPath() . '/';
            $t = str_ireplace('{thumbUrl}', $thumbUrl, $t);
            //$catalogUrl = $uploadUrl . 'catalog/thumb/';
            //$t = str_ireplace('{catalogUrl}', $catalogUrl, $t);
            // check dynamicaly added page url-s
            $t = self::replacePageUrlInContent( $t );
            // check dinamicaly added menus
            $t = self::replaceMenuTagInContent( $t, array('page_id'=>$pageID), $lang );
            // find-out file src
            $t = self::replaceFileTagInContent( $t );
            //
            $retRow[] = $t; // CHtml::encode($t);            
        }// if($contentRow !== null)
        //
        return implode("\n", $retRow);
    }
/**/
    
    /**
     * Retrieves Content's Html Code if type of content is 'image'
     * @contentRow: Content Row Array
     */
    protected function getContentHtml_Image($contentRow = null)
    {
        $retRow = array();
        //
        if($contentRow !== null){
            $imgPath = self::getUploadedImagesThumbPath() . '/';
            $imgSrc = $imgPath . $contentRow['content_html'];
            //$imgAlt = !empty($contentRow['image_alt'])? " alt='{$contentRow['image_alt']}'": '';
            $is = !empty($contentRow['content_class'])? " class='{$contentRow['content_class']}'": '';
            $is .= !empty($contentRow['content_id'])? " id='{$contentRow['content_id']}'": '';
            $is .= !empty($contentRow['content_set'])? " {$contentRow['content_set']}": '';
            $retRow[] = "<img src='$imgSrc'{$is} />";
        }// if($contentRow !== null)
        //
        return implode("\n", $retRow);
    }
    /**
     * Retrieves uploaded images thumb path under upload directory
     * Main functionality is to separate paths of development and production environments
     * Development: uploads/{theme}/files
     * Production: upload/files
     */
    protected function getUploadedImagesThumbPath()
    {
        if( $this->_thumbUrl === null ){
            $path = '/files'; // '/files' is default if not set
            //
            if( isset( Yii::app()->params['filesUploadRoot'] )) $path = Yii::app()->params['filesUploadRoot'];
            //
            if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '127.0.0.1'){
                $path = '/' . Yii::app()->params['theme_frontend'] . $path;
            }
            $ret = Yii::app()->request->getBaseUrl() . '/upload' . $path;
            // set cached thumbUrl path
            $this->_thumbUrl = $ret;
        }
        return $this->_thumbUrl;
    }
    
    /**
     * Widget Generator
     * Generates Html Output for Specified Standalone Widget
     * @menuID: menu ID to generate
     * @defParams: I don't know what is this for
     */
    public function getWidgetHtml( $widgetID=0, $defParams=null )
    {
        $ret = '<h3>Widget Not Loaded</h3>';
        $params = array();
        //MyFunctions::echoArray( $this->pars );
        //
        if($widgetID != 0){
            $row = Yii::app()->db->createCommand()
                ->from('cms_mod_register')
                ->where('id=:id', array('id'=>$widgetID))
                ->queryRow();
            //MyFunctions::echoArray( $row );
            // return parameters
            // Uncheck this to add params functionality 
            /**/           
            $paramsAll = Yii::app()->db->createCommand()
                ->select('set_key, set_name, set_value, set_default')
                ->from('cms_mod_setting')
                ->where('mod_id=:mod AND view_id=:view AND f_deleted=0 AND f_status=1',
                        array( 'mod'=>$widgetID, 'view'=>0))
                ->queryAll();
            foreach( $paramsAll as $item ){
                $params[$item['set_key']] = !empty($item['set_value'])? $item['set_value']: $item['set_default'];
            }
            //Myfunctions::echoArray( $params );
            /**/
            //            
            if(!empty($row)){
                /** resolve path/widget name */
                $path = str_replace( '/', '.', $row['mod_path'] ); // replace failed '/' signs in path
                $path = str_replace( '\\', '.', $path ); // replace failed '\' signs in path
                $pos = strrpos( $path, '.' ); // retrieve last occurence of '.'
                //MyFunctions::echoArray( array('pos'=>$pos, 'pos_is_null'=>$pos===false, 'path'=>$path, 'mod_path'=>$row['mod_path'] ) );              
                if( $pos === false ) $widget = $path; // there is no separator; path iz widget class name
                else $widget = substr( $path, strrpos( $path, '.' ) + 1 ); // cut-off last part of setting
                $widget = ucfirst( $widget ) . 'Widget'; // Upper case for widget class name
                /** display content */  
                $address = 'ext.' . $path . '.' . $widget;
                //$address = 'ext.' . $row['mod_path'] . '.' . ucfirst($row['mod_path']) . 'Widget';
                //return $address;

                $ret = $this->widget( $address, array( 'params' => $params,'type'=>'frontend') )->html . "\n";
            }
        }// if($contentID != 0)
        //
        return $ret;
    }
    
    /**
     * Module Widget Generator
     * Generates Html Output for Specified Module Widget
     * @menuID: menu ID to generate
     * @defParams: I don't know what is this for
     */
    public function getModuleWidgetHtml( $viewID=0, $defParams=null)
    {
        $ret = '<h3>Module Widget Not Loaded</h3>';
        $params = array();
        //MyFunctions::echoArray( $this->pars );
        //
        if($viewID != 0){
            $row = Yii::app()->db->createCommand()
                ->select('m.mod_path, v.view_action, v.mod_id')
                ->from('cms_mod_register m')
                ->join('cms_mod_view v', 'v.mod_id = m.id')
                ->where('v.id=:id', array('id'=>$viewID))
                ->queryRow();

            if(!empty($row)){
                /** resolve path/widget name */
                //$address = 'application.modules.' . $row['mod_path'] . '.widgets.' . $row['view_action'] . '.' . ucfirst($row['view_action']) . 'Widget';
                $path = str_replace( '/', '.', $row['mod_path'] ); // replace failed '/' signs in path
                $path = str_replace( '\\', '.', $path ); // replace failed '\' signs in path
                /** display content */
                $address = 'ext.' . $path . '.' . $row['view_action'] . '.' . ucfirst($row['view_action']) . 'Widget';
                //$address = 'ext.' . $row['mod_path'] . '.' . $row['view_action'] . '.' . ucfirst($row['view_action']) . 'Widget';
                //return $address;
                $ret = $this->widget( $address, array( 'pars' => $this->pars ) )->html . "\n";
                //MyFunctions::echoArray( $address, $ret );
            }
        }// if($contentID != 0)
        //
        return $ret;
    }
    
    /**
     * Menu Generator
     * Generates Html Output for Specified Menu
     * @menuID: menu ID to generate
     * @params['page_id']: current page id for links by page
     */
    public function getMenuHtml( $menuID=0, $params=null, $lang=1 )
    {
        $pageId = 0;
        $ret = array();
        if( $params != null && is_array($params) ){
            if( isset( $params['page_id'] ) ) $pageId = $params['page_id'];
        }
        //
        $items = self::getMenuItemList( $menuID, 0, $lang );
        $menu = Yii::app()->db->createCommand()
            ->from('mod_menu_main')
            ->where('id=:id', array('id'=>$menuID))
            ->queryRow();
        if(!empty($items)){
            $ret[] = '<ul '.$menu['ul_options'].'>';

            foreach( $items as $item ){
                // cycle through array
                $ret[] = self::getMenuItemHtml( $item, $pageId, $lang );
            }

            $ret[] = '</ul>';
        }//
        return implode("\n", $ret);
    }
    
    /**
     * Retrieves Html Output for Specified Menu Item
     * Also made recursion for childs...
     * @itemID: item ID to generate
     * @pageId: Current Page ID for generating class="active" on menu that directs to this page
     */
    protected function getMenuItemHtml( $itemID=0, $pageId=0, $lang )
    {
        $ret = array();
        //
        $item = Yii::app()->db->createCommand()
            ->from('mod_menu_item')
            ->where('id=:id', array('id'=>$itemID))
            ->queryRow();
        //
        if( !empty($item) ){
            $t = '<li';
            // 
            $isActive = ''; // check is this page is active
            //
            if( $item['li_type'] == 2 ){
                // check all childs to see if they are linked to this page to set parent's active class
                //
                if( $pageId != 0 && $pageId == $item['li_page'] ) $isActive = ' active';
                // eventually check page's parent
                if( $pageId != 0 && empty( $isActive ) ){                    
                    $parentID = self::getPageData( $pageId, 'parent_id' );
                    if( $parentID != 0 && $parentID == $item['li_page'] ){ 
                        $isActive = ' active';
                    }
                }
            }
            //
            if( !empty( $item['description'] ) || !empty( $isActive ) ) {
                $t .= ' class="' . $item['description'] . $isActive . '"';}
            // add other html options 
            if( !empty( $item['li_options'] ) ) $t .= ' ' . $item['li_options'];
            $t .= '>';
            $ret[] = $t;
            // load child menus
            $childs = self::getMenuItemList( $item['menu_id'], $item['id'], $lang );
            // check does this item's childrens are referenced to this page
            if($childActive = self::getMenuChildActive( $item['id'], $pageId )) $isActive = ' active';
            //
            switch( $item['li_type'] ){
                case 0: //no link only text show
                    $t = $item['caption'];
                    $ret[] = $t;
                    break;
                case 1: // link by url
                    $class = '';
                    if( $childActive ) $class = 'active ';
                    if(!empty($childs)) $class .= 'parent-menu';
                    if( !empty($class) ) $class = 'class="'.$class.'"';
                    $t = '<a href="' . $item['li_value'] . '" '.$class.'>' . $item['caption'] . '</a>';
                    $ret[] = $t;
                    break;
                case 2: // link by page
                    $t = Yii::app()->baseUrl . '/' . self::getPageData( $item['li_page'], 'url');
                    if( !empty( $item['li_value'] ) ) $t .= '/' . $item['li_value'];

                    $t = '<a href="' . $t . '"  class="' . $isActive . '" >' . $item['caption'] . '</a>';
                    $ret[] = $t;
                    break;                    
            }

            if( !empty( $childs ) ){
                $ret[] = "\n<ul style='display: none;' class='parent-content'>\n";
                foreach( $childs as $child ){
                    $ret[] = self::getMenuItemHtml( $child , $pageId , $lang );
                }
                $ret[] = "\n</ul>\n"; 
            }
            // close parent li tag
            $ret[] = "</li>";           
        }
        //
        return implode("", $ret);
    }
    /** Retrieve Menu Items Simple Array List */
    protected function getMenuItemList( $menuId, $parentId = 0, $lang )
    {
        $ret = array();
        $items = Yii::app()->db->createCommand()
            ->select('mi.*,mm.lang_id')
            ->from('mod_menu_item mi')
            ->join('mod_menu_main mm','mi.menu_id = mm.id')
            ->where('mi.menu_id=:mid AND mi.parent_id=:p AND mm.lang_id=:lang AND mi.f_status=1 AND mi.f_deleted=0', array('mid'=>$menuId, 'p'=>$parentId, 'lang'=>$lang))
            ->order('mi.menu_order')
            ->queryAll();

        foreach( $items as $item ){
            $ret[] = $item['id'];
        }
        return $ret;
    }
    
    /**
     * Retrieves information does any child menu is referenced to this page 
     */
    protected function getMenuChildActive( $menuId, $pageId )
    {
        $item = Yii::app()->db->createCommand()
            ->select('count(*) as isactive')
            ->from('mod_menu_item')
            ->where('parent_id=:id AND li_type=2 AND li_page=:page', array('id'=>$menuId, 'page'=>$pageId))
            ->queryScalar();
        return $item;
    }
    
    /**
     * Retrieves Html code for Script in Head Sector
     * @pageID:
     */
    protected function getPageScriptHtml( $pageID )
    {
        $retRows = array();
        // script in a head
        $retRows['script_head'] = '';
        // script in a bottom of body
        $retRows['script_body'] = '';
        //
        return $retRows;
    }
    /** --------------------------- REPLACEMENT FUNCTIONS ----------------------------- */
    
    /**
     * Retrieves Content's Html Code if type of content is 'html'
     * @param String $content String to consider replacements
     * @param Integer $pageID Used in Menu rendering for setting class="active" tag
     * @param String $lang same as $pageID
     * @return String content without tags
     * -------------------------------------------------------------
     */
    public static function replaceAllTagsInContent($content = null, $pageID=0, $lang='en')
    {
        $ret = $content;
        if( (Yii::app()->getTheme())!==null ) $baseUrl = Yii::app()->theme->baseUrl;
        else $baseUrl = Yii::app()->request->baseUrl;
        //
        if($content !== null){
            $t = $content;
            // {baseUrl} -> applications baseUrl
            if( strpos( $t, '{baseUrl}' ) !== false )
                $t = str_ireplace('{baseUrl}', $baseUrl, $t);
            // {imgUrl} -> design img path
            if( strpos( $t, '{imgUrl}' ) !== false ){            
                $imgUrl = $baseUrl . '/img/';
                $t = str_ireplace('{imgUrl}', $imgUrl, $t);
            }
            //
            // Upload dir is ALWAYS upload
            //$uploadUrl = $baseUrl . '/upload/';
            if( strpos( $t, '{uploadUrl}' ) !== false ){            
                $uploadUrl = Yii::app()->request->baseUrl . '/upload/';
                $t = str_ireplace('{uploadUrl}', $uploadUrl, $t);
            }
            //$thumbUrl = $uploadUrl . 'thumb/';
            if( strpos( $t, '{thumbUrl}' ) !== false ){            
                $thumbUrl = self::getUploadedImagesThumbPath() . '/';
                $t = str_ireplace('{thumbUrl}', $thumbUrl, $t);
            }
            //$catalogUrl = $uploadUrl . 'catalog/thumb/';
            //$t = str_ireplace('{catalogUrl}', $catalogUrl, $t);
            // check dynamicaly added page url-s
            $t = self::replacePageUrlInContent( $t );
            // check dinamicaly added menus
            $t = self::replaceMenuTagInContent( $t, array('page_id'=>$pageID), $lang );
            // find-out file src
            $t = self::replaceFileTagInContent( $t );
            //
            $ret = $t; // CHtml::encode($t);            
        }// if($contentRow !== null)
        //
        return $ret;
    }
        
    /**
     * @return string Content pageUrl creation...
     * Search for {pageUrl_id} and creates link to that page
     */
    protected function replacePageUrlInContent( $content )
    {
        $needle = '{pageUrl_';
        if( stripos( $content, $needle) !== false ){
            $baseUrl = Yii::app()->request->baseUrl;
            //
            $pos_open = stripos( $content, $needle );
            for( $i = 1; $pos_open != 0 || substr($content, 0, strlen($needle))==$needle; $i++){
                $pos_open = stripos( $content, $needle );
                $pos_close = stripos( $content, '}', $pos_open );
                $search = substr( $content, $pos_open , $pos_close-$pos_open+1 ); 
                $id = intval(substr( $search, strlen($needle), strlen($search)-strlen($needle)-1 ));
                //
                $replace = $baseUrl . '/' . self::getPageData( $id );
                $content = str_replace( $search, $replace, $content );
                //
                $pos_open = stripos( $content, $needle );
            }
        }
        //
        return $content;
    }
    
    /**
     * @return string Content pageUrl creation...
     * Search for {menu_id} and creates link to that page
     */
    protected function replaceMenuTagInContent( $content, $menuParams = null, $lang = 1 )
    {
        $needle = '{menu_';
        if( stripos( $content, $needle) !== false ){
            $pageID = 0; if( isset( $menuParams['page_id'] )) $pageID = intval( $menuParams['page_id'] );
            $parentID = self::getPageData( $pageID, 'parent_id' );
            if( $parentID ) $pageID = $parentID;
            //
            $pos_open = stripos( $content, $needle );
            //MyFunctions::echoArray( array( 'content' => $content, 'pos_open'=>$pos_open ) );
            for( $i = 1; $pos_open != 0 || substr($content, 0, strlen($needle))==$needle; $i++){
                $pos_open = stripos( $content, $needle );
                $pos_close = stripos( $content, '}', $pos_open );
                $search = substr( $content, $pos_open , $pos_close-$pos_open+1 ); 
                $id = intval(substr( $search, strlen($needle), strlen($search)-strlen($needle)-1 ));
                //
                $replace = self::getMenuHtml( $id, array('page_id'=>$pageID), $lang );
                //MyFunctions::echoArray( array( 'id' => $id, 'replace'=>$replace ) );
                $content = str_replace( $search, $replace, $content );
                //
                $pos_open = stripos( $content, $needle );
            }
        }
        //
        return $content;
    }

    /**
     * Retrieves fileID For Specified URL and language
     * @param String file's seo name
     * @return Integer file id 
     */
    public function getFileID( $seoName = null)
    {
        $retVal = 0;
        if(!empty($seoName)){
            $retVal = Yii::app()->db->createCommand()
                ->select('id')
                ->from('cms_file_item')
                ->where('file_seo=:seo', array('seo'=>$seoName))
                ->queryScalar();
        }
        //
        return $retVal;
    }
    
    /**
     * Retrieves File's Data
     * @param Integer fileID 
     * @param String fieldName
     */
    public function getFileSrc( $fileID = 0, $fileSeo = null)
    {
        if( $fileID == 0 ){
            return self::replaceFileTagInContent( $fileSeo );
        }
        //        
        $result = File::model()->findByPk($fileID)->getFileUrl();
        /** *************************************/
        return $result;
    }
    
    /**
     * @return string Content fileUrl creation...
     * Search for {file:seo-name} and creates link to that file
     */
    protected function replaceFileTagInContent( $content )
    {
        $needle = '{file:';
        //MyFunctions::echoArray( $content );
        if( stripos( $content, $needle) !== false ){
            //
            $pos_open = stripos( $content, $needle );
            //MyFunctions::echoArray( array( 'content' => $content, 'pos_open'=>$pos_open ) );
            for( $i = 1; $pos_open != 0 || substr($content, 0, strlen($needle))==$needle; $i++){
                $pos_open = stripos( $content, $needle );
                $pos_close = stripos( $content, '}', $pos_open );
                $search = substr( $content, $pos_open , $pos_close-$pos_open+1 ); 
                $seo = substr( $search, strlen($needle), strlen($search)-strlen($needle)-1 );
                $replace = ''; // if url is not found replace it with empty string 
                //                
                $fileID = self::getFileID( $seo ); 
                //MyFunctions::echoArray( array( 'content'=>$content, 'file_id'=>$fileID, 'is null'=>empty($fileID) ) );                       
                if( $fileID != 0 ){
                    $replace = self::getFileSrc( $fileID );
                }
                $content = str_replace( $search, $replace, $content );
                //
                $pos_open = stripos( $content, $needle );
            }
        }
        //
        return $content;
    }

    /**
     * Prepares Block Array to populate view's sectors
     * @pageID:
     */
    public function prepareBlockArray( $pageID )
    {
        $retArray = array();
        $pageData = Yii::app()->db->createCommand()
            ->select('p.*, l.lang_code, t.file_name')
            ->from('web_pages as p')
            ->join('cms_languages as l', 'p.lang_id=l.id')
            ->join('web_template as t', 'p.tpl_id=t.id')
            ->where('p.id=:pid', array('pid'=>$pageID))
            ->queryRow();
        if(!empty($pageData)){
            $retArray['tpl_id'] = $pageData['tpl_id'];
            $retArray['tpl_file'] = $pageData['file_name'];
            $retArray['language'] = $pageData['lang_code'];
            $retArray['title'] = $pageData['meta_title'];
            $retArray['keywords'] = $pageData['meta_keywords'];
            $retArray['description'] = $pageData['meta_description'];
            $retArray['google_code'] = $pageData['google_code'];

            $lang = $pageData['lang_id'];
            if($pageData['lang_code'] != $this->pars['lang'])
                $this->pars['lang'] = $pageData['lang_code'];
            /** Layout Specific Content */
            $t = self::getPageTemplateContents($pageID, $lang);
            if(!empty($t)) $retArray = array_merge($retArray, $t);
            //MyFunctions::echoArray( $retArray );
            /** Page Specific Content */
            $t = self::getPageSpecificContents($pageID, $lang);
            if(!empty($t)) $retArray = array_merge($retArray, $t);
            //MyFunctions::echoArray( $retArray );
            /** Page Specific Script Content */
            $t = self::getPageScriptHtml($pageID);
            if(!empty($t)) $retArray = array_merge($retArray, $t);
        }
        return $retArray;
    }

}