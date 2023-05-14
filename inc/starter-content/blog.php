<?php
/**
 * Contact starter content.
 */
return array(
	'post_type'    => 'page',
	'post_title'   => _x( 'Blog', 'Theme starter content', 'construction-light' ),
	'thumbnail'    => '{{featured-image-home}}',
	'template' => 'template-pagebuilder.php',
	'post_content' => '
	<!-- wp:spacer {"height":61} -->
	<div style="height:61px" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->
	
	<!-- wp:pattern {"slug":"constructions-agency/news"} /-->

	<!-- wp:spacer {"height":61} -->
	<div style="height:61px" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->',
);