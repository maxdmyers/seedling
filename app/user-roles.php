<?php
/**
* Add capabilities and add_role function here.
* They are hooked into WordPress in functions.php.
*/

$capabilities 	= array(
	'read' => true,
	'edit_posts' => false,
	'edit_pages' => false,
	'edit_others_posts' => false,
	'create_posts' => false,
	'manage_categories' => false,
	'publish_posts' => false,
	'edit_themes' => false,
	'install_plugins' => false,
	'update_plugin' => false,
	'update_core' => false
);

//add_role( 'role_name', __('Role Display Name', 'seedling'), $capabilities );