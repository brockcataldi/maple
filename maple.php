<?php
/**
 * Maple Entry Point File
 *
 * The file where everything is being included and the Maple class is started.
 *
 * @package Maple
 * @since 1.0.0
 *
 * Plugin Name:       Maple
 * Plugin URI:
 * Description:       Modular Bridge
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      8.2
 * Author:            Brock Cataldi
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       maple
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'MAPLE_LIB' ) ) {
	define( 'MAPLE_LIB', trailingslashit( path_join( plugin_dir_path( __FILE__ ), 'lib' ) ) );
}

if ( ! defined( 'MAPLE_FUNCTIONS' ) ) {
	define( 'MAPLE_FUNCTIONS', trailingslashit( path_join( MAPLE_LIB, 'functions' ) ) );
}

if ( ! defined( 'MAPLE_MODELS' ) ) {
	define( 'MAPLE_MODELS', trailingslashit( path_join( MAPLE_LIB, 'models' ) ) );
}

require_once MAPLE_LIB . 'maple-functions.php';
require_once MAPLE_LIB . 'maple-models.php';
require_once MAPLE_LIB . 'class-maple.php';

Maple::initialize();
