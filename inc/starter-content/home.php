<?php
/**
 * Home starter content.
 */
$default_home_content = '
<!-- wp:pattern {"slug":"constructions-agency/features"} /-->
<!-- wp:pattern {"slug":"constructions-agency/team"} /-->
<!-- wp:pattern {"slug":"constructions-agency/call-to-action"} /-->
<!-- wp:pattern {"slug":"constructions-agency/overlap"} /-->
<!-- wp:pattern {"slug":"constructions-agency/counter"} /-->
<!-- wp:pattern {"slug":"constructions-agency/portfolio"} /-->
<!-- wp:pattern {"slug":"constructions-agency/call-to-action-2"} /-->
<!-- wp:pattern {"slug":"constructions-agency/news"} /-->
<!-- wp:pattern {"slug":"constructions-agency/contact"} /-->
';

return array(
	'post_type'    => 'page',
	'post_title'   => _x( 'Home', 'Theme starter content', 'construction-light' ),
	'template' => 'template-pagebuilder.php',
	'post_content' => $default_home_content,
);
