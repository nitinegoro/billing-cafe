<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtransaction extends CI_Model 
{
	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		$this->db->order_by('payment_ID', 'desc');

		if($type == 'result')
		{
			return $this->db->get('payments', $limit, $offset)->result();
		} else {
			return $this->db->get('payments')->num_rows();
		}
	}
	

}

/* End of file Mtransaction.php */
/* Location: ./application/models/Mtransaction.php */