<div class="titleBlock"><span>CONTENTS: List of Contents</span></div>

<div class="wideContent">
    <!-- Table -->
    <div class="widget">
        <div class="title"> 
        	<div class="filter">
        		
                    <form action="<?php echo Yii::app()->createUrl($this->route); ?>" method="POST">
                    		  <div class="select-list"><?php echo CHtml::dropDownList('lang', $lang, $languages, array("empty"=>'All Languages', 'submit'    => ''  ));           ?></div>
                    		  
                    		  <?php
           				 $items = array("N"=>"Not Assigned","P"=>"Page Assigned","T"=>"Template Assigned")?>
           
		                    <div class="select-list"><?php echo CHtml::dropDownList('type',$type, $items,array('empty'=>'All type', 'submit'    => '') ); ?></div>
                    

			            <?
			            $items = array();
			           
			        //    if($type== '' || $type == 'empty') {
			         //   $items = array('empty'=>'All Page / Template');
						
			         //   }
			        //    else{
			            if ($type == "P" || $type == "T"){
			                if($type == 'P'){
			                    $aa = array ('empty'=>'All Page');
			                    $item = WebPages::model()->getPagesOptions();
			                   
			
			                }elseif($type == 'T'){
			                	   $aa = array('empty'=>'All Template');
			                    $item = Template::model()->getTemplatesOptions();
			                    
			                }
			            
			                $items = CMap::mergeArray($aa,$item);
			
			            }
			            
			            ?>
					<? if ($type == "P" || $type == "T") : ?>
                			<div class="select-list"><?php echo CHtml::dropDownList('pageTemp',$pageTemp,$items, array('id'=>'page_temp_id', 'submit'    => '') ); ?></div>
                			<? endif; ?>
                                        		  
                    </form>
			</div>
        </div>

        <table class="display dTable">
            <thead>
            <tr>

                <th>Content Name</th>
                <th>Language</th>
                <th>Created</th>
                <th>Author</th>
                <th class="center">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?  foreach ($contents as $content) : ?>

            <tr class='<?php if($content['f_status']==1) echo "gradeA"; else echo "gradeC"; ?>'>
                <td><?=$content['name'];?></td>
                <td><?=$content['lang_name'];?></td>
                <td><?=$content['created_dt'];?></td>
                <td><?=$content['user_name'];?></td>


                <td class='center' id='Content_<?=$content['id'];?>'>
                    <?php echo CHtml::link('', array('view', 'id'=>$content['id']), array('title'=>'View Content', 'class'=>'action BtnView'))."\n"; ?>
                    <?php echo CHtml::link('', array('update', 'id'=>$content['id']), array('title'=>'Edit Content', 'class'=>'action BtnEdit'))."\n"; ?>
                    <?php echo CHtml::link('', array('copy', 'id'=>$content['id']), array('title'=>'Copy Content', 'class'=>'action BtnEdit'))."\n"; ?>
                    <?php echo CHtml::link('',"", array("submit"=>array('activate', 'id'=>$content['id']), 'title'=>'Active/Inactive', 'class'=>'action BtnRead')); ?>
                    <?php echo CHtml::link('',"", array("submit"=>array('delete', 'id'=>$content['id']), 'confirm' => 'Are you sure?', 'title'=>'Delete Content', 'class'=>'action BtnDelete')); ?>
                </td>
            </tr>
            <? endforeach; ?>



            </tbody>
        </table>
        <div class="tfooter">Total number of contents: <?=count($contents);?></div>
    </div>
</div>