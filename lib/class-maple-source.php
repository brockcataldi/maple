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

        if(true == is_dir($blocks_path)){
            $this->acf_blocks = $this->gather_acf_blocks(path_join($blocks_path, 'acf'));
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
    private function gather_acf_blocks($acf_blocks_path){
        $result = array();

        if(true == is_dir($acf_blocks_path)){
            foreach(new DirectoryIterator($acf_blocks_path) as $file){

                if(true == $file->isDot()){
                    continue;
                }

                $file_name = $file->getFilename();
                $file_path = path_join($acf_blocks_path, $file_name);

                if(false == is_dir($file_path)){
                    continue;
                }

                $result[] = new Maple_Block($file_path);
            }  
        }

        return $result;
    }
}