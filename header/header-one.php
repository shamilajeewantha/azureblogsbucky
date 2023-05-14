<header id="masthead" class="site-header headerone cons-agency">
	<?php if(get_theme_mod('construction_light_top_header_enable', 'enable') == 'enable'): ?>
	<div class="cons_light_top_bar hide-on-mobile-<?php echo esc_attr(get_theme_mod('construction_light_top_header_hide_mobile', 'enable')); ?>">
        <div class="container">
        	<div class="row">
            	<div class="col-lg-6 col-md-6 col-sm-12 top-bar-menu left wow fadeInLeft">
	            	<?php
						$topheaderleft = get_theme_mod( 'construction_light_topheader_left', 'quick_contact' );
						
						if($topheaderleft == 'quick_contact'){    

						    construction_light_quick_contact();

						}else if($topheaderleft == 'social_media'){    

						    construction_light_topheader_social();

						}else{

							wp_nav_menu( array( 'theme_location' => 'menu-2', 'depth' => 1 ) );
						}
					?>
	            </div>

	            <div class="col-lg-6 col-md-6 col-sm-12 top-bar-menu right wow fadeInRight">
	            	<?php
						$topheaderright = get_theme_mod( 'construction_light_topheader_right', 'social_media' );

						if($topheaderright == 'quick_contact'){    

						    construction_light_quick_contact();

						}else if($topheaderright == 'social_media'){    

						    construction_light_topheader_social();

						}else{

							wp_nav_menu( array( 'theme_location' => 'menu-2', 'depth' => 1 ) );
						}
					?>
	            </div>
	        </div>
        </div>
    </div>
	<?php endif; ?>

    <div class="nav-classic">
	    <div class="container">
	        <div class="row">
	        	<div class="col-md-12">
		        	<div class="header-middle-inner">
		            	<div class="site-branding">
							
							<div class="brandinglogo-wrap">
			            		<?php the_custom_logo(); ?>

					            <h1 class="site-title">
					                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					                    <?php bloginfo( 'name' ); ?>
					                </a>
					            </h1>
					            <?php 
					                $construction_light_description = get_bloginfo( 'description', 'display' );
					                if ( $construction_light_description || is_customize_preview() ) : ?>
					                    <p class="site-description"><?php echo $construction_light_description; /* WPCS: xss ok. */ ?></p>
					            <?php endif; ?>
					        </div>

				            <?php do_action('construction_light_menu_toggle'); ?>
							<!-- Mobile navbar toggler  -->

							
				        </div> <!-- .site-branding -->
					       
		                
			        
						<?php
							$enable_search = get_theme_mod('construction_light_enable_search', 'enable');
							$search_layout = get_theme_mod('construction_light_search_layout', 'layout_one');
						?>
						<div class="nav-menu">
							<nav class="box-header-nav main-menu-wapper" aria-label="<?php esc_attr_e( 'Main Menu', 'constructions-agency' ); ?>" role="navigation">
								<?php
									wp_nav_menu( array(
											'theme_location'  => 'menu-1',
											'menu'            => 'primary-menu',
											'container'       => '',
											'container_class' => '',
											'container_id'    => '',
											'menu_class'      => 'main-menu',
										)
									);
								?>
								<?php if( $enable_search == 'enable' and $search_layout == 'layout_two'): ?>
								<div class="search-wrapper search-layout-two conslight-search-wrapper">
									<?php get_search_form(); ?>
									<div class="search-layout-two conslight-close-icon">
										<span>x</span>
									</div>
								</div>
								<?php endif; ?>
							</nav>
						</div>
					</div>
				</div>
	        </div><!-- .row end -->
	    </div><!-- .container end -->
	</div>

</header><!-- #masthead -->