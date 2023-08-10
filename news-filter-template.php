<?php
/* Template Name: News Filter Page */
get_header();
include('news-filter-template.php'); // Шлях до вашого файлу шаблону
get_footer();
?>

<!-- <script>
    jQuery(function($){
        $('#news-filter').submit(function(e){
            e.preventDefault();
            var selected_categories = [];
            $('.filter-checkbox:checked').each(function(){
                selected_categories.push($(this).val());
            });

            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                data: {
                    action: 'filter_news',
                    news_categories: selected_categories,
                },
                success:function(response){
                    $('.filtered-posts').html(response);
                }
            });
        });
    });
</script> -->