<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DatabaseHook {

    public function switchDatabase() {
        $CI =& get_instance();
        $CI->load->library('session');
        $CI->load->database(); // Load default database


        // Check if a tenant database is set in session
        if ($CI->session->userdata('client_db')) {
            $tenant_db = $CI->session->userdata('client_db');

            // Define new DB connection settings
            $db_config = array(
                'dsn'   => '',
                'hostname' => 'localhost',
                'username' => 'root',
                'password' => '',
                'database' => $tenant_db,
                'dbdriver' => 'mysqli',
                'dbprefix' => '',
                'pconnect' => FALSE,
                'db_debug' => (ENVIRONMENT !== 'production'),
                'cache_on' => FALSE,
                'char_set' => 'utf8',
                'dbcollat' => 'utf8_general_ci',
                'swap_pre' => '',
                'encrypt'  => FALSE,
                'compress' => FALSE,
                'stricton' => FALSE,
                'failover' => [],
                'save_queries' => TRUE
            );

            // Switch database dynamically
            $CI->db = $CI->load->database($db_config, TRUE);
        }
    }
}
