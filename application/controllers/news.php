<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * News controller
 *
 * @version 1.0
 * @author Ibragimov "MpaK" Renat <info@mrak7.com>
 * @copyright Copyright (c) 2012, AOmega, http://aomega.ru
 */
class NewsController extends MY_Controller {
    /**
     * Views directory
     * 
     * @var string
     */
    protected $view = 'news/';
    
    public function __construct(){
        parent::__construct();
        //$this->output->enable_profiler( TRUE );
    }
    
    /**
     * Show search form on the main page
     */
    public function index(){
        $data = array();
        
        $this->load->model( array('news') );
        
        $data['news'] = $this->news->find();
        // render template and show layout
        $this->template->render_to( 'content', $this->view.'index', $data )->show();
    }
    /**
     * Show object's full information
     * 
     * @param integer $id 
     */
    public function show( $id='', $alias = '' ){
        $data = array();
        if( empty($id) ) show_404 ();
        
        $this->load->model( array('news') );
        
        $data['news'] = $this->news->find( $id, 1 );
        if( empty($data['news']) ) show_404();
        
        $this->template->render_to( 'content', $this->view.'show', $data )->show();        
    }

}