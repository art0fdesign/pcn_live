/**
*   Art0fDesign Common Popup jQuery Functions  
*/
$(document).ready(function() {
    $("#policy_popup, #terms_popup").click(function(e){
        var params = {};
        e.preventDefault();
        switch( $(this).attr('id') ){
            case 'terms_popup': $("#termsPopupDiv").bPopup(params); break;
            default: $("#policyPopupDiv").bPopup(params); break; 
        }        
    });


});