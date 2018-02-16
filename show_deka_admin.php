<style>
    .deka_form{
        max-width: 600px;
    }
    .deka_form label{
        width:200px;
        display:block;
        float:left;
    }
    .deka_form input[type=text]{
        width:300px;
    }
    .deka_form textarea{
        width:600px;
        height: 200px;
    }
    .deka_form span{
        font-size: 20px;
        font-weight: 600;
        color:#000;
    }
    .deka_copy{
        cursor: pointer;
        padding: 3px 5px;
        background: #4479BA;
        color: #FFF;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        border: solid 1px #20538D;
        text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.4);
        -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
        -webkit-transition-duration: 0.2s;
        -moz-transition-duration: 0.2s;
        transition-duration: 0.2s;
        -webkit-user-select:none;
        -moz-user-select:none;
        -ms-user-select:none;
        user-select:none;
    }
    .deka_copy:hover {
        background: #356094;
        border: solid 1px #2A4E77;
        text-decoration: none;
    }
    .deka_copy:active {
        -webkit-box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.6);
        -moz-box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.6);
        box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.6);
        background: #2E5481;
        border: solid 1px #203E5F;
    }
    .deka_red{
        color:red !important;
        font-size: 14px !important;
    }
    .deka_green{
        color:green !important;
        font-size: 14px !important;
    }

    @media only screen and (max-width: 768px){
        .deka_form textarea{
            width:300px;
        }
    }

</style>
<div class="deka_form">
    <h1>Shortcodes</h1>
    <hr>
    <ul>
<!--        <li>-->
<!--            <label>Apply Now</label>-->
<!--            <a class="deka_copy" onclick="copyToClipboard('#deka_get_started')">Copy Shortcode</a>-->
<!--            <span id="deka_get_started">[get_started]</span>-->
<!--            <hr>-->
<!--        </li>-->
       <li>
            <label>Privacy Policy</label>
            <a class="deka_copy" onclick="copyToClipboard('#deka_privacy')">Copy Shortcode</a>
            <span id="deka_privacy">[privacy]</span>
            <hr>
        </li>
        <li>
            <label>Terms and Conditions</label>
            <a class="deka_copy" onclick="copyToClipboard('#deka_terms')">Copy Shortcode</a>
            <span id="deka_terms">[terms]</span>
            <hr>
        </li>
        <li>
            <label>FAQ</label>
            <a class="deka_copy" onclick="copyToClipboard('#deka_faq')">Copy Shortcode</a>
            <span id="deka_faq">[faq]</span>
            <hr>
        </li>
        <li>
            <label>Complaints</label>
            <a class="deka_copy" onclick="copyToClipboard('#deka_complaints')">Copy Shortcode</a>
            <span id="deka_complaints">[complaints]</span>
            <hr>
        </li>
        <li>
            <label>Blue Calculator</label>
            <a class="deka_copy" onclick="copyToClipboard('#deka_calculator')">Copy Shortcode</a>
            <span id="deka_calculator">[calculator]</span>
            <hr>
        </li>
        <li>
            <label>Orange Calculator</label>
            <a class="deka_copy" onclick="copyToClipboard('#deka_calculator_orange')">Copy Shortcode</a>
            <span id="deka_calculator_orange">[calculator color=orange]</span>
            <hr>
        </li>

    </ul>

    <form method="post" action="options.php">
        <?php settings_fields( 'deka-settings-group' ); ?>
        <?php do_settings_sections( 'deka-settings-group' ); ?>
        <h1 style="margin-top: 10px;">Form Settings</h1>
        <hr>
        <ul>
            <li>
                <label for="default_cid">Default Affiliate ID</label>
                <input type="text" id="default_cid" name="default_cid" value="<?php echo get_option('default_cid'); ?>">
           </li>
            <li>
                <label for="cid_ruls">Affiliate Ruls (comma separated)</label>
                <textarea id="cid_ruls" name="cid_ruls">
                    <?php echo get_option('cid_ruls'); ?>
                </textarea>
            </li>
            <li>
                <label for="form_script">Form Scripts</label>
                <textarea id="form_script" name="form_script">
                    <?php echo get_option('form_script'); ?>
                </textarea>
            </li>
        </ul>


        <h1 style="margin-top: 10px;">Settings</h1>
        <hr>

        <ul>
            <li>
                <a class="deka_copy" onclick="emptycache()">Empty Deka Cache</a>
                <span id="deka_message"></span>
                <hr>
            </li>
            <li>
                <label for="deka_site_id">Site ID</label>
                <input type="text" id="deka_site_id" name="deka_site_id" value="<?php echo get_option('deka_site_id'); ?>">
            </li>
            <li>
                <label for="deka_calc_rate">Calculator best rate</label>
                <input type="text" id="deka_calc_rate" name="deka_calc_rate" value="<?php echo get_option('deka_calc_rate'); ?>">
            </li>
            <li>
                <label for="deka_contact_address">Contact Email</label>
                <input type="text" id="deka_contact_address" name="deka_contact_address" value="<?php echo get_option('deka_contact_address'); ?>">
            </li>
            <li>
                <label for="deka_fb">Facebook</label>
                <input type="text" id="deka_fb" name="deka_fb" value="<?php echo get_option('deka_fb'); ?>">
            </li>
            <li>
                <label for="deka_twitter">Twitter</label>
                <input type="text" id="deka_twitter" name="deka_twitter" value="<?php echo get_option('deka_twitter'); ?>">
            </li>
            <li>
                <label for="deka_linkedin">Linkedin</label>
                <input type="text" id="deka_linkedin" name="deka_linkedin" value="<?php echo get_option('deka_linkedin'); ?>">
            </li>
            <li>
                <label for="deka_instagram">Instagram</label>
                <input type="text" id="deka_instagram" name="deka_instagram" value="<?php echo get_option('deka_instagram'); ?>">
            </li>
            <li>
                <label for="deka_site_key">reCaptcha Site Key</label>
                <input type="password" id="deka_site_key" name="deka_site_key" value="<?php echo get_option('deka_site_key'); ?>">
            </li>
            <li>
                <label for="deka_secret_key">reCaptcha Secret Key</label>
                <input type="password" id="deka_secret_key" name="deka_secret_key" value="<?php echo get_option('deka_secret_key'); ?>">
            </li>
            <li>
                <label for="orange-footer_top_text">Orange-footer Top Text</label>
                <textarea id="orange-footer_top_text" name="orange-footer_top_text">
                    <?php echo get_option('orange-footer_top_text'); ?>
                </textarea>
            </li>
            <li>
                <label for="orange-footer_bottom_text">Orange-footer Bottom Text</label>
                <textarea id="orange-footer_bottom_text" name="orange-footer_bottom_text">
                    <?php echo get_option('orange-footer_bottom_text'); ?>
                </textarea>
            </li>
<!--            <li>-->
<!--                <label for="footer_text">Footer Text</label>-->
<!--                <textarea id="footer_text" name="footer_text">-->
<!--                    --><?php //echo get_option('footer_text'); ?>
<!--                </textarea>-->
<!--            </li>-->
            <li>
                <label for="deka_css">CSS</label>
                <textarea id="deka_css" name="deka_css">
                    <?php echo get_option('deka_css'); ?>
                </textarea>
            </li>
            <li>
                <label for="deka_script_head">Scripts (head)</label>
                <textarea id="deka_script_head" name="deka_script_head">
                    <?php echo get_option('deka_script_head'); ?>
                </textarea>
            </li>
            <li>
                <label for="deka_script_footer">Scripts (footer)</label>
                <textarea id="deka_script_footer" name="deka_script_footer">
                    <?php echo get_option('deka_script_footer'); ?>
                </textarea>
            </li>
            <li>
                <label for="deka_noscript_footer">Noscripts (footer)</label>
                <textarea id="deka_noscript_footer" name="deka_noscript_footer">
                    <?php echo get_option('deka_noscript_footer'); ?>
                </textarea>
            </li>
            <li>
                <?php submit_button(); ?>
            </li>
        </ul>
    </form>
</div>
<script>
    var working=false;

    function copyToClipboard(element) {
        var temp = jQuery("<input>");
        jQuery("body").append(temp);
        temp.val(jQuery(element).text()).select();
        document.execCommand("copy");
        temp.remove();
    }

    function emptycache(){
        working=true;
        var image = '<img height=18px src="<?php echo get_template_directory_uri(); ?>/imgs/download.svg" alt="Loading ..." />';
        jQuery('#deka_message').html(image);
        var data = {
            'action': 'empty_cache'
        };

        jQuery.post(ajaxurl, data, function(response) {
            working=false;
            if(response=="Success"){
                jQuery('#deka_message').html('<span class="deka_green"><strong> Success!</strong> Deka Cache has been deleted successfully.</span>')
            }
            else{
                jQuery('#deka_message').html('<span class="deka_red"><strong> Error!</strong> A problem has been occurred.</span>');
            }
        });
    }

</script>
