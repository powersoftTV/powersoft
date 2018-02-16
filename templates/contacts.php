 <?php
/*
 * Template name: Contact Us page template
 */
?>

 <?php get_header(); ?>

 <div class="container padding_zero">

         <?php if(have_posts()) : ?>
             <?php while(have_posts()) : the_post(); ?>
                 <div class="contacts_wrapper">
                     <?php get_template_part( 'moving-car' ); ?>
                     <div class="orange_box">
                         <div class="orange_wrapper">
                             <div class="the_cont">
                                <?php the_content(); ?>
                             </div>
                             <div class="row margin_zero">
                                 <div class="col-sm-8">
                                     <?php if(get_post_meta($post->ID, 'email_us', true ) &&  get_option('deka_contact_address')) {
                                         $email='<a href="mailto:'.get_option('deka_contact_address').'" target="_top">'.get_option('deka_contact_address').'</a>';
                                         $email_us=str_replace('{{email}}',$email,get_post_meta($post->ID, 'email_us', true ));
                                         echo '<div class="white_box email_us overflow-hidden"><div class="col-xs-2 icon_box"><img src="'.get_template_directory_uri().'/imgs/envelop.png" alt="Email us"></div><div class="col-xs-10 contact_text">'.$email_us.'</div></div>';
                                     }
                                     ?>
<!--                                     <div class="white_box phone_us overflow-hidden">-->
<!--                                         <div class="col-xs-2 icon_box">-->
<!--                                            <img src="--><?php //echo get_template_directory_uri().'/imgs/phone.png'; ?><!--" alt="Phone us">-->
<!--                                         </div>-->
<!--                                         <div class="col-xs-10 contact_text">-->
<!--                                             --><?php //if($phone_us= get_post_meta($post->ID, 'phone_us', true )) echo $phone_us; ?>
<!--                                             <div class="call_phone">-->
<!--                                                 --><?php //if($contact_tel= get_post_meta($post->ID, 'contact_tel', true )) echo '<a href="tel:'.$contact_tel.'">Call <span>'.$contact_tel.'</span></a>'; ?>
<!--                                             </div>-->
<!--                                         </div>-->
<!--                                     </div>-->
                                     <div class="white_box write_us row-eq-height overflow-hidden">
                                         <div class="col-xs-2 icon_box">
                                             <div class="wt_wrapper_1">
                                                <img src="<?php echo get_template_directory_uri().'/imgs/pen.png'; ?>" alt="write us">
                                             </div>
                                         </div>

                                         <div class="contact_text col-xs-7 contact_text">
                                             <div class="wt_wrapper_2"><?php if($write_us= get_post_meta($post->ID, 'write_us', true )) echo $write_us; ?></div>
                                         </div>

                                         <div class="contact_address col-xs-3 icon_box">
                                             <div class="wt_wrapper_3"><?php if($contact_address= get_post_meta($post->ID, 'contact_address', true )) echo $contact_address; ?></div>
                                         </div>
                                     </div>
                                     <div class="complaints overflow-hidden">
                                         <div class="col-xs-2 icon_box">
                                            <img src="<?php echo get_template_directory_uri().'/imgs/points.png'; ?>" alt="Complaints">
                                         </div>
                                         <div class="col-xs-10 contact_text">
                                            <?php if($contacts_complaints= get_post_meta($post->ID, 'contacts_complaints', true )) echo $contacts_complaints; ?>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-sm-4" >
                                     <div class="form_wrapper">
                                         <img src="<?php echo get_template_directory_uri().'/imgs/caragogo.png'; ?>" alt="Caragago">
                                         <div class="mailbox text-center">MAILBOX</div>
                                         <div id="all_content">
                                             <div class="messages"></div>
                                             <form id="contact" class="deka_form" method="post">

                                                 <div class="form-group">
                                                     <label class="control-label" for="subj">Subject</label>
                                                     <input class="form-control" required type="text"  name="subj" id="subj">
                                                 </div>
                                                 <div class="form-group">
                                                     <label class="control-label" for="name">Name</label>
                                                     <input class="form-control" required type="text" name="name" id="name">
                                                 </div>
                                                 <div class="form-group">
                                                     <label class="control-label" for="email">Email</label>
                                                     <input class="form-control" required type="email" name="email" id="email">
                                                 </div>

                                                 <div class="form-group">
                                                     <label class="control-label" for="message">Message</label>
                                                     <textarea class="form-control" required name="message" id="message"></textarea>
                                                 </div>
                                                 <div class="form-group text-center">
                                                     <div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="<?php echo get_option('deka_site_key'); ?>"></div>
                                                 </div>
                                                 <div class="form-group text-center" id="button_wrapper">
                                                     <button class="btn" id="send_message" type="submit">SEND</button>
                                                 </div>
                                             </form>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <?php get_template_part( 'social-icons' ); ?>
                         </div>
                     </div>
                     <div class="brown_box text-center">
                         <?php if($before_footer= get_post_meta($post->ID, 'before_footer', true )) echo $before_footer; ?>
                     </div>
                 </div>
             <?php endwhile; ?>
         <?php endif; ?>

 </div>
 <?php get_footer(); ?>
