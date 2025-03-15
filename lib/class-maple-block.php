<?php 

if (!defined('ABSPATH')){
	exit; 
}

class Maple_Block{
    
    /**
     * 
     */
    public string $path;
    
    /**
     * 
     */
    public function __construct(string $path){
        $this->path = $path;
    }

    /**
     * 
     */
    public function register_block(){
        $registered = register_block_type($this->path);
        return $registered instanceof WP_Block_Type;
    }

    /**
     * 
     */
    public function register_field_group(){

        $field_group = $this->get_field_group();

        if(false === $field_group){
            return false;
        }

        if(false !== function_exists('acf_add_local_field_group')){
            acf_add_local_field_group($field_group);
        }

        return true;

    }

    /**
     * 
     */
    public function get_field_group(){
        $block_json_path = path_join($this->path, 'block.json');

        if(false == is_file($block_json_path)){
            return false;
        }

        $block_json = wp_json_file_decode($block_json_path, array('associative' => true));

        if(true == is_null($block_json)){
            return false;
        }

        return _maple_generate_block_field_group(
            $block_json['name'], 
            $block_json['title'], 
            $block_json['acf']['fields']
        );
    }
}