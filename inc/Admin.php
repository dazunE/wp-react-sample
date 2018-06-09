<?php
/*
 * WPInfomate
 *
 * @package WPInfomate
 * @author dazunj
 *
 */

namespace WPInfomate;


class Admin {

	/*
	 * plugin basename
	 * @var string
	 */

	protected $base_name = null;

	/*
	 * plugin screen suffix
	 * @var string
	 */

	protected $screen_suffix = null;

	/*
	 * Instance of the class
	 * @var object
	 */

	protected static $instance = null;

	/*
	 * Get Instance of the class
	 * @return object ( single instance of this class )
	 */

	/**
	 * @return null
	 */
	public static function getInstance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
			self::$instance->register_hooks();
		}

		return self::$instance;
	}


	/*
	 * Initialize the plugin
	 */

	private function __construct() {

		$plugin = Plugin::getInstance();
		$this->text_domain = $plugin->getTextDomain();
		$this->plugin_version = $plugin-> getPluginVersion();
		$this->base_name = plugin_basename( plugin_dir_path( realpath( dirname( __FILE__))).$this->plugin_slug.'.php');
	}

	private function register_hooks(){
		add_action('admin_menu', array( $this , 'infomate_admin_menu'));
		add_action('admin_enqueue_scripts', array( $this , 'infomate_styles_and_scripts'));
	}

	public function infomate_admin_menu(){
		$this->screen_suffix = add_menu_page(
			__('WPInfomate',$this->text_domain),
			__('WPInfo',$this->text_domain),
			'manage_options',
			$this->text_domain,
			array( $this , 'display_wpinfomate_admin'),
            'dashicons-info'
		);
	}

	public function display_wpinfomate_admin(){

		?>
		  <div id="wp-info-admin"></div>
		<?php
	}

	public function infomate_styles_and_scripts(){

	    if( !isset( $this->screen_suffix)){
	        return;
        }

        $screen = get_current_screen();
	    if( $this->screen_suffix == $screen->id ){
	        wp_enqueue_script( $this->text_domain.'-admin-script', plugins_url('assets/js/admin.js', dirname(__FILE__)), array(), $this->plugin_version );
	        wp_localize_script( $this->text_domain.'-admin-script','wpr_object', array(
	           'api_nonce' => wp_create_nonce('wp_rest'),
                'api_url' => rest_url($this->text_domain.'/v/1/')
            ));
	        wp_enqueue_style($this->text_domain.'-admin-styles', plugins_url('assets/css/admin.css' , dirname( __FILE__)),$this->plugin_version);
        }
    }
}