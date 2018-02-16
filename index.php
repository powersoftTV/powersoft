<?php get_header(); ?>


<div class="trending">
    <div class="container">
        <div class="blog_wrapper">
        
                    <?php if ($q->have_posts()) : while ($q->have_posts()) : $q->the_post(); $i++;?>
                            <div data-num="<?php echo $i; ?>" class="trending-post <?php if($i==1) echo "active" ?>" <?php if($i==1) echo 'style="opacity: 1;"' ?>>
                                <div class="row">
                                    <?php  if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
                                        <div class="col-sm-6"><div class="sl_img" style="background-image: url('<?php echo get_the_post_thumbnail_url($q->post->ID,'deka-mid-blog-thumb'); ?>')"></div></div>
                                    <?php } ?>
                                    <div class="col-sm-6">
                                        <h2><?php the_title(); ?></h2>
                                        <p><?php echo wp_trim_words( get_the_excerpt(), 16, "..." ); ?></p>
                                        <a href="<?php the_permalink(); ?>" rel="bookmark">MORE</a>
                                    </div>
                                </div>
                            </div>

                    <?php endwhile; endif;  ?>
                    <?php  wp_reset_query(); ?>
              
           </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
