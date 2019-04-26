<?php
/**
* Add arguments and register_taxonomy function here.
* They are hooked into WordPress in functions.php.
*/

// Example Taxonomy
$labels = array(
	'name'                       => 'Project Types',
	'singular_name'              => 'Project Type',
	'menu_name'                  => 'Project Type',
	'all_items'                  => 'All Project Types',
	'parent_item'                => 'Parent Project Type',
	'parent_item_colon'          => 'Parent Project Type:',
	'new_item_name'              => 'New Project Type Name',
	'add_new_item'               => 'Add New Project Type',
	'edit_item'                  => 'Edit Project Type',
	'update_item'                => 'Update Project Type',
	'view_item'                  => 'View Project Type',
	'separate_items_with_commas' => 'Separate items with commas',
	'add_or_remove_items'        => 'Add or remove items',
	'choose_from_most_used'      => 'Choose from the most used',
	'popular_items'              => 'Popular Project Types',
	'search_items'               => 'Search Project Types',
	'not_found'                  => 'Not Found',
	'no_terms'                   => 'No items',
	'items_list'                 => 'Project Types list',
	'items_list_navigation'      => 'Project Types list navigation',
);
$args = array(
	'labels'                     => $labels,
	'hierarchical'               => true,
	'public'                     => true,
	'show_ui'                    => true,
	'show_admin_column'          => true,
	'show_in_nav_menus'          => true,
	'show_tagcloud'              => false,
);
// register_taxonomy( 'project_type', array( 'projects' ), $args );