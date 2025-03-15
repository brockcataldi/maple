<?php 

if (!defined('ABSPATH')){
	exit; 
}

class Maple_Source {
    /**
     * 
     */
    private array $acf_blocks = array();

    /**
     * 
     */
    private string $path;

    /**
     * 
     */
    public function __construct(string $path){
        $this->path = wp_normalize_path(trailingslashit($path));
    }

    /**
     * 
     */
    public function after_setup_theme(){
        $blocks_path = path_join($this->path, 'blocks');

        if(true === is_dir($blocks_path)){
            $this->acf_blocks = $this->find_acf_blocks(path_join($blocks_path, 'acf'));
        }
    }

    /**
     * 
     */
    public function init(){
        foreach($this->acf_blocks as $acf_block){
            $acf_block->register_block();
        }
    }

    /**
     * 
     */
    public function acf_init(){
        foreach($this->acf_blocks as $acf_block){
            $acf_block->register_field_group();
        }
    }

    /**
     * 
     */
    private function find_acf_blocks($acf_blocks_path){
        $result = array();
        $paths = _maple_find_directories($acf_blocks_path);

        foreach($paths as $path){
            $result[] = new Maple_Block($path);
        }
        
        return $result;
    }
}