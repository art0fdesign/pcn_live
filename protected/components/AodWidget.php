<?php
/**
 * ArtOfDesign Widget class file
 *
 * @author newtash <newtash@yahoo.com>
 * @link http://www.art0fdesign.com
 * @copyright Copyright &copy; 2010-2013 Art0fDesign
 * @license http://www.art0fdesign.com/license/
 */
/**
 * AodWidget should be a base class for aod created widgets
 *
 * It wrapps basic parameters:
 * pars array ( loads it in __construct() )
 * - put as public because of backward compatibility; not in use
 *   later when calling widget call with pars parameter
 *   now it is no need to explicitly define it is loaded in contructor
 * html returning value
 */
class AodWidget extends CWidget
{
    public $pars = array();
    public $html = ''; // returning value
    //
    public $params = array();
    public $type = 'frontend';
    //
    private $_pars = array();

    /**
     * Constructor.
     * Load pars array
     */
    public function __construct()
    {
        $this->_pars = isset(Yii::app()->getController()->pars)? Yii::app()->getController()->pars: array();
        if (!empty($this->_pars) && empty($this->pars)) {
            $this->pars = $this->_pars;
        }
    }

    /**
     * Getter for pars array
     */
    public function getPars()
    {
        return $this->_pars;
    }

    /**
     * Overrides default widget function to implement AoD theming
     * widget view file's path is:
     * theme/views/moduleName/widgetName
     */
    public function getViewPath(){
        /*
        $array = array();
        $array['theme_name'] = Yii::app()->getTheme()->name;
        $array['theme_is_object'] = is_object(Yii::app()->getTheme());
        $array['theme_viewPath'] = Yii::app()->getTheme()->viewPath;
        $array['parent_viewPath'] = parent::getViewPath(false);
        $array['parent_paths'] = parent::getViewPath(true);
        $array['ext_path'] = Yii::getPathOfAlias('ext');
        $array['file_dirname'] = dirname(__FILE__);
        $array['class_name'] = get_class($this);
        $class=new ReflectionClass($array['class_name']);
        $array['class_filename'] = $class->getFileName();
        $array['class_dirname'] = dirname($class->getFileName());
        MyFunctions::echoArray( $array, $this->controller->pars );
        /**/
        if( ($theme=Yii::app()->getTheme())!==null ){
            // create dir as: /moduleName/widgetPath under theme's views path
            $class = new ReflectionClass( get_class($this) );
            $dir = str_replace( Yii::getPathOfAlias('ext'), '', dirname( $class->getFilename() ) );
            return Yii::app()->getTheme()->viewPath . $dir;
        } else { // return default viewPath
            return parent::getViewPath(false);
        }
    }

    /**
     * Prepares & retrieves prepared assets folder
     * @param String Alias to assets folder
     * @return String Path to assets folder with published scripts
     */
    public function retrieveAssetsFolder( $alias = null )
    {
        if( $alias == null ){
            $assetPath = parent::getViewPath();
            if( ($theme=Yii::app()->getTheme())!==null ){
                $assetPath = self::getViewPath() . DIRECTORY_SEPARATOR . 'js';
            }
        } else $assetPath = Yii::getPathOfAlias( $alias );
        // publish files to assets folder and return assets path
        if( $this->controller->isLive() )
            // do refresh assets in localhost
            $assetsFolder = Yii::app()->assetManager->publish( $assetPath, false, -1, true );
        else
            $assetsFolder = Yii::app()->assetManager->publish( $assetPath );
        //
        return $assetsFolder;
    }

}