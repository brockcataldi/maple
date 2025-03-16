<?php
/**
 * The _maple_generate_block_field_group function.
 *
 * Housing the _maple_generate_block_field_group function.
 *
 * I have an interest in maybe not keeping this in a function and moving it back to the class, because we'll only use this once.
 *
 * @package Maple
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The _maple_generate_block_field_group function.
 *
 * Creates the valid array for the acf_add_local_field_group functions.
 *
 * @since 1.0.0
 *
 * @param string $block_name the slug / path name of the block.
 * @param string $block_title the title of the block.
 * @param array  $block_fields the fields array.
 *
 * @return array the param array for acf_add_local_field_group.
 */
function _maple_generate_block_field_group(
	string $block_name,
	string $block_title,
	array $block_fields
) {
	if ( count( $block_fields ) < 1 ) {
		return false;
	}

	return array(
		'key'      => sprintf( 'group_block_%s', $block_name ),
		'title'    => $block_title,
		'fields'   => _maple_validate_fields(
			$block_name,
			$block_fields,
			0
		),
		'location' => array(
			array(
				array(
					'param'    => 'block',
					'operator' => '===',
					'value'    => $block_name,
				),
			),
		),
	);
}
