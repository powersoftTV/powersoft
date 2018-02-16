<?php
/*
 * Template name: Opt-Out page template
 */
?>
<?php get_header(); ?>
<div class="container padding_zero">

    <?php if(have_posts()) : ?>
        <?php while(have_posts()) : the_post(); ?>
            <div class="optout_wrapper">
                <?php get_template_part( 'moving-car' ); ?>
                <div class="orange_box">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="cont_wrap">
                                <?php the_content(); ?>
                            </div>
                            <?php get_template_part( 'social-icons' ); ?>
                        </div>
                        <div class="col-sm-4">
                            <div class="opt_out_form">
                                <div id="all_content">
                                    <div class="messages"></div>
                                    <form id="optout" class="deka_form" method="post">

                                        <div class="form-group">
                                            <label class="control-label" for="phone">Your Mobile:</label>
                                            <input class="form-control" required type="text"  name="phone" id="phone">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="email">Your Email:</label>
                                            <input class="form-control" required type="email" name="email" id="email">
                                        </div>
                                        <div class="form-group">
                                            <div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="<?php echo get_option('deka_site_key'); ?>"></div>
                                        </div>
                                        <div class="form-group" id="button_wrapper">
                                            <button class="btn" id="unsubscribe" type="submit">Unsubscribe</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endwhile; ?>
    <?php endif; ?>

</div>
<?php get_footer(); ?>
