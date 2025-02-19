<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'currency_model',
			'logs_model',
			'setting_model',
			'tenant_model'
		));

		$this->load->model('dashboard/user_model'); 
	}

	public function index($id = null)
	{ 
		$this->permission->method('setting', 'read')->redirect();
		$data['title']    = display('company setting list');
		#-------------------------------#       
		#
		#pagination starts
		#

		$config["base_url"] = base_url('setting/company/index');
		$config["total_rows"]  = $this->setting_model->settinglist();

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
		$data['languageList'] = $this->languageList();
		$data['currencyList'] = $this->setting_model->currencyList();

		$data['settings'] = $this->setting_model->settinglist($config["per_page"], $page);
		$data['tenants'] = $this->tenant_model->read();

		// $data["links"] = $this->pagination->create_links();

		if (!empty($id)) {
			$data['title'] = display('currency_edit');
			$data['intinfo']   = $this->setting_model->findById($id);
		}
		#
		#pagination ends
		#   
		$data['module'] = "setting";
		$data['page']   = "companysettinglist";

		echo Modules::run('template/layout', $data);
	}



	public function create()
	{
		$data['title']    = display('add_user');
		/*-----------------------------------*/
		$this->form_validation->set_rules('firstname', display('firstname'), 'required|max_length[50]');
		$this->form_validation->set_rules('lastname', display('lastname'), 'required|max_length[50]');
		#------------------------#
		if (!empty($id)) {
			$this->form_validation->set_rules('email', display('email'), "required|valid_email|max_length[100]");
		} else {
			$this->form_validation->set_rules('email', display('email'), 'required|valid_email|is_unique[user.email]|max_length[100]');
		}
		#------------------------#
		$this->form_validation->set_rules('password', display('password'), 'required|max_length[32]|md5');
		$this->form_validation->set_rules('about', display('about'), 'max_length[1000]');
		$this->form_validation->set_rules('status', display('status'), 'required|max_length[1]');


		/*-----------------------------------*/
		$data['user'] = (object)$userLevelData = array(
			'id' 		  => $this->input->post('id'),
			'firstname'   => $this->input->post('firstname', true),
			'lastname' 	  => $this->input->post('lastname', true),
			'email' 	  => $this->input->post('email', true),
			'password' 	  => md5($this->input->post('password')),
			'about' 	  => $this->input->post('about', true),
			'last_login'  => null,
			'last_logout' => null,
			'counter' => $this->input->post('ismonitor'),
			'ip_address'  => null,
			'status'      => $this->input->post('status', true),
			'is_admin'    => 0
		);

		$data['tenant'] = (object)$tenantLevelData = array(
			'firstname'   => $this->input->post('firstname', true),
			'lastname' 	  => $this->input->post('lastname', true),
			'email' 	  => $this->input->post('email', true),
			'db_name' 	  => $this->input->post('db_name', true),
			'db_username' => $this->input->post('db_username', true),
			'db_password' => $this->input->post('db_password'),
			'status'      => $this->input->post('status', true),
		);

	
		/*-----------------------------------*/
		if ($this->form_validation->run()) {
			try {
				// Start Transaction
				$this->db->trans_begin();
		
				// Company user creation
				if (!$this->user_model->create($userLevelData)) {
					throw new Exception(display('user_creation_failed'));
				}
		
				// Tenant creation
				if (!$this->tenant_model->create($tenantLevelData)) {
					throw new Exception(display('tenant_creation_failed'));
				}
		
				// If everything is fine, commit the transaction
				$this->db->trans_commit();
				$this->session->set_flashdata('message', display('save_successfully'));
			} catch (Exception $e) {
				// Rollback in case of any error
				$this->db->trans_rollback();
				$this->session->set_flashdata('exception', $e->getMessage());
			}
		
			// Redirect to settings page
			redirect("setting/company/index");
		}
		
	}


	public function generateUniqueCompanyId()
	{
		$maxAttempts = 10; // Prevent infinite loop
		$attempt = 0;

		do {
			$company_id = rand(100000, 999999); // Generate 6-digit number
			$this->db->select('1')->from('setting')->where('company_id', $company_id)->limit(1);
			$exists = $this->db->count_all_results();
			$attempt++;

			if ($attempt >= $maxAttempts) {
				throw new Exception("Failed to generate a unique company ID after $maxAttempts attempts.");
			}
		} while ($exists > 0);

		return $company_id;
	}


	public function updateintfrm($id)
	{

		$this->permission->method('setting', 'update')->redirect();
		$data['title'] = display('currency_edit');
		$data['intinfo']   = $this->setting_model->findById($id);
		$data['module'] = "setting";
		$data['page']   = "companysettingedit";

		dd($data['intinfo']);

		$this->load->view('setting/companysettingedit', $data);
	}

	public function languageList()
	{
		if ($this->db->table_exists("language")) {

			$fields = $this->db->field_data("language");

			$i = 1;
			foreach ($fields as $field) {
				if ($i++ > 2)
					$result[$field->name] = ucfirst($field->name);
			}

			if (!empty($result)) return $result;
		} else {
			return false;
		}
	}

	public function delete($id = null)
	{
		$this->permission->module('setting', 'delete')->redirect();
		$logData = array(
			'action_page'         => display('currency_list'),
			'action_done'     	 => "Delete Data",
			'remarks'             => "Currency Deleted",
			'user_name'           => $this->session->userdata('fullname'),
			'entry_date'          => date('Y-m-d H:i:s'),
		);
		if ($this->setting_model->delete($id)) {
			#Store data to log table.
			$this->logs_model->log_recorded($logData);
			#set success message
			$this->session->set_flashdata('message', display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception', display('please_try_again'));
		}
		redirect('setting/company/index');
	}
}
