<?php
/**
 * Describe child theme functions
 *
 * @package Construction Light
 * @subpackage Construction Agency
 * 
 */

 if ( ! function_exists( 'constructions_agency_setup' ) ) :

    function constructions_agency_setup() {
		/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Construction Agency, use a find and replace
		* to change 'constructions-agency' to the name of your theme in all the template files.
		*/
		load_theme_textdomain( 'constructions-agency', get_template_directory() . '/languages' );

		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 */
        
        $constructions_agency_theme_info = wp_get_theme();
        $GLOBALS['constructions_agency_version'] = $constructions_agency_theme_info->get( 'Version' );

		add_theme_support( "title-tag" );
		add_theme_support( 'automatic-feed-links' );
    }
endif;
add_action( 'after_setup_theme', 'constructions_agency_setup' );


/**
 * Enqueue child theme styles and scripts
*/
function constructions_agency_scripts() {
    
    global $constructions_agency_version;

    wp_dequeue_style( 'construction-light-style' );
    
    wp_enqueue_style( 'construction-agency-parent-style', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'style.css', array(), esc_attr( $constructions_agency_version ) );
    
    wp_enqueue_style( 'construction-agency-responsive', get_template_directory_uri(). '/assets/css/responsive.css');
    
    wp_enqueue_style( 'construction-agency-style', get_stylesheet_uri(), esc_attr( $constructions_agency_version ) );

    wp_enqueue_script('constructions-agency', get_stylesheet_directory_uri() . '/js/construction-agency.js', array('jquery','masonry'), esc_attr( $constructions_agency_version ), true);

	if ( is_rtl() ) {
		wp_enqueue_style( 'construction-light-rtl', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'rtl.css', array(), esc_attr( $constructions_agency_version ) );	
	}
}
add_action( 'wp_enqueue_scripts', 'constructions_agency_scripts', 20 );

function constructions_agency_css_strip_whitespace($css) {
    $replace = array(
        "#/\*.*?\*/#s" => "", // Strip C style comments.
        "#\s\s+#" => " ", // Strip excess whitespace.
    );
    $search = array_keys($replace);
    $css = preg_replace($search, $replace, $css);

    $replace = array(
        ": " => ":",
        "; " => ";",
        " {" => "{",
        " }" => "}",
        ", " => ",",
        "{ " => "{",
        ";}" => "}", // Strip optional semicolons.
        ",\n" => ",", // Don't wrap multiple selectors.
        "\n}" => "}", // Don't wrap closing braces.
        "} " => "}\n", // Put each rule on it's own line.
    );
    $search = array_keys($replace);
    $css = str_replace($search, $replace, $css);

    return trim($css);
}

/**
 * Dynamic Style
 */
add_filter( 'construction-light-dynamic-css', 'constructions_agency_dymanic_styles', 100 );
function constructions_agency_dymanic_styles($dynamic_css) {
    
    $services_bg = get_theme_mod('construction_light_service_image', apply_filters('construction_light_primary_color', '#ee212b'));
 
    $primar_color = get_theme_mod('construction_light_primary_color');
	if($primar_color){
		
		$dynamic_css .= "
		.box-header-nav .main-menu .page_item.current-page-item a, .box-header-nav .main-menu>.menu-item.current-menu-item >a,
		.site-header:not(.headertwo) .nav-classic .site-branding h1 a,
		.cons_light_feature.layout_four .feature-list .icon-box{
			color: {$primar_color};
		}
		";
	}
	
	wp_add_inline_style( 'construction-agency-style', constructions_agency_css_strip_whitespace($dynamic_css) );

}
/** modify customizer */
if ( ! function_exists( 'constructions_agency_child_options' ) ) {

    function constructions_agency_child_options( $wp_customize ) {
		$wp_customize->remove_control('construction_light_quick_info_hide_mobile');
		
		$wp_customize->get_control('construction_light_service_layout')->choices = array(
			'layout_one'  => esc_html__('Layout One', 'constructions-agency'),
			'layout_two'  =>esc_html__('Layout Two', 'constructions-agency'),
			'layout_three'  =>esc_html__('Layout Three', 'constructions-agency'),
			'layout_four'  =>esc_html__('Layout Four', 'constructions-agency'),
		);
		
		$wp_customize->get_control('construction_light_team_layout')->choices = array(
			'layout_one' => esc_html__('Layout One', 'constructions-agency'),
			'layout_two' => esc_html__('Layout Two', 'constructions-agency'),
			'layout_three' => esc_html__('Layout Three', 'constructions-agency'),
		);


		/** contact section */
		$wp_customize->add_section('construction_light_contact_section', array(
			'title' => esc_html__('Contact Section', 'constructions-agency'),
			'panel' => 'construction_light_frontpage_settings',
			'priority' => construction_light_get_section_position('construction_light_contact_section') or 100,
			'hiding_control' => 'construction_light_contact_section_disable'
		));

		//ENABLE/DISABLE SERVICE SECTION
		$wp_customize->add_setting('construction_light_contact_section_disable', array(
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
			'default' => 'disable'
		));

		$wp_customize->add_control(new Construction_Light_Switch_Control($wp_customize, 'construction_light_contact_section_disable', array(
			'section' => 'construction_light_contact_section',
			'label' => esc_html__('Enable Section ', 'constructions-agency'),
			'switch_label' => array(
				'enable' => esc_html__('Yes', 'constructions-agency'),
				'disable' => esc_html__('No', 'constructions-agency'),
			),
			'class' => 'switch-section',
			'priority' => -1
		)));

		// Section Title.
		$wp_customize->add_setting( 'construction_light_contact_title', array(
			'sanitize_callback' => 'sanitize_text_field', 	 //done	
			'transport' => 'postMessage'
		));

		$wp_customize->add_control('construction_light_contact_title', array(
			'label'		=> esc_html__( 'Enter Section Title', 'constructions-agency' ),
			'section'	=> 'construction_light_contact_section',
			'type'      => 'text'
		));

		//Section Sub Title.
		$wp_customize->add_setting( 'construction_light_contact_sub_title', array(
			'sanitize_callback' => 'sanitize_text_field',			//done
			'transport' => 'postMessage'
		) );

		$wp_customize->add_control( 'construction_light_contact_sub_title', array(
			'label'    => esc_html__( 'Enter Section Sub Title', 'constructions-agency' ),
			'section'  => 'construction_light_contact_section',
			'type'     => 'text',
		));

		$wp_customize->add_setting('construction_light_contact_quick_link', array(
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control(new ConstructionAgencyInfoText($wp_customize, 'construction_light_contact_quick_link', array(
			'label' => esc_html__('Contact Info', 'constructions-agency'),
			'section' => 'construction_light_contact_section',
			'description' => sprintf(esc_html__('Add your %s here, content is comes from top header quick info', 'constructions-agency'), '<a href="?autofocus[section]=construction_light_top_header" target="_blank">Contact Info</a>')
		)));

		$wp_customize->add_setting( 'construction_light_contact_shortcode', array(
			'sanitize_callback' => 'construction_light_sanitize_text', 	 //done	
			'transport' => 'postMessage'
		));

		$wp_customize->add_control('construction_light_contact_shortcode', array(
			'label'		=> esc_html__( 'Contact Form Shortcode', 'constructions-agency' ),
			'section'	=> 'construction_light_contact_section',
			'type'      => 'text'
		));

		$wp_customize->add_setting( 'construction_light_contact_map', array(
			'sanitize_callback' => 'construction_light_sanitize_text', 	 //done	
			'transport' => 'postMessage'
		));

		$wp_customize->add_control('construction_light_contact_map', array(
			'label'		=> esc_html__( 'Enter Map Iframe', 'constructions-agency' ),
			'section'	=> 'construction_light_contact_section',
			'type'      => 'textarea'
		));

		$wp_customize->selective_refresh->add_partial('construction_light_contact_title', array(
			'selector' => '#cl-contact-section .section-title',
			'container_inclusive' => true
		));

		$wp_customize->selective_refresh->add_partial('construction_light_contact_shortcode', array(
			'selector' => '#cl-contact-section .contact-and-map-section',
			'container_inclusive' => true
		));

		$wp_customize->selective_refresh->add_partial( 'construction_light_contact_refresh', array (
			'settings' => array( 
				'construction_light_contact_section_disable',
				'construction_light_contact_title',
				'construction_light_contact_sub_title',
				'construction_light_contact_shortcode',
				'construction_light_contact_map',
		
			),
			'selector' => '#cl-contact-section',
			'fallback_refresh' => false,
			'container_inclusive' => true,
			'render_callback' => function () {
				return get_template_part( 'section/section-contact' );
			}
		));


    }
}
add_action( 'customize_register' , 'constructions_agency_child_options', 11 );

/** include files */
require get_stylesheet_directory() . '/inc/theme-functions.php';

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'ConstructionAgencyInfoText' ) ) :
    /**
     * Info Text Control
     */
    class ConstructionAgencyInfoText extends WP_Customize_Control {
        public function render_content() {
            ?>
            <span class="customize-control-title">
                <?php echo esc_html($this->label); ?>
            </span>
            <?php if ($this->description) { ?>
                <span class="customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
                <?php
            }
        }
    }
endif;

if( !function_exists('constructions_agency_allow_iframes')):
	function constructions_agency_allow_iframes( $allowedposttags ){

		$allowedposttags['iframe'] = array(
			'align' => true,
			'allow' => true,
			'allowfullscreen' => true,
			'class' => true,
			'frameborder' => true,
			'height' => true,
			'id' => true,
			'marginheight' => true,
			'marginwidth' => true,
			'name' => true,
			'scrolling' => true,
			'src' => true,
			'style' => true,
			'width' => true,
			'allowFullScreen' => true,
			'class' => true,
			'frameborder' => true,
			'height' => true,
			'mozallowfullscreen' => true,
			'src' => true,
			'title' => true,
			'webkitAllowFullScreen' => true,
			'width' => true
		);

		return $allowedposttags;
	}
	add_filter( 'wp_kses_allowed_html', 'constructions_agency_allow_iframes', 1 );
endif;

/**
 * starter content
 */
require get_stylesheet_directory() .'/inc/starter-content/init.php';

// The filter callback function.
function constructions_agency_primary_color( $color ) {
    return "#ce9e51";
}
add_filter( 'construction_light_primary_color', 'constructions_agency_primary_color', 10, 1 );



add_filter('construction_light_fse_block_pattern_categories', function(){
	return array(
		'constructions-agency' => array( 'label' => __( 'Constructions Agency', 'constructions-agency' ) )
	);
});