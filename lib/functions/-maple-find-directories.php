<?php
/**
 * The _maple_find_directories function.
 *
 * Housing the _maple_find_directories function.
 *
 * @package Maple
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The _maple_find_directories function.
 *
 * Scans a directory and returns a list of sub directories.
 *
 * @since 1.0.0
 *
 * @param string $path the path of the directory to scan.
 *
 * @return array the array of directory paths found at the path.
 */
function _maple_find_directories( string $path ) {
	$result = array();

	if ( true === is_dir( $path ) ) {
		foreach ( new DirectoryIterator( $path ) as $file ) {

			if ( true === $file->isDot() ) {
				continue;
			}

			$file_name = $file->getFilename();
			$file_path = path_join( $path, $file_name );

			if ( false === is_dir( $file_path ) ) {
				continue;
			}

			$result[] = $file_path;
		}
	}
	return $result;
}
