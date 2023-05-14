<?php
/**
 * Contact starter content.
 */
return array(
	'post_type'    => 'page',
	'post_title'   => _x( 'About', 'Theme starter content', 'construction-light' ),
	'thumbnail'    => '{{featured-image-home}}',
	'template' => 'template-pagebuilder.php',
	'post_content' => '
	
	<!-- wp:pattern {"slug":"constructions-agency/features"} /-->
	<!-- wp:pattern {"slug":"constructions-agency/features-2"} /-->
	<!-- wp:pattern {"slug":"constructions-agency/team"} /-->

	<!-- wp:spacer {"height":61} -->
	<div style="height:61px" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->',
);