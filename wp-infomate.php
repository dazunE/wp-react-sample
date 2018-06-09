<?php

/*
Plugin Name: WPInfoMate
Plugin URI: http://dasun.blog/infomate
Description: A small plugin to check your site's Configurations Info
Author: dazunj
Author URI: http://dasun.blog
License: GPL v3
*/

namespace WPInfomate;

// Abort the direct access

use WPInfomate\Rest\EndPoints;

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'WPINFOMATE_VERSION', '1.0' );

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {

	require( __DIR__ . '/vendor/autoload.php' );

} else {

	function infomate_spl_autoload_register( $classes ) {

		$prefix = 'WPInfomate';

		if ( stripos( $classes, $prefix ) === false ) {
			return;
		}

		$file_path = __DIR__ . '/inc/' . str_ireplace( 'WPInfomate\\', '', $classes ) . '.php';
		$file_path = str_replace( '\\', DIRECTORY_SEPARATOR, $file_path );


		include_once( $file_path );
	}

	spl_autoload_register( 'WPInfomate\infomate_spl_autoload_register' );
}


function initialize() {


	Plugin::getInstance();
	Admin::getInstance();
	Rest\EndPoints::getInstance();
}

add_action( 'plugins_loaded', 'WPInfomate\initialize' );
