/**
*   Art0fDesign Accordion Content jQuery Functions
-------------------------------------------------------
Thanks to Menu Colapsed script that was 
 DEVELOPED BY: Ryan Stemkoski
 COMPANY: Zipline Interactive
 EMAIL: ryan@gozipline.com 
-------------------------------------------------------
* For better performance set accordionContent display property to none
* 'on' class is used for styling purpose
*/
$(document).ready(function() {
    var accordionButtonClass = 'accordionButton';
    var accordionContentClass = 'accordionContent';
    //
    $('.' + accordionButtonClass).click(function(e){
        e.preventDefault();
        // remove 'on' class
        $('.' + accordionButtonClass).removeClass('on').html('more');
        // close all opened divs
        $('.' + accordionContentClass).slideUp('normal');
        // reference buttons content
        var nextContent = $(this).next('.' + accordionContentClass);
        // open slide
        if( nextContent.is(':hidden') ){
            // add 'on' class
            $(this).addClass('on').html('less');
            // show slide
            nextContent.slideDown('normal');
        }
        
    });
});