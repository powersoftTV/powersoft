<footer>
    <div class="container padding_zero">
        <div class="inside">
            <div class="text-center page_wrapper">
                <nav class="main-navigation">
                    <?php  wp_nav_menu( array( 'theme_location' => 'bottom-menu') ); ?>
                </nav>
                <div class="disclaimer">
                    <?php echo Deka_Privacy::get('ukfeedsfooternew'); ?>
                </div>
            </div>
            <div class="text-center page_wrapper">
                <div class="col-sm-6 f_banner">
                    <a href="https://www.loanfactory.co.uk/" target="_blank" title="Loan Factory" ><img src="<?php echo get_template_directory_uri().'/imgs/loanfactory.jpg'; ?>" alt="Loan Factory"></a>
                </div>
                <div class="col-sm-6 f_banner">
                    <a href="https://www.loanlineuk.net/" target="_blank"  title="Loan Line"><img src="<?php echo get_template_directory_uri().'/imgs/loanline.jpg'; ?>" alt="Loan Line"></a>
                </div>
            </div>
        </div>
    </div>
</footer>


<?php wp_footer();?>

<?php if($deka_script_footer=get_option('deka_script_footer')) : ?>
    <script type="text/javascript">
        <?php echo $deka_script_footer; ?>
    </script>
<?php endif; ?>
<?php if($deka_noscript_footer=get_option('deka_noscript_footer')) : ?>
    <noscript>
        <?php echo $deka_noscript_footer; ?>
    </noscript>
<?php endif; ?>


</body>
</html>