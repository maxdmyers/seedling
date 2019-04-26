<?php
/**
* Add locations and register_nav_menus function here.
* They are hooked into WordPress in functions.php.
*/

$locations = array(
	'main-menu' 	=> __( 'Main Menu', 'seedling' ),
	'footer-menu' 	=> __( 'Footer Menu', 'seedling' ),
);
register_nav_menus( $locations );