<?php

/**
 * Parent Iterator class for all our parsers
 */
class ParserRssIterator implements Iterator{
    protected
        $url  = NULL,
        $i    = NULL,
        $data = NULL,
        $size = NULL,
        $rss  = NULL,
        $page = NULL
   ;
    
    public function __construct( $url='' ){        
        if( !empty($url) ) $this->url = $url;
        
        $this->rss  = new SimplePie( $this->url );
        $this->data = $this->rss->get_items(0, 15); // read only last 15 items
        $this->size = count( $this->data );
    }
    
    public function __destruct(){
        unset( $this->rss );
        unset( $this->data );
    }

    public function rewind() {
        $this->i = 0;
    }
    
    /**
     * Get item's object
     * 
     * @return SimplePie_Item
     */
    public function current() {
        return $this->data[ $this->i ];
    }

    public function key() {
        return $this->i;
    }

    public function next() {
        ++$this->i;
    }

    public function valid() {
        return isset( $this->data[ $this->i ] );
    }
    
    /**
     * Read page html content
     * 
     * @param string $url
     * @return \Thaivisa 
     */
    protected function get_page( $url='' ){
        if( !empty($url) ) $this->page = file_get_contents( $url );
        return $this;
    }    
}