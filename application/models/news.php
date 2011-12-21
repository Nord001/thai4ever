<?php

/**
 * News data model
 *
 * @version 1.0
 * @author Ibragimov "MpaK" Renat <info@mrak7.com>
 * @copyright Copyright (c) 2012, AOmega, http://aomega.ru
 * 
 * @property string $table 
 */
class News extends MY_Model{
    protected
        $table = 'news'
     ;    
    
    public function __construct(){
        parent::__construct();        
    }
    
}