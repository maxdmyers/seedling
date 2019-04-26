<?php
/**
* Adds composer autoload file and starts Timber
============================================== */
require_once __DIR__ . '/vendor/autoload.php';
$timber = new \Timber\Timber();

class Seedling extends \Timber\Site {

	function __construct() {
		add_action( 'init', array($this, 'extend') );
		$this->filters();
		$this->actions();
		parent::__construct();
	}

	function extend() {
		$this->themeSupport();
		$this->registerPostTypes();
		$this->registerTaxonomies();
		$this->registerMenus();
		$this->addUserRoles();
		$this->addImagesSizes();
		$this->addToACF();
	}

	/**
	 * Add all filters here
	 */
	function filters() {
		add_filter( 'timber_context', array($this, 'addToContext') );
		add_filter( 'login_headerurl', array($this, 'updateLoginLogoURL') );
		add_filter( 'login_message', array($this, 'addLoginMessage') );
		add_filter( 'acf/settings/show_admin', array($this, 'hideACFAdmin') );
	}

	/**
	 * Add all actions here
	 */
	function actions() {
		add_action( 'login_enqueue_scripts', array($this, 'updateLoginLogo') );
		add_action( 'wp_enqueue_scripts', array($this, 'enqueueScripts') );
		add_action( 'wp_head', array($this, 'addGTMHead'), 10 );
		add_action( 'body_top', array($this, 'addGTMBody') );

		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
	}

	/**
	 * Use this method to add theme support
	 */
	function themeSupport() {
		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
	}

	function registerPostTypes() {
		require __DIR__ . '/app/post-types.php';
	}

	function registerTaxonomies() {
		require __DIR__ . '/app/taxonomies.php';
	}

	function registerMenus() {
		require __DIR__ . '/app/menus.php';
	}

	function addUserRoles() {
		require __DIR__ . '/app/user-roles.php';
	}

	/**
	 * Use this method to add variables to the context
	 */
	function addToContext($context) {
		$context['site'] = $this;
		$context['menu'] = new Timber\Menu('main-menu');
		$context['footer-menu'] = new Timber\Menu('footer-menu');

		// Site-wide Settings
		if( function_exists('get_field') ) {
			$context['site_settings'] = get_fields('option');
		}

		return $context;
	}

	/**
	 * Use this method to register custom image sizes
	 */
	function addImagesSizes() {
		// add_image_size( 'hero', 3000, 9999 );
	}

	/**
	 * Use this method to add to Advanced Custom Fields
	 */
	function addToACF() {
		if( function_exists('acf_add_options_page') ) {
			
			acf_add_options_page(array(
				'page_title' 	=> 'General Settings',
				'menu_title'	=> 'Site Settings',
				'menu_slug' 	=> 'site-general-settings',
				'capability'	=> 'edit_posts',
				'redirect'		=> false
			));
			
		}
	}

	function enqueueScripts() {
		wp_deregister_script('jquery');
		wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/build/js/jquery.min.js', array(), '3.4.0');
		wp_enqueue_script('seedling-scripts', get_template_directory_uri() . '/assets/build/js/all.min.js', array(), '');
	}

	function updateLoginLogo() { ?>
	    <style type="text/css">
	        #login h1 a, .login h1 a {
	            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/logo.png);
	            background-size: 90%;
	            width: XXXpx;
	            height: XXXpx;
	            margin: 0 auto;
	        }
	    </style>
	<?php }

	function updateLoginLogoURL() {
		return get_site_url();
	}

	function addLoginMessage() {
		return "";
	}

	function hideACFAdmin() {

	    // get the current site url
	    $site_url = get_bloginfo( 'url' );

	    // an array of protected site urls  
	    $protected_urls = array(
	        'https://example.com',
	        'https://staging.example.com'
	    );

	    // check if the current site url is in the protected urls array
	    if ( in_array( $site_url, $protected_urls ) ) {
	        // hide the acf menu item
	        return false;
	    } else {
	        // show the acf menu item
	        return true;
	    }
	}

	function addGTMHead() { ?>
		<?php if ( WP_ENV === 'production' ) && ( get_field('google_tag_manager_id', 'option') ): ?>
	 
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-<?php the_field("google_tag_manager_id", "option") ?>');</script> 
		<!-- End Google Tag Manager -->
		 
		<?php endif; ?>
	<?php }

	function addGTMBody() { ?>
		<?php if ( WP_ENV === 'production' ) && ( get_field('google_tag_manager_id', 'option') ): ?>

		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-<?php the_field('google_tag_manager_id', 'option') ?>"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
	
		<?php endif; ?>
	<?php }
}

new Seedling();

/*
 _____               _ _ _             
/  ___|             | | (_)            
\ `--.  ___  ___  __| | |_ _ __   __ _ 
 `--. \/ _ \/ _ \/ _` | | | '_ \ / _` |
/\__/ /  __/  __/ (_| | | | | | | (_| |
\____/ \___|\___|\__,_|_|_|_| |_|\__, |
                                  __/ |
                                 |___/ 
*/
