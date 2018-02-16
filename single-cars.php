<?php
/**
 * The template for displaying all single posts and attachments
 *
 *
 */

get_header(); ?>
<div class="container padding_zero">
    <div class="page_wrapper">
        <div class="row">
            <div class="col-sm-9">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="single_post">
                        <?php while (have_posts()) : the_post(); ?>
                            <div class="page-content">
                                <?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
                                    <?php
                                    if (!add_post_meta($post->ID, 'post_view_count', 1, true)) {
                                        $view_count=get_post_meta($post->ID, 'post_view_count',true)*1+1;
                                        update_post_meta($post->ID, 'post_view_count', $view_count);
                                    }
                                    ?>
                                    <div>
                                        <?php the_post_thumbnail(''); ?>
                                    </div>

                                <?php } ?>
                                <h1><?php the_title(); ?></h1><hr style="border-top: 1px solid #ccc;">
                                <div>
                                    <?php echo calculate_credit($post->ID); ?>
                                    <?php
                                    $car_price=20000;
                                    if(get_post_meta( $post->ID, 'car_price', true )){
                                        $car_price=get_post_meta( $post->ID, 'car_price', true );;
                                    }
                                    ?>
                                    <a class="quote_for_car" href="/apply?form%5Bloan.amount%5D=<?php echo $car_price; ?>" rel="bookmark">QUOTE</a>
                                </div><hr style="border-top: 1px solid #ccc;">
                                <br><?php the_content(); ?><br>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </article>
            </div>
            <div class="col-sm-3">
                <h2>Blog</h2><hr style="border-top: 1px solid #ccc;">
                <?php get_sidebar(); ?>
            </div>

            <div class="car_blue_box overflow-hidden">
                <div class="cars_wrapper">
                    <div class="cars_calc_block overflow-hidden">
                        <div class="bl_wrapper">
                            <?php get_template_part( 'calculator' ); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="social text-center">
                <div class=" single-orange">
                    <ul>
                        <li>
                            <a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="<?php esc_html_e( 'Share on Facebook', 'caragogo' ); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/imgs/fb.png" alt="Facebook">
                            </a>
                        </li>

                        <li>
                           <a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&amp;url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="<?php esc_html_e( 'Tweet This Post', 'caragogo' ); ?>">
                               <img src="<?php echo get_template_directory_uri(); ?>/imgs/twitter.png" alt="Twitter">
                           </a>
                        </li>

                        <li>
                            <a href="#" onclick="window.open('https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>', 'linkedinShare', 'width=626,height=436'); return false;" title="<?php esc_html_e( 'Share on Linkedin', 'caragogo' ); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/imgs/linkedin.png" alt="Linkedin">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>