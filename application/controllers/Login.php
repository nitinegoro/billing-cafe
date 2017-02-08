<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Login page controller.
 *
 * @see https://github.com/nitinegoro/billing-cafe
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 */

class Login extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('form_validation','template'));

		$this->load->model(array('app'));
	}

	public function index()
	{
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('main-login');
        } 
        else 
        {
        	$username = $this->input->post('username');
        	$password = $this->input->post('password');

        	// get data user
        	$user = $this->_get_user($username);

        	// authentifaction dengan password verify
        	if (password_verify($password, $user->password)) 
        	{
        		// set session data
        		$this->_set_user_login($user);

        		// if session destroy in other page
        		if( $this->input->get('from_url') != '')
        		{
        			redirect( $this->input->get('from_url') );
        		} else {
        			redirect('main');
        		}

        	} else {
	        	// set error alert
				$this->template->alert(
					'Invalid Username and Password.', 
					array('type' => 'danger','icon' => 'times')
				);
        		$this->load->view('main-login');
        	}
        }
	}


	/**
	 * Auth username from database
	 *
	 * @param String
	 * @return Qeury Result
	 **/
	private function _get_user($username = '')
	{
		// get query prepare statmennts
		$query = $this->db->get_where('users', array('username'=>$username));

		if($query->num_rows() == 1)
		{
			return $query->row();
		} else {
			// hilangkan error object
			return (Object) array('password' => '');
		}
	}

	/**
	 * Handle login verification
	 *
	 * @param String
	 * @return void 
	 **/
	private function _set_user_login($user)
	{
        // set session data
        $user_session = array(
        	'is_login' => TRUE,
        	'ID_user' => $user->user_ID,
        	'user' => $user
        );	
        $this->session->set_userdata( $user_session );
	}
	
	/**
	 * undocumented class variable
	 *
	 * @var string
	 **/
	public function signout()
	{
		$this->session->sess_destroy();
		redirect($this->input->get('from_url'));
	}
}
