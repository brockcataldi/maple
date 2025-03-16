<?php
/**
 * Maple Base Class
 *
 * Housing the Maple class.
 *
 * @package Maple
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Maple Class
 *
 * The primary class of the plugin, meant to bind hooks and filters to the rest of the system.
 *
 * @since 1.0.0
 */
class Maple {

	/**
	 * The Maple_Sources array.
	 *
	 * @since 1.0.0
	 * @var array $sources the array of bound Maple_Sources.
	 */
	private array $sources = array();

	/**
	 * Maple Constructor.
	 *
	 * Literally does nothing.
	 */
	private function __construct() {}


	/**
	 * Bind Function.
	 *
	 * Binds actions to the matching functions.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function bind() {
		add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ) );
		add_action( 'init', array( $this, 'init' ) );
		add_action( 'acf/init', array( $this, 'acf_init' ) );
	}

	/**
	 * The after_setup_theme Function.
	 *
	 * The function that hooks into after_setup_theme. Does the filter where plugins and themes bind to Maple.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function after_setup_theme() {
		$source_paths = apply_filters( 'maple', array() );

		foreach ( $source_paths as $source_path ) {
			$source = new Maple_Source( $source_path );
			$source->after_setup_theme();
			$this->sources[] = $source;
		}
	}


	/**
	 * The init Function.
	 *
	 * The function that hooks into init. This calls all of the sources init functions.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function init() {
		foreach ( $this->sources as $source ) {
			$source->init();
		}
	}

	/**
	 * The acf_init Function.
	 *
	 * The function that hooks into acf/init. This calls all of the sources acf_init functions.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function acf_init() {
		foreach ( $this->sources as $source ) {
			$source->acf_init();
		}
	}

	/**
	 * The initialize Function.
	 *
	 * This is the static function that creates the class and starts the plugin.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public static function initialize() {
		$maple = new Maple();
		$maple->bind();
	}
}
