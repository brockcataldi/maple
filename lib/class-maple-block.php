<?php 

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
    
        return !($registered === false);
    }

    /**
     * 
     */
    public function register_field_group(){

        $field_group = $this->get_field_group();

        if(false == $field_group){
            return false;
        }

        acf_add_local_field_group($field_group);

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

        return $this->generate_field_group(
            $block_json['name'], 
            $block_json['title'], 
            $block_json['acf']['fields']
        );
    }

    /**
     * 
     */
    private function generate_field_group(
        string $block_name, 
        string $block_title, 
        array $block_fields
    ){

        if(count($block_fields) < 1){
            return false;
        }

        return array(
            'key' => sprintf("group_%s", $block_name),
            'title' => $block_title,
            'fields' => $this->generate_fields(
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

    /**
     * 
     */
    private function generate_fields(
        string $block_name, 
        array $fields, 
        int $depth
    ){

        $_fields = array();

        foreach($fields as $field){
            $_missing_keys = array();

            if(false === isset($field['key'])){
                $_missing_keys['key'] = sprintf('%s_%sfield_%s',
                    $block_name,
                    str_repeat('sub_', $depth),
                    $field['name']
                );
            }

            if(true === isset($field['sub_fields'])){
                $_missing_keys['sub_fields'] = $this->generate_fields(
                    $block_name,
                    $field['sub_fields'], 
                    $depth + 1
                );
            }

            $_fields[] = array_merge($field, $_missing_keys);
        }

        return $_fields;
    }
}