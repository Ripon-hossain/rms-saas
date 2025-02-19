<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CacheController extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
    }

    public function clearCache()
    {
        $this->load->helper('file');
        delete_files(APPPATH . 'cache/', TRUE); // Clears all cached files
        $this->session->set_flashdata('message',display('delete_successfully'));

        redirect("login");
    }
}

