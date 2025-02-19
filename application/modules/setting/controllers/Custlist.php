<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Custlist extends MX_Controller {
    
    public function __construct()
    {

        parent::__construct();

       
		$this->db->query('SET SESSION sql_mode = ""');
   
        $this->load->model(array(
                'supplier_model',
                'logs_model',
                'ordermanage/order_model'
            ));

		// $this->load->library('excel');	

    }


	public function list() {


		
		$this->permission->method('setting','reads')->redirect();
        $data['title']    = display('customer_list'); 
        #-------------------------------#       
        #
        #pagination starts
        #
        $config["base_url"] = base_url('setting/customerlist/index');
        $config["total_rows"]  = $this->supplier_model->countcustomerlist();
        $config["per_page"]    = 25;
        $config["uri_segment"] = 4;
        $config["last_link"] = "Last"; 
        $config["first_link"] = "First"; 
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';  
        $config['full_tag_open'] = "<ul class='pagination col-xs pull-right'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["customerlist"] = $this->supplier_model->customerlist($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        #
        #pagination ends
        #   
        $data['module'] = "setting";
        $data['page']   = "customerlist"; 
        echo Modules::run('template/layout', $data);
	}
 
}
