/**
 * Created by JetBrains PhpStorm.
 * User: zoran
 * Date: 10/3/12
 * Time: 9:14 PM
 * To change this template use File | Settings | File Templates.
 */

$(document).ready(function() {

    $("#select_form").submit(function(){
        var nsi = $("#issue_ac").attr('ajax_id');
        if( nsi!=='' && nsi !== undefined ){
            $(this).append($('<input/>', { type: 'hidden', name: 's_id', value: nsi }));
        }
    });

    var cache={}, prevReq;

    $('#issue_ac').autocomplete({
        source: function(request, response){
            var term = 'issue_' + request.term;
            if (term in cache){
                response(cache[term]);
                return;
            }
            //request['param'] = 'issue';
            //console.log(request);

            prevReq=$.getJSON('', request, function(data, status, req){
                //console.log(data);
                cache[term]=data;
                if (req===prevReq){
                    response(data);
                }
            });
        },
        select: function( event, ui ){
            $('#issue_ac').attr('ajax_id', ui.item.id);
            //console.log(ui.item.id);
        },
        change: function( event, ui ){
            if( $('#issue_ac').val() == '' ) $('#issue_ac').removeAttr('ajax_id');
        }
    });

});

