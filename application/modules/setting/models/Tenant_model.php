
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tenant_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    private $table = "tenants";

    public function test_function()
    {
        return "Model is working!";
    }

    public function create($data = array())
    {
        return $this->db->insert('tenants', $data);
    }

    public function settinglist($limit = null, $start = null)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }

    public function read()
    {
        return $this->db->select("
				tenants.*, 
				CONCAT_WS(' ', firstname, lastname) AS fullname 
			")
            ->from('tenants')
            ->order_by('id', 'desc')
            ->get()
            ->result();
    }

    public function getTenantByEmail($email)
    {
        $query = $this->db->get_where('tenants', ['email' => $email]);
        return $query->row();
    }

    public function getTenantDatabaseByStaff($email) {
        // Query the default database to get all tenant databases
        $this->db->select('db_name');
        $this->db->from('tenants');
        $tenants = $this->db->get()->result();
    
        foreach ($tenants as $tenant) {
            $tenant_db_name = $tenant->db_name; // Tenant database name
    
            // Create dynamic database config
            $db_config = [
                'dsn'   => '',
                'hostname' => 'localhost', // Change if necessary
                'username' => 'root', // Change to your DB username
                'password' => '', // Change to your DB password
                'database' => $tenant_db_name,
                'dbdriver' => 'mysqli',
                'dbprefix' => '',
                'pconnect' => FALSE,
                'db_debug' => TRUE,
                'cache_on' => FALSE,
                'char_set' => 'utf8',
                'dbcollat' => 'utf8_general_ci',
                'swap_pre' => '',
                'encrypt'  => FALSE,
                'compress' => FALSE,
                'stricton' => FALSE,
                'failover' => [],
                'save_queries' => TRUE
            ];
    
            // Load dynamic database connection
            $tenant_db_conn = $this->load->database($db_config, TRUE);
    
            // Check if the staff exists in this tenant's users table
            $tenant_db_conn->select('id');
            $tenant_db_conn->from('users');
            $tenant_db_conn->where('email', $email);
            $query = $tenant_db_conn->get();
            
            if ($query->num_rows() > 0) {
                return $tenant_db_name; // Return the tenant database where the user exists
            }
        }
    
        return null; // No matching tenant found
    }
    
}
