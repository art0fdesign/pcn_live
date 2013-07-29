/**
*   Art0fDesign Profile jQuery Functions  
*/
$(document).ready(function() {
    $("#mc_popup, .mc_popup").click(function(e){
        e.preventDefault();
        cleanUpForm();
        $("#mc_form").show();
        $("#popUpDiv").bPopup({modalClose:false, onClose:function(){cleanUpForm()}});
    });
        
       
    $("#mc_submit").click(function(e){
        e.preventDefault();
        //
        if( $(this).hasClass('closeMe') ){
            $("#popUpDiv").bPopup().close(); 
            return false;
        }
        //formValidation(); return false;
        var adata = $("#mc_form").serialize();
        // AJAX Start
        $("#mc_form, #mc_submit, .newsletterInfo").hide();
        $(".ajaxLoading").show();
        //
        var jqxhr = $.getJSON( '', adata, function(data, status){
            // AJAX Stop
            $(".ajaxLoading").hide();
            // show info
            if( data.result == 0 || data.result > 1000 ){ 
                $(".chimpInfo").html(data.message).show();
                $("#mc_submit").addClass('closeMe').html('close').show();
            } else {
                $(".chimpError").html(data.message).show();
                $("#mc_form, #mc_submit").show();
            }            
        }).error(function(){ alert('Sorry, something went wrong!'); });
        /**/
    });
    function cleanUpForm(){
        $("#mc_form")[0].reset();       
        $(".newsletterInfo").html('').hide();
        $("#mc_submit").removeClass('closeMe').html('subscribe');
    }
});