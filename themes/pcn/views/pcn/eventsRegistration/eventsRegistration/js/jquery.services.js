/**
*   Art0fDesign Common Popup jQuery Functions
*/
$(document).ready(function() {
    $("#popup_popUp").click(function(e){
        e.preventDefault();
        var divId = $(this).attr('id').replace('popup_', '');
        var params = {opacity:0.1, modalColor:'#fff'};
        $("#"+divId).bPopup();
        return false;
    });

    $(".popupMe").trigger('click');

    $('#termsCheckBox').click(function(e){
        $('#termsErrorMessage').hide();
    });

    $('#registrationSubmitButton').click(function(e){
        if (!$('#termsCheckBox').is(':checked')) {
            $('#termsErrorMessage').show();
            return false;
        }
        if ($('#registration_price').val() == 0) {
            $('#priceErrorMessage').show();
            return false;
        }
    });
});
