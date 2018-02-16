<?php
/*
 * Template name: Apply Now page template
 */
?>

<?php get_header(); ?>
<div class="container padding_zero">

        <?php if(have_posts()) : ?>
            <?php while(have_posts()) : the_post(); ?>
                <div class="apply_car text-center">
                    <?php the_content(); ?>
                </div>
                <div class="page_wrapper">
                    <?php echo do_shortcode('[get_started]'); ?>
                </div>

            <?php endwhile; ?>
        <?php endif; ?>

</div>
<div class="container padding_zero orange-footer">
    <div class="bottom_text">
        <?php echo get_option('orange-footer_bottom_text'); ?>
    </div>
    <?php get_template_part( 'social-icons' ); ?>
</div>
<?php get_footer(); ?>
