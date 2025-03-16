<?php
/**
 * Maple Source
 *
 * Contains the Maple_Source class.
 *
 * @package Maple
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Maple Source
 *
 * The class meant to house all of the scope of either a theme or plugin.
 *
 * @package Maple
 * @since 1.0.0
 */
class Maple_Source {

	/**
	 * The Maple_Blocks array.
	 *
	 * @since 1.0.0
	 * @var array $sources the array of found Maple_Blocks.
	 */
	private array $acf_blocks = array();

	/**
	 *  The path of the Source.
	 *
	 * @since 1.0.0
	 * @var string $path The path of the Source.
	 */
	private string $path;

	/**
	 * Maple_Source Constructor.
	 *
	 * Sets the source path, and normalizes it.
	 *
	 * @param string $path the path of the source.
	 */
	public function __construct( string $path ) {
		$this->path = wp_normalize_path( trailingslashit( $path ) );
	}


	/**
	 * The after_setup_theme Function.
	 *
	 * The function called by the Maple base class at the after_setup_theme Hook.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function after_setup_theme() {
		$blocks_path = path_join( $this->path, 'blocks' );

		if ( true === is_dir( $blocks_path ) ) {
			$this->acf_blocks = $this->find_acf_blocks( path_join( $blocks_path, 'acf' ) );
		}
	}

	/**
	 * The init Function.
	 *
	 * The function called by the Maple base class at the init Hook.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function init() {
		foreach ( $this->acf_blocks as $acf_block ) {
			$acf_block->register_block();
		}
	}

	/**
	 * The acf/init Function.
	 *
	 * The function called by the Maple base class at the acf/init Hook.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function acf_init() {
		foreach ( $this->acf_blocks as $acf_block ) {
			$acf_block->register_field_group();
		}
	}

	/**
	 * The acf_find_blocks function.
	 *
	 * Looks through the /block/acf/ directory, and converts the list to Maple_Blocks.
	 *
	 * @since 1.0.0
	 * @param string $acf_blocks_path The path of the ACF Folder.
	 *
	 * @return array the Maple_Blocks array.
	 */
	private function find_acf_blocks( $acf_blocks_path ) {
		$result = array();
		$paths  = _maple_find_directories( $acf_blocks_path );

		foreach ( $paths as $path ) {
			$result[] = new Maple_Block( $path );
		}

		return $result;
	}
}
