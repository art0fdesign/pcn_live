<!DOCTYPE html>
<html lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />


<?php
        $baseurl = Yii::app()->request->baseUrl;
        Yii::app()->getClientScript()->registerCoreScript('jquery');
        Yii::app()->getClientScript()->registerCoreScript('yii');
        Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
        // user specific theme
        $frontendTheme = Yii::app()->params['theme_frontend'];
?>

<link href="<?php echo $baseurl;?>/themes/cmsnew/css/main.css" rel="stylesheet" type="text/css" />


<title><?php echo Yii::app()->name; ?></title>

<script type="text/javascript" src="<?php echo $baseurl;?>/js/menu-colapsed/javascript.js"></script>
<script type="text/javascript" src="<?php echo $baseurl;?>/js/form/form_element.js"></script>
<script type="text/javascript" src="<?php echo $baseurl;?>/js/datatable/datatable.js"></script>
<script type="text/javascript" src="<?php echo $baseurl;?>/js/tiny_mce/tiny_mce.js"></script>

<script type="text/javascript" src="<?php echo $baseurl;?>/js/script.js"></script>

</head>

<body>

<div class="wraper">

<div class="headerWrapper">
    <header>

        <span><?php echo Yii::app()->user->fullName; ?></span>
        <span class="spacer"></span>
        <span>Language: </span>
        <span>English</span>
        <span class="spacer"></span>
        <span>last login: </span>
        <span><?php echo !empty(Yii::app()->user->lastLoginTime)? date('l, F d, Y, g:i a', strtotime(Yii::app()->user->lastLoginTime)): 'Not Logged Yet'; ?></span>
        <span class="spacer"></span>
        <?php echo CHtml::link('Logout', array('/site/logout')); ?>

        <div class="supervisor"><span></span></div>
        <img class="floatR" src="<?php echo $baseurl;?>/img/bgr_left_version.png" alt="supervisor" />


    </header>
</div>


<div class="bottomlineWrapper">
    <div class="bottomline">
           <div class="version" style="position: absolute;left: 10px;top:10px; font-size: 14px;font-weight: bold; color:#5FA2CB;">Admin Console: 1.3.<?php echo Yii::app()->user->getGitVersion(); ?> </div>



        <? if($this->controls) : ?>
            <?foreach($this->menu as $m) : ?>
            <span class="mainCom"><?=$m['text']?></span>
            <span class="plus"><?= is_array($m['link'])? CHtml::link('&#43;', $m['link']) : CHtml::link('&#43;', array("{$m['link']}")) ?></span>
            <? endforeach; ?>
        <? endif; ?>

     </div>
</div>


<div class="contentWrapper">
<div class="content">

<!-- LEFT MENU -->
    <? $controler = $this->getUniqueId(); ?>
    <?php $controler = Yii::app()->controller->id; ?>
    <?php $module = @Yii::app()->controller->module->id; ?>

    <nav id="menu" class="nav menu">
        <ul>

<?php /** ======================================  DASHBOARD ======================================================= */?>
            <li <? if($controler == 'site') echo "class='active'";?>><?=CHtml::link('Dashboard<span>System Information</span>', array('/site/index'), array('class'=>'accordionButton systeminfo')) ?></li>

<?php /** ======================================  PAGES =========================================================== */?>
            <li <? if($controler == 'webPages') echo "class='active'";?>><?=CHtml::link('Pages<span>List of website pages</span>', array('/webPages/index'), array('class'=>'accordionButton pagecount')) ?></li>

<?php /** ======================================  CONTENTS ======================================================== */?>
            <li <? if(in_array($controler,array('webContent','widget','menu','menuItem','webAssign'))) echo "class='active'";?>><a href="#" class="exp accordionButton contents ">Contents<span>Content manager</span></a>
                <ul class="menu1 accordionContent  <? if(in_array($controler,array('webContent','widget','menu','menuItem','webAssign','modMail'))) echo "acc-on";?>">
                    <li><?php echo CHtml::link('Contents',array('/webContent/index'))?></li>
                    <li><?php echo CHtml::link('Modules', array('/modMain/modulesList')) ?></li>
                    <li><?php echo CHtml::link('Widgets', array('/modMain/widgetsList')) ?></li>
                    <?php if ($frontendTheme == 'pcn'): ?>
                    <li><?php echo CHtml::link('Event Registrations', array('/pcn/market/ListEvents')) ?></li>
                    <li><?php echo CHtml::link('Report Purchases', array('/pcn/market/ListReports')) ?></li>
                    <?php endif; ?>
                    <li><?php echo CHtml::link('Menus', array('/menuBuilder/menu/list')) ?></li>
                    <li><?php echo CHtml::link('Assignment', array('/webAssign/index')) ?></li>
                    <li><?php echo CHtml::link('Mails', array('/modMail/list')) ?></li>
    <?php if($frontendTheme == 'pcn'): ?>
                    <li><?php echo CHtml::link('Events Registration', array('/eventsRegistration/index')); ?></li>
    <?php endif; ?>
                </ul>
            </li>

<?php /** ======================================  FILE MANAGER ==================================================== */?>
            <li <?php if($controler == 'file') echo "class='active'";?>><?php echo CHtml::link('File manager<span>Edit files and docs</span>', array('/file/index'), array('class'=>'accordionButton filemanager')) ?></li>

<?php /** ======================================  USER SPECIFIC MENUS ============================================= */?>
<?php if( $frontendTheme == 'doctors' ): ?>
            <li <? if($module == 'doctors' && $controler == 'doctor') echo "class='active'";?>><?php echo CHtml::link('Doctors<span>Doctors administration</span>', array('/doctors/doctor/index'), array('class'=>'exp accordionButton catalog')) ?>
            </li>
            <?php $filterArray = array( 'surveyNames', 'surveyCategories', 'surveyQuestionsAvailable', 'surveyDoctorSurveys' ); ?>
            <li <? if($module == 'doctorRatings' && in_array( $controler, $filterArray )) echo "class='active'";?>><?php echo CHtml::link('Ratings<span>Ratings panel', '#', array('class'=>'exp accordionButton admin')) ?>
                <ul class="menu1 accordionContent <? if( $module=='doctorRatings' && in_array( $controler, $filterArray ) ) echo "acc-on";?>">
                    <li><?php echo CHtml::link('Surveys', array('/doctorRatings/surveyNames')) ?></li>
                    <li><?php echo CHtml::link('Categories', array('/doctorRatings/surveyCategories')) ?></li>
                    <li><?php echo CHtml::link('Available Questions', array('/doctorRatings/surveyQuestionsAvailable')) ?></li>
                    <li><?php echo CHtml::link('DoctorSurveys', array('/doctorRatings/surveyDoctorSurveys')) ?></li>
                </ul>
            </li>
            <?php $filterArray = array( 'doctorLocation', 'doctorSpeciality', 'doctorSubspeciality', 'doctorDegree', 'healthIssue', 'insurance', 'doctorChoice', 'news', 'topDoctors', 'testimonials', 'surveyType', 'surveyResponseType' ); ?>
            <li <? if( in_array( $module, array( 'doctor', 'doctorRatings')) && in_array( $controler, $filterArray )) echo "class='active'";?>><?php echo CHtml::link('Settings<span>Settings panel', '#', array('class'=>'exp accordionButton admin')) ?>
                <ul class="menu1 accordionContent <? if( in_array( $module, array( 'doctor', 'doctorRatings')) && in_array( $controler, $filterArray ) ) echo "acc-on";?>">
                    <li><?php echo CHtml::link('Locations', array('/doctors/doctorLocation')) ?></li>
                    <li><?php echo CHtml::link('Specialities', array('/doctors/doctorSpeciality')) ?></li>
                    <li><?php echo CHtml::link('Subspecialities', array('/doctors/doctorSubspeciality')) ?></li>
                    <li><?php echo CHtml::link('Medical Degrees', array('/doctors/doctorDegree')) ?></li>
                    <li><?php echo CHtml::link('Health Issues', array('/doctors/healthIssue')) ?></li>
                    <li><?php echo CHtml::link('Health Issues Home', array('/doctors/healthIssueHomePage')) ?></li>
                    <li><?php echo CHtml::link('Insurances', array('/doctors/insurance')) ?></li>
                    <li><?php echo CHtml::link('Choices', array('/doctors/doctorChoice')) ?></li>
                    <li><?php echo CHtml::link('News', array('/doctors/news')) ?></li>
                    <li><?php echo CHtml::link('Top Doctors', array('/doctors/topDoctors')) ?></li>
                    <li><?php echo CHtml::link('Testimonials', array('/testimonials/testimonials')) ?></li>
                    <li>---</li>
                    <li><?php echo CHtml::link('Survey Types', array('/doctorRatings/surveyType')) ?></li>
                    <li><?php echo CHtml::link('Response Types', array('/doctorRatings/surveyResponseType')) ?></li>
                </ul>
            </li>

<?php elseif($frontendTheme == 'kopaoniknew'): ?>
            <li <? if($module == 'kopaoniknew' && $controler == 'accommodations') echo "class='active'"; ?>><?php echo CHtml::link('Accommodations<span>Administration</span>', array('/kopaoniknew/accommodations/index'), array('class'=>'exp accordionButton catalog')) ?>
            </li>
            <li <?php if($module == 'kopaoniknew' && in_array( $controler, array('accommodationsLocation', 'accommodationsDetails', 'accommodationsTags', 'accommodationsType', 'accommodationsEstateType', 'accommodationsCaterType', 'accommodationsServiceType'))) echo "class='active'"; ?>><?php echo CHtml::link('Settings<span>Settings panel', '#', array('class'=>'exp accordionButton admin')) ?>
                <ul class="menu1 accordionContent <? if( $module=='kopaoniknew' && in_array( $controler, array('accommodationsLocation', 'accommodationsDetails', 'accommodationsTags', 'accommodationsType', 'accommodationsEstateType', 'accommodationsCaterType', 'accommodationsServiceType'))) echo "acc-on";?>">
                    <li><?php echo CHtml::link('Locations', array('/kopaoniknew/accommodationsLocation'));?></li>
                    <li><?php echo CHtml::link('Details', array('/kopaoniknew/accommodationsDetails'));?></li>
                    <li><?php echo CHtml::link('Tags', array('/kopaoniknew/accommodationsTags'));?></li>
                    <li><?php echo CHtml::link('Accommodation Type', array('/kopaoniknew/accommodationsType'));?></li>
                    <li><?php echo CHtml::link('Real Estate Type', array('/kopaoniknew/accommodationsEstateType'));?></li>
                    <li><?php echo CHtml::link('Caterer Type', array('/kopaoniknew/accommodationsCaterType'));?></li>
                    <li><?php echo CHtml::link('Service Type', array('/kopaoniknew/accommodationsServiceType'));?></li>
                </ul>
            </li>

<?php elseif($frontendTheme == 'cehnew'): ?>
            <li <?php if($module == 'blog') echo "class='active'"; ?>><?php echo CHtml::link('Blog<span>Manage Posts</span>', array('/blog/blog'), array('class'=>'accordionButton modules')) ?></li>
            <li <?php if($module == 'cehnew' && $controler == 'cehImportantDates') echo "class='active'"; ?>><?php echo CHtml::link('Important Dates<span>Manage Important Dates</span>', array('/cehnew/cehImportantDates'), array('class'=>'accordionButton modules')) ?></li>
            <li <?php if($module == 'cehnew' && $controler == 'cehLocation') echo "class='active'"; ?>><?php echo CHtml::link('Directions<span>Map and Directions</span>', array('/cehnew/cehLocation'), array('class'=>'accordionButton modules')) ?></li>

<?php elseif($frontendTheme == 'summa'): ?>
            <li <?php if($module == 'summa' && in_array($controler, array('summaBlog', 'summaBlogCategory'))) echo 'class="active"' ?> ><?php echo CHtml::link('Blog<span>Edit posts</span>', '#', array('class'=>'exp accordionButton admin')) ?>
                <ul class="menu1 accordionContent <?php if($module == 'summa' && in_array($controler, array('summaBlog', 'summaBlogCategory'))) echo "acc-on" ?>">
                    <li><?php echo CHtml::link('Posts', array('summa/summaBlog')) ?></li>
                    <li><?php echo CHtml::link('Categories', array('summa/summaBlogCategory')) ?></li>
                </ul>
            </li>


<?php elseif($frontendTheme == 'cheerful'): ?>
            <li <? if($module == 'cheerful' && $controler == 'cheerfulUser') echo "class='active'"; ?>><?php echo CHtml::link('Cheerful Users<span>Users administration</span>', array('/cheerful/cheerfulUser/index'), array('class'=>'exp accordionButton catalog')) ?>
            </li>

<?php elseif($frontendTheme == 'pcn'): ?>
            <li <?php if($module == 'pcn' && in_array($controler, array('listingPcnCategoryItem'))) echo 'class="active"' ?>><?php echo CHtml::link('Our team<span>Our team administration</span>', '#', array('class'=>'exp accordionButton catalog')) ?>
                <ul class="menu1 accordionContent">
                    <li><?php echo CHtml::link('Our team', array('/aodListing/listingPcnCategoryItem/index')) ?></li>
                    <li><?php echo CHtml::link('Functional expertize', array('/aodListing/listingPcnCategory/index', 'parent_id'=>'1')) ?></li>
                    <li><?php echo CHtml::link('Industry expertize', array('/aodListing/listingPcnCategory/index', 'parent_id'=>'2')) ?></li>
                </ul>
            </li>
<?php endif; ?>

<?php /** ======================================  ADMIN =========================================================== */?>
            <?php if( Yii::app()->user->isAdmin ): ?>
            <li <?php if(in_array($controler,array('modRegister','template','user'))) echo "class='active'";?>><?php echo CHtml::link('Admin<span>Administrators panel', '#', array('class'=>'exp accordionButton admin')) ?>
                <ul class="menu1 accordionContent">
                    <li><?php echo CHtml::link('Widget &amp; Module', array('/modRegister/index')) ?></li>
                    <li><?php echo CHtml::link('Templates', array('/template/index')) ?></li>
                    <li><?php echo CHtml::link('Users', array('/user/index')) ?></li>
                    <li><?php echo CHtml::link('Listings', array('/aodListing/listingMain')) ?></li>
                    <?php /** ======== ADMIN PLUS ======== */ ?>
                    <?php if( isset(Yii::app()->params['admin_plus']['display']) && Yii::app()->params['admin_plus']['display'] ):?>
                    <li>---</li>
                    <?php
                    $adminPlus = Yii::app()->params['admin_plus'];
                    foreach( array('css', 'default', 'layout') as $item ){
                        $adminController = array( 'css'=>'updateCSS', 'default'=>'updateSectors', 'layout'=>'updateLayout' );
                        if( isset( $adminPlus[$item] ) ){
                            foreach( $adminPlus[$item] as $file=>$caption ){
                                // link generation
                                echo '
                                <li>' . CHtml::link( $caption , array('/template/' . $adminController[$item], 'file'=>$file)) . '</li>
                                ';
                            }// foreach( $adminPlus[$item] as $file=>$caption )
                        }//if( isset( $adminPlus[$item] ) ):
                    }// foreach( array('css', 'default', 'layout') as $item ){?>
                    <?php endif;//<?php if( isset(Yii::app()->params['admin_plus']['display'])?>
                </ul>
            </li>
            <?php else: ?>
            <li <?php if($controler == 'user') echo "class='active'";?>><?php echo CHtml::link('Users<span>Users administration', array('/user/index'), array('class'=>'accordionButton users')) ?></li>
            <?php endif; ?>
        </ul>
    </nav>


<!-- CONTENT -->
<?php echo $content; ?>
<!-- CONTENT END -->

<div class="clear"></div>


</div>



</div>
</div>
<!-- Footer -->

<div class="footerWrapper">
<footer>
<span class="footertext">Copyright
    <a href="http://art0fdesign.com/" target="_blank" title="...the most powerful design..."> Art of Design</a>
    2003-<?php echo date('Y'); ?>. All Rights Reserved
</span>
</footer>
</div>

</body>

</html>
