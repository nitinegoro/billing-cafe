<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Msales_category extends CI_Model 
{

	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		if($this->input->get('query') != '')
			$this->db->like('product_sales', $this->input->get('query'));

		$this->db->order_by('ps_ID', 'desc');

		if($type == 'result')
		{
			return $this->db->get('product_sales', $limit, $offset)->result();
		} else {
			return $this->db->get('product_sales')->num_rows();
		}
	}

	public function get($param = 0)
	{
		return $this->db->get_where('product_sales', array('ps_ID' => $param))->row();
	}

	public function create()
	{
		$product = array(
			'product_sales' => $this->input->post('name'),
			'description_sales' => $this->input->post('description'),
		);

		$this->db->insert('product_sales', $product);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Category Product Added.', 
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
			'product_sales' => $this->input->post('name'),
			'description_sales' => $this->input->post('description'),
		);

		$this->db->update('product_sales', $product, array('ps_ID' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Category Product Updated.', 
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
		$this->db->delete('product_sales', array('ps_ID' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Category Product deleted.', 
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
		if(is_array($this->input->post('sales')))
		{
			foreach($this->input->post('sales') as $key => $value)
				$this->db->delete('product_sales', array('ps_ID' => $value));

			$this->template->alert(
				' Category Product deleted.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Empty data selected.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

	public function multiple_update()
	{
		if(is_array($this->input->post('categories')))
		{
			foreach ($this->input->post('categories') as $key => $value) 
			{
				$product = array(
					'product_sales' => $this->input->post('name')[$key],
					'description_sales' => $this->input->post('description')[$key],
				);

				$this->db->update('product_sales', $product, array('ps_ID' => $value));
			}

			$this->template->alert(
				' Category Product Updated.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Empty data selected.', 
				array('type' => 'warning','icon' => 'times')
			);
		}
	}

}

/* End of file Mtables.php */
/* Location: ./application/models/Mtables.php */