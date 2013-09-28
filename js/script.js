/**
 * Created by JetBrains PhpStorm.
 * User: Acer
 * Date: 7/14/12
 * Time: 1:23 PM
 * To change this template use File | Settings | File Templates.
 */
$(document).ready(function(){

     $('.dTable').dataTable({
       // "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 50,
        "aaSorting": [],
        "sDom": '<""l>t<"F"fp>',
        "oPaginate": {
					"sFirst":    "First",
					"sPrevious": "<",
					"sNext":     ">",
					"sLast":     "Last"
				},
    });

   

    /** ============================ DataTable Server-Side Processing ================================ */
	$('.dAjaxTable').dataTable( {
        "sDom": "<'ajaxLength'l>rt<fpi>",
        "sPaginationType": "full_numbers",
        "iDisplayLength": 50,
        "aaSorting": [],
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "",
		
	} );
    
    $(document).on( 'click', 'a.dAjaxTableLink', function(){
        var url = $(this).attr('url');
        $('body').append($('<form/>', { id: 'jQueryPostItForm', method: 'POST', action: url, style: 'display:none;' }));
        $('#jQueryPostItForm').submit();
        return false;
    });
    
});

tinyMCE.init({
        // General options
        forced_root_block : false,
        force_br_newlines : true,
        force_p_newlines : false,

        mode : "textareas",
        theme : "advanced",
        editor_selector : "textEditor",

        plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,imagemanager",

        // Theme options
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|formatselect,fontselect,fontsizeselect,|,forecolor,backcolor",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,code,|preview",
        theme_advanced_buttons3 : "sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,fullscreen,|,insertfile,insertimage",
       theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,
         width : "485",

        // Skin options
        skin : "o2k7",
        skin_variant : "silver",

        // Example content CSS (should be your site CSS)
        content_css : "css/example.css",

        // Drop lists for link/image/media/template dialogs
       
        external_link_list_url : "js/link_list.js",
        external_image_list_url : "js/image_list.js",
        media_external_list_url : "js/media_list.js",

        // Replace values for the template plugin
        template_replace_values : {
                username : "Some User",
                staffid : "991234"
        }
});