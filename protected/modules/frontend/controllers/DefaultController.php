<?php

class DefaultController extends CController
{
    // name of public directory for storing css, scripts, template images etc.
    public $publicPath = 'frontend';
    //
    public $pageTitle = '';
    public $pars = array();
    public $pageID = 0;
    public $blocks = array();
    public $lang = 'en';

    // cache thumb url path
    public $_thumbUrl = null;

    protected $_theme = null;


    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
                'testLimit'=>1,
            ),
        );
    }
    /**
     * @return array action filters
     */
    public function beforeAction($action)
    {
        $this->_theme = Yii::app()->params['theme_frontend'];
        Yii::app()->theme = $this->_theme;
        return true;
    }

    /**
     * @return Boolean is host is localhost or live one
     */
    public function isLive()
    {
        return $_SERVER['SERVER_ADDR'] != '127.0.0.1' && $_SERVER['SERVER_ADDR'] != '::1';
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex($par=null, $par2=null, $par3=null, $par4=null, $par5=null, $par6=null, $par7=null, $par8=null, $par9=null, $par10=null)
    {
        //$this->actionError(); Yii::app()->end();
        // Resolve url parameters...
        $this->pars[0] = !empty($par)? $par: '';
        $this->pars[1] = !empty($par2)? $par2: '';
        $this->pars[2] = !empty($par3)? $par3: '';
        $this->pars[3] = !empty($par4)? $par4: '';
        $this->pars[4] = !empty($par5)? $par5: '';
        $this->pars[5] = !empty($par6)? $par6: '';
        $this->pars[6] = !empty($par7)? $par7: '';
        $this->pars[7] = !empty($par8)? $par8: '';
        $this->pars[8] = !empty($par9)? $par9: '';
        $this->pars[9] = !empty($par10)? $par10: '';
        //
        if ($par == 'process' && empty($_SERVER['HTTPS']) && $this->isLive()) {
            if (empty($_SERVER['REQUEST_URI'])) {
                $this->redirect(Yii::app()->request->getHostInfo('https'));
            }
            $this->redirect(Yii::app()->request->getHostInfo('https').$_SERVER['REQUEST_URI']);

        } elseif ($par != 'process' && !empty($_SERVER['HTTPS'])) {
            if (empty($_SERVER['REQUEST_URI'])) {
                $this->redirect(Yii::app()->request->getHostInfo('http'));
            }
            $this->redirect(Yii::app()->request->getHostInfo('http').$_SERVER['REQUEST_URI']);
        }

        //
        if( $par == 'ha' ){
            echo $this->widget('ext.webUser.socialAuth.SocialAuthWidget', array('pars'=>$this->pars))->html;
            Yii::app()->end();
        } /**/
        //
        $langCode = !empty(Yii::app()->params['defaultFrontendLangCode'])? Yii::app()->params['defaultFrontendLangCode']: 'en';


        //$Key = Yii::app()->session->sessionID.'__fr_lang';
        if($this->_theme=='dental')
            $langCode = 'sr';

        if($this->_theme=='psd'){
            $langCode = Frontend::getCMSSetting('default_language','en');

         //  print $langCode;
        /*    $cookie = new CHttpCookie('psd_lang',$langCode);
        $cookie->expire = time()+60*60*24*30;
        print $langCode;
        if(!isset(Yii::app()->request->cookies['psd_lang'])){
            Yii::app()->request->cookies['psd_lang'] = $cookie;
        }
         if($this->pars[1]!=''){

                Yii::app()->session[$Key] = $this->pars[1];
                Yii::app()->request->cookies['psd_lang']->value = $this->pars[1];
            }

            $lang = isset(Yii::app()->session[$Key])? Yii::app()->session[$Key] : $langCode;
           print $lang;
            if(empty($lang)){
                $lang = isset(Yii::app()->request->cookies['psd_lang']) ? Yii::app()->request->cookies['psd_lang']->value : $langCode;
                Yii::app()->session[$Key] = $lang;
            }
            $langCode = $lang;*/
         //  print $langCode;
        //   print_r(Yii::app()->session);


                /*

            if(!isset(Yii::app()->session['front_lang']))
                Yii::app()->session['front_lang'] = $langCode;

            if($this->pars[1]!=''){
                Yii::app()->session['front_lang'] = $this->pars[1];
            }

            $langCode = Yii::app()->session['front_lang'];      */

                 if(!isset(Yii::app()->session['front_lang']))
                Yii::app()->session['front_lang'] = $langCode;

            if($this->pars[1]!='' && in_array($this->pars[1],array('si','en'))){
                Yii::app()->session['front_lang'] = $this->pars[1];
            }

            $ln = Yii::app()->session['front_lang'];
            if(in_array($ln,array('si','en')))
             $langCode = $ln;
        }
        //print $langCode;

        $this->pars['lang'] = $langCode;
        $this->pageID = Frontend::getPageID( $par, $langCode );
        /*MyFunctions::echoArray( array(
            'pageID'=>$this->pageID,
            'par'=>$par,
            'lang'=>$langCode,
            'theme'=>$theme,
            'theme path'=>Yii::app()->theme->viewPath,
        ) );/**/
        //
        if($this->pars[0]=='')
            $this->pars[0] = Frontend::getPageData($this->pageID, 'url');
        $err = null;
        if( $this->pageID == 0){
            // show no-page
            $err = array('code'=>'701', 'message'=>'Requested URL cannot be resolved or Home page is not defined');
            //$this->render('error', $err);
        } else {
            $blocks = Frontend::prepareBlockArray( $this->pageID );
            $this->blocks = $blocks;
            //MyFunctions::echoArray($blocks);
            // Check template file existence
            if( isset( $blocks['tpl_file'] ) ){
                if( (Yii::app()->getTheme())!==null )
                    $tplFile = Yii::getPathOfAlias('webroot.themes.'.$this->_theme.'.views.frontend.default') . DIRECTORY_SEPARATOR . $blocks['tpl_file'] . '.php';
                else
                    $tplFile = Yii::getPathOfAlias('frontend.views.default') . DIRECTORY_SEPARATOR . $blocks['tpl_file'] . '.php';
            } else $tplFile = null;
            //echo $tplFile;
            if( !file_exists($tplFile) ) {
                $err = array('code'=>'702', 'message'=>'Template file NOT exists!');

            } else {

                //MyFunctions::echoArray($blocks);
                $err = null;
                $this->pageTitle = $blocks['title'];
                $this->render($blocks['tpl_file'], array('block'=>$blocks));
                //try { $this->render($this->block['tpl_id']); }
                //catch(Exception $e){ $this->render('error', array('code'=>'405', 'message'=>"Template file '{$this->viewHtml['tpl_id']}.php' not found")); }
            } // if( !file_exists($tplFile))
        }// if($this->pageID == 0)
        if ( $err != null ){
            $this->actionError($err);
        }
    }

    /**
     * Function to prepare displaying information about error in user-friendly manner
     */
    public function actionError($errorArray=null)
    {
        if( $errorArray == null ) $errorArray = array('code'=>'499', 'message'=>'Check settings before continuation');
        //
        //MyFunctions::echoArray( Yii::app()->theme->name, $this->getViewFile('error') ) ;
        $this->render('error', $errorArray);
    }
}
