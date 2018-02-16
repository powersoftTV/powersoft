<?php
/*
 * Template name: Finance template
 */
?>
<?php get_header(); ?>

<div class="container padding_zero">

        <?php if(have_posts()) : ?>
            <?php while(have_posts()) : the_post(); ?>
                <?php
                $style='class="finance-nobg text-center"';
                if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
                   $style='class="finance_bg text-center" style="background: url('.get_the_post_thumbnail_url($post,'deka-page-thumb').') center no-repeat;"';
                }
                ?>
                <div <?php echo $style; ?>>
                    <div class="title_finance">
                    <?php if(get_post_meta($post->ID, 'second_title', true )) { ?>
                              <h1><?php echo get_post_meta($post->ID, 'second_title', true ); ?></h1>
                    <?php } ?>
                    </div>
                </div>
                <div class="page_wrapper_finance">
                    <?php the_content(); ?>
                </div>

            <?php endwhile; ?>
        <?php endif; ?>

</div>
<?php get_template_part( 'orange-footer-mini' ); ?>
<?php get_footer(); ?>
