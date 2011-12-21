<?php

/**
 * Parser Class Loader & Factory create method
 */
class ParserFactory{
    static public function create( $name ){
        $file_name  = $name.'.php';
        $class_name = ucfirst( $name );
        if( !file_exists( PARSERS.$file_name ) ) throw new Exception( 'Can not find parser file '.$file_name );
        require_once( PARSERS.$file_name );
        return new $class_name;
    }
}