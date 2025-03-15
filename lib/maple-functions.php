<?php 

if (!defined('ABSPATH')){
	exit; 
}

if(false === function_exists('_maple_find_directories')){
    require_once MAPLE_FUNCTIONS . '_maple_find_directories.php';
}

if(false === function_exists('_maple_validate_fields')){
    require_once MAPLE_FUNCTIONS . '_maple_validate_fields.php';
}

if(false === function_exists('_maple_generate_block_field_group')){
    require_once MAPLE_FUNCTIONS . '_maple_generate_block_field_group.php';
}
