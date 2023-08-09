<?php
get_header();
?>

<div class="news_holder">
<?php
$args = array( 'post_type' => 'news', 'posts_per_page' => 10);
$loop = new WP_Query( $args ); 
    
while ( $loop->have_posts() ) : $loop->the_post(); ?>
    
    <div class="post_news">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        <?php the_content(); ?>
    </div>

   <?php
endwhile;
?>
</div>



<?php
get_footer();
