<?php 

if (!defined('ABSPATH')){
	exit; 
}

/**
 * 
 */
function _maple_generate_block_field_group(
    string $block_name, 
    string $block_title, 
    array $block_fields
){
    if(count($block_fields) < 1){
        return false;
    }

    return array(
        'key' => sprintf("group_block_%s", $block_name),
        'title' => $block_title,
        'fields' => _maple_validate_fields(
            $block_name, 
            $block_fields, 
            0
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '===',
                    'value' => $block_name
                )
            )
        )
    );
}