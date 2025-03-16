<?php
/**
 * Maple Models
 *
 * This includes all of the classes used in the system.
 *
 * @package Maple
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( false === class_exists( 'Maple_Block' ) ) {
	require_once MAPLE_MODELS . 'class-maple-block.php';
}

if ( false === class_exists( 'Maple_Source' ) ) {
	require_once MAPLE_MODELS . 'class-maple-source.php';
}
