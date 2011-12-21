<?php

/**
 * ParserItem
 */
class ParserItem{
    protected
        $crc, $title, $alias, $link, $content, $date, $source, $author, 
        $orig_title, $orig_content
    ;

    public function __construct( $val=array() ){
        // keep in safe :=) dummy yet
        if( !empty($val) AND is_array($val) ) foreach( $val as $k=>$v ) $this->$k = $v;        
    }
    
    /**
     * David Blaine and his magic!
     * 
     * @param  string $name key's name
     * @return mixed
     */
    public function __get( $name ){
        return $this->$name;
    }
    
}