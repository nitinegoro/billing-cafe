<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtables extends CI_Model 
{

	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		if($this->input->get('status') != '')
			$this->db->where('status', $this->input->get('status'));

		if($this->input->get('query') != '')
			$this->db->like('name', $this->input->get('query'));

		$this->db->order_by('table_ID', 'desc');

		if($type == 'result')
		{
			return $this->db->get('tables', $limit, $offset)->result();
		} else {
			return $this->db->get('tables')->num_rows();
		}
	}

}

/* End of file Mtables.php */
/* Location: ./application/models/Mtables.php */