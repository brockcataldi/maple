<?php
/**
 * The _maple_validate_fields function.
 *
 * Housing the _maple_validate_fields function.
 *
 * @package Maple
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The _maple_validate_fields function.
 *
 * Autokeys the fields array and objects.
 *
 * @since 1.0.0
 *
 * @param string $name the slug / path name of the group.
 * @param array  $fields the fields array.
 * @param int    $depth how many repeaters this is nested in.
 *
 * @return array the fields array for acf_add_local_field_group.
 */
function _maple_validate_fields(
	string $name,
	array $fields,
	int $depth
) {

	$_fields = array();

	foreach ( $fields as $field ) {
		$_missing_keys = array();

		if ( false === isset( $field['key'] ) ) {
			$_missing_keys['key'] = sprintf(
				'%s_%sfield_%s',
				$name,
				str_repeat( 'sub_', $depth ),
				$field['name']
			);
		}

		if ( true === isset( $field['sub_fields'] ) ) {
			$_missing_keys['sub_fields'] = _maple_validate_fields(
				$name,
				$field['sub_fields'],
				$depth + 1
			);
		}

		$_fields[] = array_merge( $field, $_missing_keys );
	}

	return $_fields;
}
