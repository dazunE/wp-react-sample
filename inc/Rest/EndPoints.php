<?php
/**
 * Created by PhpStorm.
 * User: jkcs-dasun
 * Date: 5/4/18
 * Time: 14:32
 */

namespace WPInfomate\Rest;
use WPInfomate;


class EndPoints {

	/*
	 * Instance of this class
	 * @var object
	 */

	protected static $instance;

	/*
	 * Constructor of the class
	 *
	 */

	private function __construct() {

		$plugin = WPInfomate\Plugin::getInstance();
		$this->text_domain = $plugin->getTextDomain();

	}

	/*
	 * Get instance of the class
	 * @var object
	 */

	public static function getInstance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
			self::$instance->register_hooks();
		}

		return self::$instance;
	}

	/*
	 * Register hooks to inti Rest API
	 */

	public function register_hooks(){

		add_action('rest_api_init',array( $this , 'register_rest_endpoints'));

	}

	public function register_rest_endpoints(){

		$version = '1';
		$namespace = $this->text_domain.'/v/'.$version;

		register_rest_route( $namespace, 'server', array(
			array(
				'methods'               => \WP_REST_Server::READABLE,
				'callback'              => array( $this, 'get_server_info' ), // Set to our renamed 'get' callback function
				'permission_callback'   => array( $this, 'admin_permissions_check' ),
				'args'                  => array(),
			),
		) );

		register_rest_route( $namespace, 'wpinfo', array(
			array(
				'methods'               => \WP_REST_Server::READABLE,
				'callback'              => array( $this, 'get_wp_info' ), // Set to our renamed 'get' callback function
				'permission_callback'   => array( $this, 'admin_permissions_check' ),
				'args'                  => array(),
			),
		) );

	}

	public function get_server_info( $request ){

		global $wpdb;

		$data = array(

			'os' => php_uname('s'),
			'server_ip' => $_SERVER['SERVER_ADDR'],
			'server_hostname' => php_uname('n'),
			'server_protocol' => $_SERVER['SERVER_PROTOCOL'],
			'server_admin' => $_SERVER['SERVER_ADMIN'],
			'server_port' => $_SERVER['SERVER_PORT'],
			'php_version' => phpversion(),
			'mysql_version' => $wpdb->db_version(),
			'php_memory_limit' => ini_get('memory_limit'),
			'cgi_version' => $_SERVER['GATEWAY_INTERFACE'],
			'uptime' => exec("uptime", $system)
		);
		$response = array();

		foreach ( $data as $key => $value ){
			$info = array(
				'name' => $key,
				'value' => $value
			);

			array_push( $response, $info);
		}


		return new \WP_REST_Response( $response );
	}

	public function get_wp_info(){

		$data = array(
				'active_theme' => esc_html(wp_get_theme()->get('Name')),
				'hostname' => DB_HOST,
				'db_username' => DB_USER,
				'db_name' => DB_NAME,
				'db_charset' => DB_CHARSET,
				'debugging' => WP_DEBUG ? "Enabled" : "Disabled",
				'memory_limit' => WP_MEMORY_LIMIT
		);

		$response = array();

		foreach ( $data as $key => $value ){
			$info = array(
				'name' => $key,
				'value' => $value
			);

			array_push( $response, $info);
		}


		return new \WP_REST_Response( $response );

	}

	public function admin_permissions_check( $request ){
		return current_user_can('manage_options');
	}
}