<div class="titleBlock"><span>WEB PAGES: List of Pages</span></div>

<div class="wideContent">
    <!-- Table -->
    <div class="widget">
        <div class="title"> 
        	<div class="filter">
        	<span><a>Filter by:</a></span>
                    <form action="<?php echo Yii::app()->createUrl($this->route); ?>" method="POST">
                    		  <div class="select-list"><?php echo CHtml::dropDownList('lang', $lang, $languages, array("empty"=>'All Languages', 'submit'    => '',  ));           ?>
                              </div>
                              <div class="select-list"><?php echo CHtml::dropDownList('tpl', $tpl, $templates, array("empty"=>'All Templates', 'submit'    => '',  ));           ?>
                              </div>
                    </form>
			</div>
        </div>

       <table class="display dTable">
            <thead>
            <tr>
                <th class="center">ID</th>
                <th>Page Name</th>
                <th>Template</th>
                <th>URL</th>
                <th>Language</th>
                <th class="center">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?  foreach ($pages as $page) : ?>

            <tr class='<?php if($page->f_status==1) echo "gradeA"; else echo "gradeC"; ?>'>
                <td class="center"><?=$page->id;?></td>
                <td><?=$page->name;?></td>
                <td><?=$page->template->name;?></td>
                <td>/<?=$page->url?></td>
                <td><?=$page->language->lang_name;?></td>
                <td class='center' >
                    <?php echo CHtml::link('', array('view', 'id'=>$page->id), array('title'=>'View Page', 'class'=>'action BtnView'))."\n"; ?>
                    <?php echo CHtml::link('', array('update', 'id'=>$page->id), array('title'=>'Edit Page', 'class'=>'action BtnEdit'))."\n"; ?>
                    <?php echo CHtml::link('',"", array("submit"=>array('activate', 'id'=>$page->id), 'title'=>'Active/Inactive', 'class'=>'action BtnRead')); ?>
                    <?php echo CHtml::link('',"", array("submit"=>array('delete', 'id'=>$page->id), 'confirm' => 'Are you sure?', 'title'=>'Delete Page', 'class'=>'action BtnDelete')); ?>
                </td>
            </tr>
                <? endforeach; ?>



            </tbody>
        </table>
        <div class="tfooter">Total number of pages: <?=count($pages);?></div>
    </div>
</div>

