<?php if( get_theme_mod('construction_light_contact_section_disable', 'disable') == 'enable'): ?>
<section id="cl-contact-section" class="cl-bg-right cl-section cl-service-section cons_light_feature cl-contact-section">
   <div class="cl-section-wrap">
      <div class="container">
         <div class="row">
            <?php
            $title = get_theme_mod('construction_light_contact_title');
            $sub_title = get_theme_mod('construction_light_contact_sub_title');
            ?>
            <div class="col-lg-12 col-sm-12 col-xs-12">
               <?php if($title): ?>
               <h2 class="section-title"><?php echo esc_html($title); ?></h2>
               <?php endif; ?>
               <?php if($sub_title): ?>
               <div class="section-tagline"><?php echo esc_html( $sub_title ); ?></div>
               <?php endif; ?>
            </div>
         </div>

        <?php
            $contact_num = get_theme_mod('construction_light_contact_num');
            $email       = get_theme_mod('construction_light_email');
            $location    = get_theme_mod('construction_light_address');	
        ?>

        <div class="row">
            <?php if($contact_num): ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 feature-list mb-3">
               <div class="box">
                  <div class="bottom-content">
                     <div class="icon-box">
                        <i class="fas fa-mobile-alt"></i>
                     </div>
                     <h4><?php echo esc_html__('Call Us', 'constructions-agency'); ?></h4>
                     <a href="tel:<?php echo esc_attr( $contact_num ); ?>" class="sp_quick_info_tel">
                		</i><?php echo esc_html( $contact_num ); ?>
                	</a>
                  </div>
               </div>
            </div>
            <?php endif; ?>
            <?php if($email): ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 feature-list mb-3">
               <div class="box">
                  <div class="bottom-content">
                     <div class="icon-box">
                        <i class="far fa-envelope-open"></i>
                     </div>
                     <h4><?php echo esc_html__('Email Us', 'constructions-agency'); ?></h4>
                     <a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>" class="sp_quick_info_mail">
                		<?php echo esc_html( antispambot( $email ) ); ?>
                	</a>
                  </div>
               </div>
            </div>
            <?php endif; ?>
            <?php if($location): ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 feature-list mb-3">
               <div class="box">
                  <div class="bottom-content">
                     <div class="icon-box">
                        <i class="far fa-map"></i>
                     </div>
                     <h4><?php echo esc_html__('Address', 'constructions-agency'); ?></h4>
                     <span>
                         <?php echo esc_html( $location ); ?>
                     </span>
                  </div>
               </div>
            </div>
            <?php endif; ?>
            
        </div>
        

        <div class="row contact-and-map-section mt-5 ml-0 mr-0">
           <?php 
               $shortcode = get_theme_mod('construction_light_contact_shortcode');
               $iframe = get_theme_mod('construction_light_contact_map');
               $col = "col-lg-6 col-md-6 col-sm-6 col-xs-12";
               if(trim($iframe) == '' || trim($shortcode) == ''){
                  $col = "col-lg-12 col-md-12 col-sm-12 col-xs-12";
               }
           ?>
            <?php if($shortcode): ?>
            <div class="<?php echo esc_attr($col); ?> contact-shortcode pl-0">
                <?php echo do_shortcode( $shortcode ); ?>
            </div>
            <?php endif; ?>
            <?php if( $iframe ): ?>
            
            <div class="<?php echo esc_attr($col); ?> contact-map pr-0 <?php if( trim($shortcode) == '') echo 'pl-0'; ?>">
                <?php echo wp_kses_post( $iframe ); ?>
            </div>
            <?php endif; ?>
        </div>
      </div>
   </div>
</section>
<?php endif; ?>