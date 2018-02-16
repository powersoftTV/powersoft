<?php get_header(); ?>


<div class="trending">
    <div class="container">
        <div class="blog_wrapper">
        <?php
        global $post;
        $args=array(
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
        $q = new WP_Query($args);
        $i=0;
        ?>
            <div class="blog_title text-center">
                <h1 class="bl_title">Car Blog</h1>
            </div><hr class="hidden-xs">
           <div class="trending hidden-xs">
                <div id="slideshow">
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
               <div class="sl_controls" style="width: <?php echo (($i*21)+40).'px'; ?>">
                   <?php for($j=1; $j<=$i; $j++) { ?>
                       <a class="control_dot <?php if($j==1) echo "active" ?>" data-num="<?php echo $j; ?>"><?php echo $j; ?></a>
                    <?php  }  ?>
               </div>
           </div>
        </div>
    </div>
</div>
<div class="container padding_zero">
    <div class="blog_wrapper">

        <div class="overflow-hidden">
            <div class="col-sm-9">
                <div class="infinite-content">
                    <?php
                    $i=0;
                    $ppp=$wp_query->query_vars['posts_per_page'];
                   // $rows=ceil($ppp/3);
                    $col=$col1=$col2=$col3="";
                    ?>
                    <?php if (have_posts()) : while (have_posts()) : the_post(); $i++; ?>
                        <?php
                            $col.=create_one_post();
                            if( $i == 1){
                                $col1.=create_one_post();
                            }
                            else{
                                if( $i == 2 ){
                                    $col2.=create_one_post();
                                }
                                else{
                                    if( $i == 3 ){
                                        $col3.=create_one_post();
                                        $i=0;

                                    }
                                }
                            }

                        ?>
                    <?php endwhile; endif;  ?>

                    <div class="overflow-hidden visible-sm visible-xs">
                        <?php echo $col; ?>
                    </div>
                    <div class="overflow-hidden hidden-sm hidden-xsw">
                        <div class="col-sm-4 padding_zero col1">
                            <?php echo $col1; ?>
                        </div>
                        <div class="col-sm-4 padding_zero col2">
                            <?php echo $col2; ?>
                        </div>
                        <div class="col-sm-4 padding_zero col3">
                            <?php echo $col3; ?>
                        </div>
                    </div>
                </div>
<!--                <a href="#" class="inf-more-but">More Posts</a>-->
                <div class="nav-links">
                    <?php if (function_exists("pagination")) { pagination($wp_query->max_num_pages); } ?>
                </div>
            </div>
            <div class="col-sm-3 sd_bar">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>

    <div class="container brown_box text-center">
        Whatever your credit rating <b>we’ll find the right finance for you!</b>
    </div>
</div>
<?php get_template_part( 'orange-footer' ); ?>
<?php get_footer(); ?>
