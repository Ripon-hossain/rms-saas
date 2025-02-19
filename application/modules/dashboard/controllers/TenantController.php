<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TenantController extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('setting/tenant_model'); 
    }

    // Simulate login and store tenant database in session
    public function switchDatabase() {

        $email = "company_demo@gmail.com";

        $tenant = $this->tenant_model->getTenantByEmail($email);


        if ($tenant) {
            $this->session->set_userdata('client_db', $tenant->db_name);
            echo "Switched to database: " . $tenant->db_name;
        } else {
            echo "Client not found!";
        }
    }

    // Verify the current active database
    public function checkDatabase() {
        $query = $this->db->query("SELECT DATABASE() AS db_name");
        $result = $query->row();

        echo "Current Database: " . $result->db_name;
    }


    public function testTenantLookup() {

        
        $email = "company1@gmail.com"; // Replace with a real email
        $tenant_db = $this->Tenant_model->getTenantDatabaseByStaff($email);

        echo $tenant_db;
        
        if ($tenant_db) {
            dd("User found in tenant database: " . $tenant_db);
        } else {
            dd("not found");
        }
    }
}
