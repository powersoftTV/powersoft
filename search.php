<?php get_header(); ?>
<div class="container padding_zero">
<?php if(isset($_GET['s']) && $_GET['s']) { ?>

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

    <?php
}
else{ ?>

    <div class="blog_wrapper">
        <div class="overflow-hidden">
            <div class="col-sm-9">
                <h3 class="page-content  text-center">Sorry, but nothing matched your search criteria. Please try again with some different keywords.</h3>
            </div>
            <div class="col-sm-3 sd_bar">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
<?php }
?>
    <div class="container brown_box text-center">
        Whatever your credit rating <b>we’ll find the right finance for you!</b>
    </div>
</div>
<?php get_template_part( 'orange-footer' ); ?>
<?php get_footer(); ?>
