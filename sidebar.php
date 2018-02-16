<div class="sidebar">
<?php
    global $post;
    $args1=array(
        'post_type' => 'post',
        'posts_per_page' => 6,
        'meta_key' => 'post_view_count',
        'order' => 'DESC',
        'orderby' => 'meta_value_num',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'post_trending',
                'value' => 1,
                'compare' => '='
            )
        )
    );
    $args2=array(
        'post_type' => 'post',
        'posts_per_page' => 6,
    );
    $q = new WP_Query($args1);
    $q2 = new WP_Query($args2);

    ?>

    <div class="posts_block">
        <?php if ($q->have_posts()) : echo '<div class="head_wrapper_brown"><div class="block_head brown"><h2>TRENDING NOW</h2></div></div>'; while ($q->have_posts()) : $q->the_post();?>
            <div class="sb_post">
                <h2><?php echo wp_trim_words( get_the_title(), 9, "..." ); ?><a href="<?php the_permalink(); ?>" rel="bookmark"> read more</a></h2>
            </div>
        <?php endwhile; endif;  ?>
        <?php  wp_reset_query(); ?>
    </div>
    <div class="posts_block">
        <?php if ($q2->have_posts()) : echo '<div class="head_wrapper_orange"><div class="block_head orange"><h2>LATEST</h2></div></div>'; while ($q2->have_posts()) : $q2->the_post(); ?>
            <div class="sb_post">
                <h2><?php echo wp_trim_words( get_the_title(), 9, "..." ); ?><a href="<?php the_permalink(); ?>" rel="bookmark"> read more</a></h2>
            </div>
        <?php endwhile; endif;  ?>
        <?php  wp_reset_query(); ?>
    </div>

    </div>
    <div class="sb_widget" >
        <div id="widgetized-header">

            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar')) : else : ?>
            <?php endif; ?>

        </div>
    </div>
</div>
