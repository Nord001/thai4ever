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
    public function index( $page=0 ){
        $data = array();
        
        $this->load->model( array('news') );
		$per_page = 12;

        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li class="first">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="last">';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        
        $config['base_url']		= '/page/';
        $config['num_links'] 	= 6;
        $config['total_rows']	= $this->news->count();
        $config['per_page']		= $per_page;
        $config['cur_page']		= $page;

		$config['uri_segment'] = 2;
		$config['page_query_string'] = FALSE;
        $this->load->library('pagination', $config);

		$data['page']		= $page;
		$data['pagination'] = $this->pagination->create_links();

		$data['news']		= $this->news->find( '', $per_page, $page );
        
//        $data['news'] = $this->news->find();
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