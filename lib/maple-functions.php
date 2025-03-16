<?php
/**
 * Maple Functions
 *
 * This includes all of the internal functions used in the system.
 *
 * @package Maple
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( false === function_exists( '-maple-find-directories' ) ) {
	require_once MAPLE_FUNCTIONS . '-maple-find-directories.php';
}

if ( false === function_exists( '-maple-validate-fields' ) ) {
	require_once MAPLE_FUNCTIONS . '-maple-validate-fields.php';
}

if ( false === function_exists( '-maple-generate-block-field-group' ) ) {
	require_once MAPLE_FUNCTIONS . '-maple-generate-block-field-group.php';
}
