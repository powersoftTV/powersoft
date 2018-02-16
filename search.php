<?php get_header(); ?>
    <div class="container padding_zero">

		<?php if(have_posts()) : ?>
			<?php while(have_posts()) : the_post(); ?>
                <div class="page_wrapper">


					<?php the_content(); ?>

                </div>

			<?php endwhile; ?>
		<?php endif; ?>

    </div>
<?php get_footer(); ?>