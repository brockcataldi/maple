<?php 
/*
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

if (!defined('ABSPATH')){
	exit; 
}

if(!defined('MAPLE_LIB')){
    define('MAPLE_LIB', trailingslashit(path_join(plugin_dir_path(__FILE__), 'lib' )));
}

require_once MAPLE_LIB . 'class-maple-block.php';
require_once MAPLE_LIB . 'class-maple-source.php';
require_once MAPLE_LIB . 'class-maple.php';

Maple::initialize();