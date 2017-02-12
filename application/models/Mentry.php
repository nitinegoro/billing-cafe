<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Entry Model page controller.
 *
 * @see https://github.com/nitinegoro/billing-cafe
 * @version 1.0.1
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 */

class Mentry extends CI_Model 
{
	public function get_product_items()
	{
		$this->db->order_by('product_name', 'asc');
		return $this->db->get_where('product_item', array('status' => 'available'))->result();
	}

	public function product_detail($param = 0)
	{
		return $this->db->get_where('product_item', array('item_ID' => $param))->row();
	}

	public function table_check($param = 0, $status = 'pre')
	{
		$query = $this->db->get_where('pre_order', array('table_number' => $param, 'status' => $status));

		return $query->num_rows();
	}
	

}

/* End of file Mentry.php */
/* Location: ./application/models/Mentry.php */