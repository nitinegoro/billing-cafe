<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Muser extends CI_Model {

	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		$this->db->join('user_role_access', 'users.role_id = user_role_access.role_id', 'left');
		// searching fields data
		//$this->db->where_not_in('user_id', 1);
		
		if($this->input->get('q') != '')
			$this->db->like('full_name', $this->input->get('q'));
		if($this->input->get('q') != '')
			$this->db->or_like('user_email', $this->input->get('q'));

		if($type == 'result')
		{
			return $this->db->get('users', $limit, $offset)->result();
		} else {
			return $this->db->get('users')->num_rows();
		}
	}

	public function get($param = 0)
	{
		return $this->db->get_where('users', array('user_ID' => $param))->row();
	}

	/**
	 * Cek Validasi Kode Produk
	 *
	 * @return Bolean
	 **/
	public function check()
	{
		if($this->input->post('user_ID') != '')
		{
			$get = $this->get($this->input->post('user_ID'));

			$this->db->where('user_ID', $this->input->post('user_ID'))
					 ->where_not_in('username', $get->username);			
		} else {
			$this->db->where('username', $this->input->post('username'));	
		}

		return $this->db->get('users')->num_rows();
	}

	/**
	 * Inserting data
	 *
	 * @return String
	 **/
	public function insert()
	{
		$user = array(
			'username' => $this->input->post('username'),
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'fullname' => $this->input->post('full_name'),
			'email' => $this->input->post('email'),
			'phone' => $this->input->post('phone'),
			'registered' => date('Y-m-d H:i:s'),
			'role_id' => $this->input->post('role')
		);

		$this->db->insert('users', $user);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Success adding user.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Failed to saving data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	/**
	 * Updating data
	 *
	 * @param Integer ID_user
	 * @return String
	 **/
	public function update($param = 0)
	{
		$get = $this->get($param);

		$user = array(
			'fullname' => (!$this->input->post('full_name')) ? $get->fullname : $this->input->post('full_name'),
			'email' => (!$this->input->post('email')) ? $get->email : $this->input->post('email'),
			'phone' => (!$this->input->post('phone')) ? $get->phone : $this->input->post('phone'),
			'role_id' => (!$this->input->post('role')) ? $get->role_id : $this->input->post('role')
		);

		$this->db->update('users', $user, array('user_ID' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' User Updated.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Failed to saving data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	/**
	 * Deleting data
	 *
	 * @param Integer ID_user
	 * @return String
	 **/
	public function delete($param  = 0)
	{
		$get = $this->get($param);

		$this->db->delete('users', array('user_ID' => $param));

		$this->template->alert(
			' Users deleted.', 
			array('type' => 'success','icon' => 'check')
		);
	}


	/**
	 * Multiple Update user
	 *
	 * @return string
	 **/
	public function multiple_update()
	{
		if(is_array($this->input->post('users')))
		{
			foreach ($this->input->post('users') as $key => $value) 
			{
				$get = $this->get($value);

				$user = array(
					'fullname' => (!$this->input->post('full_name')[$key]) ? $get->fullname : $this->input->post('full_name')[$key],
					'email' => (!$this->input->post('email')[$key]) ? $get->email : $this->input->post('email')[$key],
					'phone' => (!$this->input->post('phone')[$key]) ? $get->phone : $this->input->post('phone')[$key],
					'role_id' => (!$this->input->post('role')[$key]) ? $get->role_id : $this->input->post('role')[$key]
				);

				$this->db->update('users', $user, array('user_ID' => $value));
			}
			$this->template->alert(
				' Users changes.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Failed to saving data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	/**
	 * Multiple Delete user
	 *
	 * @return string
	 **/
	public function multiple_delete()
	{
		if(is_array($this->input->post('users')))
		{
			foreach ($this->input->post('users') as $key => $value) 
			{
				$this->db->delete('users', array('user_ID' => $value));
			}
			$this->template->alert(
				' Users deleted.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Failed to remove.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	/**
	 * Update passowrd and username account
	 *
	 * @param session id
	 * @return String
	 **/
	public function update_account()
	{
		$get = $this->get($this->session->userdata('user')->user_ID);

		$old_pass = password_hash($this->input->post('old_pass'), PASSWORD_DEFAULT);
		$new_pass = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

		$user = array(
			'username' => $this->input->post('username'),
			'password' => (!$this->input->post('password')) ? $old_pass : $new_pass,
		);

		$this->db->update('users', $user, array('user_ID' => $get->user_ID));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Login setting changes.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Failed to saving data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	/**
	 * Get Role Acces (tb_role_access)
	 *
	 * @param Integer
	 * @return Query
	 **/
	public function get_role($role = FALSE)
	{
		if ($role == TRUE) 
		{
			$query = $this->db->query("SELECT role_id, role_name, description, role FROM user_role_access WHERE role_id = ?", array($role));

		} 
		else {
			$query = $this->db->query("SELECT role_id, role_name, description, role FROM user_role_access");
		}

		return $query;
	}

	/**
	 * Handle Insert Privileges
	 *
	 * @return string
	 **/
	public function insertPrivileges()
	{
		$data = array(
			'role_name' => $this->input->post('name'),
			'description' => $this->input->post('description'),
			'role' => json_encode($this->input->post('role')) 
		);

		$this->db->insert('user_role_access', $data);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Success adding Privileges.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Failed to saving data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	/**
	 * Handle Insert Privileges
	 *
	 * @return string
	 **/
	public function updatePrivileges($param = 0)
	{
		$data = array(
			'role_name' => $this->input->post('name'),
			'description' => $this->input->post('description'),
			'role' => json_encode($this->input->post('role')) 
		);

		$this->db->update('user_role_access', $data, array('role_id' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Privileges Changes.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Failed to saving data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	/**
	 * Get data role (Convert to string)
	 *
	 * @return string
	 **/
	public function role($json, $module_number = 0, $obj = 'menu')
	{
		$data = json_decode($json);
		$role_value = $data[$module_number]->$obj;
		return $role_value;
	}

	/**
	 * Get data role (Convert to Array)
	 *
	 * @return string
	 **/
	public function getRole($json, $module_name = '')
	{
		$data = json_decode($json);
		//$role_value = $data[$module_name];
		foreach($data as $key => $value)
		{
			switch ($module_name) 
			{
				case $key:
					if(is_array($value) == FALSE)
						continue;
					return $value;
					break;
			}
		}
	}

	/**
	 * undocumented class variable
	 *
	 * @var string
	 **/
	public function deletePrivileges($param = 0)
	{
		$this->db->delete('tb_role_access', array('role_id' => $param));

		$this->db->update('tb_users', array('role_id' => 2), array('role_id' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Success deleting Privileges.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Failed to remove data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}
}

/* End of file Muser.php */
/* Location: ./application/models/Muser.php */