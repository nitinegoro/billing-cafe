<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Product Model.
 *
 * @see https://github.com/nitinegoro/billing-cafe
 * @version 1.0.1
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 */

class Mproduct extends CI_Model 
{
	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		$this->db->join('product_sales', 'product_item.ps_ID = product_sales.ps_ID', 'left');

		if($this->input->get('status') != '')
			$this->db->where('product_item.status', $this->input->get('status'));

		if($this->input->get('category') != '')
			$this->db->where('product_item.ps_ID', $this->input->get('category'));

		if($this->input->get('query') != '')
			$this->db->like('product_item.product_name', $this->input->get('query'))
					 ->or_like('product_item.code', $this->input->get('query'));

		$this->db->order_by('item_ID', 'desc');

		if($type == 'result')
		{
			return $this->db->get('product_item', $limit, $offset)->result();
		} else {
			return $this->db->get('product_item')->num_rows();
		}
	}

	public function get($param = 0)
	{
		$this->db->join('product_sales', 'product_item.ps_ID = product_sales.ps_ID', 'left');

		return $this->db->get_where('product_item', array('item_ID' => $param))->row();
	}

	public function category()
	{
		return $this->db->get('product_sales')->result();
	}

	public function create()
	{
		$product = array(
			'code' => $this->input->post('code'),
			'ps_ID' => $this->input->post('category'),
			'product_name' => $this->input->post('name'),
			'description_product' => $this->input->post('description'),
			'price' => $this->input->post('price'),
			'status' => $this->input->post('status') 
		);

		$this->db->insert('product_item', $product);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Product Added.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Failed to saving data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	public function update($param = 0)
	{
		$product = array(
			'code' => $this->input->post('code'),
			'ps_ID' => $this->input->post('category'),
			'product_name' => $this->input->post('name'),
			'description_product' => $this->input->post('description'),
			'price' => $this->input->post('price'),
			'status' => $this->input->post('status') 
		);

		$this->db->update('product_item', $product, array('item_ID' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Product changed.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Failed to saving data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	public function delete($param = 0)
	{
		$this->db->delete('product_item', array('item_ID' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Product deleted.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Failed to delete data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	public function multiple_delete()
	{
		if(is_array($this->input->post('products')))
		{
			foreach($this->input->post('products') as $key => $value)
				$this->db->delete('product_item', array('item_ID' => $value));

			$this->template->alert(
				' Product deleted.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Empty selected data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	public function set_status($param = '')
	{
		if(is_array($this->input->post('products')))
		{
			foreach($this->input->post('products') as $key => $value)
				$this->db->update('product_item', array('status' => $param), array('item_ID' => $value));

			$this->template->alert(
				' Product changed.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Empty selected data.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	/**
	 * Cek Validasi Kode Produk
	 *
	 * @return Bolean
	 **/
	public function check_code()
	{
		if($this->input->post('item_ID') != '')
		{
			$get = $this->get($this->input->post('item_ID'));

			$this->db->where('code', $this->input->post('code'))
					 ->where_not_in('item_ID', $get->item_ID);			
		} else {
			$this->db->where('code', $this->input->post('code'));	
		}

		return $this->db->get('product_item')->num_rows();
	}

}

/* End of file Mproduct.php */
/* Location: ./application/models/Mproduct.php */