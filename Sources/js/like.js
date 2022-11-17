$(document).ready(function(){
    
    $('.like').on('click', function(){
        var idbaihat = $(this).data('id');
            $post = $(this);

        $.ajax({
            url: './php/luotlike.php',
            type: 'post',
            data: {
                'liked': 1,
                'idbaihat': idbaihat
            },
            success: function(response){
                $post.parent().find('span.likes_count').text(response);
                $post.addClass('d-none');
                $post.siblings().removeClass('d-none');
            }
        });
    });

    $('.unlike').on('click', function(){
        var idbaihat = $(this).data('id');
        $post = $(this);

        $.ajax({
            url: './php/luotlike.php',
            type: 'post',
            data: {
                'unliked': 1,
                'idbaihat': idbaihat
            },
            success: function(response){
                $post.parent().find('span.likes_count').text(response);
                $post.addClass('d-none');
                $post.siblings().removeClass('d-none');
            }
        });
    });
});