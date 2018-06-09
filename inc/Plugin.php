<?php

/*
 * WPInfomate
 *
 * @package WPInfomate
 * @author dazunj
 *
 */

namespace WPInfomate;

class Plugin{

	/*
	 * text-domain
	 * @var string
	 */

	protected $text_domain = 'wp-infomate';

	/*
	 * Instance of the class
	 * @var object
	 */

	protected static $instance = null;

	/*
	 * Constructor
	 */

	private function __construct() {
		$this->plugin_version = WPINFOMATE_VERSION;
	}


	/**
	 * Get text-domain
	 * @return string
	 */
	public function getTextDomain() {
		return $this->text_domain;
	}

	/**
	 * Get plugin version
	 * @return string
	 */
	public function getPluginVersion() {
		return $this->plugin_version;
	}

	/**
	 * Return instance of this class
	 * @return object
	 */
	public static function getInstance() {
		if( null == self::$instance){
			self::$instance = new self;
		}
		return self::$instance;
	}



}