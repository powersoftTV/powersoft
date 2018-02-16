<div class="social text-center">
    <ul>
        <?php
        if(get_option('deka_fb')) {
            echo '<li><a href="'.get_option('deka_fb').'" title="Facebook"><img src="'.get_template_directory_uri().'/imgs/fb.png" alt="Facebook"></a></li>';
        }
        if(get_option('deka_twitter')) {
            echo '<li><a href="'.get_option('deka_twitter').'" title="Twitter"><img src="'.get_template_directory_uri().'/imgs/twitter.png" alt="Twitter"></a></li>';
        }
        if(get_option('deka_linkedin')) {
            echo '<li><a href="'.get_option('deka_linkedin').'" title="Linkedin"><img src="'.get_template_directory_uri().'/imgs/linkedin.png" alt="Linkedin"></a></li>';
        }
        if(get_option('deka_instagram')) {
            echo '<li><a href="'.get_option('deka_instagram').'" title="Instagram"><img src="'.get_template_directory_uri().'/imgs/instagram.png" alt="Instagram"></a></li>';
        }
        ?>
    </ul>
</div>
