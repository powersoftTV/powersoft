<?php
/*
 * Template name: Cars template
 */
?>
<?php get_header(); ?>
<?php
$title='';
?>
<?php if(have_posts()) : ?>
    <?php while(have_posts()) : the_post(); ?>
              <?php
                $title=get_the_title();
                if(!add_option( 'deka_cars',strtolower(get_the_title()))){
                    update_option( 'deka_cars', strtolower(get_the_title()) );
                }
                ?>
    <?php endwhile; ?>
<?php endif; ?>
<div class="container padding_zero">
    <div class="white_bg">
        <img src="<?php echo get_template_directory_uri().'/imgs/cars_bg.jpg'; ?>" alt="<?php echo $_SERVER['HTTP_HOST'] ?>">
    </div>
    <div class="car_orange_box overflow-hidden">
        <div class="cars_wrapper">
            <div class="cars_block">
                <?php
                $cars_posts ="";
                if(get_post_meta($post->ID, 'cars_posts', true )){
                    $cars_posts= get_post_meta($post->ID, 'cars_posts', true );
                }
                $args=array(
                    'post_type' => 'cars',
                    'posts_per_page' => 7,
                    'orderby'=>'publish_date',
                    'order' => 'DESC'
                );
                $q = new WP_Query($args);
                $i=0;
                ?>
                <?php if($q->have_posts()) : ?>
                    <?php while($q->have_posts()) : $q->the_post(); $i++; ?>
                        <?php
                        $car_price=20000;
                        if(get_post_meta( $post->ID, 'car_price', true )){
                            $car_price=get_post_meta( $post->ID, 'car_price', true );;
                        }
                        if($i==1){ ?>
                            <div  class="cars-main">
                                <div class="car_tv">
                                    <div class="car_tv_txt text-center">
                                        <h1><?php echo wp_trim_words( $title, 10, "..." ); ?></h1>
                                    </div>
                                    <?php  if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
                                        echo   '<div class="text-center"><a href="'.get_the_permalink().'" rel="bookmark"><div>'.get_the_post_thumbnail($post,'deka-mid_car-thumb', array( 'class' => 'reg-img' )).'</div></a></div>';
                                    } ?>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 main_car_text">
                                        <h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                                        <p><?php echo wp_trim_words( get_the_excerpt(), 16, "..." ); ?></p>
                                        <a class="quote" href="/apply?form%5Bloan.amount%5D=<?php echo $car_price; ?>" rel="bookmark">QUOTE</a>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="credit">
                                            <?php echo calculate_credit($post->ID); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cars_text text-center">
                                <?php echo $cars_posts; ?>
                            </div>
                       <?php }
                       else { ?>
                        <div  class="cars-post"  >
                            <div class="row">
                                <?php  if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
                                 echo   '<div class="col-sm-7 padding_zero"><a href="'.get_the_permalink().'" ><div>'.get_the_post_thumbnail($post,'deka-small_car-thumb', array( 'class' => 'reg-img' )).'</div></a></div>';
                                } ?>
                                <div class="col-sm-5 padding_zero car_text">
                                    <h2><a href="<?php echo get_the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), 4, "..." ); ?></a></h2>
                                    <p><?php echo wp_trim_words( get_the_excerpt(), 9, "..." ); ?></p>
                                    <a class="quote" href="/apply?form%5Bloan.amount%5D=<?php echo $car_price; ?>" rel="bookmark">QUOTE</a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    <?php endwhile; ?>
                <?php endif; ?>
                <?php  wp_reset_query(); ?>
            </div>
        </div>
    </div>
    <div class="car_blue_box overflow-hidden">
        <div class="cars_wrapper">
            <div class="cars_calc_block overflow-hidden">
                <div class="bl_wrapper">
                    <div class="calc_text text-center">
                        <?php if($cars_calc= get_post_meta($post->ID, 'cars_calc', true )) echo $cars_calc; ?>
                    </div>
                    <?php get_template_part( 'calculator' ); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="cars_wrapper">
        <div class="blogs_block">
            <div class="blogs_text">
                <?php if($cars_blog= get_post_meta($post->ID, 'cars_blog', true )) echo $cars_blog; ?>
            </div>
            <?php echo do_shortcode("[adl-post-slider id='82']"); ?>
        </div>
    </div>
</div>
<?php get_template_part( 'orange-footer' ); ?>
<?php get_footer(); ?>
