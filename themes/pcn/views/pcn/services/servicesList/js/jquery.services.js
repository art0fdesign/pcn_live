/**
*   Art0fDesign Common Popup jQuery Functions  
*/
$(document).ready(function() {
    $(".service_popup").click(function(e){        
        e.preventDefault();
        var divId = $(this).attr('id').replace('popup_', '');
        var params = {opacity:0.1, modalColor:'#fff'};
        $("#"+divId).bPopup(params);
    });
    
    $(".popupMe").trigger('click');
});
