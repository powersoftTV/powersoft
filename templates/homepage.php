 <?php
/*
 * Template name: Home page template
 */
?>
 <?php $howlong=5; ?>
 <?php get_header(); ?>
 <?php

 $args=array(
     'post_type' => 'cars',
     'posts_per_page' => 1,
     'orderby'=>'publish_date',
     'order' => 'DESC'
 );
 $q = new WP_Query($args);
 $html_str='';
 ?>
 <?php if($q->have_posts()) : ?>
     <?php while($q->have_posts()) : $q->the_post(); ?>
         <?php
         $deka_cars="car of the month";
         if(get_option('deka_cars')){
             $deka_cars=get_option('deka_cars');
         }
         $car_price=20000;
         if(get_post_meta( $post->ID, 'car_price', true )){
             $car_price=get_post_meta( $post->ID, 'car_price', true );;
         }
         $html_str='<div class="row"><div class="col-sm-6 overflow-hidden">';
         if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
             $html_str .=  '<div class="text-center"><a href="'.get_the_permalink().'" rel="bookmark"><div class="cow_img">'.get_the_post_thumbnail($post,'deka-home_car-thumb', array( 'class' => 'reg-img' )).'</div></a></div>';
         }
         $html_str .= '<a class="quote" href="/car-of-the-month">FIND OUT MORE ></a>';
         $html_str .= '</div><div class="col-sm-6">';
         $html_str .= '<div class="cow_head"><strong>caragogo:</strong>'.$deka_cars;
         $html_str .= '<h2><a href="'.get_the_permalink().'" >'.get_the_title().'</a></h2>';
         $html_str .= '<p>'.wp_trim_words( get_the_excerpt(), 16, "..." ).'</p></div>';
         $html_str .= '<div class="credit">'.calculate_credit($post->ID).'</div></div></div>';
         ?>

     <?php endwhile; ?>
 <?php endif; ?>
 <?php  wp_reset_query(); ?>
 <div class="container padding_zero">

         <?php if(have_posts()) : ?>
             <?php while(have_posts()) : the_post(); ?>
                 <div class="home_page_wrapper">
                     <?php get_template_part( 'moving-car' ); ?>
                     <div class="block_1">
                         <div class="all_wrapper">
                             <div class="line_text">
                                 <?php the_content(); ?>
                             </div>
                             <?php get_template_part( 'calculator' ); ?>
                         </div>
                     </div>
                     <div class="brown_box text-center">
                        <?php if($block_1_1= get_post_meta($post->ID, 'next_to_calc', true )) echo $block_1_1; ?>
                     </div>
                     <div class="brown_box block_2 overflow-hidden">
                         <div class="all_wrapper">
                             <div class="col-sm-6  padding_zero">
                                 <div class="left_block">
                                    <?php if($block_left= get_post_meta($post->ID, 'blue_box_left', true )) echo $block_left; ?>

                                 </div>
                                 <img src="<?php echo get_template_directory_uri().'/imgs/car.png'; ?>" alt="">
                             </div>
                             <div class="col-sm-6 padding_zero">
                                 <div class="right_block">
                                    <?php if($block_right= get_post_meta($post->ID, 'blue_box_right', true )) echo $block_right; ?>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="brown_box block_2_2 text-center">
                         <?php if($block_2_2= get_post_meta($post->ID, 'next_to_bb', true )) echo $block_2_2; ?>
                     </div>
                     <div class="cow_block">
                         <div class="cow_wrapper">
                            <?php echo $html_str; ?>
                         </div>
                     </div>
                     <div class="blogs_block">
                         <div class="all_wrapper">
                            <?php echo do_shortcode("[adl-post-slider id='82']"); ?>
                         </div>
                     </div>
                     <div class="faq_block overflow-hidden">
                         <div class="all_wrapper">
                             <div class="col-sm-6  padding_zero">
                                 <div class="left_block">
                                     <?php if($block_left= get_post_meta($post->ID, 'faq_left', true )) echo $block_left; ?>
                                 </div>
                                 <img src="<?php echo get_template_directory_uri().'/imgs/car2.png'; ?>" alt="">
                             </div>
                             <div class="col-sm-6 padding_zero">
                                 <div class="right_block">
                                     <?php if($block_right= get_post_meta($post->ID, 'faq_right', true )) echo $block_right; ?>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             <?php endwhile; ?>
         <?php endif; ?>

 </div>
 <?php get_template_part( 'orange-footer' ); ?>
 <?php get_footer(); ?>
