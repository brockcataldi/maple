<?php 

if (!defined('ABSPATH')){
	exit; 
}

/**
 * 
 */
function _maple_find_directories($acf_blocks_path){
    $result = array();

    if(true === is_dir($acf_blocks_path)){
        foreach(new DirectoryIterator($acf_blocks_path) as $file){

            if(true === $file->isDot()){
                continue;
            }

            $file_name = $file->getFilename();
            $file_path = path_join($acf_blocks_path, $file_name);

            if(false === is_dir($file_path)){
                continue;
            }

            $result[] = $file_path;
        }  
    }
    return $result;
}