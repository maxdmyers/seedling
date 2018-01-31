<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once __DIR__ . '/vendor/autoload.php';
use Timber\Site;

class Seedling extends Site {

	public function __construct() {
		add_filter( 'timber_context', array($this, 'addToContext') );
		add_action( 'init', array($this, 'extend') );
		add_action( 'login_enqueue_scripts', array($this, 'updateLoginLogo') );
		add_filter( 'login_headerurl', array($this, 'updateLoginLogoURL') );
		add_filter( 'login_message', array($this, 'addLoginMessage') );
		parent::__construct();
	}

	public function extend() {
		$this->themeSupport();
		$this->registerPostTypes();
		$this->registerTaxonomies();
		$this->addUserRoles();
		$this->addImagesSizes();
		$this->addToACF();
	}

	/**
	 * Use this method to add variables to the context
	 */
	public function addToContext($context) {
		$context['menu'] = new Timber\Menu('main-menu');
		$context['footer-menu'] = new Timber\Menu('footer-menu');
		$context['options'] = get_fields('option');
		$context['site'] = $this;
		return $context;
	}

	/**
	 * Use this method to add theme support
	 */
	public function themeSupport() {
		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
	}

	/**
	 * Use this method to register custom post types
	 */
	public function registerPostTypes() {}

	/**
	 * Use this method to register custom taxonomies
	 */
	public function registerTaxonomies() {}

	/**
	 * Use this method to register custom image sizes
	 */
	public function addImagesSizes() {
		// add_image_size( 'hero', 3000, 9999 );
	}

	/**
	 * Use this method to add to Advanced Custom Fields
	 */
	public function addToACF() {
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

	public function updateLoginLogo() { ?>
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

	public function updateLoginLogoURL() {
		return get_site_url();
	}

	public function addLoginMessage() {
		return "";
	}
}

new Seedling();
