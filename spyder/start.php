<?php
error_reporting( E_ALL ^ E_NOTICE ^ E_DEPRECATED );

date_default_timezone_get( 'Asia/Bangkok' ); // timezone (default: php.ini date.timezone)
mb_internal_encoding( 'UTF-8' ); // everythin in UTF-8
ini_set( 'default_charset', 'UTF-8' );

define( 'ROOT', './' );
define( 'LIBS', ROOT.'libs/' );
define( 'PARSERS', ROOT.'parsers/' );

require_once( LIBS.'helpers.php' );            // functions for help

require_once( ROOT.'config.php' );             // main config file
require_once( LIBS.'simplepie.inc' );          // class for parse RSS
require_once( LIBS.'parserrssiterator.php' );  // parent class for all parsers
require_once( LIBS.'parserfactory.php' );      // our factory method for parsers
require_once( LIBS.'parseritem.php' );         // our factory method for parsers


class ThaiSpyder{
    protected
        $db     = NULL,
        $config = array()
    ;
    
    public function __construct( $config=array() ){
        if( empty($config) ) throw new Exception( 'You should use $config array in the config.php file' );
        $this->config = $config;
    }
    
    public function connect(){
        //var_dump( $this->config );
        $this->db = new PDO( $this->config['DB']['dsn'], $this->config['DB']['user'], $this->config['DB']['psw'] );
        // set UTF-8 as default charset
        $this->db->query( 'SET NAMES "utf8"' );
        $this->db->query( 'SET sql_mode = default' );        
    }
    
    public function parse_news(){
        foreach( $this->config['NEWS_PARSERS'] as $parser_name ){
            $parser = ParserFactory::create( $parser_name );
            foreach( $parser as $item ){
                echo "-------------------------------------------------------\n";
                echo $item->title."\n";
                echo $item->date."\n";
                echo $item->link."\n";
                echo clean_html($item->content)."\n";
            }
        }
    }
    
    /*---- Private ---*/
    
}

try{
    $spyder = new ThaiSpyder( $config );
    $spyder->connect();
    $spyder->parse_news();
}catch( Exception $e ){
    //var_dump( $e );
    die( 'Exception: '.$e->getMessage() );
}