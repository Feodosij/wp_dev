<?php
get_header();
?>

<div id="news-filter">
    <?php
    $categories = get_terms(array(
        'taxonomy' => 'news_category',
        'hide_empty' => false,
    ));

    foreach ($categories as $category) :
        echo '<label><input type="checkbox" name="news_categories[]" value="' . $category->term_id . '"> ' . $category->name . '</label><br>';
    endforeach;
    ?>
    <button type="button" id="reset-filter">Reset Filter</button>
</div>

<div class="news_holder">

<?php
$args = array('post_type' => 'news', 'posts_per_page' => 5);
$loop = new WP_Query($args);

while ($loop->have_posts()) : $loop->the_post(); ?>
    
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

