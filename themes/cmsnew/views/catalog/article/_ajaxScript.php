    $("#tags_add_link").click(function(){
        var tag = $("#tag_selected").val();
        if( tag == 0){
            alert('Tag must be selected!');            
        } else {
            $.ajax({
                type: 'POST', 
                url: '<?php echo CController::createUrl('/catalog/article/ajaxTagsAdd'); ?>',
                data: { 'art': <?php echo $model->id ?>, 'tag': tag }, 
            }).done( function( data ){
                $("#tags_list").empty().html( data );
            });
        }
        return false;
    });
    //$(".action").live('click', function(){
    $(document).on( 'click', '.action', function(){ // 1.7+
        var tag = $(this).attr('id').substr(4);
        if( confirm( 'Are You Sure?') ) {
            $.ajax({
                type: 'POST', 
                url: '<?php echo CController::createUrl('/catalog/article/ajaxTagsRemove'); ?>',
                data: { 'art': <?php echo $model->id ?>, 'tag': tag }, 
            }).done( function( data ){
                $("#tags_list").empty().html( data );
            });
        }
        //alert('Delete!');
        return false;
    });
