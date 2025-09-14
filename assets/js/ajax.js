jQuery(document).ready(function($){

    $('.akb-like').on('click', function(){

        var post_id = $(this).data('post-id');

        $.ajax({
            url: akb_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'akb_post_voting',
                pid: post_id,
                type: 'like',
                nonce: akb_ajax.nonce
            },
            success: function(response) {
                alert(response.data.message);
                //alert(response.data.message + "" + response.data.last_query);
            }
        });
    });
    $('.akb-dislike').on('click', function(){

        var post_id = $(this).data('post-id');

        $.ajax({
            url: akb_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'akb_post_voting',
                pid: post_id,
                type: 'dislike',
                nonce: akb_ajax.nonce
            },
            success: function(response) {
                alert(response.data.message);
                //alert(response.data.message + "" + response.data.last_query);
            }
        });
    });
});