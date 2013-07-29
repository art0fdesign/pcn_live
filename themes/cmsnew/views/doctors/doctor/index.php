<div class="titleBlock">
    <span>DOCTORS: List of Doctors</span>
</div>
<div class="wideContent">
	<!-- Table -->
    <div class="widget">
		<div class="title">
			<div class="filter">
                <form action="<?php echo Yii::app()->createUrl($this->route); ?>" method="POST">
                    <div class="select-list">
                        <?php echo CHtml::dropDownList('cat', $selectedCategory, $categories, $htmlOptions = array( 'submit' => '', ));?>
                    </div>
                </form>
			</div>
		</div>

        <table class="display dAjaxTable">

        <thead>
    		<tr>       
                <th class="center">ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>E-Mail</th>
                <th>Verified</th>
        		<th class="center" style="width:80px;">Actions</th>        
            </tr>
        </thead>
        
    	<tbody>
    		<tr>
    			<td colspan="4" class="dataTables_empty">Loading data from server</td>
    		</tr>
    	</tbody>
        
        </table>
    </div>

</div>
