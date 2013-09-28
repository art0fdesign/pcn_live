<!DOCTYPE html>
<html lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />

<title><?php echo Yii::app()->name; ?></title>
 <?php
        $baseurl = Yii::app()->request->baseUrl;

    ?>
<link href="<?php echo $baseurl;?>/themes/cmsnew/css/main.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo $baseurl;?>/js/menu-colapsed/jquery-1.4.2.min.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo $baseurl;?>/js/menu-colapsed/javascript.js"></script>
<script type="text/javascript" src="<?php echo $baseurl;?>/js/form/form_element.js"></script>


</head>

<body>

<div class="wraper">

<div class="headerWrapper">
	<header>

        <span><?php echo Yii::app()->user->full_name; ?></span>
        <span class="spacer"></span>
        <span>Language: </span>
        <span>English</span>
        <span class="spacer"></span>
        <span>last login: </span>
        <span><?php echo !empty(Yii::app()->user->last_login_time)? date('l, F d, Y, g:i a', strtotime(Yii::app()->user->last_login_time)): 'Not Logged Yet'; ?></span>
        <span class="spacer"></span>
        <?php echo CHtml::link('Logout', array('/site/logout')); ?>

		<div class="supervisor"><span></span></div>
		<img class="floatR" src="<?php echo $baseurl;?>/img/bgr_left_version.png" alt="supervisor" />


	</header>
</div>


<div class="bottomlineWrapper">
	<div class="bottomline">
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
        <li <? if($controler == 'site') echo "class='active'";?>><?=CHtml::link('Dashboard<span>System Information</span>', array('/site/index'), array('class'=>'accordionButton systeminfo')) ?></li>
        <li <? if($controler == 'webPages') echo "class='active'";?>><?=CHtml::link('Pages<span>List of website pages</span>', array('/webPages/index'), array('class'=>'accordionButton pagecount')) ?></li>


        <li <? if($controler == 'webContent') echo "class='active'";?>><a href="<?=Yii::app()->request->baseUrl.'/admin/webContent/index'?>" class="accordionButton contents">Contents<span>Content manager</span></a></li>

        <li></li>
		<li><a href="#" class="accordionButton systeminfo">Dashboard<span>System Information</span></a></li>
		<li><a href="#" class="accordionButton pagecount">Pages<span>List of website pages</span></a>
			<ul class="menu1 accordionContent">
				<li><a href="page.html" class="exp">Home</a></li>
				<li><a href="#" class="exp">About</a></li>
				<li><a class="exp">Contact</a></li>
				<li><a href="#" class="exp">Portfolio</a></li>
				<li><a href="#" class="exp">Testimonials</a></li>
				<li><a class="exp">News</a></li>
			</ul>
		</li>
		<li><a href="#" class="accordionButton contents">Contents<span>Content manager</span></a>
			<ul class="menu1 accordionContent">
				<li><a href="content.html" class="exp">Home</a></li>
				<li><a href="#" class="exp">About</a></li>
				<li><a class="exp">Contact</a>
					<ul class="sub accordionContent">
						<li><a href="#">Contact Info</a></li>
						<li><a href="#">Contact Form</a></li>
					</ul>
				</li>
				<li><a href="#" class="exp">Portfolio</a></li>
				<li><a href="#" class="exp">Testimonials</a></li>
				<li><a class="exp">News</a>
					<ul class="sub accordionContent">
						<li><a href="#">World</a></li>
						<li><a href="#">Regional</a></li>
						<li><a href="#">Local</a></li>
					</ul>
				</li>
			</ul>
		</li>
		<li><a href="#" class="accordionButton filemanager">File manager<span>Edit files and docs</span></a></li>
		<li><a href="#" class="exp accordionButton modules">Modules<span>Wiidgets and modules</span></a>
			<ul class="menu1 accordionContent">
				<li><a href="#" class="exp">Banner slider</a></li>
				<li><a href="#" class="exp">Twitter</a></li>
				<li><a class="exp">Sidebar menu</a>
					<ul class="sub accordionContent">
						<li><a href="content.html">Group name</a></li>
						<li><a href="#">Category</a></li>
						<li><a href="#">Subcategory</a></li>
					</ul>
				</li>
				<li><a href="#" class="exp">Contact form</a></li>
			</ul>
		</li>
		<li><a href="#" class="accordionButton catalog">Catalog<span>Product and services</span></a></li>
		<li><a href="#" class="accordionButton users">Users<span>Users administration</span></a></li>
		<li><a href="#" class="accordionButton settings">Settings<span>Cms adjustments</span></a></li>
		<li><a href="#" class="accordionButton admin">Admin<span>Administrators panel</span></a></li>
		</ul>
	</nav>

<div class="titleBlock"><span>Menu Item</span></div>

<div class="wideContent">
<p> Lorem ispuddadaf;akf fda;f kfkak falfk fkalf i asf lfslkagj lfgu ijl ksgakuasi gugljas </p>
</div>

<div class="middleContent">

	        <form action="" class="form">
            <fieldset>
                <div class="widget">
                    <div class="title1"><h6>Content Data</h6></div>

                    <div class="formRow mt30">
                        <label>Content name:</label>
                        <div class="formRight"><input type="text" value="" /></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Page:</label>
                        <div class="formRight"><input type="text" value="" /></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Sector:</label>
                        <div class="formRight"><input type="text" value="" /></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Type:</label>
                        <div class="formRight"><input type="text" value="" /></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Order:</label>
                        <div class="formRight"><input type="text" value="" /></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Release date:</label>
                        <div class="formRight"><input type="text" value="" /></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Language:</label>
                        <div class="formRight">
						<select id="lang" class="styled" name="lang">
							<option value="01">Srpski</option>
							<option value="02">English</option>
						</select>

						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow mb30">
                    <label>Status:</label>
                    <div class="formRight">
  					   <input type="checkbox" name="ch1" id="" class="styled">
                       <label style="width:60px;" for="ch1">active</label>
					   <div class="clear"></div>
                    </div>
					</div>
                </div>
            </fieldset>

            <fieldset>
                <div class="widget">
					<div class="title1"><h6>Description</h6></div>

                    <div class="formRow mt30">
                        <label>Content title:</label>
                        <div class="formRight"><input type="text" value="" /></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                    	<label>Title options:</label>
                        <div class="formRight">
                            <span class="oneTwo"><input type="text" placeholder="Title tag" value="" /></span>
							<div class="mt15"></div>
                            <span class="oneTwo"><input type="text" placeholder="Title class" value="" /></span>
                        </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow mb30">
					<label>Display title:</label>
                    <div class="formRight">
  					   <input type="radio" name="ch2" id="" class="styled">
                       <label style="width:30px;" for="ch2">active</label>
					   <input type="radio" name="ch3" id="" class="styled">
                       <label style="width:30px;" for="ch3">inactive</label>
					   <div class="clear"></div>
                    </div>
					</div>
                </div>
			</fieldset>

			<fieldset>
                <div class="widget longWidget">
					<div class="title1"><h6>Meta Data</h6></div>

                    <div class="formRow mt30">
 						<span class="count">58</span>
						<label>Page title:</label>
                        <input type="text" value="" />
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <span class="count">255</span>
						<label>Keywords:</label>
                        <textarea rows="4" cols="" name=""></textarea>

						<div class="clear"></div>
                    </div>
					<div class="formRow mb30">
                        <span class="count">152</span>
						<label>Description:</label>
                        <textarea rows="4" cols="" name=""></textarea>

                        <div class="clear"></div>
                    </div>
                </div>

				<div class="widget">
					<div class="title1"><h6>TEXT / HTML editor</h6></div>
					<div class="mt40 mb40"></div>
				</div>
			</fieldset>
		</form>

		<!-- TABLE -->
        <div class="widget">
		<div class="title">
		<div class="filter">
			<h6>Filter by:</h6>
				<div class="f1">
				<select name="list" id="f1" class="styled">
					<option value="01">group</option>
					<option value="02">subgroup</option>
				</select>
				</div>
				<div class="f2">
				<select name="group" id="f2" class="styled">
					<option value="11">category</option>
					<option value="12">subcategory</option>
					<option value="13">type</option>
				</select>
				</div>
		</div>
		</div>

            <table class="display dTable">
            <thead>
			<tr>
            <th>ID</th>
            <th>Page Name</th>
            <th>Parent</th>
            <th>Template</th>
			<th>URL Rewriting</th>
			<th>Status</th>
			<th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr class="gradeX">
            <td><input type="checkbox" class="styled" class="styled" id="#" name="check" /></td>
            <td>Trident</td>
            <td>Internet Explorer 4.0</td>
            <td>Internet Explorer 4.0</td>
            <td>Win 95+</td>
            <td>Win 95+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeC">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Trident</td>
            <td>Internet Explorer 5.0</td>
            <td>Internet Explorer 5.0</td>
            <td>Win 95+</td>
            <td>Win 95+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Trident</td>
            <td>Internet Explorer 5.5</td>
            <td>Internet Explorer 5.5</td>
            <td>Win 95+</td>
            <td>Win 95+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Trident</td>
            <td>Internet Explorer 6</td>
            <td>Internet Explorer 6</td>
            <td>Win 98+</td>
            <td>Win 98+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Trident</td>
            <td>Internet Explorer 7</td>
            <td>Internet Explorer 7</td>
            <td>Win XP SP2+</td>
            <td>Win XP SP2+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Trident</td>
            <td>AOL browser (AOL desktop)</td>
            <td>AOL browser (AOL desktop)</td>
            <td>Win XP</td>
            <td>Win XP</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Gecko</td>
            <td>Firefox 1.0</td>
            <td>Firefox 1.0</td>
            <td>Win 98+ / OSX.2+</td>
            <td>Win 98+ / OSX.2+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Gecko</td>
            <td>Firefox 1.5</td>
            <td>Firefox 1.5</td>
            <td>Win 98+ / OSX.2+</td>
            <td>Win 98+ / OSX.2+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Gecko</td>
            <td>Firefox 2.0</td>
            <td>Firefox 2.0</td>
            <td>Win 98+ / OSX.2+</td>
            <td>Win 98+ / OSX.2+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Gecko</td>
            <td>Firefox 3.0</td>
            <td>Firefox 3.0</td>
            <td>Win 2k+ / OSX.3+</td>
            <td>Win 2k+ / OSX.3+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Gecko</td>
            <td>Camino 1.0</td>
            <td>Camino 1.0</td>
            <td>OSX.2+</td>
            <td>OSX.2+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Gecko</td>
            <td>Camino 1.5</td>
            <td>Camino 1.5</td>
            <td>OSX.3+</td>
            <td>OSX.3+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Gecko</td>
            <td>Netscape 7.2</td>
            <td>Netscape 7.2</td>
            <td>Win 95+ / Mac OS 8.6-9.2</td>
            <td>Win 95+ / Mac OS 8.6-9.2</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Gecko</td>
            <td>Netscape Browser 8</td>
            <td>Netscape Browser 8</td>
            <td>Win 98SE+</td>
            <td>Win 98SE+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Gecko</td>
            <td>Netscape Navigator 9</td>
            <td>Netscape Navigator 9</td>
            <td>Win 98+ / OSX.2+</td>
            <td>Win 98+ / OSX.2+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Gecko</td>
            <td>Mozilla 1.0</td>
            <td>Mozilla 1.0</td>
            <td>Win 95+ / OSX.1+</td>
            <td>Win 95+ / OSX.1+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Gecko</td>
            <td>Mozilla 1.1</td>
            <td>Mozilla 1.1</td>
            <td>Win 95+ / OSX.1+</td>
            <td>Win 95+ / OSX.1+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Gecko</td>
            <td>Mozilla 1.2</td>
            <td>Mozilla 1.2</td>
            <td>Win 95+ / OSX.1+</td>
            <td>Win 95+ / OSX.1+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Gecko</td>
            <td>Mozilla 1.3</td>
            <td>Mozilla 1.3</td>
            <td>Win 95+ / OSX.1+</td>
            <td>Win 95+ / OSX.1+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Gecko</td>
            <td>Mozilla 1.4</td>
            <td>Mozilla 1.4</td>
            <td>Win 95+ / OSX.1+</td>
            <td>Win 95+ / OSX.1+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Gecko</td>
            <td>Mozilla 1.5</td>
            <td>Mozilla 1.5</td>
            <td>Win 95+ / OSX.1+</td>
            <td>Win 95+ / OSX.1+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Gecko</td>
            <td>Mozilla 1.6</td>
            <td>Mozilla 1.6</td>
            <td>Win 95+ / OSX.1+</td>
            <td>Win 95+ / OSX.1+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Gecko</td>
            <td>Mozilla 1.7</td>
            <td>Mozilla 1.7</td>
            <td>Win 98+ / OSX.1+</td>
            <td>Win 98+ / OSX.1+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Gecko</td>
            <td>Mozilla 1.8</td>
            <td>Mozilla 1.8</td>
            <td>Win 98+ / OSX.1+</td>
            <td>Win 98+ / OSX.1+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Gecko</td>
            <td>Seamonkey 1.1</td>
            <td>Seamonkey 1.1</td>
            <td>Win 98+ / OSX.2+</td>
            <td>Win 98+ / OSX.2+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Gecko</td>
            <td>Epiphany 2.20</td>
            <td>Epiphany 2.20</td>
            <td>Gnome</td>
            <td>Gnome</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Webkit</td>
            <td>Safari 1.2</td>
            <td>Safari 1.2</td>
            <td>OSX.3</td>
            <td>OSX.3</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Webkit</td>
            <td>Safari 1.3</td>
            <td>Safari 1.3</td>
            <td>OSX.3</td>
            <td>OSX.3</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Webkit</td>
            <td>Safari 2.0</td>
            <td>Safari 2.0</td>
            <td>OSX.4+</td>
            <td>OSX.4+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Webkit</td>
            <td>Safari 3.0</td>
            <td>Safari 3.0</td>
            <td>OSX.4+</td>
            <td>OSX.4+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Webkit</td>
            <td>OmniWeb 5.5</td>
            <td>OmniWeb 5.5</td>
            <td>OSX.4+</td>
            <td>OSX.4+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Webkit</td>
            <td>iPod Touch / iPhone</td>
            <td>iPod Touch / iPhone</td>
            <td>iPod</td>
            <td>iPod</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Webkit</td>
            <td>S60</td>
            <td>S60</td>
            <td>S60</td>
            <td>S60</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Presto</td>
            <td>Opera 7.0</td>
            <td>Opera 7.0</td>
            <td>Win 95+ / OSX.1+</td>
            <td>Win 95+ / OSX.1+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Presto</td>
            <td>Opera 7.5</td>
            <td>Opera 7.5</td>
            <td>Win 95+ / OSX.2+</td>
            <td>Win 95+ / OSX.2+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Presto</td>
            <td>Opera 8.0</td>
            <td>Opera 8.0</td>
            <td>Win 95+ / OSX.2+</td>
            <td>Win 95+ / OSX.2+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Presto</td>
            <td>Opera 8.5</td>
            <td>Opera 8.5</td>
            <td>Win 95+ / OSX.2+</td>
            <td>Win 95+ / OSX.2+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Presto</td>
            <td>Opera 9.0</td>
            <td>Opera 9.0</td>
            <td>Win 95+ / OSX.3+</td>
            <td>Win 95+ / OSX.3+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Presto</td>
            <td>Opera 9.2</td>
            <td>Opera 9.2</td>
            <td>Win 88+ / OSX.3+</td>
            <td>Win 88+ / OSX.3+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Presto</td>
            <td>Opera 9.5</td>
            <td>Opera 9.5</td>
            <td>Win 88+ / OSX.3+</td>
            <td>Win 88+ / OSX.3+</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Presto</td>
            <td>Opera for Wii</td>
            <td>Opera for Wii</td>
            <td>Wii</td>
            <td>Wii</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Presto</td>
            <td>Nokia N800</td>
            <td>Nokia N800</td>
            <td>N800</td>
            <td>N800</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Presto</td>
            <td>Nintendo DS browser</td>
            <td>Nintendo DS browser</td>
            <td>Nintendo DS</td>
            <td>Nintendo DS</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeC">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>KHTML</td>
            <td>Konqureror 3.1</td>
            <td>Konqureror 3.1</td>
            <td>KDE 3.1</td>
            <td>KDE 3.1</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>KHTML</td>
            <td>Konqureror 3.3</td>
            <td>Konqureror 3.3</td>
            <td>KDE 3.3</td>
            <td>KDE 3.3</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>KHTML</td>
            <td>Konqureror 3.5</td>
            <td>Konqureror 3.5</td>
            <td>KDE 3.5</td>
            <td>KDE 3.5</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeX">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Tasman</td>
            <td>Internet Explorer 4.5</td>
            <td>Internet Explorer 4.5</td>
            <td>Mac OS 8-9</td>
            <td>Mac OS 8-9</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeC">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Tasman</td>
            <td>Internet Explorer 5.1</td>
            <td>Internet Explorer 5.1</td>
            <td>Mac OS 7.6-9</td>
            <td>Mac OS 7.6-9</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeC">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Tasman</td>
            <td>Internet Explorer 5.2</td>
            <td>Internet Explorer 5.2</td>
            <td>Mac OS 8-X</td>
            <td>Mac OS 8-X</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Misc</td>
            <td>NetFront 3.1</td>
            <td>NetFront 3.1</td>
            <td>Embedded devices</td>
            <td>Embedded devices</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeA">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Misc</td>
            <td>NetFront 3.4</td>
            <td>NetFront 3.4</td>
            <td>Embedded devices</td>
            <td>Embedded devices</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeX">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Misc</td>
            <td>Dillo 0.8</td>
            <td>Dillo 0.8</td>
            <td>Embedded devices</td>
            <td>Embedded devices</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeX">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Misc</td>
            <td>Links</td>
            <td>Links</td>
            <td>Text only</td>
            <td>Text only</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeX">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Misc</td>
            <td>Lynx</td>
            <td>Lynx</td>
            <td>Text only</td>
            <td>Text only</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeC">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Misc</td>
            <td>IE Mobile</td>
            <td>IE Mobile</td>
            <td>Windows Mobile 6</td>
            <td>Windows Mobile 6</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeC">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Misc</td>
            <td>PSP browser</td>
            <td>PSP browser</td>
            <td>PSP</td>
            <td>PSP</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            <tr class="gradeC">
            <td><input type="checkbox" class="styled" id="#" name="check" /></td>
            <td>Misc</td>
            <td>PSP browser</td>
            <td>PSP browser</td>
            <td>PSP</td>
            <td>PSP</td>
            <td class="center">
			<a class="action BtnView" href="#" title='View Page'></a>
			<a class="action BtnEdit" href="#" title='Edit Page'></a>
			<a class="action BtnRead" href="#" title='Active/Inactive'></a>
			<a class="action BtnDelete" href="#" title='Delete'></a>
			</td>
            </tr>
            </tbody>
            </table>
        </div>

</div>

<div class="rightContent">

		<div class="rightWidget widget">
			<div class="title"><h6>Template</h6></div>

			<div class="tplbox">
				<div class="area">
					<a href="#" class="sector active" style="width:208px; height:40px"><span>1</span></a>
					<a href="#" class="sector" style="width:208px; height:50px"><span>2</span></a>
					<a href="#" class="sector" style="width:124px; height:100px"><span>3</span></a>
					<a href="#" class="sector" style="width:82px; height:100px"><span>4</span></a>
					<a href="#" class="sector" style="width:208px; height:48px"><span>5</span></a>
				</div>
			</div>
		</div>

		<div class="rightWidget widget">
			<div class="title"><h6>Changes</h6></div>

				<div class="formRow mt25">
				<b>Created by: </b><br/>
				<span> Radovan Dragić</span>
				</div>
				<div class="formRow">
				<b>Created: </b><br/>
				<span> 2011-09-24 07:59</span>
				</div>
				<div class="formRow">
				<b>Last time modified by: </b><br/>
				<span> Radovan Dragić</span>
				</div>
				<div class="formRow mb10">
				<b>Last time modified: </b><br/>
				<span> 2011-09-24 07:59</span>
				</div>
		</div>

		<div class="rightWidget widget">
		<form action="" class="form">
        <fieldset>
			<div class="title"><h6>Info inputs</h6></div>

				<div class="formRow mt30 mr5 mb20">
                    <label>Title 1:</label>
                    <div class="formRight"><input type="text" value="" /></div>
                    <br class="clear" />

                    <label>Title 2:</label>
                    <div class="formRight"><input type="text" value="" /></div>
                    <br class="clear" />

                    <label>Title 3:</label>
                    <div class="formRight"><input type="text" value="" /></div>
                    <br class="clear" />
                </div>
		</fieldset>
		</form>
		</div>

</div>



</div>
</div>


<div class="push"></div>
</div>

<!-- Footer -->

<div class="footerWrapper">
<footer>
<span class="footertext">Copyright  
	<a href="http://art0fdesign.com/" target="_blank" title="...the most powerful design..."> Art of Design</a> 
	2003-2012. All Rights Reserved
</span>
</footer>
</div>

</body>

</html>