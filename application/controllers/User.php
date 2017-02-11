<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Application 
{
	public $data = array();

	public function __construct()
	{
		parent::__construct();

		$this->load->js(base_url('assets/app/user.js'));

		$this->load->library(array('form_validation'));

		$this->load->model('muser', 'user');

		$this->breadcrumbs->unshift(1, 'Settings', 'user');
	}

	public function index()
	{
		$this->breadcrumbs->unshift(2, 'All Users', 'user');

		$this->page_title->push('Settings', 'All Users');

		// set pagination
		$config = $this->template->pagination_list();
		$config['base_url'] = site_url("user?q={$this->input->get('q')}");
		$config['per_page'] = 20;
		$config['total_rows'] = $this->user->get_all(null, null, 'num');
		$config['uri_segment'] = 3;

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "All Users",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'users' => $this->user->get_all($config['per_page'], $this->input->get('page')),
			'role_access' => $this->user->get_role()
		);
		$this->template->view('user/semua_user', $this->data);
	}

	public function adduser()
	{
		$this->breadcrumbs->unshift(2, 'All Users', 'user');
		$this->breadcrumbs->unshift(3, 'Add User', 'adduser');
		$this->page_title->push('Settings', 'Add User');

        $this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
        $this->form_validation->set_rules('user_ID', '#', 'trim');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_validate_username');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('pass_again', 'Password Again', 'trim|required|matches[password]');
        $this->form_validation->set_rules('email', 'E-Mail', 'trim|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'trim');
        $this->form_validation->set_rules('role', 'User Privileges', 'trim|required');

        if ($this->form_validation->run() == TRUE)
        {
            $this->user->insert();
            redirect('user');
        } 

		$this->data = array(
			'title' => "Add User",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'role_access' => $this->user->get_role()->result_array()
		);
		$this->template->view('user/add_user', $this->data);
	}


	/**
	 * Auth username from database
	 *
	 * @param String
	 * @return Qeury Result
	 **/
	public function validate_username()
	{
		if($this->user->check() == TRUE)
		{
			$this->form_validation->set_message('validate_username', 'Sorry! Username already in use.');
			return false;
		} else {
			return true;
		}
	}



	/**
	 * Get edit Form user
	 *
	 * @return html output
	 **/
	public function update($param = 0)
	{
		$this->breadcrumbs->unshift(2, 'All Users', 'user');
		$this->breadcrumbs->unshift(3, 'Update User', 'get');
		$this->page_title->push('Settings', 'Update User');

		$this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
        $this->form_validation->set_rules('user_ID', '#', 'trim');
        $this->form_validation->set_rules('email', 'E-Mail', 'trim|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'trim');
        $this->form_validation->set_rules('role', 'User Privileges', 'trim|required');

        if ($this->form_validation->run() == TRUE)
        {
            $this->user->update($param);
            redirect("user/update/{$param}");
        } 

		$this->data = array(
			'title' => "Update User",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'get' => $this->user->get($param),
			'role_access' => $this->user->get_role()->result_array()
		);
		$this->template->view('user/edit_user', $this->data);
	}


	/**
	 * Handle Delete User
	 *
	 * @param Integer ID_user
	 * @return void
	 **/
	public function delete($param = 0)
	{
		$this->user->delete($param);
		redirect('user');
	}

	/**
	 * Handle Multiple Action
	 *
	 * @return String
	 **/
	public function bulkuser()
	{
		switch ($this->input->post('action')) 
		{
			case 'set_update':
				$this->multiple_update();
				break;
			case 'update':
				$this->user->multiple_update();
				redirect('user');
				break;
			case 'delete':
				$this->user->multiple_delete();
				redirect('user');
				break;
			default:
				$this->template->alert(
					' Tidak ada data yang dipilih.', 
					array('type' => 'warning','icon' => 'times')
				);
				break;
		}
	}

	/**
	 * Multiple Form update
	 *
	 * @access private
	 * @return Html Output
	 **/
	private function multiple_update()
	{
		$this->breadcrumbs->unshift(2, 'All Users', 'user');
		$this->breadcrumbs->unshift(3, 'Update User', 'get');
		$this->page_title->push('Settings', 'Update User');

		$this->data = array(
			'title' => "Update User",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'role_access' => $this->user->get_role()->result_array()
		);
		$this->template->view('user/multiple_edit_user', $this->data);
	}


	/**
	 * Get Account Setting page
	 *
	 * @return html output
	 **/
	public function account()
	{
		$this->breadcrumbs->unshift(2, 'Settings', 'account');
		$this->page_title->push('Settings', 'Login Setting');

        $this->form_validation->set_rules('user_ID', '#', 'trim');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[6]|callback_validate_username');
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]');
        $this->form_validation->set_rules('pass_again', 'Password Again', 'trim|matches[password]');
        $this->form_validation->set_rules('old_pass', 'Old Password', 'trim|required|callback_validate_password');

        if ($this->form_validation->run() == TRUE)
        {
			$this->user->update_account();
			redirect('user/account', 'refresh');
        } 

		$this->data = array(
			'title' => "Login Setting",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'get' => $this->user->get( $this->session->userdata('user')->user_ID)
		);
		$this->template->view('user/account', $this->data);
	}

	/**
	 * Mengecek benarnya password lama
	 *
	 * @return String
	 **/
	public function validate_password()
	{
		$password = $this->input->post('old_pass');

		$get = $this->user->get( $this->session->userdata('user')->user_ID);
        // authentifaction dengan password verify
        if (password_verify($password,$get->password)) 
        {
        	return true;
		} else {
			$this->form_validation->set_message('validate_password', 'Sorry! Password not valid.');
			return false;
		}
	}

	/**
	 * Setting Privilegs User
	 *
	 * @return Html Output
	 **/
	public function role()
	{
		$this->breadcrumbs->unshift(2, 'User Privileges', 'role');
		$this->page_title->push('Settings', 'User Privileges');

		$this->data = array(
			'title' => "User Privileges",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'role_access' => $this->user->get_role()->result()
		);
		$this->template->view('user/user_role', $this->data);
	}

	/**
	 * From Add Privilegs User
	 *
	 * @return Html Output
	 **/
	public function addrole()
	{
		$this->breadcrumbs->unshift(2, 'User Privileges', 'role');
		$this->breadcrumbs->unshift(3, 'Add New', 'adduser');
		$this->page_title->push('Settings', 'User Privileges');

		$this->data = array(
			'title' => "Add New Privileges",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files()
		);
		$this->template->view('user/add_role', $this->data);
	}

	/**
	 * Insert Privileges User
	 *
	 * @var string
	 **/
	public function insertrole()
	{
		$this->user->insertPrivileges();
		redirect('user/addrole');
	}

	/**
	 * From Update Privilegs User
	 *
	 * @return Html Output
	 **/
	public function getrole($param = 0)
	{
		$this->breadcrumbs->unshift(2, 'User Privileges', 'user/role');
		$this->breadcrumbs->unshift(3, 'Update', 'adduser');
		$this->page_title->push('Settings', 'User Privileges');

		$this->data = array(
			'title' => "Update Privileges",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'get' => $this->user->get_role($param)->row()
		);

		$this->template->view('user/edit_role', $this->data);
	}

	/**
	 * Update Privileges User
	 *
	 * @return string
	 **/
	public function updaterole($param = 0)
	{
		$this->user->updatePrivileges($param);	
		redirect("user/getrole/{$param}");
	}

	/**
	 * Delete Privileges User
	 *
	 * @return string
	 **/
	public function deleterole($param = 0)
	{
		$this->user->deletePrivileges($param);	
		redirect("user/role");
	}

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */