<?php 

if (!defined('ABSPATH')){
	exit; 
}

/**
 * 
 */
function _maple_validate_fields(
    string $name, 
    array $fields, 
    int $depth
){

    $_fields = array();

    foreach($fields as $field){
        $_missing_keys = array();

        if(false === isset($field['key'])){
            $_missing_keys['key'] = sprintf('%s_%sfield_%s',
                $name,
                str_repeat('sub_', $depth),
                $field['name']
            );
        }

        if(true === isset($field['sub_fields'])){
            $_missing_keys['sub_fields'] = _maple_validate_fields(
                $name,
                $field['sub_fields'], 
                $depth + 1
            );
        }

        $_fields[] = array_merge($field, $_missing_keys);
    }

    return $_fields;
}