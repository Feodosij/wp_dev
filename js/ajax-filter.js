jQuery(function($) {
    $('input[name="news_categories[]"]').change(function() {
        var selected_categories = [];
        $('input[name="news_categories[]"]:checked').each(function() {
            selected_categories.push($(this).val());
        });

        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'filter_news',
                news_categories: selected_categories,
            },
            success: function(response) {
                $('.news_holder').html(response);
            }
        });
    });
});


