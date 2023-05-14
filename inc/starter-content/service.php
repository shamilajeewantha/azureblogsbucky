<?php
/**
 * Service starter content.
 */
return array(
	'post_type'    => 'page',
	'post_title'   => _x( 'Service', 'Theme starter content', 'construction-light' ),
	'thumbnail'    => '{{featured-image-home}}',
	'construction_light_page_layouts' => 'no',
	'template' => 'template-pagebuilder.php',
	'post_content' => '
    <!-- wp:pattern {"slug":"constructions-agency/features-2"} /-->
    <!-- wp:pattern {"slug":"constructions-agency/service"} /-->
    <!-- wp:pattern {"slug":"constructions-agency/features"} /-->
        
    ',
);