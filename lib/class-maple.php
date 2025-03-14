<?php 

if (!defined('ABSPATH')){
	exit; 
}

class Maple {

    /**
     * 
     */
    private array $sources = array();

    /**
     * 
     */
    private function __construct(){}

    /**
     * 
     */
    public function bind(){
        add_action('after_setup_theme', array($this, 'after_setup_theme'));
        add_action('init', array($this, 'init'));
        add_action('acf/init', array($this, 'acf_init'));
    }

    /**
     * 
     */
    public function after_setup_theme(){
        $source_paths = apply_filters('maple/register', array());

        foreach($source_paths as $source_path){
            $source = new Maple_Source($source_path);
            $source->after_setup_theme();
            $this->sources[] = $source;
        }
    }

    /**
     * 
     */
    public function init(){
        foreach($this->sources as $source){
            $source->init();
        }
    }

    /**
     * 
     */
    public function acf_init(){
        foreach($this->sources as $source){
            $source->acf_init();
        }
    }

    /**
     * 
     */
    public static function initialize(){
        $maple = new Maple();
        $maple->bind();
    }
}