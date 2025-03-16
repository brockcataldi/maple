<?php
/**
 * Maple Block
 *
 * Contains the Maple_Block class.
 *
 * @package Maple
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Maple Block
 *
 * The "acf" blocks class, meant to do all of the heavy lifting for the acf blocks.
 *
 * @package Maple
 * @since 1.0.0
 */
class Maple_Block {

	/**
	 *  The path of the ACF Block.
	 *
	 * @since 1.0.0
	 * @var string $path The path of the ACF Block.
	 */
	public string $path;

	/**
	 * Maple_Block Constructor.
	 *
	 * Sets the block path.
	 *
	 * @param string $path the path of the Block.
	 */
	public function __construct( string $path ) {
		$this->path = $path;
	}

	/**
	 * The register_block Function.
	 *
	 * Registers the block at at the block path, via register_block_type
	 *
	 * @see register_block_type
	 *
	 * @return boolean whether or not the block was registered.
	 */
	public function register_block() {
		$registered = register_block_type( $this->path );
		return $registered instanceof WP_Block_Type;
	}

	/**
	 * The register_field_group Function.
	 *
	 * Registers the custom "fields" property on the block.json file.
	 *
	 * @see acf_add_local_field_group
	 *
	 * @return boolean whether or not the field group was registered.
	 */
	public function register_field_group() {

		$field_group = $this->get_field_group();

		if ( false === $field_group ) {
			return false;
		}

		if ( false !== function_exists( 'acf_add_local_field_group' ) ) {
			acf_add_local_field_group( $field_group );
		}

		return true;
	}

	/**
	 * The get_field_group Function.
	 *
	 * Gets and validates the custom "fields" property on the block.json file.
	 *
	 * @see _maple_generate_block_field_group
	 *
	 * @return array|boolean either the field group array or false if there's an error.
	 */
	public function get_field_group() {
		$block_json_path = path_join( $this->path, 'block.json' );

		if ( false === is_file( $block_json_path ) ) {
			return false;
		}

		$block_json = wp_json_file_decode( $block_json_path, array( 'associative' => true ) );

		if ( true === is_null( $block_json ) ) {
			return false;
		}

		return _maple_generate_block_field_group(
			$block_json['name'],
			$block_json['title'],
			$block_json['acf']['fields']
		);
	}
}
