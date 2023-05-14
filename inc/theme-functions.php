<?php
/**
 * remove parent actions
 */
add_action( 'init', 'constructions_agency_remove_action');

function constructions_agency_remove_action() {
    remove_action('construction_light_action_team', 'construction_light_team', 75);
    remove_action('construction_light_action_blog', 'construction_light_blog', 65);
}

/**
 *  Our Team Member Section
*/
if (! function_exists( 'constructions_agency_team' ) ):
    function constructions_agency_team(){

        $title = get_theme_mod('construction_light_team_title');
        $sub_title = get_theme_mod('construction_light_team_sub_title');

        $team_layout = get_theme_mod('construction_light_team_layout', 'layout_one');
        if($team_layout == 'layout_three'){
            $team_layout = "layout_one layout_three";
        }
        $team_page = get_theme_mod('construction_light_team');

        $team_options = get_theme_mod('construction_light_team_options','enable');
        if( !empty( $team_options ) && $team_options == 'enable' ){
        ?>
        <section id="cl_team" class="cons_light_team_layout_two <?php echo esc_attr( $team_layout ); ?>">
            <div class="container">
                
                <?php construction_light_section_title( $title, $sub_title ); ?>

                <div class="row">
                    <?php

                        if (!empty( $team_page ) ):

                        $team_pages = json_decode($team_page);

                        foreach ($team_pages as $team_page):
                        
                        $page_id = $team_page->team_page;

                            if (!empty( $page_id )):

                            $team_query = new WP_Query('page_id=' . $page_id);

                            if ($team_query->have_posts()): while ($team_query->have_posts()): $team_query->the_post();
                    ?>

                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="box">
                                <figure>
                                    <?php
                                        if( !empty( $team_layout ) && $team_layout == 'layout_two') {

                                            the_post_thumbnail('thumbnail');

                                        } else {

                                            the_post_thumbnail('construction-agency-team');

                                        }
                                    ?>
                                </figure>

                                <div class="team-wrap">

                                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

                                    <?php if (!empty( $team_page->designation ) ): ?>

                                        <span><?php echo esc_html($team_page->designation); ?></span>

                                    <?php endif; ?>

                                    <?php the_excerpt(); ?>

                                    <ul class="sp_socialicon">
                                        <?php if (!empty( $team_page->facebook ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $team_page->facebook ); ?>">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                        <?php endif; if (!empty( $team_page->twitter ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url($team_page->twitter); ?>">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                        <?php endif; if (!empty( $team_page->linkedin ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url($team_page->linkedin); ?>">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>
                                            </li>
                                        <?php endif; if (!empty( $team_page->instagram ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url($team_page->instagram); ?>">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>

                                </div>
                            </div>
                        </div>

                    <?php endwhile; endif; endif; endforeach; endif; ?>
                </div>
            </div>
        </section>
    <?php } }
endif;
add_action('construction_light_action_team', 'constructions_agency_team', 75);

/**
 *  Blog Section.
*/
if (! function_exists( 'constructions_agency_blog' ) ):
    function constructions_agency_blog(){

        $title = get_theme_mod('construction_light_blog_title');
        $sub_title = get_theme_mod('construction_light_blog_sub_title');
        $alignment = get_theme_mod('construction_light_posts_alignment', 'center');
        $blog_options = get_theme_mod('construction_light_home_blog_section','enable');
        if( !empty( $blog_options ) && $blog_options == 'enable' ){
        ?>
        <section id="cl_blog" class="cons_light_blog-list-area">
            <div class="container">

                <?php construction_light_section_title( $title, $sub_title ); ?>

                <div class="row">
                    <?php
                        $blog = get_theme_mod('construction_light_blog');
                        $cat_id = explode(',', $blog);
                        $blog_posts = get_theme_mod('construction_light_posts_num', 'three');

                        if ($blog_posts == 'three') {

                            $post_num = 3;

                        } else {

                            $post_num = 6;

                        }

                        $args = array(
                            'posts_per_page' => $post_num,
                            'post_type' => 'post',
                            'tax_query' => array(

                                array(
                                    'taxonomy' => 'category',
                                    'field' => 'term_id',
                                    'terms' => $cat_id
                                ),
                            ),
                        );

                        $blog_query = new WP_Query ($args);

                        if ( $blog_query->have_posts() ): while ( $blog_query->have_posts() ) : $blog_query->the_post();

                            if( function_exists( 'pll_register_string' ) ){ 

                                $blogreadmore_btn = pll__( get_theme_mod( 'construction_light_blogtemplate_btn', 'Continue Reading' ) );

                            }else{ 

                                $blogreadmore_btn = get_theme_mod( 'construction_light_blogtemplate_btn', 'Continue Reading' );

                            }
                    ?>
                        <div class="col-lg-4 col-md-4 col-sm-6 articlesListing blog-grid">
                            <article id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>>
                                <div class="blog-post-thumbnail">
                                    <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                                        <?php the_post_thumbnail('construction-light-medium'); ?>
                                    </a>
                                </div>
                                <div class="box text-<?php echo esc_attr($alignment); ?>">
                                    <div class="blog-content-wrapper">
                                        <?php the_title( '<h3 class="title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );  ?>
                                        
                                        <div class="entry-content">
                                            <?php the_excerpt(); ?>
                                        </div>

                                        <?php if ( 'post' === get_post_type() ){ do_action( 'construction_light_post_meta', 10 ); }  ?>
                                    </div>
                                </div>

                            </article><!-- #post-<?php the_ID(); ?> -->
                        </div>
                    <?php endwhile; endif; ?>
                </div>
            </div>
        </section>
    <?php } }
endif;
add_action('construction_light_action_blog', 'constructions_agency_blog', 65);