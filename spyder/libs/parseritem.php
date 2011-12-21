<?php

/**
 * ParserItem
 */
class ParserItem{
    protected $title, $link, $content, $date;

    public function __construct( $val=array() ){
        // keep in safe :=)
        if( !empty($val) ){
            $this->title   = $val['title'];
            $this->link    = $val['link'];
            $this->date    = $val['date'];
            $this->content = $val['content'];
        }
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