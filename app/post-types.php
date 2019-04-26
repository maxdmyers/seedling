<?php
/**
* Add arguments and register_post_type function here.
* They are hooked into WordPress in functions.php.
*/

// Example Custom Post Type
$labels = array(
	'name'                  => 'Projects',
	'singular_name'         => 'Project',
	'menu_name'             => 'Projects',
	'name_admin_bar'        => 'Project',
	'archives'              => '',
	'attributes'            => 'Project Attributes',
	'parent_item_colon'     => '',
	'all_items'             => 'All Projects',
	'add_new_item'          => 'Add New Project',
	'add_new'               => 'Add New',
	'new_item'              => 'New Project',
	'edit_item'             => 'Edit Project',
	'update_item'           => 'Update Project',
	'view_item'             => 'View Project',
	'view_items'            => 'View Projects',
	'search_items'          => 'Search Project',
	'not_found'             => 'Not found',
	'not_found_in_trash'    => 'Not found in Trash',
	'featured_image'        => 'Featured Image',
	'set_featured_image'    => 'Set featured image',
	'remove_featured_image' => 'Remove featured image',
	'use_featured_image'    => 'Use as featured image',
	'insert_into_item'      => 'Insert into Project',
	'uploaded_to_this_item' => 'Uploaded to this Project',
	'items_list'            => 'Projects list',
	'items_list_navigation' => 'Projects list navigation',
	'filter_items_list'     => 'Filter Projects list',
);
$rewrite = array(
	'slug'                => 'projects',
	'with_front'          => true,
	'pages'               => true,
	'feeds'               => true,
);
$args = array(
	'label'                 => 'Project',
	'description'           => 'Projects',
	'labels'                => $labels,
	'supports'              => array( 'title', 'editor' ),
	'hierarchical'          => false,
	'public'                => true,
	'show_ui'               => true,
	'show_in_menu'          => true,
	'menu_position'         => 5,
	'menu_icon'             => 'dashicons-building',
	'show_in_admin_bar'     => true,
	'show_in_nav_menus'     => true,
	'can_export'            => true,
	'has_archive'           => false,
	'exclude_from_search'   => true,
	'publicly_queryable'    => true,
	'rewrite'				=> $rewrite,
	'capability_type'       => 'page',
);
// register_post_type( 'projects', $args );