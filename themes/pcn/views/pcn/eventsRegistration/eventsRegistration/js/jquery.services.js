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

    $('#termsCheckBox, #reportTermsCheckBox, #registrationTermsCheckBox').click(function(e){
        $('#termsErrorMessage').hide();
        $('#registrationTermsErrorMessage').hide();
        $('#reportTermsErrorMessage').hide();
    });

    $('#registrationSubmitButton').click(function(e){
        var termsError = false;
        // if ($('#termsCheckBox').length>0 && !$('#termsCheckBox').is(':checked')) {
        //     $('#termsErrorMessage').show();
        //     termsError = true;
        // }
        // if ($('#registrationTermsCheckBox').length>0 && !$('#registrationTermsCheckBox').is(':checked')) {
        //     $('#registrationTermsErrorMessage').show();
        //     termsError = true;
        // }
        if ($('#reportTermsCheckBox').length>0 && !$('#reportTermsCheckBox').is(':checked')) {
            $('#reportTermsErrorMessage').show();
            termsError = true;
        }
        if (termsError) {
            return false;
        }
        console.log($('#registration_price'));
        if ($('#registration_price').val() == 0) {
            $('#priceErrorMessage').show();
            return false;
        }
    });
});
