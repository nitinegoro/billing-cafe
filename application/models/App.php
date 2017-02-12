<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model Pengaturan Aplikasi (Prepare Applicaton) 
 *
 * @see https://github.com/nitinegoro/billing-cafe
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 */

class App extends CI_Model 
{

	private $data = array();

	public function __construct()
	{
		parent::__construct();

	}

	/**
	 * Get data option
	 *
	 * @param String (option_name)
	 * @return string
	 **/
	public function get($value='')
	{
		if(is_string($value))
		{
			$this->db->select('option_value');

			$query = $this->db->get_where('options', array('option_name' => $value));

			if(!$query->num_rows())
				return false;

			return $query->row()->option_value;
		} else {
			return false;
		}
	}

	/**
	 * updating data option
	 *
	 * @param String (option_name)
	 * @return Boolean
	 **/
	public function update($name = '', $value = '')
	{
		if(is_string($name) OR $name != '')
		{
			$query = $this->db->query("UPDATE options SET option_value = ? WHERE option_name = ?", array($value, $name));
			return $this->db->affected_rows();
		} else {
			return false;
		}
	}


	/**
	 * Get data Cashier
	 *
	 * @return Result
	 **/
	public function cashier()
	{
		return $this->db->get("users")->result();
	}

}

/* End of file Option.php */
/* Location: ./application/models/Option.php */