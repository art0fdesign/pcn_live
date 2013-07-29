<div class="titleBlock">
    <span>SUBSPECIALITIES: List of Subspecialities</span>
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
                <th>ID</th>
                <th>Category</th>
                <th>Speciality</th>
                <th>Name</th>
                <th>Status</th>
        		<th class="center">Actions</th>        
            </tr>
        </thead>
        
        <tbody>
    		<tr>
    			<td colspan="6" class="dataTables_empty">Loading data from server</td>
    		</tr>
        </tbody>
        
        </table>

    </div>

</div>
