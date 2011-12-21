<?php

/**
 * ThaiVisa.com news parsers and translator
 */
class Thaivisa extends ParserRssIterator {    
    public
        $tr   = NULL
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
        $val  = array();
        
        $item = parent::current();        
        $val['orig_title']   = trim( $item->get_title() );
        $val['link']         = trim( $item->get_link() );
        $val['source']       = $val['link'];
        $val['date']         = $item->get_date();
        // get page and find content
        $val['orig_content'] = $this->get_page( $val['link'] )->parse_content();        
        // translate
        $val['title']   = $this->tr->translate(clean_html($val['orig_title']),   'en', 'ru');
        $val['content'] = $this->tr->translate(clean_html($val['orig_content']), 'en', 'ru');
        $val['alias']   = nice_title( $val['title'] );
        
        return new ParserItem( $val );
    }
    

    
    protected function parse_content(){
        //class='post entry-content '> bla-bla  </div>
        $m = array();   // we will keep here
        list( $t, $text ) = explode( "<div class='post entry-content '>", $this->page );
        list( $text, $t ) = explode( '</div>', $text );
        return $text;
    }
    
}