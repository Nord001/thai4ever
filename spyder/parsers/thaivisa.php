<?php

/**
 * ThaiVisa.com news parsers and translator
 */
class Thaivisa extends ParserRssIterator {
    protected
        $page = NULL
    ;
    
    /**
     * Init Thaivisa parser
     * @param string $url 
     */
    public function __construct( $url='' ){
        parent::__construct( 'http://www.thaivisa.com/forum/rss/forums/1-thailand-news-thaivisacom/' );
    }
    
    /**
     * Prepare and return current item
     * 
     * @return \ParserItem 
     */
    public function current() {
        $item = parent::current();
        $val  = array();
        $val['title']   = $item->get_title();
        $val['link']    = $item->get_link();
        $val['date']    = $item->get_date();
        // get page and find content
        $val['content'] = $this->get_page( $val['link'] )->parse_content();        
        return new ParserItem( $val );
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
    
    protected function parse_content(){
        //class='post entry-content '        </div>
        $m = array();   // we will keep here
        list( $t, $text ) = explode( "<div class='post entry-content '>", $this->page );
        list( $text, $t ) = explode( '</div>', $text );
        return $text;
    }
    
}