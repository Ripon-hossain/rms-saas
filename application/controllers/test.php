 <?php 
 class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

        public function login()
        {
            $tenant_id = $this->input->post('tenant_id');
            $username = $this->input->post('username');
            $password = md5($this->input->post('password')); // Encrypt Password

            // Get tenant database info from master DB
            $tenant = $this->db->get_where('tenants', ['tenant_id' => $tenant_id])->row();

            if ($tenant) {
                // Store tenant database details in session
                $this->session->set_userdata([
                    'tenant_db'   => $tenant->database_name,
                    'tenant_user' => $tenant->db_username,
                    'tenant_pass' => $tenant->db_password,
                ]);

                // Now connect to tenant database and check login
                $tenant_db = $this->load->database([
                    'dsn'      => '',
                    'hostname' => 'localhost',
                    'username' => $tenant->db_username,
                    'password' => $tenant->db_password,
                    'database' => $tenant->database_name,
                    'dbdriver' => 'mysqli',
                    'dbprefix' => '',
                    'pconnect' => FALSE,
                    'db_debug' => (ENVIRONMENT !== 'production'),
                    'cache_on' => FALSE,
                    'char_set' => 'utf8',
                    'dbcollat' => 'utf8_general_ci',
                ], TRUE);

                $user = $tenant_db->get_where('users', ['username' => $username, 'password' => $password])->row();

                if ($user) {
                    $this->session->set_userdata([
                        'user_id'    => $user->id,
                        'tenant_id'  => $tenant_id,
                        'logged_in'  => TRUE,
                    ]);

                    redirect('dashboard');
                } else {
                    echo "Invalid login!";
                }
            } else {
                echo "Tenant not found!";
            }
        }
}
