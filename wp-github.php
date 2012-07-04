<?php
/*
Plugin Name: WP-Github
Plugin URI: http://www.github.com/johnciacia/wp-github
Description: Display your GitHub repositories in posts
Version: 1.0
Author: johnciacia
Author URI: http://www.johnciacia.com
License: GPL2
*/

if( ! class_exists( 'WP_Github' ) ) {
	class WP_Github {

		public static $REPO_ID = 1;

		public static function initialize() {
			add_action( 'wp_enqueue_scripts', array( __CLASS__, 'wp_enqueue_scripts' ) ); 
			add_shortcode( 'repo', array( __CLASS__, 'repo' ) );
		}

		public static function wp_enqueue_scripts() {
			wp_enqueue_script( 'repo.js', plugins_url( 'repo.min.js', __FILE__ ), array('jquery'), '399420bd2bde8178aeec5463bd86b428a27cd34a', true );
		}

		public static function repo( $atts ) {
			if( ! isset( $atts['user'], $atts['name'] ) ) return '';

			$out = '<div id="repo_' . self::$REPO_ID . '"></div>';
			$out .= '<script type="text/javascript">';
			$out .= 'jQuery( document ).ready( function($) { ';
			$out .= '  $( "#repo_' . self::$REPO_ID++ . '" ).repo( ' . json_encode($atts) . ' );';
			$out .= '});';
			$out .= '</script>';

			return $out;
		}

	}

	WP_Github::initialize();
}