/**
*   Art0fDesign Accordion Content jQuery Functions
-------------------------------------------------------
Thanks to Menu Colapsed script that was 
 DEVELOPED BY: Ryan Stemkoski
 COMPANY: Zipline Interactive
 EMAIL: ryan@gozipline.com 
-------------------------------------------------------
* For better performance set accordionMenu display property to none
* 'on' class is used for styling purpose
*/
$(document).ready(function() {
    var accordionButtonClass = 'accordionParent';
    var accordionContentClass = 'accordionMenu';
    var accordionButtonLevel2Class = 'accordionParentLevel2';
    var accordionContentLevel2Class = 'accordionMenuLevel2';
    //
    $('.' + accordionButtonClass).click(function(e){
        e.preventDefault();
        // remove 'on' class
        $('.' + accordionButtonClass).removeClass('on');
        // close all opened divs
        $('.' + accordionContentClass).slideUp('normal');
        // reference buttons content
        var nextContent = $(this).next('.' + accordionContentClass);
        // open slide
        if( nextContent.is(':hidden') ){
            // add 'on' class
            $(this).addClass('on');
            // show slide
            nextContent.slideDown('normal');
        }
    });
    //
    $('.' + accordionButtonLevel2Class).click(function(e){
        e.preventDefault();
        // remove 'on' class
        $('.' + accordionButtonLevel2Class).removeClass('on');
        // close all opened divs
        $('.' + accordionContentLevel2Class).slideUp('normal');
        // reference buttons content
        var nextContent = $(this).next('.' + accordionContentLevel2Class);
        // open slide
        if( nextContent.is(':hidden') ){
            // add 'on' class
            $(this).addClass('on');
            // show slide
            nextContent.slideDown('normal');
        }
    });
});