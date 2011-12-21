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

require_once( LIBS.'BingTranslateLib/BingTranslate.class.php');

class ThaiSpyder{
    protected
        $db     = NULL,
        $tr     = NULL,
        $config = array()
    ;
    
    public function __construct( $config=array() ){
        if( empty($config) ) throw new Exception( 'You should use $config array in the config.php file' );
        $this->config = $config;
    }
    
    public function connect(){
        $this->db = new PDO( $this->config['DB']['dsn'], $this->config['DB']['user'], $this->config['DB']['psw'] );
        // set UTF-8 as default charset
        $this->db->query( 'SET NAMES "utf8"' );
        $this->db->query( 'SET sql_mode = default' );
        // @todo: put your value from MS
        $this->tr = new BingTranslateWrapper('---YOUR CODE---');
        $this->tr->cacheEnabled( true );
        // @todo: 4refactoring maybe will better to keep this object inside the ParserFactory?
    }
    
    /**
     * Parse news and keep them in the DB 
     */
    public function parse_news(){
        foreach( $this->config['NEWS_PARSERS'] as $parser_name ){
            //
            $parser     = ParserFactory::create( $parser_name );
            $parser->tr = $this->tr; // maybe they want to translate something?
            foreach( $parser as $item ){
                if( $this->is_new($item->link) )
                    $this->save_news_item ( $item );
                /*
                echo "-------------------------------------------------------\n";
                echo $item->title."\n";
                echo $item->date."\n";
                echo $item->link."\n";
                 */
            }
        }
    }

    /*---- Private ---*/
    
    protected function is_new( $link ){
		try{
	    	$q = $this->db->prepare('SELECT id FROM `news` WHERE crc=:crc LIMIT 1');
    		$r = $q->execute( array( ':crc'=>(string)sha1($link) ) );
    		$r = $q->fetch( PDO::FETCH_ASSOC );
    	} catch (PDOException $e) {
 			return TRUE;
        }
    	if( empty($r) ) return TRUE;
        return FALSE;
    }
    
    protected function save_news_item( $item ){
		try{
            $q = $this->db->prepare(
                'INSERT INTO `news`
                (`crc`, `added_at`, `title`, `alias`, `content`, `author`, `source`, `orig_title`, `orig_content`)
                VALUES
                (:crc, :added_at, :title, :alias, :content, :author, :source, :orig_title, :orig_content)'
            );
            $q->execute( array(
                ':crc'          => (string)sha1( $item->link ),
                ':added_at'     => (string)mysql_date( $item->date ),
                ':title'        => (string)$item->title,
                ':alias'        => (string)$item->alias,
                ':content'      => (string)$item->content,
                ':author'       => (string)$item->author,
                ':source'       => (string)$item->source,
                ':orig_title'   => (string)$item->orig_title,
                ':orig_content' => (string)$item->orig_content,
                
            ));
		} catch (PDOException $e) {
 			return FALSE;
        }        
    }
    
    
}

try{
    $spyder = new ThaiSpyder( $config );
    $spyder->connect();
    $spyder->parse_news();
}catch( Exception $e ){
    //var_dump( $e );
    die( 'Exception: '.$e->getMessage() );
}